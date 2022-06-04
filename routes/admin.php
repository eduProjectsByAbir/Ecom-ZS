<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
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

    Route::controller(SubCategoryController::class)->prefix('subcategory/subcategory')->name('sub.subcategory.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/create', 'store')->name('store');
        Route::get('/edit/{subcategory:slug}', 'edit')->name('edit');
        Route::put('/update/{subcategory:slug}', 'update')->name('update');
        Route::delete('/delete/{subcategory:slug}', 'destroy')->name('delete');
    });
});