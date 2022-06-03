<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
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
        Route::put('/create', 'store')->name('store');
        Route::get('/edit', 'edit')->name('edit');
        Route::put('/update', 'update')->name('update');
        Route::delete('/delete', 'distroy')->name('delete');
    });
});