@extends('backend.global.master')
@section('title', 'General Knowledge List')
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
                    <h4 class="card-title">General Knowledge List</h4>
                    <a href="{{ route('GKCreateorUpdate') }}" class="btn btn-primary btn-rounded">Add New Question</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @foreach ($paginator as $date => $questions)
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h3>Date: {{ \Carbon\Carbon::parse($date)->format('d F Y') }}</h3>
                                    <a href="{{ route('GKEdit', $date) }}" class="btn btn-primary btn-sm btn-rounded">Edit</a>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered verticle-middle table-responsive-sm" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Question</th>
                                                <th>Answer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($questions as $index => $question)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $question->question }}</td>
                                                    <td>{{ $question->answer }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $paginator->links() }}
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_scripts')
@endsection