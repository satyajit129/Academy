@extends('custom.global.app')
@section('custom_css')
    <style>
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.5);
            /* semi-transparent black */
            border-radius: 50%;
        }

        .exam-item .card {
            transition: transform 0.3s ease-in-out;
        }

        .exam-item .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .exam-item .exam-name {
            color: #28a745;
        }

        #searchInput {
            border: 2px solid #28a745;
        }

        .custom-card {
            position: relative;
            overflow: hidden;
            /* Ensures elements stay inside the card */
        }

        .custom-badge {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            background-color: #6c757d;
            color: #fff;
            font-size: 0.9rem;
            padding: 0.5em 0.5em;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 10;
            transform: translate(50%, -50%);
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
    <div class="container mt-5">
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
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <input type="text" id="searchInput" class="form-control shadow-sm"
                                    placeholder="Search exams by Name or Exam category...">
                            </div>
                        </div>
                        <div class="row" id="examList">
                            @include('custom.pages.exam.partials.exam_list', [
                                'custom_exams' => $custom_exams,
                            ])
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

    <script>
        $(document).ready(function() {
            // Handle search input
            $('#searchInput').on('input', function() {
                fetchExams($(this).val());
            });
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                const page = $(this).attr('href').split('page=')[1];
                fetchExams($('#searchInput').val(), page);
            });

            function fetchExams(query = '', page = 1) {
                $.ajax({
                    url: "{{ route('customExamsSearch') }}",
                    method: "GET",
                    data: {
                        query: query,
                        page: page
                    },
                    success: function(data) {
                        $('#examList').html(data);
                    }
                });
            }
        });
    </script>
@endsection
