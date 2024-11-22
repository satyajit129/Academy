@extends('backend.global.master')
@section('title', 'Custom Exams List')
@section('custom_css')
    
@endsection


@section('content')
    <div class="container-fluid">
        @include('backend.global.get_greetings')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @include('backend.global.alert')
                    
                    <div class="card-body">
                        <h3>Questions:</h3>
                        <div class="exam-questions mt-4">
                            @if ($custom_exam->questions->isEmpty())
                                <p class="text-center">No questions assigned.</p>
                            @else
                                @foreach ($custom_exam->questions as $question)
                                    <div class="card mb-4">
                                        
                                        <div class="card-body">
                                            <div style="display: flex; align-items: center; gap: 10px;">
                                                <strong> <span class="badge badge-primary rounded-pill">{{ $loop->iteration }}</span> </strong> {{ $question->question_text }}
                                            </div>
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
                                @endforeach
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_scripts')
@endsection
