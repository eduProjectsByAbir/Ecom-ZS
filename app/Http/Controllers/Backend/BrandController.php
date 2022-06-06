<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!userCan('brand.view')){
            abort('403');
        }
        $brands = Brand::latest('id')->paginate(10);
        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        if(!userCan('brand.store')){
            abort('403');
        }
        $request->validate([
            'name' => 'required|string|max:40|unique:brands,name',
            'image' => 'nullable|image|max:1024',
        ]);

        $brand = Brand::create($request->except('csrf_token', 'image'));

        if($request->hasFile('image')){
            $url = updateImage($request->file('image'), 'brands');
            $brand->image = $url;
            $brand->save();
        }

        if($brand){
            flashSuccess('Brand created successfully!');
            return back();
        }

        flashError('Something went wrong...');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        if(!userCan('brand.edit')){
            abort('403');
        }
        $brandData = $brand;
        $brands = Brand::latest('id')->paginate(10);
        return view('admin.brand.index', compact('brands', 'brandData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        if(!userCan('brand.update')){
            abort('403');
        }
        $request->validate([
            'name' => 'required|string|max:40|unique:brands,name,'.$brand->id,
        ]);
        
        $brand->image !== null ? $request->validate(['image' => 'nullable|image|max:1024']) : $request->validate(['image' => 'required|image|max:1024']);

        $brand->name = $request->name;

        if($request->hasFile('image')){
            deleteImage($brand->image);
            $url = updateImage($request->file('image'), 'brands');
            $brand->image = $url;
        }

        $brand->save();
        if($brand){
            flashSuccess('Brand Updated successfully!');
            return redirect()->route('admin.brand.edit', $brand->slug);
        }

        flashError('Something went wrong...');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        if(!userCan('brand.delete')){
            flashError('Your Don\'t Have Permission to Deleted!');
            return back();
        }

        if($brand->image !== null){
            deleteImage($brand->image);
        }

        $brand->delete();
        flashSuccess('Brand Deleted successfully!');
        return redirect()->route('admin.brand.index');
    }
}
