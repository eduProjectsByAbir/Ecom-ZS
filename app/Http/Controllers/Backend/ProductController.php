<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SubSubcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('brand','category', 'subcategory', 'sub_subcategory', 'product_images')->latest('id')->paginate(15);

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.product.create', compact('brands', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'required|integer',
            'category_id' => 'required|integer',
            'sub_category_id' => 'nullable|integer',
            'sub_subcategory_id' => 'nullable|integer',
            'code' => 'required',
            'qty' => 'required',
            'tags' => 'required',
            'price' => 'required',
            'discount_price' => 'nullable',
            'short_description' => 'required',
            'long_description' => 'nullable',
            'product_thumbnail' => 'required|image|max:1024',
            'hot_deals' => 'nullable',
            'featured' => 'nullable',
            'special_offer' => 'nullable',
            'special_deals' => 'nullable',
        ]);
        
        $product = Product::create($request->except('csrf_token', 'product_thumbnail'));
        
        if($request->hasFile('product_thumbnail')){
            $url = updateImage($request->file('product_thumbnail'), 'product/thumbnails');
            $product->product_thumbnail = $url;
            $product->save();
        }
        
        if($product){
            flashSuccess('Product added successfully!');
            return back();
        }

        flashError('Something went wrong...');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function getSubcategories(Request $request)
    {
        $subcategories = SubCategory::where('category_id', $request->category_id)->get();
        return response()->json($subcategories);
    }

    public function getSub_Subcategories(Request $request)
    {
        $subcategories = SubSubcategory::where('sub_category_id', $request->sub_category_id)->get();
        return response()->json($subcategories);
    }
}
