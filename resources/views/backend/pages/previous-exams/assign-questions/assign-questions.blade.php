@extends('backend.global.master')
@section('title', 'Assign Questions')
@section('custom_css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection


@section('content')
    <div class="container-fluid">
        @include('backend.global.get_greetings')
        <!-- row -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    @include('backend.global.alert')
                    <div class="card-header">
                        <h4 class="card-title">Add Questions</h4>
                    </div>
                    <form action="{{ route('assignQuestionsStore') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <input type="text" hidden name="previous_exam_id" value="{{ $previous_exam->id }}">
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="">Select Subject</label>
                                    <select  id="subject_id" class="form-control">
                                        <option selected disabled>Select Subject</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
    
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="">Select Lesson</label>
                                    <select  id="lesson_id" class="form-control">
                                        <option selected disabled>Select Lesson</option>
                                    </select>
                                </div>
                            </div>
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="">Select Topics</label>
                                    <select  id="topic_id" class="form-control">
                                        <option selected disabled>Select Topic</option>
                                    </select>
                                </div>
                            </div>
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="">Select Sub Topic</label>
                                    <select  id="subject_sub_topic_id" id="subject_sub_topic_id" class="form-control">
                                        <option selected disabled>Select Sub Topic</option>
                                    </select>
                                </div>
                            </div>
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="">Select Questions</label>
                                    <select name="question_ids[]" id="question_id" class="form-control multi-select-placeholder js-states" multiple="multiple">
                                        
                                        @forelse ($questions as $question)
                                            <option value="{{ $question->id }}">{{ $question->question_text }}</option>
                                        @empty
                                            <option >No data found</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="rounded-button mt-3">
                                <button type="submit" class="btn btn-rounded btn-outline-primary pl-4 pr-4">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h3>Questions:</h3>
                        <ul>
                            @if ($previous_exam->questions->isEmpty())
                                <li>No questions assigned.</li>
                            @else
                                @foreach ($previous_exam->questions as $question)
                                    <li style="display: flex; align-items: center; justify-content: space-between;">
                                        <span>{{ $loop->iteration }}. {{ Str::limit($question->question_text, 50) }}</span>
                                        <span style="flex: 1; border-bottom: 1px dotted #ccc; margin: 0 10px;"></span>
                                        <a href="{{ route('assignQuestionsDelete', ['previous_exam_id' => $previous_exam->id, 'question_id' => $question->id]) }}" onclick="alert('Are you sure? You want to delete this question?')" style="color: #dc3545;">
                                            <i class="fas fa-times" style="cursor: pointer; color: #dc3545;"></i>
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>
@endsection

@section('custom_scripts')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            function populateOptions(selector, options, placeholder, textField = 'name', includePlaceholder = true) {
                $(selector).empty();
                if (includePlaceholder) {
                    $(selector).append('<option value="" disabled selected>' + placeholder + '</option>');
                }
                $.each(options, function(index, value) {
                    $(selector).append('<option value="' + value.id + '">' + value[textField] + '</option>');
                });
            }
            function fetchQuestions(data) {
                $.ajax({
                    url: "{{ route('getQuestions') }}",
                    type: "GET",
                    data: data,
                    success: function(response) {
                        console.log(response);
                        populateOptions('#question_id', response, 'Select Question', 'question_text', false);
                    }
                });
            }
            $('#subject_id').on('change', function() {
                var subject_id = $(this).val();
                if (subject_id) {
                    $.ajax({
                        url: "{{ route('getSubjectLessons') }}",
                        type: "GET",
                        data: { subject_id: subject_id },
                        success: function(response) {
                            console.log(response);
                            populateOptions('#lesson_id', response, 'Select Lesson');
                            fetchQuestions({ subject_id: subject_id });
                        }
                    });
                } else {
                    $('#lesson_id').empty();
                }
            });
            $('#lesson_id').on('change', function() {
                var lesson_id = $(this).val();
                if (lesson_id) {
                    $.ajax({
                        url: "{{ route('getSubjectTopics') }}",
                        type: "GET",
                        data: { lesson_id: lesson_id },
                        success: function(response) {
                            console.log(response);
                            populateOptions('#topic_id', response, 'Select Topic');
                            fetchQuestions({ lesson_id: lesson_id });
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
                        data: { topic_id: topic_id },
                        success: function(response) {
                            console.log(response);
                            populateOptions('#subject_sub_topic_id', response, 'Select Sub Topic');
                            fetchQuestions({ topic_id: topic_id });
                        }
                    });
                } else {
                    $('#subject_sub_topic_id').empty();
                }
            });
            $('#subject_sub_topic_id').on('change', function() {
                var sub_topic_id = $(this).val();
                if (sub_topic_id) {
                    fetchQuestions({ sub_topic_id: sub_topic_id });
                } else {
                    $('#question_id').empty();
                }
            });
        });
    </script>
    
    
    
@endsection
