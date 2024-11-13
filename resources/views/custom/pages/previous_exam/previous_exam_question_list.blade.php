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
    <div class="container mt-5">
        <div class="row mb-2">
            <div class="col-lg-8">
                <div class="card rounded-0">
                    <div class="card-header">
                        <h4>{{ $previous_job_exam->name }}</h4>
                        <small>Code: {{ $previous_job_exam->exam_code }}</small> |
                        @php
                            $hours = floor($previous_job_exam->duration / 60);  // Get the number of full hours
                            $minutes = $previous_job_exam->duration % 60;  // Get the remaining minutes
                        @endphp 
                        <small>Duration: {{ $hours }} hour{{ $hours != 1 ? 's' : '' }} {{ $minutes }} minute{{ $minutes != 1 ? 's' : '' }}</small> |
                        <small>Question Type: @if ($previous_job_exam->exam_type === 1) MCQ @else Written
                            
                        @endif </small>
                    </div>
                    <div class="card-body rounded-0">
                        @php
                            $groupedQuestions = $previous_job_exam->questions->groupBy('subject_id');
                        @endphp
                        <div class="d-flex justify-content-start gap-1 flex-lg-row flex-column">
                            <button href="#" class="btn btn-sm btn-outline-info"
                                style="border-radius: 0; padding:5px 16px;" onclick="showAllQuestions()">All</button>
                            @foreach ($groupedQuestions as $subjectId => $questions)
                                @php
                                    $subjectName = $questions->first()->subject->name ?? 'Unknown Subject';
                                @endphp
                                <button href="#" class="btn btn-sm btn-outline-info"
                                    style="border-radius: 0; padding:5px 16px;"
                                    onclick="filterQuestions({{ $subjectId }})">{{ $subjectName }}</button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="card mt-2 rounded-0">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title m-0">All Questions</h4>
                        <a href="{{ route('previousJobExamsStartExam',['id' => encrypt($previous_job_exam->id)]) }}" class="btn btn-primary rounded-0" style="padding: 5px 16px;" type="button">
                             যাচাই করুন
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row" id="questionContainer">
                            @foreach ($previous_job_exam->questions as $question)
                                <div class="col-lg-6 col-12 question-card" data-subject-id="{{ $question->subject_id }}">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <p class="m-0">## {{ $question->question_text }}</p>
                                            <div class="question-options ml-4 mt-2">
                                                @foreach ($question->options as $option)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            id="option{{ $option->id }}"
                                                            name="question{{ $question->id }}" value="{{ $option->id }}"
                                                            @if ($option->is_correct) checked @endif>
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
                                    <a href="{{ route('previousJobExamsQuestion', ['slug' => $related_exam_slug, 'id' => $related_exam_id]) }}">
                                        <i class="fa fa-book"></i>
                                        {{ \Illuminate\Support\Str::limit($related_exam->name, 45) }}
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
