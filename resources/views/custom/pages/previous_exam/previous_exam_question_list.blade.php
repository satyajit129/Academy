@extends('custom.global.master')

@section('content')
    <div class="container-fluid mt-5">
        <div class="row mb-2 ">
            <div class="col-lg-3">
                <div class="row g-0 border overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <h4 class="border-bottom text-center">পিএসসি ও অন্যান্য নিয়োগ পরীক্ষা</h4>
                        <ul class="list-group">
                            <li class="list-group-item">১০ম বি সি এস লিখিত পরিক্ষা</li>
                            <li class="list-group-item">১১ম বি সি এস লিখিত পরিক্ষা</li>
                            <li class="list-group-item">১২ম বি সি এস লিখিত পরিক্ষা</li>
                            <li class="list-group-item">১৩ম বি সি এস লিখিত পরিক্ষা</li>
                            <li class="list-group-item">১৪ম বি সি এস লিখিত পরিক্ষা</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card rounded-0">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 >NRBC Bank PLC || Trainee Assistant </h3>
                        <div>
                            <button class="btn btn-primary rounded-0" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#takeExamFilterOffcanvas" aria-controls="takeExamFilterOffcanvas">
                            Start Exam
                        </button>
                        </div>
                        
                    </div>
                    <div class="card-body rounded-0">
                        <div class="d-flex justify-content-between  gap-4 flex-lg-row flex-column">
                            <a href="" class="btn btn-sm btn-outline-info w-100 active">All</a>
                            <a href="" class="btn btn-sm btn-outline-info w-100 ">বাংলা</a>
                            <a href="" class="btn btn-sm btn-outline-info w-100 ">English</a>
                            <a href="" class="btn btn-sm btn-outline-info w-100 ">গনিত</a>
                            <a href="" class="btn btn-sm btn-outline-info w-100 ">তথ্য প্রযুক্তি</a>
                            <a href="" class="btn btn-sm btn-outline-info w-100 ">সাধারন জ্ঞান</a>
                        </div>
                    </div>
                    
                </div>
                <div class="card mt-2 rounded-0">
                    <div class="card-header">
                        <h4 class="card-title text-center">বাংলা</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 mt-2 mb-2 border-bottom">
                                <p>1. চন্দ্র শব্দের চারটি প্রতিশব্দ লিখুন।</p>
                                <div class="d-flex flex-wrap gap-2">
                                    <div class="form-check col-lg-6 col-12">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Default radio 1
                                        </label>
                                    </div>
                                    <div class="form-check col-lg-6 col-12">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Default radio 2
                                        </label>
                                    </div>
                                    <div class="form-check col-lg-6 col-12">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault3">
                                        <label class="form-check-label" for="flexRadioDefault3">
                                            Default radio 3
                                        </label>
                                    </div>
                                    <div class="form-check col-lg-6 col-12">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault4">
                                        <label class="form-check-label" for="flexRadioDefault4">
                                            Default radio 4
                                        </label>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-lg-6 mt-2 mb-2 border-bottom">
                                <p>1. চন্দ্র শব্দের চারটি প্রতিশব্দ লিখুন।</p>
                                <div class="d-flex flex-wrap gap-2">
                                    <div class="form-check col-lg-6 col-12">
                                        <input class="form-check-input" type="radio" name="flexRadioDefaulta"
                                            id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Default radio 1
                                        </label>
                                    </div>
                                    <div class="form-check col-lg-6 col-12">
                                        <input class="form-check-input" type="radio" name="flexRadioDefaulta"
                                            id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Default radio 2
                                        </label>
                                    </div>
                                    <div class="form-check col-lg-6 col-12">
                                        <input class="form-check-input" type="radio" name="flexRadioDefaulta"
                                            id="flexRadioDefault3">
                                        <label class="form-check-label" for="flexRadioDefault3">
                                            Default radio 3
                                        </label>
                                    </div>
                                    <div class="form-check col-lg-6 col-12">
                                        <input class="form-check-input" type="radio" name="flexRadioDefaulta"
                                            id="flexRadioDefault4">
                                        <label class="form-check-label" for="flexRadioDefault4">
                                            Default radio 4
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mt-2 mb-2 border-bottom">
                                <p>1. চন্দ্র শব্দের চারটি প্রতিশব্দ লিখুন।</p>
                                <div class="d-flex flex-wrap gap-2">
                                    <div class="form-check col-lg-6 col-12">
                                        <input class="form-check-input" type="radio" name="flexRadioDefaultb"
                                            id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Default radio 1
                                        </label>
                                    </div>
                                    <div class="form-check col-lg-6 col-12">
                                        <input class="form-check-input" type="radio" name="flexRadioDefaultb"
                                            id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Default radio 2
                                        </label>
                                    </div>
                                    <div class="form-check col-lg-6 col-12">
                                        <input class="form-check-input" type="radio" name="flexRadioDefaultb"
                                            id="flexRadioDefault3">
                                        <label class="form-check-label" for="flexRadioDefault3">
                                            Default radio 3
                                        </label>
                                    </div>
                                    <div class="form-check col-lg-6 col-12">
                                        <input class="form-check-input" type="radio" name="flexRadioDefaultb"
                                            id="flexRadioDefault4">
                                        <label class="form-check-label" for="flexRadioDefault4">
                                            Default radio 4
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="takeExamFilterOffcanvas" aria-labelledby="takeExamFilterOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="takeExamFilterOffcanvasLabel">পরীক্ষা প্রস্তুতি</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
                <div class="mb-3">
                    <label for="questionCount" class="form-label">প্রশ্ন সংখ্যা</label>
                    <input type="number" class="form-control" id="questionCount" name="question_count" value="60">
                </div>
                <div class="mb-3">
                    <label for="examDuration" class="form-label">পরীক্ষার সময় (মিনিট)</label>
                    <input type="number" class="form-control" id="examDuration" name="exam_duration" value="60">
                </div>
                <div class="mb-3">
                    <label for="passMark" class="form-label">পাস মার্ক</label>
                    <input type="number" class="form-control" id="passMark" name="pass_mark" value="25">
                </div>
                <div class="mb-3">
                    <label for="negativeMark" class="form-label">নেগেটিভ মার্ক</label>
                    <input type="number" step="0.1" class="form-control" id="negativeMark" name="negative_mark" value="0.5">
                </div>
                <div class="mb-3">
                    <label for="questionValue" class="form-label">প্রতিটি প্রশ্নের মান</label>
                    <input type="number" class="form-control" id="questionValue" name="question_value" value="1">
                </div>
                <button type="submit" class="btn btn-success rounded-0">পরীক্ষা শুরু করুন</button>
           
        </div>
        
    </div>
@endSection
