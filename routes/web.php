<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\DashboardController;

include(base_path('routes/commands.php'));

Route::get('/', function () {
    return view( 'welcome');
});

Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function(){
    Route::get('/login', [AdminController::class, 'loginForm'])->name('admin.login.form');
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['is_admin', 'auth:sanctum,admin', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
});

Route::middleware(['is_admin', 'auth:sanctum,admin', config('jetstream.auth_session'), 'verified'])->prefix('admin/profile')->name('admin.profile.')->group(function () {
    Route::get('/', [AdminProfileController::class, 'show'])->name('show');
    Route::get('/edit', [AdminProfileController::class, 'edit'])->name('edit');
    Route::put('/update', [AdminProfileController::class, 'update'])->name('update');
    Route::get('/edit/password', [AdminProfileController::class, 'editPassword'])->name('edit.password');
    Route::put('/update/password', [AdminProfileController::class, 'updatePassword'])->name('update.password');
    Route::delete('/delete', [AdminProfileController::class, 'distroy'])->name('delete');
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
