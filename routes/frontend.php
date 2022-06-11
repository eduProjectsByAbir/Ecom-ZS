<?php

use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::controller(WebsiteController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/product/{product:slug}', 'showProduct')->name('showProduct');
    Route::get('/products', 'showProducts')->name('showProducts');
    Route::get('/product/json/{id}', 'getProductJson')->name('fe.getProductJson');
});

Route::controller(CartController::class)->group(function () {
    Route::post('/product/addtocart', 'addToCart')->name('addToCart');
    
    
});