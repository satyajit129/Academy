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
                    <form action="{{ route('questionStore') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="question_text">Question Text</label>
                                    <textarea name="question_text" id="" class="form-control"  rows="5">{{ old('question_text') }}</textarea>

                                </div>
                            </div>

                            <div class="basic-form" id="multiple-options-form" >
                                <label>Options</label>
                                <div id="options-container">
                                    @for($i = 0; $i < 4; $i++)
                                        <div class="form-group d-flex align-items-center">
                                            <input type="radio" name="correct_option" value="{{ $i }}" 
                                                {{ isset($question) && $question->correct_option === $i ? 'checked' : '' }}>
                                            <textarea class="form-control ml-2" name="options[]" rows="2" placeholder="Option {{ $i + 1 }}" >{{ isset($question) && isset($question->options[$i]) ? $question->options[$i] : '' }}</textarea>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="subject_id">Subject</label>
                                    <select name="subject_id" id="subject_id" class="form-control">
                                        <option selected disabled>Select Subject</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
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
                                            <option value="{{ $subject_lesson->id }}">
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
                                            <option value="{{ $subject_topic->id }}">
                                                {{ $subject_topic->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="question_type">Sub Topic</label>
                                    <select name="sub_topic_id" id="subject_sub_topic_id" id="subject_sub_topic_id" class="form-control">
                                        <option selected disabled>Select Sub Topic</option>
                                        @foreach ($subject_sub_topics as $subject_sub_topic)
                                            <option value="{{ $subject_sub_topic->id }}" @if (isset($question) && $question->subject_sub_topic_id == $subject_sub_topic->id) selected @endif>
                                                {{ $subject_sub_topic->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="marks">Marks</label>
                                    <input type="number" name="marks" id="marks" class="form-control" value="{{ old('marks') }}">
                                </div>
                            </div>
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="meta_tags">Meta Tags</label>
                                    <input type="text" name="meta_tags" id="meta_tags" class="form-control" value="{{ old('meta_tags') }}">
                                </div>
                            </div>
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <textarea name="meta_description" id="" class="form-control" rows="10">{{ old('meta_description') }}</textarea>
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
                $('#subject_sub_topic_id').empty();
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
    
            $('#topic_id').on('change', function() {
                var topic_id = $(this).val();
                if (topic_id) {
                    $.ajax({
                        url: "{{ route('getSubjectSubTopics') }}",
                        type: "GET",
                        data: {
                            topic_id: topic_id
                        },
                        success: function(response) {
                            console.log(response);
                            $('#subject_sub_topic_id').empty();
                            $('#subject_sub_topic_id').append('<option value="" disabled selected>Select Sub Topic</option>');
                            $.each(response, function(index, value) {
                                $('#subject_sub_topic_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#subject_sub_topic_id').empty();
                }
            });
        });
    </script>
    
    

@endsection
