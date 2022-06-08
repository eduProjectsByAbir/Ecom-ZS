<?php

use App\Http\Controllers\Frontend\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::controller(WebsiteController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/product/{product:slug}', 'showProduct')->name('showProduct');
    Route::get('/products', 'showProducts')->name('showProducts');
});