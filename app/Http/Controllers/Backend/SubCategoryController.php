<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        if(!userCan('subcategory.view')){
            abort('403');
        }
        $categories = Category::all();
        $subcategories = SubCategory::with('category:id,name')->latest('id')->paginate(10);
        return view('admin.subcategory.index', compact('categories', 'subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!userCan('subcategory.store')){
            abort('403');
        }
        $request->validate([
            'name' => 'required|string|max:40|unique:brands,name',
            'category_id' => 'required|integer',
        ]);

        $subcategory = SubCategory::create($request->except('csrf_token'));

        if($subcategory){
            flashSuccess('Subcategory created successfully!');
            return back();
        }

        flashError('Something went wrong...');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        if(!userCan('subcategory.edit')){
            abort('403');
        }
        $subcategoryData = $subCategory;
        $categories = Category::all();
        $subcategories = SubCategory::with('category:id,name')->latest('id')->paginate(10);
        return view('admin.subcategory.index', compact('subcategoryData', 'categories', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        if(!userCan('subcategory.update')){
            abort('403');
        }
        $request->validate([
            'name' => 'required|string|max:40|unique:categories,name,'.$subCategory->id,
            'category_id' => 'required|integer',
        ]);

        $subCategory->name = $request->name;
        $subCategory->save();

        flashSuccess('Subcategory Updated successfully!');
        return redirect()->route('admin.subcategory.edit', $subCategory->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        if(!userCan('subcategory.delete')){
            abort('403');
        }

        $subCategory->delete();
        flashSuccess('Subcategory Deleted successfully!');
        return redirect()->route('admin.subcategory.index');
    }
}
