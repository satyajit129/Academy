@extends('custom.global.app')
@section('custom_css')
    <style>
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.5);
            /* semi-transparent black */
            border-radius: 50%;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
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
    <div class="container-fluid mt-5">
        <div class="row mb-2 align-items-center">
            <h2 class="text-center border-bottom">পরীক্ষা</h2>
            <h4>সেরা 10 পারফর্মার</h4>
            <div class="owl-carousel">
                <div class="item">
                    <div class="card rounded-0 m-1">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center mb-3">
                                <img src="{{ asset('images/' . (Auth::user()->profile_image ?? 'man.png')) }}"
                                    alt="{{ Auth::user()->name ?? 'User Icon' }}" class="rounded-circle me-2"
                                    style="width: 50px; height: 50px; object-fit: cover;">
                                <div>
                                    <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                    <small class="text-muted">{{ Auth::user()->email }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="card rounded-0 m-1">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center mb-3">
                                <img src="{{ asset('images/' . (Auth::user()->profile_image ?? 'man.png')) }}"
                                    alt="{{ Auth::user()->name ?? 'User Icon' }}" class="rounded-circle me-2"
                                    style="width: 50px; height: 50px; object-fit: cover;">
                                <div>
                                    <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                    <small class="text-muted">{{ Auth::user()->email }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="card rounded-0 m-1">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center mb-3">
                                <img src="{{ asset('images/' . (Auth::user()->profile_image ?? 'man.png')) }}"
                                    alt="{{ Auth::user()->name ?? 'User Icon' }}" class="rounded-circle me-2"
                                    style="width: 50px; height: 50px; object-fit: cover;">
                                <div>
                                    <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                    <small class="text-muted">{{ Auth::user()->email }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="card rounded-0 m-1">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center mb-3">
                                <img src="{{ asset('images/' . (Auth::user()->profile_image ?? 'man.png')) }}"
                                    alt="{{ Auth::user()->name ?? 'User Icon' }}" class="rounded-circle me-2"
                                    style="width: 50px; height: 50px; object-fit: cover;">
                                <div>
                                    <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                    <small class="text-muted">{{ Auth::user()->email }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" p-3 " style="text-align: right;">
                <a href="#" class="btn btn-outline-primary rounded-0">সকল পারফর্মার দেখুন</a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <div class="card rounded-0">
                    <div class="card-header">
                        <h4 class="card-title">পরীক্ষা সমূহ</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-4 col-12">
                                <div class="card rounded-0 position-relative">
                                    <div class="card-body">
                                        <h6>মডেল টেস্ট ৪৭</h6>
                                        <div class="d-flex align-items-center justify-content-start gap-2">
                                            <p class="border p-2">২০ প্রশ্ন</p>
                                            <p class="border p-2">২০ মার্ক</p>
                                            <p class="border p-2">১০ মিনিট</p>
                                        </div>
                                        <p>পরীক্ষক : Satyajit </p>
                                        <p>বিষয় : <span class="badge text-bg-secondary">Bangla</span> <span class="badge text-bg-secondary">English</span> </p>
                                    </div>
                                    <span class="position-absolute top-0 start-100 translate-middle p-2 bg-success border border-light rounded-circle">
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="card rounded-0 position-relative">
                                    <div class="card-body">
                                        <h6>মডেল টেস্ট ৪৭</h6>
                                        <div class="d-flex align-items-center justify-content-start gap-2">
                                            <p class="border p-2">২০ প্রশ্ন</p>
                                            <p class="border p-2">২০ মার্ক</p>
                                            <p class="border p-2">১০ মিনিট</p>
                                        </div>
                                        <p>পরীক্ষক : Satyajit </p>
                                        <p>বিষয় : <span class="badge text-bg-secondary">Bangla</span> <span class="badge text-bg-secondary">English</span> </p>
                                    </div>
                                    <span class="position-absolute top-0 start-100 translate-middle p-2 bg-success border border-light rounded-circle">
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="card rounded-0 position-relative">
                                    <div class="card-body">
                                        <h6>মডেল টেস্ট ৪৭</h6>
                                        <div class="d-flex align-items-center justify-content-start gap-2">
                                            <p class="border p-2">২০ প্রশ্ন</p>
                                            <p class="border p-2">২০ মার্ক</p>
                                            <p class="border p-2">১০ মিনিট</p>
                                        </div>
                                        <p>পরীক্ষক : Satyajit </p>
                                        <p>বিষয় : <span class="badge text-bg-secondary">Bangla</span> <span class="badge text-bg-secondary">English</span> </p>
                                    </div>
                                    <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                    </span>
                                    <a href="" class="stretched-link"></a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                loop: true,
                autoplay: true,
                autoplayTimeout: 2000,
                margin: 10,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            });
        });
    </script>
@endsection
