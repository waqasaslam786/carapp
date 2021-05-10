<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carmodal;
use App\Models\Car;
use App\Models\Brand;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CarRequest;

class CarController extends Controller
{
    public function index()
    {        
        $cars= Car::latest()->paginate(10);
        return view('cars.index',compact('cars'));
    }

    public function create()
    {   
        $brands= Brand::latest()->get();
        $modals=Carmodal::latest()->get();
        return view('cars.create')->with(['brands'=>$brands,'modals'=>$modals]);
    }

    public function getModal($brandid=0)
    {  
        $modals['data'] = Carmodal::orderby("name","asc")
            ->select('id','name')
        	->where('brand_id',$brandid)
        	->get();
        return response()->json($modals);
    }

    public function store(CarRequest $request ,Car $car)
     {  
        $validated=$request->validated();
        // Discussion About decode Image

        if($request->image_decode)
        {
            
            $data = $request->image_decode;
            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $image_file = uniqid().'.png';
            $upload_path='storage/image/' . $image_file;
            $image_base = base64_decode($image_array_2[1]);
            file_put_contents($upload_path, $image_base);
        }else {
            $image_file='noimage.jpg';
        }

        // if ($request->file('images')) {
        //     $filenameWithExt = $request->file('images')->getClientOriginalName ();
        //     // Get Filename
        //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //     // Get just Extension
        //     $extension = $request->file('images')->getClientOriginalExtension();
        //     // Filename To store
        //     $fileNameToStore = $filename. '_'. time().'.'.$extension;
        //     // Upload Image
        //     $path = $request->file('images')->storeAs('public/image', $fileNameToStore);
        //  }
        //     // Else add a dummy image
        // else {
        //     $fileNameToStore = 'noimage.jpg';
        // }
        
        $car->name =$request->name;
        $car->brand_id=$request->brand_id;
        $car->car_modal_id=$request->car_modal_id;
        $car->color=$request->color;
        $car->year=$request->year;
        $car->images=$image_file;
        $car_result=$car->save();
        $car_id=$car->id;
        if($car_result && $request->images_uploader!="")
        {
            if ($request->file('images_uploader')) {
                $images = $request->file('images_uploader');
                foreach($images as $image){
                    $filenameWithExt = $image->getClientOriginalName ();
                    // Get Filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    // Get just Extension
                    $extension = $image->getClientOriginalExtension();
                    // Filename To store
                    $fileNameToStore = $filename. '_'. time().'.'.$extension;
                    // Upload Image
                     $path = $image->storeAs('public/image/uploader_images', $fileNameToStore);
                    $images_row[]=$fileNameToStore;
                }    
            }
                // Else add a dummy image
            else {
                $fileNameToStore = 'noimage.jpg';
            }

            $image=new Image;
            $encoded_images=json_encode($images_row);
            $image->car_id=$car_id;
            $image->multiple_images=$encoded_images;
            $m_images=$image->save();
            if(!$m_images){
                return redirect()->route('cars.index')->with(['error'=>'Multiple Images Are Not Upload ']);        
            }
        }

        return redirect()->route('cars.index')->with(['success'=>'Car Created Sucessfully']); 
    }

    public function edit(Car $car)
    {
        $brands= Brand::latest()->get();
        $modals=Carmodal::latest()->get();
        $images = DB::table('images')
                ->where('car_id', '=', $car->id)
                ->first();
                $images_row=json_decode($images->multiple_images);
        return view('cars.create')->with(['car'=>$car, 'brands'=>$brands,'modals'=>$modals,'images_row'=>$images_row]);
    }

    public function update(CarRequest $request, $id)
    {
        // dd($request);
        // $validated=$request->validated();
        // if ($request->file('images')) {

        //     $filenameWithExt = $request->file('images')->getClientOriginalName ();
        //     // Get Filename
        //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //     // Get just Extension
        //     $extension = $request->file('images')->getClientOriginalExtension();
        //     // Filename To store
        //     $fileNameToStore = $filename. '_'. time().'.'.$extension;
        //     // Upload Image
        //     $path = $request->file('images')->storeAs('public/image', $fileNameToStore);
        //     }
        //     // Else add a dummy image
        //     else {
        //     $fileNameToStore = 'noimage.jpg';
        // }

        if($request->image_decode)
        {
            
            $data = $request->image_decode;
            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $image_file = uniqid().'.png';
            $upload_path='storage/image/' . $image_file;
            $image_base = base64_decode($image_array_2[1]);
            file_put_contents($upload_path, $image_base);
        }else {
            $image_file='noimage.jpg';
        }

        $car = Car::find($id);
        $car->name =$request->name;
        $car->brand_id=$request->brand_id;
        $car->car_modal_id=$request->car_modal_id;
        $car->color=$request->color;
        $car->year=$request->year;
        if ($request->image_decode){
            $car->images=$image_file;
        }

        $car_result=$car->save();

        if($car_result && $request->images_uploader!="")
        {
            if ($request->file('images_uploader')) {
                $images = $request->file('images_uploader');
                foreach($images as $image){
                    $filenameWithExt = $image->getClientOriginalName ();
                    // Get Filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    // Get just Extension
                    $extension = $image->getClientOriginalExtension();
                    // Filename To store
                    $fileNameToStore = $filename. '_'. time().'.'.$extension;
                    // Upload Image
                     $path = $image->storeAs('public/image/uploader_images', $fileNameToStore);
                    $images_row[]=$fileNameToStore;
                }    
            }
                // Else add a dummy image
            else {
                $fileNameToStore = 'noimage.jpg';
            }

            $encoded_images=json_encode($images_row);
            $images_result=Image::where('car_id','=',$id)
            ->update(['multiple_images' => $encoded_images]);
            
            if(!$images_result){
                return redirect()->route('cars.index')->with(['error'=>'Multiple Images Are Not Upload ']);        
            }
        }

        return redirect()->route('cars.index')->with('success','Car Updated successfully');
    }

    // Delete Project
    public function destroy($id)
    {
        $car = Car::find($id);
        $car->delete();
        return redirect()->route('cars.index')->with('success','Car Deleted Successfully');
    }
}