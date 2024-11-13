@extends('backend.global.master')
@section('title', 'Previous Exams Category Create/Edit')
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
                        <h4 class="card-title">Previous Exams Category Information</h4>
                        <a href="{{ route('previousExamsList') }}" class="btn btn-primary btn-rounded">Back To List</a>
                    </div>
                    <form action="{{ route('previousExamsCategoryStore', isset($previous_exam_category) ? $previous_exam_category->id : '') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="name">Previous Exam Category Name</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ old('name', isset($previous_exam_category) ? $previous_exam_category->name : '') }}"
                                        placeholder="Enter Previous Exam Category name" required>
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
