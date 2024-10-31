<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\RedirectIfNotAuthenticated;
use Illuminate\Support\Facades\Route;



Route::middleware(['web'])->group(function () {
    Route::get('/admin',[AdminAuthController::class,'adminAuth'])->name('adminAuth')->middleware(RedirectIfAuthenticated::class);
    Route::post('/admin/login',[AdminAuthController::class,'adminLoginRequest'])->name('adminLoginRequest');

    Route::get('/admin/logout',[AdminAuthController::class,'adminLogout'])->name('adminLogout');
    
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
        Route::group(['prefix' => 'subject-lessons'], function () {
            Route::get('/list', [SubjectLessonsController::class, 'subjectLessonsList'])->name('subjectLessonsList');
            Route::get('/create-or-edit/{id?}', [SubjectLessonsController::class, 'subjectLessonsCreateOrEdit'])->name('subjectLessonsCreateOrEdit');
            Route::post('/store/{id?}', [SubjectLessonsController::class, 'subjectLessonsStore'])->name('subjectLessonsStore');
            Route::get('/delete/{id}', [SubjectLessonsController::class, 'subjectLessonsDelete'])->name('subjectLessonsDelete');
        });
        Route::group(['prefix' => 'subject-topics'], function () {
            Route::get('/list', [SubjectTopicsController::class, 'subjectTopicsList'])->name('subjectTopicsList');
            Route::get('/create-or-edit/{id?}', [SubjectTopicsController::class, 'subjectTopicsCreateOrEdit'])->name('subjectTopicsCreateOrEdit');
            
            Route::post('/store/{id?}', [SubjectTopicsController::class, 'subjectTopicsStore'])->name('subjectTopicsStore');
            Route::get('/delete/{id}', [SubjectTopicsController::class, 'subjectTopicsDelete'])->name('subjectTopicsDelete');
        });
        Route::group(['prefix' => 'years'], function () {
            Route::get('/list', [YearsController::class, 'yearsList'])->name('yearsList');
            Route::get('/create-or-edit/{id?}', [YearsController::class, 'yearsCreateOrEdit'])->name('yearsCreateOrEdit');
            Route::post('/store/{id?}', [YearsController::class, 'yearsStore'])->name('yearsStore');
            Route::get('/delete/{id}', [YearsController::class, 'yearsDelete'])->name('yearsDelete');
        });
        Route::group(['prefix' => 'previous-exams'], function () {
            Route::get('/list', [PreviousExamsController::class, 'previousExamsList'])->name('previousExamsList');
            Route::get('/create-or-edit/{id?}', [PreviousExamsController::class, 'previousExamsCreateOrEdit'])->name('previousExamsCreateOrEdit');
            Route::post('/store/{id?}', [PreviousExamsController::class, 'previousExamsStore'])->name('previousExamsStore');
            Route::get('/delete/{id}', [PreviousExamsController::class, 'previousExamsDelete'])->name('previousExamsDelete');
        });
        Route::group(['prefix' => 'question'], function () {
            Route::get('/list', [QuestionController::class, 'questionList'])->name('questionList');
            Route::get('/create-or-edit/{id?}', [QuestionController::class, 'questionCreateOrEdit'])->name('questionCreateOrEdit');
            Route::post('/store/{id?}', [QuestionController::class, 'questionStore'])->name('questionStore');
            Route::get('/delete/{id}', [QuestionController::class, 'questionDelete'])->name('questionDelete');
        });
        Route::get('get-subject-lessons', [SubjectTopicsController::class, 'getSubjectLessons'])->name('getSubjectLessons');
        Route::get('get-subject-topics', [QuestionController::class, 'getSubjectTopics'])->name('getSubjectTopics');
    });

});

