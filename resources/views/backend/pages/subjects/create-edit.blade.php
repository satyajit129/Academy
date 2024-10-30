@extends('backend.global.master')
@section('title', 'Subject Create/Edit')
@section('custom_css')

    </style>
@endsection


@section('content')
    <div class="container-fluid">
        @include('backend.global.get_greetings')
        <div class="row">
            <div class="col-xxl-12">
                <div class="card">
                    @include('backend.global.alert')
                    <div class="card-header">
                        <h4 class="card-title">Subject Information</h4>
                        <a href="{{ route('subjectList') }}" class="btn btn-primary btn-rounded">Back To List</a>
                    </div>
                    <form action="{{ route('subjectStore', isset($subject) ? $subject->id : '') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="name">Subject Name</label>
                                    <input type="text" class="form-control" name="name" id="subject-name"
                                        value="{{ old('name', isset($subject) ? $subject->name : '') }}"
                                        placeholder="Enter Subject name" required>
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
