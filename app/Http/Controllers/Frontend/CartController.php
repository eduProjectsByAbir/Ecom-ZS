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
                'slug' => $product->slug,
                'color' => $request->color,
                'size' => $request->size
            ],
        ]);

        if($cart && $request->page !== null && request()->has('page') && request('page') == 'details'){
            flashSuccess('Product added to cart!');
            return back();
        }

        return $cart ? response()->json([
            'success' => 'Successfully added to cart',
            'cartCount' => Cart::count(),
        ]): response()->json([
            'error' => 'Something went wrong!',
            'cartCount' => Cart::count(),
        ]);
    }

    public function navCart(){
        $data = [];
        $data['carts'] = Cart::content();
        $data['cartQty'] = Cart::count();
        $data['cartsTotal'] = Cart::total();
        $data['cartsTax'] = Cart::tax();

        return response()->json($data);
    }

    public function cartRemoveProduct(Request $request){
        $cart = Cart::remove(request('id'));
        flashSuccess('Product Removed.');
        return  response()->json([
            'success' => 'Product Removed!',
            'cartCount' => Cart::count(),
        ]);
    }

    public function myCart(){
        $data = [];
        $data['carts'] = Cart::content();
        $data['cartQty'] = Cart::count();
        $data['cartsTotal'] = Cart::total();
        $data['cartsTax'] = Cart::tax();
        $data['cartsPriceTotal'] = Cart::priceTotal();
        $data['cartsSubTotal'] = Cart::subtotal();
        $data['cartsDiscount'] = Cart::discount();
        // return $data;
        return view('frontend.pages.my-cart', $data);
    }

    public function updateCart(Request $request){
        $product = Cart::get($request->id);
        if($request->do == 'plus'){
            $cartUpdate = Cart::update($request->id, $product->qty+1);
        }

        if($request->do == 'minus'){
            $cartUpdate = Cart::update($request->id, $product->qty-1);
        }

        if($cartUpdate){
            return  response()->json([
                'success' => 'Product Updated!',
                'cartData' => $product = Cart::get($request->id),
                'cartTax' => Cart::tax(),
                'cartDiscount' => Cart::discount(),
                'cartsSubTotal' => Cart::subtotal(),
                'cartsTotal' => Cart::total(),
            ]);
        }

        return  response()->json([
            'error' => 'Something went wrong!',
            'cartCount' => Cart::count(),
        ]);
    }
}
