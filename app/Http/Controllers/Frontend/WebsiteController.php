<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Carbon\Carbon;

class WebsiteController extends Controller
{
    public function index(){
        $date = Carbon::now()->subDays(7);
        $sliders = Slider::where('status', 1)->latest()->take(3)->get();
        $latestproducts = Product::where('status', 1)->where('created_at', '>=', $date)->latest('id')->limit(6)->get();
        $featuredproducts = Product::where('status', 1)->where('featured', 1)->latest('id')->limit(6)->get();
        $hotproducts = Product::where('status', 1)->where('hot_deals', 1)->latest('id')->limit(6)->get();

        // $cat_products = Category::with('productsLimit')->latest('id')->get();
        $catproducts = Category::latest('id')->get();
        // $cat_products = Category::with(['products' => function($query){
        //                         $query->where('status', 1)->limit(10);
        //                     }])->latest('id')->get();
        // $cat_products = Product::with(['category.products' => function($query){
        //                         $query->where('products.status', 1)->limit(10);
        //                     }])->get();
        return view('frontend.home', compact('sliders', 'latestproducts', 'catproducts', 'featuredproducts', 'hotproducts'));
    }

    public function showProduct($product){
        $productDetails = Product::whereSlug($product)->with('brand','category', 'subcategory', 'sub_subcategory', 'product_images')->firstOrFail();
        $featuredproducts = Product::where('status', 1)->where('featured', 1)->latest('id')->limit(6)->get();
        return view('frontend.pages.product-details', compact('productDetails', 'featuredproducts'));
    }
}