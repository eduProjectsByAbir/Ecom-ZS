<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index(){
        $categories = Category::with('subcategories', 'subcategories.subSubcategories')->latest()->get();
        return view('frontend.home', compact('categories'));
    }
}
