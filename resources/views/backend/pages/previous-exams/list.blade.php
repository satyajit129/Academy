@extends('backend.global.master')
@section('title', 'Previous Exams List')
@section('custom_css')
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
                    <h4 class="card-title">Previous Exams List</h4>
                    <a href="{{ route('previousExamsCreateOrEdit') }}" class="btn btn-primary btn-rounded">Add New Exam</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered verticle-middle table-responsive-sm" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Code</th>
                                    <th>Year</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Type</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($previous_exams as $previous_exam)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $previous_exam->name }}</td>
                                        <td>{{ $previous_exam->category->name }}</td>
                                        <td>{{ $previous_exam->exam_code }}</td>
                                        <td>{{ $previous_exam->year->year }}</td>
                                        <td>{{ $previous_exam->exam_date ? \Carbon\Carbon::parse($previous_exam->exam_date)->format('m/d/Y') : 'N/A' }}</td>
                                        <td>{{ $previous_exam->duration }}</td>
                                        <td>
                                            @php
                                                if($previous_exam->type == 1){
                                                    $previous_exam->type = 'MCQ';
                                                }else{
                                                    $previous_exam->type = 'Written';
                                                }
                                            @endphp
                                            {{ $previous_exam->type }}
                                        </td>
                                        <td><a href="{{ route('previousExamsCreateOrEdit', $previous_exam->id) }}" class="btn btn-primary btn-rounded">Edit</a></td>
                                        <td><a href="{{ route('previousExamsDelete', $previous_exam->id) }}" class="btn btn-danger btn-rounded">Delete</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No Data Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_scripts')
@endsection