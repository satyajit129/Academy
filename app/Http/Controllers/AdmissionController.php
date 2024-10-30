<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    public function admission()
    {
        return view('custom.pages.admission.admission');
    }
}
