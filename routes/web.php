<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;




// 


Route::view('/', 'custom.pages.landing');
Route::get('/login', [AuthController::class,'login'])->name('login');
Route::post('/login-request', [AuthController::class,'loginRequest'])->name('loginRequest');

Route::get('/auth/google', [GoogleController::class,'redirectToGoogle'])->name('redirectToGoogle');
Route::get('/auth/google/callback', [GoogleController::class,'googleCallback'])->name('googleCallback');

Route::get('/register', [AuthController::class,'register'])->name('register');
Route::post('/register-request', [AuthController:: class,'registerRequest'])->name('registerRequest');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [AuthController::class,'logout'])->name('logout');
    Route::get('/profile', [AuthController::class,'profile'])->name('profile');
    Route::get('/resume', [AuthController::class,'resume'])->name('resume');
    Route::get('/my-exam', [AuthController::class,'myExam'])->name('myExam');
});

Route::get('/programming', [ProgrammingController::class,'programming'])->name('programming');
Route::get('/admission', [AdmissionController::class,'admission'])->name('admission');

Route::group(['prefix' => 'job-solution'], function () {
    Route::get('/', [JobSolutionController::class, 'jobSolution'])->name('jobSolution');
});

Route::group(['prefix' => 'previous-job-exams'], function () {
    Route::get('/', [PreviousJobExamsController::class, 'previousJobExams'])->name('previousJobExams');
    Route::group(['middleware' => 'auth'], function () {
        Route::get('{type}/{slug}', [PreviousJobExamsController::class, 'previousJobExamsQuestion'])->name('previousJobExamsQuestion');
    });
});

Route::group(['prefix' => 'exams'], function () {
    Route::get('/', [ExamController::class, 'exams'])->name('exams');
});


