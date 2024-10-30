@extends('custom.global.master')

@section('content')
    <div class="container-fluid">
        <div class="row mb-2">
            <div id="carouselExampleCaptions" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://placeholder.pics/svg/2500x900" class="d-block w-100 " alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>First slide label</h5>
                            <p>Some representative placeholder content for the first slide.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://placeholder.pics/svg/2500x900" class="d-block w-100 " alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Second slide label</h5>
                            <p>Some representative placeholder content for the second slide.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://placeholder.pics/svg/2500x900" class="d-block w-100 " alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Third slide label</h5>
                            <p>Some representative placeholder content for the third slide.</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-5">

        <div class="row mb-2">
            <h2 class="text-center border-bottom">সেবাসমূহ</h2>
            <div class="col-md-4">
                <div class="row g-0 border  overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary-emphasis">ভর্তি প্রস্তুতি
                        </strong>
                        <h3 class="mb-0">বিশ্ববিদ্যালয় ভর্তির পূর্ণাঙ্গ সমাধান</h3>
                        <a href="{{ route('admission') }}" class="icon-link gap-1 icon-link-hover stretched-link">
                            Continue reading
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row g-0 border  overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-success-emphasis">প্রোগ্রামিং প্রস্তুতি</strong>
                        <h3 class="mb-0">স্কিল ডেভেলপমেন্ট সেকশন</h3>
                        <a href="{{ route('programming') }}" class="icon-link gap-1 icon-link-hover stretched-link">
                            Continue reading
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row g-0 border  overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-success-emphasis">চাকরি প্রস্তুতি
                        </strong>
                        <h3 class="mb-0">চাকরি প্রস্তুতির পূর্ণাঙ্গ সমাধান</h3>
                        <a href="{{ route('jobSolution') }}" class="icon-link gap-1 icon-link-hover stretched-link">
                            Continue reading
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
