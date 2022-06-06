<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
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
        if(!userCan('product.view')){
            abort('403');
        }
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
        if(!userCan('product.create')){
            flashError('Your don\'t have permission for this action!');
            return back();
        }
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
        if(!userCan('product.store')){
            abort('403');
        }
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
            return redirect()->route('admin.product.create.multiple.image', $product->id);
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if(!userCan('product.edit')){
            flashError('Your don\'t have permission for this action!');
            return back();
        }
        $brands = Brand::all();
        $categories = Category::all();
        $subcategory = SubCategory::where('id', $product->sub_category_id)->get();
        $sub_subcategory = SubSubcategory::where('id', $product->sub_subcategory_id)->get();
        return view('admin.product.edit', compact('brands', 'categories', 'subcategory', 'sub_subcategory', 'product'));
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
        if(!userCan('product.update')){
            abort('403');
        }
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
            'color' => 'nullable',
            'size' => 'nullable',
            'discount_price' => 'nullable',
            'short_description' => 'required',
            'long_description' => 'nullable',
            'hot_deals' => 'nullable',
            'featured' => 'nullable',
            'special_offer' => 'nullable',
            'special_deals' => 'nullable',
            'status' => 'nullable',
        ]);

        $product->product_thumbnail ? $request->validate(['product_thumbnail' => 'nullable|image|max:1024']) : $request->validate(['product_thumbnail' => 'required|image|max:1024']);

        $product->name = $request->name;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->sub_subcategory_id = $request->sub_subcategory_id;
        $product->code = $request->code;
        $product->qty = $request->qty;
        $product->tags = $request->tags;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->color = $request->color;
        $product->size = $request->size;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->hot_deals = request('hot_deals', 0);
        $product->featured = request('featured', 0);
        $product->special_offer = request('special_offer', 0);
        $product->special_deals = request('special_deals', 0);
        $product->status = request('status', 0);

        if($request->hasFile('product_thumbnail')){
            deleteImage($product->product_thumbnail);
            $url = updateImage($request->file('product_thumbnail'), 'product/thumbnails');
            $product->product_thumbnail = $url;
        }
        $product->save();

        if($product){
            flashSuccess('Product updated successfully!');
            return back();
        }

        flashError('Something went wrong...');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if(!userCan('product.delete')){
            flashError('Your don\'t have permission for this action!');
            return back();
        }
        if($product->product_thumbnail !== null){
            deleteImage($product->product_thumbnail);
        }

        $product->delete();
        flashSuccess('Product Deleted successfully!');
        return redirect()->route('admin.product.index');
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

    public function createMultipleImage($id){
        $productImages = ProductImage::where('product_id', $id)->latest()->get();
        return view('admin.product.multiple-image', compact('productImages', 'id'));
    }

    public function storeMultipleImage(Request $request, $id){

        foreach ($request->file as $image) {
            if ($image) {
                $url = updateImage($image, 'product/images/');
                ProductImage::create([
                    'product_id' => $id,
                    'image' => $url,
                ]);
            }
        }

        flashSuccess('Product Images Uploaded successfully!');

        return response()->json([
            'message' => 'Product Images Saved Successfully',
            'url' => route('admin.product.create.multiple.image', $id)
        ]);
    }
}
