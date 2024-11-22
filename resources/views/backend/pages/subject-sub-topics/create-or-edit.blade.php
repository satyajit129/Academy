@extends('backend.global.master')
@section('title', 'Subject Sub Topics Create/Edit')
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
                        <h4 class="card-title">Subject Sub Topics Information</h4>
                        <a href="{{ route('subjectSubTopicsList') }}" class="btn btn-primary btn-rounded">Back To List</a>
                    </div>
                    <form action="{{ route('subjectSubTopicsStore', isset($subject_sub_topic) ? $subject_sub_topic->id : '') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="name">Sub Topic Name</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ old('name', isset($subject_sub_topic) ? $subject_sub_topic->name : '') }}"
                                        placeholder="Enter Subject lesson name" required>
                                </div>
                            </div>
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="topic_id">Subject Topic</label>
                                    <select name="topic_id" id="topic_id" class="form-control">
                                        <option selected disabled>Select Topic</option>
                                        @foreach ($subject_topics as $subject_topic)
                                            <option value="{{ $subject_topic->id }}"@if (isset($subject_sub_topic) && $subject_sub_topic->topic_id == $subject_topic->id) selected @endif
                                            >{{ $subject_topic->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-rounded btn-outline-primary pl-4 pr-4">Submit</button>
                        </div>
                </div>
                </form>

            </div>
        </div>
    </div>

    </div>
@endsection

@section('custom_scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endsection
