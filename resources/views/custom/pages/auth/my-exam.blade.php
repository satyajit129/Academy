@extends('custom.global.app')

@section('custom_css')
    
@endsection

@section('content')
<!-- Page Header Start -->
<div class="container-fluid page-header py-5" style="margin-bottom: 6rem;">
    <div class="container py-5">
        <h1 class="display-3 text-white mb-3 animated slideInDown">বিগত চাকরির পরীক্ষা</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">About</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->
<div class="container-fluid ">
    <div class="row">
        <div class="col-lg-5 bg-light p-3">
            <div class="card rounded-0">
                <div class="card-body">
                    <div class="text-center mb-4 p-4 bg-light rounded shadow-sm">
                        <!-- Profile Image and Info -->
                        <img src="@if (auth()->user()->profile_image == null)
                             {{ asset('images/man.png') }} 
                        @else
                            {{ asset('images/' . auth()->user()->profile_image) }}
                        @endif" alt="Profile Image" class="img-fluid rounded-circle mb-3" style="width: 100px; height: 100px;">
                        <h5>Satyajit Roy (Satyajit)</h5>
                        <p>Member Since: 28 Sep, 2024</p>
                    
                        <!-- Exams Summary Title -->
                        <h4 class="mt-4">My Exams Summary</h4>
                    
                        <!-- Exams Summary Table -->
                        <table class="table table-bordered table-striped table-hover table-sm mt-3">
                            <thead class="table-primary">
                                <tr>
                                    <th class="text-center w-50">Exams</th>
                                    <th class="text-center w-50">{{ $user_custom_exams->count() }}</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <tr>
                                    <td class="text-center w-50">Passed</td>
                                    <td class="text-center w-50">{{ $passed_count }}</td>
                                </tr>
                                <tr>
                                    <td class="text-center w-50">Failed</td>
                                    <td class="text-center w-50">{{ $failed_count }}</td>
                                </tr>
                            </tbody>
                        </table>
                    
                        <!-- Question Summary Table -->
                        <table class="table table-bordered table-striped table-hover table-sm mt-3">
                            <thead class="table-primary">
                                <tr>
                                    <th class="text-center w-50">Question</th>
                                    <th class="text-center w-50">20</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center w-50">Answered</td>
                                    <td class="text-center w-50">1</td>
                                </tr>
                                <tr>
                                    <td class="text-center w-50">Right Answer</td>
                                    <td class="text-center w-50">0</td>
                                </tr>
                                <tr>
                                    <td class="text-center w-50">Wrong Answer</td>
                                    <td class="text-center w-50">0</td>
                                </tr>
                                <tr>
                                    <td class="text-center w-50">Skipped</td>
                                    <td class="text-center w-50">0</td>
                                </tr>
                            </tbody>
                        </table>
                    
                        <!-- Marks Summary Table -->
                        <table class="table table-bordered table-striped table-hover table-sm mt-3">
                            <thead class="table-primary">
                                <tr>
                                    <th class="text-center w-50">Marks</th>
                                    <th class="text-center w-50">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center w-50">Obtained Marks</td>
                                    <td class="text-center w-50">15</td>
                                </tr>
                                <tr>
                                    <td class="text-center w-50">Negative Marks</td>
                                    <td class="text-center w-50">2</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>

        </div>
        <div class="col-lg-7 bg-light p-3">
            <div class="card rounded-0">
                <div class="card-header">
                    <div class="text-center mb-4 py-2 bg-light">
                        <h4 class="mt-4">My Exams</h4>
                        
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="w-50">Showing 1 - 1 of 1 entries</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionExample">
                        <div class="row">
                            @foreach ($user_custom_exams as $index => $user_custom_exam)
                                <div class="col-lg-6 mb-3">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{ $user_custom_exam->id }}">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                                    data-bs-target="#collapse{{ $user_custom_exam->id }}" 
                                                    aria-expanded="true" aria-controls="collapse{{ $user_custom_exam->id }}">
                                                {{ \Carbon\Carbon::parse($user_custom_exam->exam_date_time)->format('j F Y h:i A') }}
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $user_custom_exam->id }}" class="accordion-collapse collapse" 
                                             aria-labelledby="heading{{ $user_custom_exam->id }}" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <strong>Exam Date:</strong> {{ $user_custom_exam->exam_date_time }} <br>
                                                <strong>Final Score:</strong> {{ $user_custom_exam->final_score }} <br>
                                                <strong>Total Answered:</strong> {{ $user_custom_exam->total_answered }} <br></strong>
                                                <strong>Total Correct:</strong> {{ $user_custom_exam->total_correct }} <br>
                                                <strong>Total Wrong:</strong> {{ $user_custom_exam->total_wrong }} <br>
                                                <!-- You can add more dynamic content here -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_scripts')

@endsection