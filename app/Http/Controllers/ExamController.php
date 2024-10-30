<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function exams(){
        return view('custom.pages.exam.exams');
    }
}
