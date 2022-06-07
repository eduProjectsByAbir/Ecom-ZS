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
        $sliders = Slider::where('status', 1)->take(3)->get();
        $latest_products = Product::where('status', 1)->where('created_at', '>=', $date)->latest('id')->limit(6)->get();
        return view('frontend.home', compact('sliders', 'latest_products'));
    }
}
