@extends('backend.global.master')
@section('title', 'Previous Exams Create/Edit')
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
                        <h4 class="card-title">Previous Exams Information</h4>
                        <a href="{{ route('previousExamsList') }}" class="btn btn-primary btn-rounded">Back To List</a>
                    </div>
                    <form action="{{ route('previousExamsStore', isset($previous_exam) ? $previous_exam->id : '') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="name">Previous Exam Name</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ old('name', isset($previous_exam) ? $previous_exam->name : '') }}"
                                        placeholder="Enter Previous Exam name" required>
                                </div>
                            </div>

                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="exam_code">Exam Code</label>
                                    <input type="text" class="form-control" name="exam_code" id="exam_code"
                                        value="{{ old('exam_code', isset($previous_exam) ? $previous_exam->exam_code : '') }}"
                                        placeholder="Enter Exam Code" required>
                                </div>
                            </div>

                            
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="year_id">Year</label>
                                    <select class="form-control" name="year_id" id="year_id">
                                        <option selected disabled>Select Year</option>
                                        @foreach ($years as $year)
                                            <option value="{{ $year->id }}"
                                                {{ old('year_id', isset($previous_exam) ? $previous_exam->year_id : '') == $year->id ? 'selected' : '' }}>
                                                {{ $year->year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="exam_date">Exam Date</label>
                                    <input type="date" class="form-control" name="exam_date" id="exam_date"
                                        value="{{ old('exam_date', isset($previous_exam) ? $previous_exam->exam_date : '') }}"
                                        placeholder="Enter Exam Date" required>
                                </div>
                            </div>
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="exam_type">Exam Type</label>
                                    <select class="form-control" name="exam_type" id="exam_type">
                                        <option selected disabled>Select Exam Type</option>
                                        <option value="1"
                                            {{ old('exam_type', isset($previous_exam) ? $previous_exam->exam_type : '') == '1' ? 'selected' : '' }}>
                                            MCQ</option>
                                        <option value="2"
                                            {{ old('exam_type', isset($previous_exam) ? $previous_exam->exam_type : '') == '2' ? 'selected' : '' }}>
                                            Written</option>
                                    </select>
                                </div>
                            </div>
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="duration">Exam Duration</label>
                                    <div class="d-flex" style="gap: 10px;">
                                        <input type="number" class="form-control me-2" name="hours" id="hours"
                                            value="{{ old('hours', isset($previous_exam) ? floor($previous_exam->duration / 60) : '') }}"
                                            placeholder="Hours" min="0" required>
                                        <input type="number" class="form-control" name="minutes" id="minutes"
                                            value="{{ old('minutes', isset($previous_exam) ? $previous_exam->duration % 60 : '') }}"
                                            placeholder="Minutes" min="0" max="59" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="basic-form">
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
