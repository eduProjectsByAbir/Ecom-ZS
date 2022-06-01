<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\DashboardController;
use Illuminate\Support\Facades\Auth;

include(base_path('routes/commands.php'));
include(base_path('routes/frontend.php'));
include(base_path('routes/admin.php'));
include(base_path('routes/backend.php'));

Route::any('/test', function(){
    dd(Auth::guard('user')->user());
});


Route::middleware([
    'auth:sanctum,web',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
