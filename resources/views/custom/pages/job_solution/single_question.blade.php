@extends('custom.global.app')

@section('custom_css')
@endsection


@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 bg-dark" style="margin-bottom: 6rem;">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">জব সলিউশন</h1>
            <nav aria-label="breadcrumb" class="animated slideInDown">
                <ol class="breadcrumb bg-transparent p-0 m-0">
                    <li class="breadcrumb-item">
                        <a class="text-white text-decoration-none" href="/">হোম পেজ </a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Single Question Start -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="m-0">{{ $question->question_text }}</h5>
                        <hr>
                        <div class="question-options ml-4 mt-2">
                            @foreach ($question->options as $option)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="option{{ $option->id }}"
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
                <div class="card mt-3">
                    <div class="card-header">
                        <h3 class="m-0">সম্পর্কিত প্রশ্ন</h3>
                    </div>
                    
                    <div class="card-body">
                        @foreach($relatedQuestions as $related_question)
                            @php
                                $question_id = encrypt($related_question->id);
                                $question_slug = $related_question->slug;
                            @endphp
                            <a href="{{ route('singleQuestion', ['slug' => $question_slug, 'id' => $question_id]) }}">{{ $related_question->question_text }}</a>
                            
                            @foreach ($related_question->options as $option)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="option{{ $related_question->id }}_{{ $option->id }}"
                                        name="question{{ $related_question->id }}" value="{{ $option->id }}"
                                        @if ($option->is_correct) checked @endif>
                                    <label class="form-check-label" for="option{{ $related_question->id }}_{{ $option->id }}">
                                        {{ $option->option_text }}
                                    </label>
                                </div>
                            @endforeach
                            <hr>
                        @endforeach 
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection


@section('custom_scripts')
@endsection
