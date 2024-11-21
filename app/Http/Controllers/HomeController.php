<?php

namespace App\Http\Controllers;

use App\Models\CustomExam;
use App\Models\PreviousExamCategory;
use App\Models\Subject;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function landingPage(){
        $exam_categories = PreviousExamCategory::where('status',1)->latest()->get();
        $subjects = Subject::with('questions')
                ->where('status', 1)
                ->whereHas('questions')
                ->get();
        
        $custom_exams = CustomExam::where('status', 1)->latest()->get();
        $team_members = TeamMember::where('status', 1)->latest()->get();
        return view('custom.pages.landing', compact('team_members','exam_categories','subjects','custom_exams'));
    }
    public function about(){
        return view('custom.pages.about');
    }
    public function contact(){
        return view('custom.pages.contact');
    }
}
