@extends('backend.global.master')
@section('title', 'Year Create/Edit')
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
                        <h4 class="card-title">Year Information</h4>
                        <a href="{{ route('yearsList') }}" class="btn btn-primary btn-rounded">Back To List</a>
                    </div>
                    <form action="{{ route('yearsStore', isset($year) ? $year->id : '') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="year">Year</label>
                                    <input type="number" class="form-control" name="year" 
                                        value="{{ old('year', isset($year) ? $year->year : '') }}"
                                        placeholder="Enter Year" required>
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
