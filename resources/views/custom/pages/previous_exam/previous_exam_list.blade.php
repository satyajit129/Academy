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
            
            <h4 class="display-3 text-white mb-3 animated slideInDown">বিগত চাকরির পরীক্ষা</h4>
            <nav aria-label="breadcrumb animated slideInDown">
            </nav>
        </div>
    </div>
    <div style="background:#d9c9d7bd; padding: 2rem 0; margin-bottom: 6rem;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-wrapper">
                        <div class="section-header text-center">
                            <div style="display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom:10px;">
                                <span style="flex-grow: 1; height: 2px; background-color: #FF3E41;"></span>
                                <h3 style="margin: 0; padding: 0 10px;">পরীক্ষা সমুখ </h3>
                                <span style="flex-grow: 1; height: 2px; background-color: #FF3E41;"></span>
                            </div>
                        </div>
                        <div class="section-body">
                            <div class="row" id="examList">
                                @include('custom.pages.previous_exam.partials.exam_list', [
                                    'previous_job_exams' => $previous_job_exams,
                                ])
                            </div>
                            
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
