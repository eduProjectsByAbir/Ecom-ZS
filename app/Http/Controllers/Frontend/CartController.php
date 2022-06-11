<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request){
        $product = Product::findOrFail($request->id);
        $price = $product->price_discount == null ? $product->price :  $product->price-$product->price_discount;
        $cart = Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $price,
            'weight' => 1,
            'options' => [
                'image' => $product->product_thumbnail_url,
                'color' => $request->color,
                'size' => $request->size
            ],
        ]);

        return $cart ? response()->json([
            'success' => 'Successfully added to cart',
            'cartCount' => Cart::count(),
        ]): response()->json([
            'error' => 'Something went wrong!',
            'cartCount' => Cart::count(),
        ]);
    }
}
