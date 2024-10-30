<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobSolutionController extends Controller
{
    public function jobSolution(){
        return view('custom.pages.job_solution.job_solution_topic');
    }
}
