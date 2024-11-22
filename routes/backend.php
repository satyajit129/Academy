<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\RedirectIfNotAuthenticated;
use Illuminate\Support\Facades\Route;



Route::middleware(['web'])->group(function () {
    Route::get('/admin', [AdminAuthController::class, 'adminAuth'])->name('adminAuth')->middleware(RedirectIfAuthenticated::class);
    Route::post('/admin/login', [AdminAuthController::class, 'adminLoginRequest'])->name('adminLoginRequest');

    Route::get('/admin/logout', [AdminAuthController::class, 'adminLogout'])->name('adminLogout');

    Route::group(['prefix' => 'admin', 'middleware' => RedirectIfNotAuthenticated::class], function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'adminDashboard'])->name('adminDashboard');
        Route::get('/settings', [SettingsController::class, 'settings'])->name('settings');
        Route::post('/settings-save/{id}', [SettingsController::class, 'settingsSave'])->name('settingsSave');

        Route::group(['prefix' => 'years'], function () {
            Route::get('/list', [YearsController::class, 'yearsList'])->name('yearsList');
            Route::get('/create-or-edit/{id?}', [YearsController::class, 'yearsCreateOrEdit'])->name('yearsCreateOrEdit');
            Route::post('/store/{id?}', [YearsController::class, 'yearsStore'])->name('yearsStore');
            Route::get('/delete/{id}', [YearsController::class, 'yearsDelete'])->name('yearsDelete');
        });

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

        Route::group(['prefix' => 'subject-sub-topics'], function () {
            Route::get('/list', [SubjectSubTopicsController::class, 'subjectSubTopicsList'])->name('subjectSubTopicsList');
            Route::get('/create-or-edit/{id?}', [SubjectSubTopicsController::class, 'subjectSubTopicsCreateOrEdit'])->name('subjectSubTopicsCreateOrEdit');
            Route::post('/store/{id?}', [SubjectSubTopicsController::class, 'subjectSubTopicsStore'])->name('subjectSubTopicsStore');
            Route::get('/delete/{id}', [SubjectSubTopicsController::class, 'subjectSubTopicsDelete'])->name('subjectSubTopicsDelete');
        });

        Route::group(['prefix' => 'question'], function () {
            Route::get('/list', [QuestionController::class, 'questionList'])->name('questionList');
            Route::get('/create', [QuestionController::class, 'questionCreate'])->name('questionCreate');
            Route::post('/store/{id?}', [QuestionController::class, 'questionStore'])->name('questionStore');
            Route::get('/edit/{id}', [QuestionController::class, 'questionEdit'])->name('questionEdit');
            Route::get('/delete/{id}', [QuestionController::class, 'questionDelete'])->name('questionDelete');
        });
        Route::group(['prefix' => 'previous-exams'], function () {

            Route::get('/list', [PreviousExamsController::class, 'previousExamsList'])->name('previousExamsList');
            Route::get('/create-or-edit/{id?}', [PreviousExamsController::class, 'previousExamsCreateOrEdit'])->name('previousExamsCreateOrEdit');
            Route::post('/store/{id?}', [PreviousExamsController::class, 'previousExamsStore'])->name('previousExamsStore');
            Route::get('/delete/{id}', [PreviousExamsController::class, 'previousExamsDelete'])->name('previousExamsDelete');
            Route::group(['prefix' => 'assign-exam-questions'], function () {
                Route::get('/list', [PreviousExamsController::class, 'assignQuestionsList'])->name('assignQuestionsList');
                Route::get('/assign-questions/{id}', [PreviousExamsController::class, 'assignQuestions'])->name('assignQuestions');
                Route::post('/assign-questions-store', [PreviousExamsController::class, 'assignQuestionsStore'])->name('assignQuestionsStore');
                Route::get('/delete/{previous_exam_id}/{question_id}', [PreviousExamsController::class, 'assignQuestionsDelete'])->name('assignQuestionsDelete');
            });

            Route::group(['prefix' => 'category'], function () {
                Route::get('/list', [PreviousExamsController::class, 'previousExamsCategoryList'])->name('previousExamsCategoryList');
                Route::get('/create-or-edit/{id?}', [PreviousExamsController::class, 'previousExamsCategoryCreateOrEdit'])->name('previousExamsCategoryCreateOrEdit');
                Route::post('/store/{id?}', [PreviousExamsController::class, 'previousExamsCategoryStore'])->name('previousExamsCategoryStore');
                Route::get('/delete/{id}', [PreviousExamsController::class, 'previousExamsCategoryDelete'])->name('previousExamsCategoryDelete');
            });
        });

        Route::group(['prefix' => 'custom-exams'], function () {
            Route::get('/list', [CustomExamsController::class, 'customExamsList'])->name('customExamsList');
            Route::get('/create', [CustomExamsController::class, 'customExamsCreate'])->name('customExamsCreate');

            Route::post('/store-subject-wise-questions', [CustomExamsController::class, 'storeSubjectWiseQuestions'])->name('storeSubjectWiseQuestions');
            Route::post('/store-lesson-wise-questions', [CustomExamsController::class, 'storeLessonWiseQuestions'])->name('storeLessonWiseQuestions');
            Route::post('/store-topic-wise-questions', [CustomExamsController::class, 'storeTopicWiseQuestions'])->name('storeTopicWiseQuestions');
            Route::post('/store-sub-topic-wise-questions', [CustomExamsController::class, 'storeSubTopicWiseQuestions'])->name('storeSubTopicWiseQuestions');

            Route::get('edit/{id}', [CustomExamsController::class, 'customExamsEdit'])->name('customExamsEdit');
            Route::get('/view-questions/{id}', [CustomExamsController::class, 'customExamsViewQuestions'])->name('customExamsViewQuestions');
            Route::get('/download/{id}', [PDFController::class, 'customExamsDownload'])->name('customExamsDownload');
        });

        Route::group(['prefix'=> 'team-members'],function(){
            Route::get('/list',[TeamMemberController::class,'teamMembersList'])->name('teamMembersList');
            Route::get('/create-or-update/{id?}',[TeamMemberController::class,'teamMemberCreateorUpdate'])->name('teamMemberCreateorUpdate');
            Route::post('/store/{id?}',[TeamMemberController::class,'teamMembersStore'])->name('teamMembersStore');
            Route::get('/delete/{id}',[TeamMemberController::class,'teamMemberDelete'])->name('teamMemberDelete');
        });

        Route::group(['prefix' => 'gk'], function(){
            Route::get('/list',[GKController::class,'GKList'])->name('GKList');
            Route::get('/create-or-update/{id?}',[GKController::class,'GKCreateorUpdate'])->name('GKCreateorUpdate');
            Route::post('/store',[GKController::class,'GKStore'])->name('GKStore');
            Route::get('/edit/{date}',[GKController::class,'GKEdit'])->name('GKEdit');
            Route::post('/update/{date}',[GKController::class,'GKUpdate'])->name('GKUpdate');
        });

        Route::get('get-subject-lessons', [SubjectTopicsController::class, 'getSubjectLessons'])->name('getSubjectLessons');
        Route::get('get-subject-topics', [QuestionController::class, 'getSubjectTopics'])->name('getSubjectTopics');
        Route::get('get-subject-sub-topics', [QuestionController::class, 'getSubjectSubTopics'])->name('getSubjectSubTopics');
        Route::get('get-questions', [QuestionController::class, 'getQuestions'])->name('getQuestions');

        Route::get('/get-multiple-subject-lessons', [CustomExamsController::class, 'getMultipleSubjectLessons'])->name('getMultipleSubjectLessons');
        Route::get('/get-multiple-subject-topics', [CustomExamsController::class, 'getMultipleSubjectTopics'])->name('getMultipleSubjectTopics');
        Route::get('/get-multiple-subject-sub-topics', [CustomExamsController::class, 'getMultipleSubjectSubTopics'])->name('getMultipleSubjectSubTopics');
    });

});

