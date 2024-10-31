@extends('backend.global.master')
@section('title', 'Subject Lessons Create/Edit')
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
                        <h4 class="card-title">Subject Lesson Information</h4>
                        <a href="{{ route('subjectLessonsList') }}" class="btn btn-primary btn-rounded">Back To List</a>
                    </div>
                    <form action="{{ route('subjectLessonsStore', isset($subject_lesson) ? $subject_lesson->id : '') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="name">Lession Name</label>
                                    <input type="text" class="form-control" name="name" 
                                        value="{{ old('name', isset($subject_lesson) ? $subject_lesson->name : '') }}"
                                        placeholder="Enter Subject lesson name" required>
                                </div>
                            </div>
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="subject_id">Subject</label>
                                    <select name="subject_id" id="subject_id" class="form-control">
                                        <option selected disabled>Select Subject</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}" @if (isset($subject_lesson) && $subject_lesson->subject_id == $subject->id) selected @endif>{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="rounded-button">
                                <button type="submit"
                                    class="btn btn-rounded btn-outline-primary pl-4 pr-4">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection

@section('custom_scripts')

@endsection
