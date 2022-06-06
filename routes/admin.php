<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubSubcategoryController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function(){
    Route::get('/login', [AdminController::class, 'loginForm'])->name('admin.login.form');
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['is_admin', 'auth:sanctum,admin', config('jetstream.auth_session'), 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Profile Routes
    Route::controller(AdminProfileController::class)->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', 'show')->name('show');
    Route::get('/edit', 'edit')->name('edit');
    Route::put('/update', 'update')->name('update');
    Route::get('/edit/password', 'editPassword')->name('edit.password');
    Route::put('/update/password', 'updatePassword')->name('update.password');
    Route::delete('/delete', 'distroy')->name('delete');
    Route::get('admin/logout', [AdminController::class, 'destroy'])->name('logout');
    });

    Route::controller(BrandController::class)->prefix('brand')->name('brand.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/create', 'store')->name('store');
        Route::get('/edit/{brand:slug}', 'edit')->name('edit');
        Route::put('/update/{brand:slug}', 'update')->name('update');
        Route::delete('/delete/{brand:slug}', 'destroy')->name('delete');
    });

    Route::controller(CategoryController::class)->prefix('category')->name('category.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/create', 'store')->name('store');
        Route::get('/edit/{category:slug}', 'edit')->name('edit');
        Route::put('/update/{category:slug}', 'update')->name('update');
        Route::delete('/delete/{category:slug}', 'destroy')->name('delete');
    });

    Route::controller(SubCategoryController::class)->prefix('subcategory')->name('subcategory.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/create', 'store')->name('store');
        Route::get('/edit/{subCategory:slug}', 'edit')->name('edit');
        Route::put('/update/{subCategory:slug}', 'update')->name('update');
        Route::delete('/delete/{subCategory:slug}', 'destroy')->name('delete');
    });

    Route::controller(SubSubcategoryController::class)->prefix('sub/subcategory')->name('sub.subcategory.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/create', 'store')->name('store');
        Route::get('/edit/{subSubcategory:slug}', 'edit')->name('edit');
        Route::put('/update/{subSubcategory:slug}', 'update')->name('update');
        Route::delete('/delete/{subSubcategory:slug}', 'destroy')->name('delete');
    });

    Route::controller(ProductController::class)->prefix('product')->name('product.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{product:slug}', 'edit')->name('edit');
        Route::put('/update/{product:slug}', 'update')->name('update');
        Route::delete('/delete/{product:slug}', 'destroy')->name('delete');
        Route::post('/get/subcategory', 'getSubcategories')->name('getSubcategories');
        Route::post('/get/sub/subcategory', 'getSub_Subcategories')->name('getSub_subcategories');
        Route::get('/status/change', 'status_change')->name('toggle.status');

        Route::get('/multiple/image/{id}', 'createMultipleImage')->name('create.multiple.image');
        Route::post('/store//multiple/image/{id}', 'storeMultipleImage')->name('store.multiple.image');
        Route::delete('/delete/image/{id}', 'destroyImage')->name('delete.image');
    });

    Route::controller(SliderController::class)->prefix('slider')->name('slider.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/create', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('delete');
        Route::get('/status/change', 'status_change')->name('toggle.status');
    });
});