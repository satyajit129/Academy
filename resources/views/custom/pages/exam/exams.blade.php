@extends('custom.global.master')
@section('custom_css')
    <style>
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.5);
            /* semi-transparent black */
            border-radius: 50%;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid mt-5">
        <div class="row mb-2 align-items-center">
            <h2 class="text-center border-bottom">পরীক্ষা সমূহ</h2>
            <h4 >Top 10 Performer</h4>
            <div class="col-12 col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center ">
                            @if (Auth::user()->profile_image != null)
                                <img src="{{ asset('images/' . Auth::user()->profile_image) }}" style="width: 65px; height: 65px;" class="rounded-circle me-2" alt="{{ Auth::user()->name }}">
                            @else
                                <img src="{{ asset('images/man.png') }}" alt="User Icon" class="rounded-circle me-2" style="width: 65px; height: 65px;">
                            @endif
    
                            <div>
                                <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                <small class="text-muted">{{ Auth::user()->email }}</small> <br>
                                <small class="text-muted">Total Obtained Marks: <strong>85</strong></small> <br>
                                <small class="text-muted">Total Marks: <strong>100</strong></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="col-12 col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center ">
                            @if (Auth::user()->profile_image != null)
                                <img src="{{ asset('images/' . Auth::user()->profile_image) }}" style="width: 65px; height: 65px;" class="rounded-circle me-2" alt="{{ Auth::user()->name }}">
                            @else
                                <img src="{{ asset('images/man.png') }}" alt="User Icon" class="rounded-circle me-2" style="width: 65px; height: 65px;">
                            @endif
    
                            <div>
                                <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                <small class="text-muted">{{ Auth::user()->email }}</small> <br>
                                <small class="text-muted">Total Obtained Marks: <strong>85</strong></small> <br>
                                <small class="text-muted">Total Marks: <strong>100</strong></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="col-12 col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center ">
                            @if (Auth::user()->profile_image != null)
                                <img src="{{ asset('images/' . Auth::user()->profile_image) }}" style="width: 65px; height: 65px;" class="rounded-circle me-2" alt="{{ Auth::user()->name }}">
                            @else
                                <img src="{{ asset('images/man.png') }}" alt="User Icon" class="rounded-circle me-2" style="width: 65px; height: 65px;">
                            @endif
    
                            <div>
                                <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                <small class="text-muted">{{ Auth::user()->email }}</small> <br>
                                <small class="text-muted">Total Obtained Marks: <strong>85</strong></small> <br>
                                <small class="text-muted">Total Marks: <strong>100</strong></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
@endSection
