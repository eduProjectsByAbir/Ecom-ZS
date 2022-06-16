<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\SubSubcategory;
use Illuminate\Http\Request;

class SubSubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!userCan('subsubcategory.view')){
            abort('403');
        }
        $categories = SubCategory::all();
        $sub_subcategories = SubSubcategory::with('subcategory:id,name')->latest('id')->paginate(10);
        return view('admin.sub_subcategory.index', compact('categories', 'sub_subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!userCan('subsubcategory.store')){
            abort('403');
        }
        $request->validate([
            'name' => 'required|string|max:40|unique:sub_subcategories,name',
            'sub_category_id' => 'required|integer',
        ]);

        $subcategory = SubSubcategory::create($request->except('csrf_token'));

        if($subcategory){
            flashSuccess('Sub Subcategory created successfully!');
            return back();
        }

        flashError('Something went wrong...');
        return back();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubSubcategory  $subSubcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubSubcategory $subSubcategory)
    {
        if(!userCan('subsubcategory.edit')){
            abort('403');
        }
        $subcategoryData = $subSubcategory;
        $categories = SubCategory::all();
        $sub_subcategories = SubSubcategory::with('subcategory:id,name')->latest('id')->paginate(10);
        return view('admin.sub_subcategory.index', compact('subcategoryData', 'categories', 'sub_subcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubSubcategory  $subSubcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubSubcategory $subSubcategory)
    {
        if(!userCan('subsubcategory.update')){
            abort('403');
        }
        $request->validate([
            'name' => 'required|string|max:40|unique:sub_subcategories,name,'.$subSubcategory->id,
            'sub_category_id' => 'required|integer',
        ]);

        $subSubcategory->name = $request->name;
        $subSubcategory->sub_category_id = $request->sub_category_id;
        $subSubcategory->save();

        flashSuccess('Sub Subcategory Updated successfully!');
        return redirect()->route('admin.sub.subcategory.edit', $subSubcategory->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubSubcategory  $subSubcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubSubcategory $subSubcategory)
    {
        if(!userCan('subsubcategory.delete')){
            flashError('Your Don\'t Have Permission to Deleted!');
            return back();
        }

        $subSubcategory->delete();
        flashSuccess('Sub Subcategory Deleted successfully!');
        return redirect()->route('admin.sub.subcategory.index');
    }
}
