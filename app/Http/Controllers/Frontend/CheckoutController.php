<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AddressCity;
use App\Models\AddressCountry;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(){
        if(auth()->check()){
            if(Cart::total() <= 0){
                flashWarning('Please add product and then checkout...');
                return redirect(route('showProducts'));
            }
            $data = [];
            $data['carts'] = Cart::content();
            $data['cartQty'] = Cart::count();
            $data['cartsTotal'] = round(Cart::total());
            $data['cartsTax'] = round(Cart::tax());
            $data['cartsPriceTotal'] = round(Cart::priceTotal());
            $data['cartsSubTotal'] = round(Cart::subtotal());
            $data['cartsDiscount'] = round(Cart::discount());
            $data['countries'] = AddressCountry::all();

            return view('frontend.pages.checkout', $data);
        }

        flashWarning('Please login or register to checkout...');
        return redirect(route('login'));
    }
}
