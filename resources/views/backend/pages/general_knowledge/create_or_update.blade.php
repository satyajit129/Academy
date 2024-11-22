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
                    <form action="{{ route('GKStore') }}" method="POST" enctype="multipart/form-data" id="GKForm">
                        @csrf

                        <div class="card-body">
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="date">Select Date</label>
                                    <input type="date" name="date" placeholder="Enter date" class="form-control"
                                        id="date">
                                </div>
                                @for ($i = 1; $i <= 10; $i++)
                                    <div class="form-group">
                                        <label for="question_{{ $i }}">Question {{ $i }}</label>
                                        <input type="text" class="form-control"
                                            name="questions[{{ $i }}][question]"
                                            id="question_{{ $i }}" placeholder="Enter Question">
                                    </div>
                                    <div class="form-group">
                                        <label for="answer_{{ $i }}">Answer for Question
                                            {{ $i }}</label>
                                        <textarea class="form-control" name="questions[{{ $i }}][answer]" id="answer_{{ $i }}"
                                            placeholder="Enter Written Answer"></textarea>
                                        <span class="text-danger" id="answer_error_{{ $i }}"
                                            style="display:none;"></span> <!-- Error message container -->
                                    </div>
                                @endfor
                                <div class="rounded-button">
                                    <button type="submit"
                                        class="btn btn-rounded btn-outline-primary pl-4 pr-4">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#GKForm').submit(function(event) {
                let isValid = true;
                for (let i = 1; i <= 10; i++) {
                    let question = $('#question_' + i).val().trim();
                    let answer = $('#answer_' + i).val().trim();
                    $('#answer_error_' + i).hide();
                    if (question !== '' && answer === '') {
                        $('#answer_error_' + i).text('Answer is required for Question ' + i).show();
                        isValid = false;
                    }
                }
                if (!isValid) {
                    event.preventDefault();
                }
            });
        });
    </script>

@endsection
