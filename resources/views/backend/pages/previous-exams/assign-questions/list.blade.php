@extends('backend.global.master')
@section('title', 'Assign Questions')
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
                    </div>

                    <div class="card-body">
                        @forelse ($previous_exams as $previous_exam)
                            <hr>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>{{ $previous_exam->name }}</h4>
                                    <div>
                                        <small class="text-primary">Year: {{ $previous_exam->year->year }}</small> |
                                        <small class="text-primary">Exam Date:
                                            {{ $previous_exam->exam_date ? \Carbon\Carbon::parse($previous_exam->exam_date)->format('m/d/Y') : 'N/A' }}</small>
                                        |
                                        <small class="text-primary">Duration:
                                            {{ floor($previous_exam->duration / 60) }} hour
                                            {{ $previous_exam->duration % 60 }} min
                                        </small> |

                                        <small class="text-primary">Status:
                                            @if ($previous_exam->is_published == 1)
                                                <span class="badge badge-success">Published</span>
                                            @else
                                                <span class="badge badge-danger">Unpublished</span>
                                            @endif
                                        </small>
                                    </div>
                                    <div>
                                        <span class="text-dark"><small class="text-primary">Total Questions: </small>
                                            200</span>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <a href="{{ route('assignQuestions', $previous_exam->id) }}"
                                        class="btn btn-sm btn-outline-primary">Questions</a>
                                </div>
                            </div>
                            <hr>
                        @empty
                            <p class="text-center">No Previous Exams Found</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_scripts')
@endsection
