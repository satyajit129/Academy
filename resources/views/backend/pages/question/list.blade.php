@extends('backend.global.master')
@section('title', 'QuestionList')
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
                        <h4 class="card-title">Questions List</h4>
                        <a href="{{ route('questionCreate') }}" class="btn btn-primary btn-rounded">Add New Question</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered verticle-middle table-responsive-sm" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Question</th>
                                        <th style="text-align: left !important;">Options</th>
                                        <th>Subject</th>
                                        <th>Lesson</th>
                                        <th>Topic</th>
                                        <th>Sub Topic</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($questions as $question)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $question->question_text }}</td>
                                            <td style="text-align: left !important;">
                                                <details>
                                                    <summary>
                                                        <strong>Options</strong>
                                                    </summary>
                                                    @foreach ($question->options as $option)
                                                        <small class="text-info">{{ $loop->iteration }} . {{ $option->option_text }} </small>
                                                        <br>
                                                    @endforeach
                                                </details>

                                            </td>
                                            <td>{{ $question->subject->name }}</td>
                                            <td>{{ $question->subjectLesson->name }}</td>
                                            <td>{{ $question->subjectTopic->name }}</td>
                                            <td>{{ $question->subjectSubTopic->name }}</td>
                                            <td><a href="{{ route('questionEdit', $question->id) }}"
                                                    class="btn btn-primary btn-rounded">Edit</a></td>
                                            <td><a href="{{ route('questionDelete', $question->id) }}"
                                                    class="btn btn-danger btn-rounded">Delete</a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No Data Found</td>
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
