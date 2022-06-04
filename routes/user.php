<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\UserController;

Route::middleware(['auth:sanctum,web', config('jetstream.auth_session'), 'verified'])->prefix('user')->name('user.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('home');
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'edit'])->name('profile');
    Route::put('/profile/update', [UserController::class, 'update'])->name('profile.update');
    Route::get('/change/password', [UserController::class, 'editPassword'])->name('profile.password');
    Route::put('/update/password', [UserController::class, 'updatePassword'])->name('profile.password.update');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});