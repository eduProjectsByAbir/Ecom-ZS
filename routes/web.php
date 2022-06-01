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
    dd(Auth::guard('web')->user());
});


