@extends('custom.global.app')
@section('custom_css')
    <style>
        .form-check-input:checked {
            background-color: #14a814;
            border-color: #14a814;
        }
    </style>
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
    <div class=" py-5" style="background: linear-gradient(to right, #6a11cb, #2575fc);">
        
    <div class="container mt-5">
        <div class="row mb-2">
            <div class="col-lg-8">
                <div class="card rounded-0">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="m-0">{{ $previous_job_exam->name }}</h4>
                        <small class="text-muted">Code: {{ $previous_job_exam->exam_code }}</small>
                    </div>
                    <div class="card-body rounded-0">
                        @php
                            $hours = floor($previous_job_exam->duration / 60);  
                            $minutes = $previous_job_exam->duration % 60;  
                        @endphp
                        <div class="d-flex justify-content-between">
                            <small class="text-muted">Duration: {{ $hours }} hour{{ $hours != 1 ? 's' : '' }} {{ $minutes }} minute{{ $minutes != 1 ? 's' : '' }}</small>
                            <small class="text-muted">
                                Question Type: 
                                @if ($previous_job_exam->exam_type === 1) 
                                    <span class="badge bg-info">MCQ</span>
                                @else 
                                    <span class="badge bg-warning">Written</span>
                                @endif
                            </small>
                        </div>
                    </div>
                    <div class="card-body rounded-0">
                        @php
                            $grouped_questions = $previous_job_exam->questions->groupBy('subject_id');
                        @endphp
                        <div class="d-flex justify-content-start gap-2 flex-lg-row flex-column">
                            <button href="#" class="btn btn-sm btn-outline-info" style="border-radius: 0; padding:5px 16px;" onclick="showAllQuestions()">
                                <i class="fa fa-list"></i> All
                            </button>
                            @foreach ($grouped_questions as $subjectId => $questions)
                                @php
                                    $subject_name = $questions->first()->subject->name ?? 'Unknown Subject';
                                @endphp
                                <button href="#" class="btn btn-sm btn-outline-info" style="border-radius: 0; padding:5px 16px;" onclick="filterQuestions({{ $subjectId }})">
                                    <i class="fa fa-tag"></i> {{ $subject_name }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
    
                <div class="card mt-2 rounded-0">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title m-0">All Questions</h4>
                        <a href="{{ route('previousJobExamsStartExam',['id' => encrypt($previous_job_exam->id)]) }}" class="btn btn-primary rounded-0" style="padding: 5px 16px;" type="button">
                            <i class="fa fa-check-circle"></i> যাচাই করুন
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row" id="questionContainer">
                            @foreach ($previous_job_exam->questions as $question)
                                <div class="col-lg-6 col-12 question-card" data-subject-id="{{ $question->subject_id }}">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <p class="m-0"><strong>##</strong> {{ $question->question_text }}</p>
                                            <div class="question-options ml-4 mt-2">
                                                @foreach ($question->options as $option)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" id="option{{ $option->id }}" name="question{{ $question->id }}" value="{{ $option->id }}" @if ($option->is_correct) checked @endif>
                                                        <label class="form-check-label" for="option{{ $option->id }}">
                                                            {{ $option->option_text }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="col-lg-4">
                <div class="card rounded-0">
                    <div class="card-header">
                        <h4 class="m-0">Related Exams</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @forelse ($related_exams as $related_exam)
                            @php
                                $related_exam_id = encrypt($related_exam->id);
                                $related_exam_slug = encrypt($related_exam->slug);
                            @endphp
                                <li class="list-group-item">
                                    <a href="{{ route('previousJobExamsQuestion', ['slug' => $related_exam_slug, 'id' => $related_exam_id]) }}" class="d-flex align-items-center">
                                        <i class="fa fa-book fa-fw me-2"></i> 
                                        <span>{{ \Illuminate\Support\Str::limit($related_exam->name, 45) }}</span>
                                    </a>
                                </li>
                            @empty
                                <li class="list-group-item">No related exams available</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    
@endSection

@section('custom_scripts')
    <script>
        // Function to show all questions
        function showAllQuestions() {
            $('.question-card').show();
        }

        // Function to filter questions by subject
        function filterQuestions(subjectId) {
            $('.question-card').each(function() {
                $(this).toggle($(this).data('subject-id') == subjectId);
            });
        }
    </script>
@endsection
