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
                        <h4 class="m-4">পরীক্ষার বিবরণ </h4>
                    </div>
                    <div class="card-body">
                        <!-- পরীক্ষার বিবরণ ডটেড লাইন সহ -->
                        <div class="exam-details">
                            <p><span>প্রশ্নের সংখ্যা</span><span class="dotted-line"></span><span>10 প্রশ্ন</span></p>
                            <p><span>মোট নম্বর</span><span class="dotted-line"></span><span>10 নম্বর</span></p>
                            <p><span>কাট মার্কস</span><span class="dotted-line"></span><span>5 নম্বর</span></p>
                            <p><span>নেগেটিভ মার্কস</span><span class="dotted-line"></span><span>0.5 নম্বর</span></p>
                            <p>
                                <span>পরীক্ষার সময়কাল</span>
                                <span class="dotted-line"></span>
                                <span id="exam-timer">10:00</span> &nbsp; মিনিট
                            </p>
                            <hr>
                    
                            <form action="" method="POST">
                                @csrf
                                @foreach ($custom_exam_questions->questions as $index => $question)
                                    <div class="question mb-4">
                                        <h6>প্রশ্ন-{{ $index + 1 }}: {{ $question->question_text }}</h6>
                                        <div style="padding-left: 16px;">
                                            @foreach ($question->options as $option)
                                                <div class="form-check">
                                                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}" id="option{{ $option->id }}" class="form-check-input">
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
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endSection

@section('custom_scripts')
@endsection
