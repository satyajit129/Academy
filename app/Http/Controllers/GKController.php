<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GKController extends Controller{
    public function GKList(){
        return view('backend.pages.general_knowledge.list');
    }
    public function GKCreateorUpdate($id= null){
        return view('backend.pages.general_knowledge.create_or_update');
    }
}
