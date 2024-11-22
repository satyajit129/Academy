@extends('custom.global.app')
@section('custom_css')
    <style>
        .toast-error {
            background-color: #f44336 !important;
            color: white !important;
        }

        /* General Styles */
        .performers-container {
            display: flex;
            flex-direction: column;
            border: 1px solid #ddd;
            margin-top: 20px;
        }

        .performer-row {
            display: flex;
            border-bottom: 1px solid #ddd;
        }

        .performer-cell {
            padding: 8px 12px;
            flex: 1;
            text-align: center;
        }

        /* Header Style */
        .performer-row.header {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        /* Data Rows */
        .performers-list .performer-row {
            display: flex;
            border-bottom: 1px solid #f1f1f1;
        }

        .performers-list .performer-row:nth-child(odd) {
            background-color: #f9f9f9;
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
                        <h4 class="m-0">Here the the list of All Performers</h4>
                    </div>
                    <div class="card-body">
                        <div class="performers-container">
                            <div class="performer-row header">
                                <div class="performer-cell">#</div>
                                
                                <div class="performer-cell">Name</div>
                                <div class="performer-cell">Total Answered</div>
                                <div class="performer-cell">Total Correct</div>
                                <div class="performer-cell">Total Wrong</div>
                                <div class="performer-cell">Total Marks</div>
                            </div>

                            <div id="performers_data" class="performers-list">
                                @include('custom.pages.exam.partials.all_performers_list', [
                                    'all_performers' => $all_performers,
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
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                const page = $(this).attr('href').split('page=')[1];
                fetchData(page);
            });

            function fetchData(page = 1) {
                $.ajax({
                    url: "{{ route('seeAllPerformerData') }}",
                    method: "GET",
                    data: {
                        page: page
                    },
                    success: function(data) {
                        $('#performers_data').html(data);
                    }
                });
            }
        });
    </script>
@endsection
