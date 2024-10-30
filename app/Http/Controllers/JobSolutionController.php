<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobSolutionController extends Controller
{
    public function jobSolution()
    {
        return view('custom.pages.jobSolution.jobsolution');
    }
    public function jobsolutionExamQuestion()
    {
        return view('custom.pages.jobSolution.jobsolutionexamquestion');
    }
}
