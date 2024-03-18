@extends('frontend.global.master')
@section('title', 'Academy')

@section('frontend_custom_stylesheet')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


@stop

@section('frontend_content')
    <div class="container">
        @include('frontend.layout.hero_section')

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4">
            <h1 class="h3 mb-0 text-gray-800">ক্যাটাগরি</h1>
        </div>
        <div class="feature-card">
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->

                <div class="col-xl-4 col-md-6 mb-4">
                    <a href="">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center" style="padding: 1rem;">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            job Preparation</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">চাকরি প্রস্তুতি</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-book"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>


                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <a href="">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center" style="padding: 1rem;">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            job Preparation</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">চাকরি প্রস্তুতি</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-book"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>

@stop

@section('frontend_custom_scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
@stop
