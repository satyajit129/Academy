<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\RedirectIfNotAuthenticated;
use Illuminate\Support\Facades\Route;


Route::get('admin/auth',[AdminAuthController::class,'adminAuth'])->name('adminAuth')->middleware(RedirectIfAuthenticated::class);
Route::post('admin/auth/login-request',[AdminAuthController::class,'adminLoginRequest'])->name('adminLoginRequest');


Route::group(['guard' => 'web', 'prefix' => 'admin', 'middleware' => RedirectIfNotAuthenticated::class], function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'adminDashboard'])->name('adminDashboard');
});