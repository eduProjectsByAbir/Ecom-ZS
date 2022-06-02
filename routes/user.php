<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\UserController;

Route::middleware(['auth:sanctum,web', config('jetstream.auth_session'), 'verified'])->prefix('user')->name('user.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('home');
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});