@extends('custom.global.app')

@section('custom_css')
<!-- CSS Styling -->
<style>
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
</style>
@endsection

@section('content')
<!-- Page Header Start -->
<div class="container-fluid page-header py-2" style="margin-bottom: 3rem;">
    <div class="container py-5">
        <h1 class="display-3 text-white mb-3 animated slideInDown">জব সলিউশন</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Start Exam</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<div class="container">
    <!-- Exam Details Start -->
    <div class="row">
        <div class="col-lg-12">
            <!-- Card for Exam Details -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">পরীক্ষার বিবরণ</h3>
                </div>
                <div class="card-body">
                    <!-- পরীক্ষার বিবরণ ডটেড লাইন সহ -->
                    <div class="exam-details">
                        <p><span>প্রশ্নের সংখ্যা</span><span class="dotted-line"></span><span>{{ $numberOfQuestions }} প্রশ্ন</span></p>
                        <p><span>মোট নম্বর</span><span class="dotted-line"></span><span>{{ $totalMarks }} নম্বর</span></p>
                        <p><span>কাট মার্কস</span><span class="dotted-line"></span><span>{{ $cutMarks }} নম্বর</span></p>
                        <p><span>নেগেটিভ মার্কস</span><span class="dotted-line"></span><span>{{ $negativeMarks }} নম্বর</span></p>
                        <p>
                            <span>পরীক্ষার সময়কাল</span>
                            <span class="dotted-line"></span>
                            <span id="exam-timer">{{ $examDuration }}:00 </span> &nbsp; মিনিট
                        </p>
                    </div>
                </div>
                <form action="{{ route('submitExam') }}" method="POST" id="exam-form">
                    @csrf
                    <div class="card-body">
                        <input type="hidden" name="question_ids" value="{{ $questions->pluck('id')->toJson() }}">
                        <input type="hidden" name="number_of_questions" value="{{ $numberOfQuestions }}">
                        <input type="hidden" name="total_marks" value="{{ $totalMarks }}">
                        <input type="hidden" name="cut_marks" value="{{ $cutMarks }}">
                        <input type="hidden" name="negative_marks" value="{{ $negativeMarks }}">
                        @foreach ($questions as $index => $question)
                        
                            <div class="question mb-4">
                                <h6>প্রশ্ন-{{ $index + 1 }}: {{ $question->question_text }}</h6>
                                <div style="padding-left: 16px;">
                                @foreach ($question->options as $option)
                                
                                    <div class="form-check">
                                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}" id="option{{ $option->id }}" class="form-check-input">
                                        <label for="option{{ $option->id }}"  class="form-check-label">{{ $option->option_text }}</label>
                                    </div>
                                @endforeach
                            </div>
                            </div>
                        @endforeach
                        <div style="text-align: right">
                            <button type="submit" class="btn btn-primary ">Submit Exam</button>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
    <!-- Exam Details End -->
</div>


@endsection

@section('custom_scripts')
<script>
    $(document).ready(function() {
      // Get the duration in minutes from your server-side variable
      var duration = {{ $examDuration }};
      var time = duration * 60; // Convert minutes to seconds
  
      function startTimer() {
        // Update timer every second
        var timerInterval = setInterval(function() {
          var minutes = Math.floor(time / 60);
          var seconds = time % 60;
  
          // Format time as MM:SS
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
            timeOut: 5000, // Time in milliseconds before the toast disappears
            extendedTimeOut: 1000, // Time for toast animation before disappearing
            preventDuplicates: true, // Prevent multiple toasts for the same message
            newestOnTop: true, // Show newest toast on top
            progressBar: true,
            closeHtml: '<button><i class="fa fa-times"></i></button>', // Custom close button
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
@endsection
