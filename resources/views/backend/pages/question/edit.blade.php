@extends('backend.global.master')
@section('title', 'Question Create/Edit')
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
                        <h4 class="card-title">Question Information</h4>
                        <a href="{{ route('questionList') }}" class="btn btn-primary btn-rounded">Back To List</a>
                    </div>
                    <form action="{{ route('questionStore', isset($question) ? $question->id : '') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="question_text">Question Text</label>
                                    <textarea name="question_text" id="" class="form-control"  rows="5">{{ old('question_text', isset($question) ? $question->question_text : '') }}</textarea>

                                </div>
                            </div>

                            <div class="basic-form" id="multiple-options-form" >
                                <label>Options</label>
                                <div id="options-container">
                                    @foreach ($question->options as $options)
                                        <div class="form-group d-flex align-items-center">
                                            <input type="radio" name="correct_option" value="{{ $options->id }}" {{ $options->is_correct == 1 ? 'checked' : '' }}>
                                            <textarea class="form-control ml-2" name="options[]" rows="2" placeholder="Option {{ $options->id }}" >{{ $options->option_text }}</textarea>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="subject_id">Subject</label>
                                    <select name="subject_id" id="subject_id" class="form-control">
                                        <option selected disabled>Select Subject</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}" @if (isset($question) && $question->subject_id == $subject->id) selected @endif>{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="lesson_id">Lesson</label>
                                    <select name="lesson_id" id="lesson_id" class="form-control">
                                        <option selected disabled>Select Lesson</option>
                                        @foreach ($subject_lessons as $subject_lesson)
                                            <option value="{{ $subject_lesson->id }}" @if (isset($question) && $question->lesson_id == $subject_lesson->id) selected @endif>
                                                {{ $subject_lesson->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="topic_id">Topic</label>
                                    <select name="topic_id" id="topic_id" class="form-control">
                                        <option selected disabled>Select Topic</option>
                                        @foreach ($subject_topics as $subject_topic)
                                            <option value="{{ $subject_topic->id }}" @if (isset($question) && $question->topic_id == $subject_topic->id) selected @endif>
                                                {{ $subject_topic->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="marks">Marks</label>
                                    <input type="number" name="marks" id="marks" class="form-control" value="{{ old('marks', isset($question) ? $question->marks : '') }}">
                                </div>
                            </div>
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="meta_tags">Meta Tags</label>
                                    <input type="text" name="meta_tags" id="meta_tags" class="form-control" value="{{ old('meta_tags', isset($question) ? $question->meta_tags : '') }}">
                                </div>
                            </div>
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <textarea name="meta_description" id="" class="form-control" rows="10">{{ old('meta_description', isset($question) ? $question->meta_description : '') }}</textarea>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="rounded-button mt-3">
                                <button type="submit" class="btn btn-rounded btn-outline-primary pl-4 pr-4">Submit</button>
                            </div>
                        </div>
                        
                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection

@section('custom_scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#subject_id').on('change', function() {
                var subject_id = $(this).val();
                if (subject_id) {
                    $.ajax({
                        url: "{{ route('getSubjectLessons') }}",
                        type: "GET",
                        data: {
                            subject_id: subject_id
                        },
                        success: function(response) {
                            console.log(response);
                            $('#lesson_id').empty();
                            $('#lesson_id').append('<option value="" disabled selected>Select Lesson</option>');
                            $.each(response, function(index, value) {
                                $('#lesson_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#lesson_id').empty();
                    
                }
                $('#topic_id').empty();
            });
    
            $('#lesson_id').on('change', function() {
                var lesson_id = $(this).val();
                if (lesson_id) {
                    $.ajax({
                        url: "{{ route('getSubjectTopics') }}",
                        type: "GET",
                        data: {
                            lesson_id: lesson_id
                        },
                        success: function(response) {
                            console.log(response);
                            $('#topic_id').empty();
                            $('#topic_id').append('<option value="" disabled selected>Select Topic</option>');
                            $.each(response, function(index, value) {
                                $('#topic_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#topic_id').empty();
                }
            });
        });
    </script>
    

@endsection
