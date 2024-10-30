@extends('custom.global.master')

@section('content')
    <div class="container-fluid mt-5">
        <div class="row mb-2 align-items-center">
            <h2 class="text-center border-bottom">চাকরি প্রস্তুতি</h2>
            <div class="col-lg-2">
                <div class="row g-0 border overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <button type="button" class="btn btn-primary rounded-0 w-100" data-bs-toggle="offcanvas"
                            data-bs-target="#filterOffcanvas" aria-controls="filterOffcanvas">
                            ফিল্টার করুন
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="row g-0 border overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">

                    <div class="col-lg-4 p-4 d-flex flex-column position-static">
                        <div class="card rounded-0">
                            <div class="card-body">
                                <strong class="d-inline-block mb-2 text-success-emphasis">NRBC Bank PLC || Trainee Assistant
                                    Officer(TAO) (26-10-2024) - <span class="badge bg-success">50</span></strong>
                                <div class="d-flex justify-content-start gap-3 align-items-center">
                                    <div class="mb-1 text-body-secondary border p-2">Nov 12</div>
                                    <div class="mb-1 text-body-secondary border p-2">MCQ</div>
                                    <div class="mb-1 text-body-secondary border p-2">Written</div>
                                </div>
                                <div class="d-flex justify-content-between gap-3 align-items-center">
                                    <a href="{{ route('jobsolutionExamQuestion',['type' => 'mcq', 'slug' => 'nrbc-bank-plc']) }}" class="icon-link gap-1 icon-link-hover stretched-link">
                                        See all Question
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4  p-4 d-flex flex-column position-static">
                        <div class="card rounded-0">
                            <div class="card-body">
                                <strong class="d-inline-block mb-2 text-success-emphasis">NRBC Bank PLC || Trainee Assistant
                                    Officer
                                    (TAO) (26-10-2024)</strong>
                                <div class="d-flex justify-content-start gap-3 align-items-center">
                                    <div class="mb-1 text-body-secondary border p-2">Nov 12</div>
                                    <div class="mb-1 text-body-secondary border p-2">Written</div>
                                </div>
                                <div class="d-flex justify-content-between gap-3 align-items-center">
                                    <a href="{{ route('jobsolutionExamQuestion',['type' => 'mcq', 'slug' => 'nrbc-bank-plc']) }}" class="icon-link gap-1 icon-link-hover stretched-link">
                                        See all Question
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4  p-4 d-flex flex-column position-static">
                        <div class="card rounded-0">
                            <div class="card-body">
                                <strong class="d-inline-block mb-2 text-success-emphasis">NRBC Bank PLC || Trainee Assistant
                                    Officer
                                    (TAO) (26-10-2024)</strong>
                                <div class="d-flex justify-content-start gap-3 align-items-center">
                                    <div class="mb-1 text-body-secondary border p-2">Nov 12</div>
                                    <div class="mb-1 text-body-secondary border p-2">MCQ</div>
                                </div>
                                <div class="d-flex justify-content-between gap-3 align-items-center">
                                    <a href="{{ route('jobsolutionExamQuestion',['type' => 'mcq', 'slug' => 'nrbc-bank-plc']) }}" class="icon-link gap-1 icon-link-hover stretched-link">
                                        See all Question
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- Off-Canvas Filter Sidebar -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="filterOffcanvas" aria-labelledby="filterOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="filterOffcanvasLabel">ফিল্টার অপশন</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <h5 class="mb-3">প্রশ্নের ধরন</h5>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="questionType" id="mcq" value="MCQ">
                <label class="form-check-label" for="mcq">
                    এমসিকিউ (MCQ)
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="questionType" id="written" value="Written">
                <label class="form-check-label" for="written">
                    লিখিত (Written)
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="questionType" id="mcqandwritten" value="MCQandWritten">
                <label class="form-check-label" for="viva">
                    এমসিকিউ এবং লিখিত (MCQ & Written)
                </label>
            </div>
            <hr>
            <!-- Exam Type Title and Select Field -->
            <h5 class="mt-4 mb-3">পরীক্ষার ধরন</h5>
            <select class="form-select" aria-label="Select Exam Type">
                <option selected>পরীক্ষার ধরন নির্বাচন করুন</option>
                <option value="">BCS পরীক্ষা</option>
                <option value="">Bank পরীক্ষা</option>
                <option value="">Teacher পরীক্ষা</option>
            </select>
            <hr>
            <h5 class="mt-4 mb-3">পরীক্ষার সাল</h5>
            <select class="form-select" aria-label="Select Exam Type">
                <option selected>পরীক্ষার সাল নির্বাচন করুন</option>
                <option value="">2019</option>
                <option value="">2020</option>
                <option value="">2021</option>
                <option value="">2022</option>
                <option value="">2023</option>
                <option value="">2024</option>
                <option value="">2025</option>

            </select>
            <hr>
            <button class="btn btn-success rounded-0">ফিল্টার করুন</button>
        </div>
    </div>

    <!-- Offcanvas -->

@endSection
