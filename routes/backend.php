<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\RedirectIfNotAuthenticated;
use Illuminate\Support\Facades\Route;



Route::middleware(['web'])->group(function () {
    Route::get('/admin',[AdminAuthController::class,'adminAuth'])->name('adminAuth')->middleware(RedirectIfAuthenticated::class);
    Route::post('/admin/login',[AdminAuthController::class,'adminLoginRequest'])->name('adminLoginRequest');

   Route::group(['prefix' => 'admin', 'middleware' => RedirectIfNotAuthenticated::class ], function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'adminDashboard'])->name('adminDashboard');
        Route::get('/settings', [SettingsController::class, 'settings'])->name('settings');
        Route::post('/settings-save/{id}', [SettingsController::class, 'settingsSave'])->name('settingsSave');


        Route::group(['prefix' => 'subject'], function () {
            Route::get('/list', [SubjectController::class, 'subjectList'])->name('subjectList');
            Route::get('/create-or-edit/{id?}', [SubjectController::class, 'subjectCreateOrEdit'])->name('subjectCreateOrEdit');
            Route::post('/store/{id?}', [SubjectController::class, 'subjectStore'])->name('subjectStore');
            Route::get('/delete/{id}', [SubjectController::class, 'subjectDelete'])->name('subjectDelete');
        });
        Route::group(['prefix' => 'subject-topics'], function () {
            Route::get('/list', [SubjectTopicsController::class, 'subjectTopicsList'])->name('subjectTopicsList');
            Route::get('/create-or-edit/{id?}', [SubjectTopicsController::class, 'subjectTopicsCreateOrEdit'])->name('subjectTopicsCreateOrEdit');
            Route::post('/store/{id?}', [SubjectTopicsController::class, 'subjectTopicsStore'])->name('subjectTopicsStore');
            Route::get('/delete/{id}', [SubjectTopicsController::class, 'subjectTopicsDelete'])->name('subjectTopicsDelete');
        });
    });

});


