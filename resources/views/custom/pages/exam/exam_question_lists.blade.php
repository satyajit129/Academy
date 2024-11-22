@extends('custom.global.app')
@section('custom_css')
    <style>
        .form-check-input:checked {
            background-color: #14a814;
            border-color: #14a814;
        }
        .exam-details p {
            display: flex;
            align-items: center;
            font-size: 1.1rem;
            margin: 0.5rem 0;
        }
        .exam-details span {
            display: inline-block;
        }
        .exam-details span:first-child {
            min-width: 150px; /* Adjust as needed */
            font-weight: bold;
        }
        .dotted-line {
            flex: 1;
            border-bottom: 1px dotted #000;
            margin: 0 10px;
        }
        .toast-error {
        background-color: #f44336 !important; /* Red background for errors */
        color: white !important; /* White text color */
    }
    </style>
@endsection
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5" style="margin-bottom: 6rem;">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">বিগত চাকরির পরীক্ষা</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">About</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->
    <div class="container mt-5">
        <div class="row mb-2">
            <div class="col-lg-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="m-0">পরীক্ষার নামঃ {{ $custom_exam_questions->name }} </h4>
                    </div>
                    <div class="card-body">
                        <!-- পরীক্ষার বিবরণ ডটেড লাইন সহ -->
                        <div class="exam-details">
                            <p><span>প্রশ্নের সংখ্যা</span><span class="dotted-line"></span><span>{{ $custom_exam_questions->questions->count() }} প্রশ্ন</span></p>
                            <p><span>মোট নম্বর</span><span class="dotted-line"></span><span>{{ $custom_exam_questions->questions->count() }}নম্বর</span></p>
                            <p><span>পাশ মার্কস</span><span class="dotted-line"></span><span>{{ $custom_exam_questions->passing_marks }} নম্বর</span></p>
                            <p><span>নেগেটিভ মার্কস</span><span class="dotted-line"></span><span>{{ $custom_exam_questions->negative_marks }} নম্বর (Per Wrong Answer)</span></p>
                            <p>
                                <span>পরীক্ষার সময়কাল</span>
                                <span class="dotted-line"></span>
                                <span id="exam-timer">{{ $custom_exam_questions->exam_duration }}:00</span> &nbsp; মিনিট
                            </p>
                            <hr>
                    
                            <form action="{{ route('customExamSubmit') }}" method="POST" id="exam-form">
                                <input type="hidden" value="{{ $custom_exam_questions->id }}" name="custom_exam_id">
                                @csrf
                            
                                @foreach ($custom_exam_questions->questions as $index => $question)
                                    <div class="question mb-4">
                                        <h6>প্রশ্ন-{{ $index + 1 }}: {{ $question->question_text }}</h6>
                                        <div style="padding-left: 16px;">
                                            @foreach ($question->options as $option)
                                                <div class="form-check">
                                                    <input type="radio" name="answers[{{ $question->id }}]" 
                                                           value="{{ $option->id }}" 
                                                           id="option{{ $option->id }}" 
                                                           class="form-check-input">
                                                    <label for="option{{ $option->id }}" class="form-check-label">{{ $option->option_text }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            
                                <div style="text-align: right;">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                            
                            <!-- Modal -->
                            <div id="resultModal" class="modal fade" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="resultModalLabel">Exam Results</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endSection

@section('custom_scripts')
<script>
    $(document).ready(function() {
      var duration = {{ $custom_exam_questions->exam_duration }};
      var time = duration * 60; 
      function startTimer() {
        var timerInterval = setInterval(function() {
          var minutes = Math.floor(time / 60);
          var seconds = time % 60;
          $('#exam-timer').text(minutes + ':' + (seconds < 10 ? '0' : '') + seconds);
  
        if (time <= 0) {
            clearInterval(timerInterval);
            $('#exam-form').submit();
        }
          time--; 
        }, 1000);
      }
      startTimer();
    });
</script>

@if ($errors->any())
<script>
    @foreach ($errors->all() as $error)
        toastr.error('{{ $error }}', 'Validation Error', {
            positionClass: 'toast-top-right',
            closeButton: true,
            progressBar: true,
            timeOut: 50000, 
            extendedTimeOut: 1000, 
            preventDuplicates: true, 
            newestOnTop: true, 
            progressBar: true,
            closeHtml: '<button><i class="fa fa-times"></i></button>', 
            toastClass: 'toast toast-error',
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
    $(document).ready(function () {
    $('#exam-form').on('submit', function (e) {
        e.preventDefault();

        let formData = $(this).serialize(); 

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: formData,
            success: function (response) {
                
                $('#resultModal .modal-body').html(`
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>##</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>মেসেজ</strong></td>
                                <td>${response.message}</td>
                            </tr>
                            <tr>
                                <td><strong>মোট নম্বর</strong></td>
                                <td>${response.result.total_marks}</td>
                            </tr>
                            <tr>
                                <td><strong>মোট উত্তর দেওয়া হয়েছে</strong></td>
                                <td>${response.result.total_answered}</td>
                            </tr>
                            <tr>
                                <td><strong>সঠিক উত্তর</strong></td>
                                <td>${response.result.total_correct}</td>
                            </tr>
                            <tr>
                                <td><strong>ভুল উত্তর</strong></td>
                                <td>${response.result.total_wrong}</td>
                            </tr>
                            <tr>
                                <td><strong>চেষ্টার সংখ্যা</strong></td>
                                <td>${response.result.attempts}</td>
                            </tr>
                            <tr>
                                <td><strong>অবস্থা</strong></td>
                                <td>${response.result.is_passed ? 'উত্তীর্ণ' : 'অনুত্তীর্ণ'}</td>
                            </tr>
                        </tbody>
                    </table>
                `);
                
                const serializedAnswers = encodeURIComponent(JSON.stringify(response.all_question_with_user_answer));
                
                const downloadUrl = "{{ route('downloadQuestionPdf', ['user_id' => '__USER_ID__', 'custom_question_id' => '__QUESTION_ID__', 'all_question_with_user_answer' => '__QUESTION_AND_ANSWER__' ]) }}";
                
                const finalDownloadUrl = downloadUrl
                    .replace('__USER_ID__', response.user_id)
                    .replace('__QUESTION_ID__', response.question_id)
                    .replace('__QUESTION_AND_ANSWER__', serializedAnswers);
                
                const downloadButton = `<a href="${finalDownloadUrl}" class="btn btn-primary">Download</a>`;
                $('#resultModal .modal-footer').html(downloadButton);
                $('#resultModal').modal('show');
            },

            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    for (let field in errors) {
                        if (errors.hasOwnProperty(field)) {
                            errors[field].forEach(function (error) {
                                toastr.error(error, 'Validation Error', {
                                    closeButton: true,
                                    progressBar: true,
                                    timeOut: 5000,
                                });
                            });
                        }
                    }
                } else {
                    console.error('Error response:', xhr.responseJSON);
                    toastr.error(xhr.responseJSON.message, {
                        closeButton: true,
                        progressBar: true,
                        timeOut: 10000,
                    });
                }
            }

        });
    });
});

</script>
@endsection
