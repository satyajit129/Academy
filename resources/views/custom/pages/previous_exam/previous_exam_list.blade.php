@extends('custom.global.app')

@section('custom_css')
    <style>
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
        <div class="row mb-2">

            <div class="col-lg-4 col-12 mt-1">
                <div class="card">
                    <div class="card-header">
                        <h4 class="m-0">অন্যান্য নিয়োগ পরীক্ষা</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="{{ route('previousJobExams') }}"><i class="fas fa-briefcase me-2"></i> সব
                                    পরীক্ষা</a>
                            </li>
                            @foreach ($others_jobs_categories as $category)
                                @php
                                    $category_id = encrypt($category->id);
                                @endphp
                                <li class="list-group-item">
                                    <a class="" href="{{ route('previousJobExams', ['category' => $category_id]) }}">
                                        <i class="fas fa-briefcase me-2"></i>
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-lg-8 col-12 mt-1">
                <div class="card">
                    <div class="card-header">
                        <h4 class="m-0">বিগত চাকরির পরীক্ষা</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <input type="text" id="searchInput" class="form-control shadow-sm"
                                    placeholder="Search exams by Name or Exam category...">
                            </div>
                        </div>

                        <div class="row" id="examList">
                            <!-- Exam List Partial -->
                            @include('custom.pages.previous_exam.partials.exam_list', [
                                'previous_job_exams' => $previous_job_exams,
                            ])
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
                    url: "{{ route('previousJobExamsSearch') }}",
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
