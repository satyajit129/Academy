@extends('custom.global.app')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('frontend/css/subject_wise_question_design.css') }}">
    <style>
        .badge {
            display: inline-block;
            padding: 0.6em 0.6em;
        }
        .toast {
    font-family: 'Arial', sans-serif; /* Custom font */
    border-radius: 10px; /* Rounded corners */
    padding: 15px; /* Add padding to make the toast bigger */
}

.toast-success {
    background-color: #28a745 !important; /* Green background for success */
    color: #fff !important; /* White text */
}

.toast-error {
    background-color: #dc3545 !important; /* Red background for error */
    color: #fff !important; /* White text */
}

.toast-info {
    background-color: #17a2b8 !important; /* Blue background for info */
    color: #fff !important; /* White text */
}

.toast-warning {
    background-color: #ffc107 !important; /* Yellow background for warning */
    color: #000 !important; /* Black text */
}

.toast-close-button {
    color: #fff !important; /* Close button color */
    font-size: 18px; /* Size of the close button */
}

.toast-title {
    font-weight: bold; /* Make title bold */
}

.toast-message {
    font-size: 14px; /* Set the size of the message */
}
    </style>
@endsection


@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5" style="margin-bottom: 6rem;">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">জব সলিউশন</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">About</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h3 class="mb-2 text-primary">{{ $subject_info->name ?? 'Subject Name' }}</h3>

                        @isset($lesson_info)
                            <h4 class="mb-1 text-secondary">{{ $lesson_info->name }}</h4>
                        @endisset

                        @isset($topic_info)
                            <h5 class="mb-1 text-muted">{{ $topic_info->name }}</h5>
                        @endisset

                        @isset($sub_topic_info)
                            <h6 class="mb-0 text-info">{{ $sub_topic_info->name }}</h6>
                        @endisset

                        <p class="mt-2 text-dark">
                            প্রশ্ন সংখ্যা: <span class="badge bg-info">{{ $questions->count() }}</span>
                        </p>
                    </div>

                    <div class="card-body">
                        <div class="float-end">
                            <a href="#" class="btn btn-primary" data-bs-toggle="offcanvas"
                                data-bs-target="#testYourselfOffCanvas"> নিজেকে যাচাই করুন</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach ($questions as $index => $question)
                        @php
                            $question_id = encrypt($question->id);
                            $question_slug = $question->slug;
                        @endphp
                            <div class="card mb-4 shadow-sm">
                                <div class="card-body">
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <a href="{{ route('singleQuestion', ['slug' => $question_slug, 'id' => $question_id]) }}" class="h6 text-primary">
                                            {{ $questions->firstItem() + $index }}. {{ $question->question_text }}
                                        </a>                                        
                                    </div>
                                    <div class="question-options ml-4 mt-2">
                                        @foreach ($question->options as $option)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    id="option{{ $option->id }}" name="question{{ $question->id }}"
                                                    value="{{ $option->id }}" @if ($option->is_correct) checked @endif>
                                                <label class="form-check-label" for="option{{ $option->id }}" >
                                                    {{ $option->option_text }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $questions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Off-Canvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="testYourselfOffCanvas" aria-labelledby="offcanvasTestLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasTestLabel">নিজেকে যাচাই করুন</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <h4>পরীক্ষার সেটিংস</h4>
                <form id="examForm" action="{{ route('startExam') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="numberOfQuestions" class="form-label">প্রশ্নের সংখ্যা</label>
                        <input type="number" class="form-control" id="numberOfQuestions" name="numberOfQuestions" min="1" max="{{ $questions->count() }}" required>
                        <small class="form-text text-muted">অবধি প্রশ্ন: {{ $questions->count() }}</small>
                        <div id="questionLimitError" class="text-danger mt-1" style="display: none; font-size: 14px;">প্রশ্নের সংখ্যা উপলব্ধ প্রশ্নের চেয়ে বেশি হতে পারে না।</div>
                    </div>
                    <div class="mb-3">
                        <label for="totalMarks" class="form-label">মোট নম্বর</label>
                        <input type="number" class="form-control" id="totalMarks" name="totalMarks" required>
                    </div>
                    <div class="mb-3">
                        <label for="cutMarks" class="form-label">কাট মার্কস</label>
                        <input type="number" class="form-control" id="cutMarks" name="cutMarks" required>
                    </div>
                    <div class="mb-3">
                        <label for="negativeMarks" class="form-label">নেগেটিভ মার্কস</label>
                        <select name="negativeMarks" class="form-control" required>
                            <option value="0">0</option>
                            <option value="0.25">0.25</option>
                            <option value="0.5" selected>0.5</option>
                            <option value="1">1</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="examDuration" class="form-label">পরীক্ষার সময়কাল (মিনিট)</label>
                        <input type="number" class="form-control" id="examDuration" name="examDuration" required>
                    </div>

                    <input type="hidden" name="question_ids" value="{{ $questions->pluck('id')->toJson() }}">
                    <button type="submit" id="startExamButton" class="btn btn-success">পরীক্ষা শুরু করুন</button>
                </form>
                
            </div>
        </div>
        
    </div>
@endsection


@section('custom_scripts')
@if ($errors->any())
    <script>
        @foreach ($errors->all() as $error)
            toastr.error('{{ $error }}', 'Validation Error', {
                positionClass: 'toast-top-right',
                closeButton: true,
                progressBar: true,
                timeOut: 5000, 
                extendedTimeOut: 1000, 
                preventDuplicates: true, 
                newestOnTop: true, 
                progressBar: true,
                closeHtml: '<button><i class="fa fa-times"></i></button>',
            });
        @endforeach
    </script>
@endif

@if(session('error'))
    <script>
        toastr.error("{{ session('error') }}", "Error", {
            positionClass: 'toast-top-right',
            closeButton: true,
            progressBar: true,
            timeOut: 5000,
            extendedTimeOut: 1000,
            preventDuplicates: true,
            newestOnTop: true,
            progressBar: true,
            closeHtml: '<button><i class="fa fa-times"></i></button>',
        });
    </script>
@endif

    <script>
        $(document).ready(function() {
            $('#numberOfQuestions').on('input', function() {
                const maxQuestions = {{ $questions->count() }};
                const selectedQuestions = parseInt($(this).val());
                
                if (selectedQuestions > maxQuestions) {
                    $('#questionLimitError').show();
                    $(this).val(maxQuestions);
                    $('#startExamButton').attr('disabled', 'disabled');
                } else {
                    $('#questionLimitError').hide();
                }
                $('#totalMarks').val(selectedQuestions * 1);

                let cutMarks = selectedQuestions * 0.40;
                $('#cutMarks').val(Math.floor(cutMarks));

                let examDuration = selectedQuestions * 0.60;
                $('#examDuration').val(Math.floor(examDuration));
            });
        });
    </script>

@endsection
