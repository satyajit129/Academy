<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function landingPage(){
        $team_members = TeamMember::where('status', 1)->latest()->get();
        return view('custom.pages.landing', compact('team_members'));
    }
    public function about(){
        return view('custom.pages.about');
    }
    public function contact(){
        return view('custom.pages.contact');
    }
}
