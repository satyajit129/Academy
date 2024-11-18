<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function landingPage(){
        return view('custom.pages.landing');
    }
    public function about(){
        return view('custom.pages.about');
    }
    public function contact(){
        return view('custom.pages.contact');
    }
}
