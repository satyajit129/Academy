@extends('backend.global.master')
@section('title', 'Assign Custom Questions')
@section('custom_css')
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css" rel="stylesheet"> --}}

    <style>
        .border-dotted {
            border-bottom: 2px dotted black !important;
            height: 1px;
        }
    </style>
@endsection


@section('content')
    <div class="container-fluid">
        @include('backend.global.get_greetings')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @include('backend.global.alert')

                    <div class="card-body">
                        <div class="form-group">
                            <label for="exam_type">Select Exam Type</label>
                            <select id="exam_type" name="exam_type" class="form-control">
                                <option value="" selected disabled>Select Exam Type</option>
                                <option value="subject_wise">Subject Wise Exam</option>
                                <option value="lesson_wise">Lesson Wise Exam</option>
                                <option value="topic_wise">Topic Wise Exam</option>
                                <option value="sub_topic_wise">Sub Topic Wise Exam</option>
                            </select>
                        </div>

                        <div id="subject-wise-section" class="d-none">
                            <form action="{{ route('storeSubjectWiseQuestions') }}" method="post">
                                @csrf
                                <input type="text" name="exam_type" value="subject_wise" hidden>
                                @include('backend.pages.custom-exams.include_common_info')
                                <h5 class="mt-4">Select Subject for Questions</h5>
                                @php
                                    $hrColors = ['#007bff', '#28a745', '#dc3545', '#ffc107', '#17a2b8'];
                                @endphp
                                @foreach ($subjects as $index => $subject)
                                    <div class="d-flex align-items-center mb-2">
                                        <span
                                            style="border: 1px solid black; padding: 5px 15px; color: {{ $hrColors[$index % count($hrColors)] }}">{{ $subject->name }}
                                            - <span class="badge badge-primary">{{ $subject->questions->count() }}</span>
                                        </span>
                                        <div class="flex-grow-1 mx-2 border-bottom border-dotted"></div>
                                        <input type="number" name="number_of_questions[{{ $subject->id }}]"
                                            class="form-control  text-right"
                                            value="{{ old('number_of_questions.' . $subject->id) }}" style="width: 180px;"
                                            placeholder="Number of Questions" min="1"
                                            max="{{ $subject->questions->count() }}">
                                    </div>
                                @endforeach
                                <button type="submit" class="btn btn-primary">Assign Questions</button>
                            </form>
                        </div>

                        <div id="lesson-wise-section" class="d-none">
                            <form action="{{ route('storeLessonWiseQuestions') }}" method="post">

                                @csrf
                                <input type="text" name="exam_type" value="lesson_wise" hidden>
                                @include('backend.pages.custom-exams.include_common_info')
                                <div class="basic-form">
                                    <div class="form-group">
                                        <label for="">Select Subject</label>
                                        <select
                                            class="subject_id_lesson form-control multi-select-placeholder js-states select2-hidden-accessible"
                                            multiple>
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5 class="mt-4">Select Lesson for Questions</h5>
                                    <div id="lesson"></div>
                                </div>
                                <button type="submit" class="btn btn-primary">Assign Questions</button>
                            </form>
                        </div>


                        <div id="topic-wise-section" class="d-none">
                            <form action="{{ route('storeTopicWiseQuestions') }}" method="post">
                                @csrf
                                <input type="text" name="exam_type" value="topic_wise" hidden>
                                @include('backend.pages.custom-exams.include_common_info')
                                <div class="form-group">
                                    <label for="">Select Subject</label>
                                    <select
                                        class="subject_id_topic form-control multi-select-placeholder js-states select2-hidden-accessible"
                                        multiple>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Select Lesson</label>
                                    <select
                                        class="lesson_id_topic form-control multi-select-placeholder js-states select2-hidden-accessible"
                                        multiple>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <h5 class="mt-4">Select Topic for Questions</h5>
                                    <div id="topics">

                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Assign Questions</button>
                            </form>
                        </div>

                        <div id="sub-topic-wise-section" class="d-none">
                            <form action="{{ route('storeSubTopicWiseQuestions') }}" method="post">
                                <input type="text" name="exam_type" value="sub_topic_wise" hidden>
                                @csrf
                                @include('backend.pages.custom-exams.include_common_info')
                                <div class="form-group">
                                    <label for="">Select Subject</label>
                                    <select
                                        class="subject_id_sub_topic form-control multi-select-placeholder js-states select2-hidden-accessible"
                                        multiple>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Select Lesson</label>
                                    <select
                                        class="lesson_id_sub_topic form-control multi-select-placeholder js-states select2-hidden-accessible"
                                        multiple>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Select Topic</label>
                                    <select
                                        class="topic_id_sub_topic form-control multi-select-placeholder js-states select2-hidden-accessible"
                                        multiple>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <h5 class="mt-4">Select Sub Topic for Questions</h5>
                                    <div id="sub_topics">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Assign Questions</button>
                            </form>
                        </div>
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
            $('#exam_type').change(function() {
                const selectedExamType = $(this).val();
                $('#subject-wise-section, #lesson-wise-section, #topic-wise-section, #sub-topic-wise-section')
                    .addClass('d-none');
                if (selectedExamType === 'subject_wise') {
                    $('#subject-wise-section').removeClass('d-none');
                } else if (selectedExamType === 'lesson_wise') {
                    $('#lesson-wise-section').removeClass('d-none');
                } else if (selectedExamType === 'topic_wise') {
                    $('#topic-wise-section').removeClass('d-none');
                } else if (selectedExamType === 'sub_topic_wise') {
                    $('#sub-topic-wise-section').removeClass('d-none');
                }
            });

            $('.subject_id_lesson').on('change', function() {
                var subject_ids = $(this).val();
                console.log(subject_ids);

                if (subject_ids && subject_ids.length > 0) {
                    $.ajax({
                        url: "{{ route('getMultipleSubjectLessons') }}",
                        type: "GET",
                        data: {
                            subject_ids: subject_ids
                        },
                        success: function(response) {
                            console.log(response);
                            $('#lesson').empty();
                            $.each(response, function(index, lessons) {
                                var hrColors = ['#007bff', '#28a745', '#dc3545',
                                    '#ffc107', '#17a2b8'
                                ];
                                var questionCount = lessons.questions ? lessons
                                    .questions.length : 0; // Check if question exists
                                var lessonHTML = `
                                    <div class="d-flex align-items-center mb-2">
                                        <span style="border: 1px solid black; padding: 5px 15px; color: ${hrColors[index % hrColors.length]}">${lessons.name} - <span class="badge badge-primary">${questionCount}</span>  </span>
                                        <div class="flex-grow-1 mx-2 border-bottom border-dotted"></div>
                                        <input type="number" name="number_of_questions[${lessons.id}]" class="form-control  text-right" style="width: 180px;" placeholder="Max Questions" min="1" max="${questionCount}">
                                    </div>
                                `;
                                $('#lesson').append(lessonHTML);
                            });
                        },

                        error: function() {
                            console.error('Error loading lessons');
                        }
                    });
                } else {
                    $('#lesson').empty();
                }
            });

            $('.subject_id_topic').on('change', function() {
                var subject_ids = $(this).val();
                if (subject_ids && subject_ids.length > 0) {
                    $.ajax({
                        url: "{{ route('getMultipleSubjectLessons') }}",
                        type: "GET",
                        data: {
                            subject_ids: subject_ids
                        },
                        success: function(response) {
                            console.log(response);
                            $('.lesson_id_topic').empty();
                            $.each(response, function(index, lesson) {
                                $('.lesson_id_topic').append(
                                    `<option value="${lesson.id}">${lesson.name}</option>`
                                );
                            });
                        },
                        error: function() {
                            console.error('Error loading topics');
                        }
                    });
                } else {
                    $('.lesson_id_topic').empty();
                }
            });
            $('.lesson_id_topic').on('change', function() {
                var lesson_ids = $(this).val();
                if (lesson_ids && lesson_ids.length > 0) {
                    console.log(lesson_ids);
                    $.ajax({
                        url: "{{ route('getMultipleSubjectTopics') }}",
                        type: "GET",
                        data: {
                            lesson_ids: lesson_ids
                        },
                        success: function(response) {
                            console.log(response);
                            $('#topics').empty();
                            $.each(response, function(index, topics) {
                                var hrColors = ['#007bff', '#28a745', '#dc3545',
                                    '#ffc107', '#17a2b8'
                                ];
                                var questionCount = topics.questions ? topics.questions
                                    .length : 0;
                                var topicHTML = `
                                    <div class="d-flex align-items-center mb-2">
                                        <span style="border: 1px solid black; padding: 5px 15px; color: ${hrColors[index % hrColors.length]}">${topics.name} - <span class="badge badge-primary">${questionCount}</span></span>
                                        <div class="flex-grow-1 mx-2 border-bottom border-dotted"></div>
                                        <input type="number" name="number_of_questions[${topics.id}]" class="form-control  text-right" style="width: 180px;" placeholder="Max Questions" min="1" max="${questionCount}">
                                    </div>
                                `;
                                $('#topics').append(topicHTML);
                            });
                        },
                        error: function() {
                            console.error('Error loading topics');
                        }
                    });
                } else {
                    $('.topic_id_topic').empty();
                }
            });
            $('.subject_id_sub_topic').on('change', function() {
                var subject_ids = $(this).val();
                if (subject_ids && subject_ids.length > 0) {
                    $.ajax({
                        url: "{{ route('getMultipleSubjectLessons') }}",
                        type: "GET",
                        data: {
                            subject_ids: subject_ids
                        },
                        success: function(response) {
                            console.log(response);
                            $('.lesson_id_sub_topic').empty();
                            $.each(response, function(index, lesson) {
                                $('.lesson_id_sub_topic').append(
                                    `<option value="${lesson.id}">${lesson.name}</option>`
                                );
                            });
                        },
                        error: function() {
                            console.error('Error loading topics');
                        }
                    });
                } else {
                    $('.lesson_id_sub_topic').empty();
                }
            });
            $('.lesson_id_sub_topic').on('change', function() {
                var lesson_ids = $(this).val();
                if (lesson_ids && lesson_ids.length > 0) {
                    console.log(lesson_ids);
                    $.ajax({
                        url: "{{ route('getMultipleSubjectTopics') }}",
                        type: "GET",
                        data: {
                            lesson_ids: lesson_ids
                        },
                        success: function(response) {
                            console.log(response);
                            $('.topic_id_sub_topic').empty();
                            $.each(response, function(index, topics) {
                                $('.topic_id_sub_topic').append(
                                    `<option value="${topics.id}">${topics.name}</option>`
                                );
                            });
                        },
                        error: function() {
                            console.error('Error loading topics');
                        }
                    });
                } else {
                    $('.topic_id_sub_topic').empty();
                }
            });
            $('.topic_id_sub_topic').on('change', function() {
                var topic_ids = $(this).val();
                if (topic_ids && topic_ids.length > 0) {
                    console.log(topic_ids);
                    $.ajax({
                        url: "{{ route('getMultipleSubjectSubTopics') }}",
                        type: "GET",
                        data: {
                            topic_ids: topic_ids
                        },
                        success: function(response) {
                            $('#sub_topics').empty();
                            console.log(response);
                            $('.sub_topic_id_sub_topic').empty();
                            $.each(response, function(index, sub_topics) {
                                var hrColors = ['#007bff', '#28a745', '#dc3545',
                                    '#ffc107', '#17a2b8'
                                ];
                                var questionCount = sub_topics.questions ? sub_topics
                                    .questions.length : 0;
                                var sub_topicHTML = `
                                    <div class="d-flex align-items-center mb-2">
                                        <span style="border: 1px solid black; padding: 5px 15px; color: ${hrColors[index % hrColors.length]}">${sub_topics.name} - <span class="badge badge-primary">${questionCount}</span></span>
                                        <div class="flex-grow-1 mx-2 border-bottom border-dotted"></div>
                                        <input type="number" name="number_of_questions[${sub_topics.id}]" class="form-control  text-right" style="width: 180px;" placeholder="Max Questions" min="0" max="${questionCount}">
                                    </div>
                                `;
                                $('#sub_topics').append(sub_topicHTML);
                            });
                        },
                        error: function() {
                            console.error('Error loading sub topics');
                        }
                    });
                } else {
                    $('.sub_topic_id_sub_topic').empty();
                }
            });
        });
    </script>
@endsection
