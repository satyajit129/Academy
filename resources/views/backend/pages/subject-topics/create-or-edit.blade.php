@extends('backend.global.master')
@section('title', 'Subject Topics Create/Edit')
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
                        <h4 class="card-title">Subject Topics Information</h4>
                        <a href="{{ route('subjectList') }}" class="btn btn-primary btn-rounded">Back To List</a>
                    </div>
                    <form action="{{ route('subjectTopicsStore', isset($subject_topic) ? $subject_topic->id : '') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="name">Topic Name</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ old('name', isset($subject_topic) ? $subject_topic->name : '') }}"
                                        placeholder="Enter Subject lesson name" required>
                                </div>
                            </div>
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="subject_id">Subject</label>
                                    <select name="subject_id" id="subject_id" class="form-control">
                                        <option selected disabled>Select Subject</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}"
                                                @if (isset($subject_lesson) && $subject_lesson->subject_id == $subject->id) selected @endif>{{ $subject->name }}
                                            </option>
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
                                            <option value="{{ $subject_lesson->id }}"
                                                @if (isset($subject_topic) && $subject_topic->lesson_id == $subject_lesson->id) selected @endif>
                                                {{ $subject_lesson->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                                $('#lesson_id').append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            })
                        }
                    })
                } else {
                    $('#lesson_id').empty();
                }
            })
        })
    </script>
@endsection
