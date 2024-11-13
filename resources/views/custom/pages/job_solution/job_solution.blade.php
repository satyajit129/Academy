@extends('custom.global.app')

@section('custom_css')
@endsection


@section('content')
<!-- Page Header Start -->
<div class="container-fluid page-header py-5 bg-dark" style="margin-bottom: 6rem;">
    <div class="container py-5">
        <h1 class="display-3 text-white mb-3 animated slideInDown">জব সলিউশন</h1>
        <nav aria-label="breadcrumb" class="animated slideInDown">
            <ol class="breadcrumb bg-transparent p-0 m-0">
                <li class="breadcrumb-item">
                    <a class="text-white text-decoration-none" href="/">হোম পেজ </a>
                </li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->
<div class="container-fluid mt-5">
    <div class="row mb-4 align-items-center justify-content-center">
        <div class="col-12">
            <h2 class="text-center text-uppercase border-bottom mb-4">জব সলিউশন</h2>
        </div>
        @foreach ($subjects as $subject)
            @php
                $subject_id = encrypt($subject->id);
                $subject_slug = encrypt($subject->slug);
            @endphp

            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">

                <div class="service-item p-4">
                    <div class="overflow-hidden mb-4">
                        <img class="img-fluid" src="img/service-1.jpg" alt="">
                    </div>
                    <h4 class="mb-3"><i class="fas fa-book me-2"></i> {{ $subject->name }}</h4>
                    <p><i class="fas fa-check-circle me-2"></i> MCQ - {{ $subject->questions->count() }}</p>
                    <a href="{{ route('jobSolutionSubjectWise', ['slug' => $subject_slug, 'id' => $subject_id]) }}" class="btn-slide mt-2 stretched-link"><i class="fa fa-arrow-right"></i><span>See Details</span></a>
                </div>

            </div>
        @endforeach
    </div>
</div>

@endsection


@section('custom_scripts')
@endsection
