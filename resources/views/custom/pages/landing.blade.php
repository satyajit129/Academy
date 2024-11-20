@extends('custom.global.app')

@section('content')
<!-- Carousel Start -->
<div class="container-fluid p-0 pb-5">
    <div class="owl-carousel header-carousel position-relative mb-5">
        <div class="owl-carousel-item position-relative" style="height: 400px;"> <!-- Adjust the height here -->
            <img class="img-fluid" src="{{ asset('landing/img/book.jpg') }}" alt="" style="object-fit: cover; height: 100%;">
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                style="background: rgba(6, 3, 21, .5);">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-10 col-lg-8">
                            <h5 class="text-white text-uppercase mb-3 animated slideInDown">বাংলাদেশের সকল ধরনের চাকরি সমাধান</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Carousel End -->



    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container py-5">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-secondary text-uppercase">আমাদের সেবাসমুহ</h6>
                <h1 class="mb-5">আমাদের সেবা সমুহ ঘুরে দেখুন</h1>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item p-4">
                        <div class="overflow-hidden mb-4">
                            <img class="img-fluid" src="img/service-1.jpg" alt="">
                        </div>
                        <h4 class="mb-3">কমপ্লিট জব সল্যুশন</h4>
                        <p>You can view the full Job solution information by clicking this button.</p>
                        <a class="btn-slide mt-2" href="{{ route('jobSolution') }}"><i class="fa fa-arrow-right"></i><span>আরও দেখুন</span></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item p-4">
                        <div class="overflow-hidden mb-4">
                            <img class="img-fluid" src="img/service-2.jpg" alt="">
                        </div>
                        <h4 class="mb-3">বিগত চাকরির পরিক্ষাসমুহ</h4>
                        <p>You can view the specifics of the previous job exam by clicking this button.</p>
                        <a class="btn-slide mt-2" href="{{ route('previousJobExams') }}"><i class="fa fa-arrow-right"></i><span>আরও দেখুন</span></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item p-4">
                        <div class="overflow-hidden mb-4">
                            <img class="img-fluid" src="img/service-3.jpg" alt="">
                        </div>
                        <h4 class="mb-3">নিজেকে যাচাইকরণ</h4>
                        <p>Do you want to test yourself and see your progress? Click here to take a test.</p>
                        <a class="btn-slide mt-2" href="{{ route('exams') }}"><i class="fa fa-arrow-right"></i><span>আরও দেখুন</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->



    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container py-5">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-secondary text-uppercase">Our Team</h6>
                <h1 class="mb-5">Expert Team Members</h1>
            </div>
            <div class="row g-4">
                @foreach ($team_members as $team_member)
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item p-4">
                        <div class="overflow-hidden mb-4">
                            <img class="img-fluid" src="{{ asset('images/'.$team_member->image) }}" alt="" style="width: 100%;">
                        </div>
                        <h5 class="mb-0">{{ $team_member->name }}</h5>
                        <p>{{ $team_member->role }}</p>
                        <div class="btn-slide mt-1">
                            <i class="fa fa-share"></i>
                            <span>
                                <a href="{{ $team_member->facebook_link }}"><i class="fab fa-facebook-f"></i></a>
                                <a href="{{ $team_member->insta_link }}"><i class="fab fa-instagram"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
                
            </div>
        </div>
    </div>
    <!-- Team End -->
@endsection
