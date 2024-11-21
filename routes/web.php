<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;



// Static Pages

    Route::get('/',[HomeController::class,'landingPage'])->name('landingPage');
    Route::get('/about',[HomeController::class,'about'])->name('about');
    Route::get('/contact',[HomeController::class,'contact'])->name('contact');

    // Authentication Routes
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login-request', [AuthController::class, 'loginRequest'])->name('loginRequest');
    Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('redirectToGoogle');
    Route::get('/auth/google/callback', [GoogleController::class, 'googleCallback'])->name('googleCallback');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register-request', [AuthController::class, 'registerRequest'])->name('registerRequest');

    // Authenticated Routes
    Route::middleware('auth')->group(function () {
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
        Route::get('/profile-edit',[AuthController::class,'profileEdit'])->name('profileEdit');
        Route::post('/profile-update/{id}',[AuthController::class,'profileUpdate'])->name('profileUpdate');
        Route::get('/additional-info-edit',[AuthController::class,'additionalInfoEdit'])->name('additionalInfoEdit');
        Route::post('/additional-info-update/{id}',[AuthController::class,'additionalInfoUpdate'])->name('additionalInfoUpdate');
        Route::post('update-profile-image',[AuthController::class,'updateProfileImage'])->name('updateProfileImage');
        Route::get('/resume', [AuthController::class, 'resume'])->name('resume');
        Route::get('/my-exam', [AuthController::class, 'myExam'])->name('myExam');
    });

    // Public Routes for Specific Pages
    Route::get('/programming', [ProgrammingController::class, 'programming'])->name('programming');
    Route::get('/admission', [AdmissionController::class, 'admission'])->name('admission');

    // Job Solution Routes
    Route::prefix('job-solution')->group(function () {
        Route::get('/', [FrontendJobSolutionController::class, 'jobSolution'])->name('jobSolution');
        Route::middleware('auth')->group(function () {
            Route::get('/subject-wise/{slug}/{id}', [FrontendJobSolutionController::class, 'jobSolutionSubjectWise'])->name('jobSolutionSubjectWise');
            Route::get('/subject-wise-questions/{subject_id}', [FrontendJobSolutionController::class, 'subjectWiseQuestions'])->name('subjectWiseQuestions');
            Route::get('/lesson-wise-questions/{lesson_id}/{subject_id}', [FrontendJobSolutionController::class, 'lessonWiseQuestions'])->name('lessonWiseQuestions');
            Route::get('/topic-wise-questions/{topic_id}/{lesson_id}/{subject_id}', [FrontendJobSolutionController::class, 'topicWiseQuestions'])->name('topicWiseQuestions');
            Route::get('/sub-topic-wise-questions/{sub_topic_id}/{topic_id}/{lesson_id}/{subject_id}', [FrontendJobSolutionController::class, 'subTopicWiseQuestions'])->name('subTopicWiseQuestions');
            Route::post('/start-exam', [FrontendJobSolutionController::class, 'startExam'])->name('startExam');
            Route::post('/submit-exam', [FrontendJobSolutionController::class, 'submitExam'])->name('submitExam');
            Route::get('/single-question/{slug}/{id}', [FrontendJobSolutionController::class, 'singleQuestion'])->name('singleQuestion');
        });
    });

    // Previous Job Exams Routes
    Route::prefix('previous-job-exams')->group(function () {
        Route::get('/', [FrontendPreviousJobExamsController::class, 'previousJobExams'])->name('previousJobExams');
        Route::get('/previous-exam-search', [FrontendPreviousJobExamsController::class, 'previousJobExamsSearch'])->name('previousJobExamsSearch');
        Route::middleware('auth')->group(function () {
            Route::get('/questions/{slug}/{id}', [FrontendPreviousJobExamsController::class, 'previousJobExamsQuestion'])->name('previousJobExamsQuestion');
            Route::get('/start-exam/{id}', [FrontendPreviousJobExamsController::class, 'previousJobExamsStartExam'])->name('previousJobExamsStartExam');
            Route::post('/submit-exam',[FrontendPreviousJobExamsController::class,'previousJobExamSubmit'])->name('previousJobExamSubmit');
            Route::get('/exam-solution',[FrontendPreviousJobExamsController::class,'previousJobExamSolution'])->name('previousJobExamSolution');
        });
        
    });

    // Exams Routes
    Route::prefix('custom-exams')->group(function () {
        Route::get('/', [ExamController::class, 'exams'])->name('exams');
        Route::get('/exam-search', [ExamController::class, 'customExamsSearch'])->name('customExamsSearch');
        Route::middleware('auth')->group(function () {
            Route::get('/questions/{id}/{slug}', [ExamController::class, 'customExamsquestions'])->name('customExamsquestions');
            Route::post('submit-ecam',[ExamController::class,'customExamSubmit'])->name('customExamSubmit');
            Route::get('/download-question-pdf',[PDFController::class,'downloadQuestionPdf'])->name('downloadQuestionPdf');
            Route::get('/top-performers',[ExamController::class,'topPerformers'])->name('topPerformers');
            Route::get('/see-all-performer',[ExamController::class,'seeAllPerformer'])->name('seeAllPerformer');
            Route::get('/see-all-performer-data', [ExamController::class,'seeAllPerformerData'])->name('seeAllPerformerData');
        });
    });