<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function(){
    Route::get('/login', [AdminController::class, 'loginForm'])->name('admin.login.form');
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['is_admin', 'auth:sanctum,admin', config('jetstream.auth_session'), 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Profile Routes
    Route::prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [AdminProfileController::class, 'show'])->name('show');
    Route::get('/edit', [AdminProfileController::class, 'edit'])->name('edit');
    Route::put('/update', [AdminProfileController::class, 'update'])->name('update');
    Route::get('/edit/password', [AdminProfileController::class, 'editPassword'])->name('edit.password');
    Route::put('/update/password', [AdminProfileController::class, 'updatePassword'])->name('update.password');
    Route::delete('/delete', [AdminProfileController::class, 'distroy'])->name('delete');
    Route::get('admin/logout', [AdminController::class, 'destroy'])->name('logout');
    });

    Route::prefix('brand')->name('brand.')->group(function () {
        Route::get('/', [AdminProfileController::class, 'index'])->name('index');
        Route::put('/create', [AdminProfileController::class, 'store'])->name('store');
        Route::get('/edit', [AdminProfileController::class, 'edit'])->name('edit');
        Route::put('/update', [AdminProfileController::class, 'update'])->name('update');
        Route::delete('/delete', [AdminProfileController::class, 'distroy'])->name('delete');
    });
});