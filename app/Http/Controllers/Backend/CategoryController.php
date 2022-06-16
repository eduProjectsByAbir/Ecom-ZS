<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!userCan('category.view')){
            abort('403');
        }
        $categories = Category::withCount('subcategories')->latest('id')->paginate(10);
        return view('admin.category.index', compact('categories'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!userCan('category.store')){
            abort('403');
        }
        $request->validate([
            'name' => 'required|string|max:40|unique:categories,name',
            'icon' => 'nullable|image|max:1024',
        ]);

        $category = Category::create($request->except('csrf_token', 'icon'));

        if($request->hasFile('icon')){
            $url = updateImage($request->file('icon'), 'categories');
            $category->icon = $url;
            $category->save();
        }

        if($category){
            flashSuccess('Category created successfully!');
            return back();
        }

        flashError('Something went wrong...');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if(!userCan('category.edit')){
            abort('403');
        }
        $categoryData = $category;
        $categories = Category::withCount('subcategories')->latest('id')->paginate(10);
        return view('admin.category.index', compact('categories', 'categoryData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if(!userCan('category.update')){
            abort('403');
        }
        $request->validate([
            'name' => 'required|string|max:40|unique:categories,name,'.$category->id,
        ]);

        $category->icon ? $request->validate(['icon' => 'nullable|image|max:1024']) : $request->validate(['icon' => 'required|image|max:1024']);

        $category->name = $request->name;

        if($request->hasFile('icon')){
            deleteImage($category->icon);
            $url = updateImage($request->file('icon'), 'categories');
            $category->icon = $url;
        }

        $category->save();
        if($category){
            flashSuccess('Category Updated successfully!');
            return redirect()->route('admin.category.edit', $category->slug);
        }

        flashError('Something went wrong...');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if(!userCan('category.delete')){
            flashError('Your Don\'t Have Permission to Deleted!');
            return back();
        }

        if($category->icon !== null){
            deleteImage($category->icon);
        }

        $category->delete();
        flashSuccess('Category Deleted successfully!');
        return redirect()->route('admin.category.index');
    }
}
