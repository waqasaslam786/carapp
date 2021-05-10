<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carmodal;
use App\Models\Brand;
use App\Http\Requests\CarModalRequest;


class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models= Carmodal::latest()->paginate(10);
        return view('models.index',compact('models'));
    }

    public function create()
    {
        $brands=Brand::latest()->get();
        return view('models.create',compact('brands'));
    }

    public function store(CarModalRequest $request)
    {
        $validated=$request->validated();
        Carmodal::create($request->all());
        return redirect()->route('models.index')->with(['success'=>'Models Created Sucessfully']);
    }

    public function show(Carmodal $models)
    {
        return view('models.show',compact('models'));
    }

    public function edit(Carmodal $model)
    {
        $brands=Brand::latest()->get();
        return view('models.create')->with(['model'=>$model,'brands'=>$brands]);
    }

    public function update(CarModalRequest $request,$id)
    {
        $validated=$request->validated();        
        $modal = Carmodal::find($id);
        $modal->name =$request->name;
        $modal->brand_id=$request->brand_id;
        $modal->save();
        return redirect()->route('models.index')->with('success','Models Updated Successfully');  
    }

    public function destroy($id)
    {
        $modal = Carmodal::find($id);
        $modal->delete();
        return redirect()->route('models.index')->with('success','Models Deleted Successfully');
    }
}