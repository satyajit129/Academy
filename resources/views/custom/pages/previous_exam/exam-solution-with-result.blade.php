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
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="m-0">পরীক্ষার ফলাফল </h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>মেট্রিক</th>
                                    <th>মান</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>মোট মার্কস</td>
                                    <td>{{ $previous_job_exam->questions->count() }}</td>
                                </tr>
                                <tr>
                                    <td>সঠিক উত্তর</td>
                                    <td>{{ $correct_answers }}</td>
                                </tr>
                                <tr>
                                    <td>ভুল উত্তর</td>
                                    <td>{{ $incorrect_answers }}</td>
                                </tr>
                                <tr>
                                    <td>নেগেটিভ মার্ক</td>
                                    <td>{{ $negative_mark }}</td>
                                </tr>
                                @php
                                    $total_correct_mark = $correct_answers;
                                    $total_negative_mark = ($incorrect_answers * $negative_mark);
                                @endphp
                                <tr>
                                    <td>স্কোর</td>
                                    <td>{{ $score - $total_negative_mark }}</td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                    
                    <hr>
                    <div class="card-body">
                        <h4>প্রশ্নসমূহ </h4>
                            @foreach ($previous_job_exam->questions as $index => $question)
                                @php
                                    $user_answer = collect($questions_details)->firstWhere('question.id', $question->id);
                                    $selected_answer_id = $user_answer['selected_answer'] ?? null;
                                    $correct_answer_id = $user_answer['correct_answer'] ?? null;
                                    $is_correct = $user_answer['is_correct'] ?? false;
                                    $correct_option = $question->options->firstWhere('id', $correct_answer_id);
                                @endphp

                                <div class="question mb-4" 
                                    style="padding: 10px; 
                                            @if ((int)$selected_answer_id ===  $correct_answer_id) background-color: #00800014; 
                                            @elseif ($selected_answer_id && !$is_correct) background-color: #ff00002e;
                                            @else background-color: #f1f1f1; /* Default color */
                                            @endif">
                                    <h6>## {{ $question->question_text }}</h6>
                                    <div style="padding-left: 16px;">
                                        @foreach ($question->options as $option)
                                            <div class="form-check">
                                                <input type="radio" 
                                                    name="answers[{{ $question->id }}]" 
                                                    value="{{ $option->id }}" 
                                                    id="option{{ $option->id }}" 
                                                    class="form-check-input question-option"
                                                    data-question-id="{{ $question->id }}" 
                                                    data-option-id="{{ $option->id }}"
                                                    {{ $selected_answer_id == $option->id ? 'checked' : '' }}>
                                            
                                                <label for="option{{ $option->id }}" class="form-check-label">
                                                    {{ $option->option_text }}
                                                </label>
                                                @if ($selected_answer_id && !$is_correct && $selected_answer_id == $option->id)
                                                    <span style="color: red; font-weight: bold;"> (Wrong Answer)</span>
                                                @endif
                                                @if ($option->is_correct)
                                                    <span style="color: green; font-weight: bold;"> (Correct Answer)</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endSection

@section('custom_scripts')
@endsection
