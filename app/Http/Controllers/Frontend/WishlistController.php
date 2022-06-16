<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request)
    {
        if (auth('web')->check()) {
            $exist = Wishlist::where('user_id', auth('web')->user()->id)->where('product_id', $request->id)->first();
            if (!$exist) {
                Wishlist::create([
                    'user_id' => auth('web')->user()->id,
                    'product_id' => request('id'),
                ]);

                return response()->json([
                    'success' => 'Added To Wishlist!'
                ]);
            } else {
                return response()->json([
                    'success' => 'Already in wishlist!'
                ]);
            }
        } else {
            return response()->json([
                'error' => 'Please login first, then try again!'
            ]);
        }
    }

    public function removeFromWishlist($id)
    {
        if (auth('web')->check()) {
            $removed = Wishlist::findOrFail($id)->delete();
            if ($removed) {
                flashSuccess('Product Removed from Wishlist.');
                return back();
            } else {
                flashError('Something went wrong!');
                return back();
            }
        } else {
            return response()->json([
                'error' => 'Please login first, then try again!'
            ]);
        }
    }
}
