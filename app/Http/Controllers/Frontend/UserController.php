<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wishlist;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(auth()->user()->id);
        return view('frontend.user.index', compact('user'));
    }
    
    public function edit()
    {
        $user = User::findOrFail(auth()->user()->id);
        return view('frontend.user.profile', compact('user'));
    }
    public function update(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);
        $request->validate([
            'name' => 'required|string|max:50|min:2',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'required|max:15|min:10',
            'profile_photo_path' => 'nullable|mimes:jpg,jpeg,png|max:1024',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if($request->hasFile('profile_photo_path')){
            deleteImage($user->profile_photo_path);
            $url = updateImage($request->file('profile_photo_path'), 'user/image');
            $user->profile_photo_path = $url;
        }
        $user->save();
        flashSuccess('Profile Updated Successfully!');
        return back();
    }
    
    public function editPassword(){
        $user = User::findOrFail(auth()->user()->id);
        return view('frontend.user.change-password', compact('user'));
    }
    
    public function updatePassword(Request $request){
        $request->validate([
            'current_password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, auth()->user()->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
            'password' => 'required|string|same:password_confirmation|max:30|min:6',
            'password_confirmation' => 'required|string|same:password'
        ]);

        if (!isset($request['current_password']) || !Hash::check($request['current_password'], auth()->user()->password)) {
            flashError('Current Password Doesn\'t Match!');
            return back();
        }

        if(Hash::check($request->current_password, auth()->user()->password)){
            $user = User::findOrFail(auth()->user()->id);
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::guard('web')->logout();
            flashSuccess('Password Changed Successfully!');
            return redirect()->route('login');
        }

        flashError('Something went wrong!');
        return back();
    }

    public function logout(){
        Auth::guard('web')->logout();
        flashSuccess('Successfully Logout!');
        return redirect()->route('login');
    }

    public function wishlist(){
        $wishlists = Wishlist::with('product')->where('user_id', auth('web')->user()->id)->get();
        return view('frontend.pages.wishlist', compact('wishlists'));
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
}
