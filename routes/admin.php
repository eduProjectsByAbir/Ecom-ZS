<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AddressController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubSubcategoryController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function(){
    Route::get('/login', [AdminController::class, 'loginForm'])->name('admin.login.form');
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:admin', 'auth:sanctum,admin', config('jetstream.auth_session'), 'verified'])->prefix('admin')->name('admin.')->group(function () {
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

    Route::controller(CouponController::class)->prefix('coupon')->name('coupon.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/create', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('delete');
        Route::get('/status/change/{id}', 'status_change')->name('toggle.status');
    });

    Route::controller(AddressController::class)->prefix('address')->name('address.')->group(function () {
        // country
        Route::prefix('country')->name('country.')->group(function () {
            Route::get('/', 'indexCountry')->name('index');
            Route::post('/create', 'storeCountry')->name('store');
            Route::get('/edit/{id}', 'editCountry')->name('edit');
            Route::put('/update/{id}', 'updateCountry')->name('update');
            Route::delete('/delete/{id}', 'destroyCountry')->name('delete');
        });

        // division
        Route::prefix('division')->name('division.')->group(function () {
            Route::get('/', 'indexDivision')->name('index');
            Route::post('/create', 'storeDivision')->name('store');
            Route::get('/edit/{id}', 'editDivision')->name('edit');
            Route::put('/update/{id}', 'updateDivision')->name('update');
            Route::delete('/delete/{id}', 'destroyDivision')->name('delete');
        });

        // disitrict
        Route::prefix('district')->name('district.')->group(function () {
            Route::get('/', 'indexDistrict')->name('index');
            Route::post('/create', 'storeDistrict')->name('store');
            Route::get('/edit/{id}', 'editDistrict')->name('edit');
            Route::put('/update/{id}', 'updateDistrict')->name('update');
            Route::delete('/delete/{id}', 'destroyDistrict')->name('delete');
        });

        // city
        Route::prefix('city')->name('city.')->group(function () {
            Route::get('/', 'indexCity')->name('index');
            Route::post('/create', 'storeCity')->name('store');
            Route::get('/edit/{id}', 'editCity')->name('edit');
            Route::put('/update/{id}', 'updateCity')->name('update');
            Route::delete('/delete/{id}', 'destroyCity')->name('delete');
        });

    });

    Route::controller(OrderController::class)->prefix('order')->name('order.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/show/{id}', 'show')->name('show');
        Route::get('/invoice/{id}', 'invoice')->name('invoice');
        Route::delete('/delete/{id}', 'destroy')->name('delete');
        Route::get('/status/change/{id}', 'statusChange')->name('toggle.status');
    });
});