<?php

use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\WebsiteController;
use App\Http\Controllers\Frontend\WishlistController;
use Illuminate\Support\Facades\Route;

Route::controller(WebsiteController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/product/{product:slug}', 'showProduct')->name('showProduct');
    Route::get('/products', 'showProducts')->name('showProducts');
    Route::get('/product/json/{id}', 'getProductJson')->name('fe.getProductJson');
    Route::post('division/list/json', 'divisionListJson')->name('divisionListJson');
    Route::post('district/list/json', 'districtListJson')->name('districtListJson');
    Route::post('city/list/json', 'cityListJson')->name('cityListJson');
});

Route::controller(CartController::class)->group(function () {
    Route::get('/cart', 'myCart')->name('myCart');
    Route::post('/product/addtocart', 'addToCart')->name('addToCart');
    Route::post('/cart/update', 'updateCart')->name('updateCart');
    Route::get('/cart/navcart', 'navCart')->name('navCart');
    Route::get('/cart/remove/product', 'cartRemoveProduct')->name('cartRemoveProduct');
    Route::post('/cart/apply/coupon', 'applyCoupon')->name('applyCoupon');
    Route::get('/cart/remove/coupon', 'removeCoupon')->name('removeCoupon');
});

Route::controller(WishlistController::class)->group(function () {
    Route::post('/product/add-to-wishlist', 'addToWishlist')->name('addToWishlist');
    Route::get('/product/remove/wishlist/{id}', 'removeFromWishlist')->name('remove.wishlist');
});

Route::controller(CheckoutController::class)->group(function () {
    Route::get('/checkout', 'checkout')->name('checkout');
});