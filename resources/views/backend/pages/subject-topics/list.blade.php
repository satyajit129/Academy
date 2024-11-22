@extends('backend.global.master')
@section('title', 'Subject Topics List')
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
                    <h4 class="card-title">Subject Topics List</h4>
                    <a href="{{ route('subjectTopicsCreateOrEdit') }}" class="btn btn-primary btn-rounded">Add New Topic</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered verticle-middle table-responsive-sm" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Subject</th>
                                    <th>Lesson</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subject_topics as $subject_topic)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $subject_topic->name }}</td>
                                        <td>{{ $subject_topic->subject->name }}</td>
                                        <td>{{ $subject_topic->subjectLessons->name }}</td>
                                        <td><a href="{{ route('subjectTopicsCreateOrEdit', $subject_topic->id) }}" class="btn btn-primary btn-rounded">Edit</a></td>
                                        <td><a href="{{ route('subjectTopicsDelete', $subject_topic->id) }}" class="btn btn-danger btn-rounded">Delete</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No Data Found</td>
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