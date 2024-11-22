@extends('backend.global.master')
@section('title', 'General Knowledge Create/Edit')
@section('custom_css')
@endsection


@section('content')
    <div class="container-fluid">
        @include('backend.global.get_greetings')
        <div class="row">
            <div class="col-xxl-12">
                <div class="card">
                    @include('backend.global.alert')
                    <div class="card-header">
                        <h4 class="card-title">General Knowledge Information</h4>
                        <a href="{{ route('GKList') }}" class="btn btn-primary btn-rounded">Back To List</a>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ route('GKUpdate', $date) }}" method="POST" id="GKForm">
                                @csrf
                                @foreach ($general_knowledges as $index => $knowledge)
                                    <div class="form-group">
                                        <label for="question_{{ $index }}">Question {{ $index + 1 }}</label>
                                        <input type="text" class="form-control" name="questions[{{ $index }}][question]"
                                            id="question_{{ $index }}" value="{{ $knowledge->question }}" placeholder="Enter Question">
                                    </div>
                                    <div class="form-group">
                                        <label for="answer_{{ $index }}">Answer for Question {{ $index + 1 }}</label>
                                        <textarea class="form-control" name="questions[{{ $index }}][answer]" 
                                            id="answer_{{ $index }}" placeholder="Enter Answer">{{ $knowledge->answer }}</textarea>
                                        <span id="answer_error_{{ $index }}" class="text-danger" style="display:none;"></span>
                                    </div>
                                @endforeach
                                <div class="rounded-button">
                                    <button type="submit" class="btn btn-rounded btn-outline-primary pl-4 pr-4">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle form submission
            $('#GKForm').submit(function(event) {
                let isValid = true;
    
                // Loop through each question and answer dynamically
                @foreach ($general_knowledges as $index => $knowledge)
                    // Avoid redeclaring variables, directly use unique IDs
                    (function(index) {
                        let question = $('#question_' + index).val().trim();
                        let answer = $('#answer_' + index).val().trim();
                        
                        // Hide the error message initially
                        $('#answer_error_' + index).hide();
                        
                        // Check if question is provided but answer is empty
                        if (question !== '' && answer === '') {
                            // Show error message if the answer is missing
                            $('#answer_error_' + index).text('Answer is required for Question ' + (index + 1)).show();
                            isValid = false;
                        }
                    })({{ $index }});
                @endforeach
    
                // If validation fails, prevent form submission
                if (!isValid) {
                    event.preventDefault();
                }
            });
        });
    </script>

@endsection
