<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreviousJobExamsController extends Controller
{
    public function previousJobExams(){
        return view('custom.pages.previous_exam.previous_exam_list');
    }

    public function previousJobExamsQuestion(){
        return view('custom.pages.previous_exam.previous_exam_question_list');
    }
}
