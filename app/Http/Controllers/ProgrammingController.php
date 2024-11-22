<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgrammingController extends Controller
{

    public function programming()
    {
        return view('custom.pages.programming.programming');
    }
}
