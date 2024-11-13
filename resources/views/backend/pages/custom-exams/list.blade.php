@extends('backend.global.master')
@section('title', 'Custom Exams List')
@section('custom_css')
@endsection


@section('content')
<div class="container-fluid">
    @include('backend.global.get_greetings')
    <div class="row">
        <div class="col-12">
            <div class="card">
                @include('backend.global.alert')
                <div class="card-header">
                    <h4 class="card-title">Custom Exams List</h4>
                    <a href="{{ route('customExamsCreate') }}" class="btn btn-primary btn-rounded">Add New Exam</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered verticle-middle table-responsive-sm" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Questions</th>
                                    <th>Pass Mark</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>View</th>
                                    <th>Download</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($custom_exams as $custom_exam)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $custom_exam->name }}</td>
                                        <td>{{ $custom_exam->exam_type }}</td>
                                        <td>{{ $custom_exam->number_of_questions }}</td>
                                        <td>{{ $custom_exam->passing_marks }}</td>
                                        <td>
                                            @if ($custom_exam->status == 1)
                                                <span class="badge badge-success">Upcoming</span>
                                            @elseif($custom_exam->status == 2)
                                                <span class="badge badge-danger">On Going</span>
                                            @else
                                                <span class="badge badge-primary">Completed</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('customExamsEdit', $custom_exam->id) }}" class="btn btn-danger btn-rounded">Edit</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('customExamsViewQuestions', $custom_exam->id) }}" class="btn btn-primary btn-rounded">
                                                View
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('customExamsDownload', $custom_exam->id) }}" class="btn btn-primary btn-rounded">
                                                Download
                                            </a>
                                        </td>
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