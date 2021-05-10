<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands= Brand::latest()->paginate(10);
        return view('brands.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        // dd($request);
        $validated=$request->validated();
        $brand_result=Brand::create($validated);
        if($brand_result)
        {
            return redirect()->route('brands.index')->with(['success'=>'Brand Created Sucessfully']);
        }
        else
        {
            return redirect()->route('brands.index')->with(['failed'=>'Something Went Wrong']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Brand $brand)
    {
        return view('brands.show',compact('brand'));
    }

    public function edit(Brand $brand)
    {
        return view('brands.create',compact('brand'));
    }

    public function update(BrandRequest $request, Brand $brand)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
        ]);
        
        $updatedbrand=$brand->update($request->all());
        
        if($updatedbrand)
        {
            return redirect()->route('brands.index')->with('success','Brands Updated Successfully');  
        }
        else {
            return redirect()->route('brands.index')->with(['error'=>'Something Went Wrong']);  
        }
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('brands.index')->with('success','Brands Deleted Successfully');
    }
}