<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Image;
use Illuminate\Support\Facades\DB;


class ImageController extends Controller
{
    public function index()
    {

        

$cars = DB::table('images')
            ->join('cars', 'cars.id', '=', 'images.car_id')
            ->select('images.*', 'cars.name')
            ->get();
return view('carimages.index',compact('cars'));
    }

    
    public function create(){
        $cars= car::latest()->get();
        return view('carimages.create',compact('cars'));
    }
    
    public function store(Request $request,Image $imaged)
    {
        if ($request->file('multiple_images')) {
            $images = $request->file('multiple_images');
            foreach($images as $image){
                $filenameWithExt = $image->getClientOriginalName ();
                // Get Filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just Extension
                $extension = $image->getClientOriginalExtension();
                // Filename To store
                $fileNameToStore = $filename. '_'. time().'.'.$extension;
                // Upload Image
                //  $path = $image->move('public/image', $fileNameToStore);
                 $path = $image->storeAs('public/image', $fileNameToStore);
                $images_row[]=$fileNameToStore;
            }

            // if (request()->hasFile('imagePath')){
            //     $uploadedImage = $request->file('imagePath');
            //     $imageName = time() . '.' . $image->getClientOriginalExtension();
            //     $destinationPath = public_path('/images/productImages/');
            //     $uploadedImage->move($destinationPath, $imageName);
            //     $image->imagePath = $destinationPath . $imageName;
            // }


        }
            // Else add a dummy image
        else {
            $fileNameToStore = 'noimage.jpg';
        }
        $encoded_images=json_encode($images_row);
        $imaged->car_id =$request->car_id;
        $imaged->multiple_images=$encoded_images;
        
        $imaged->save();
        return redirect()->route('carimages.index')->with(['success'=>'Car Images Uploaded Sucessfully']);
    }

    public function show($id)
    {        
        $result=Image::find($id);
        $images=json_decode($result->multiple_images);
        return view('carimages.show')->with(['images'=>$images]);
    }
}