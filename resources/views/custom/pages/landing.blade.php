@extends('custom.global.app')

@section('custom_css')

@endsection

@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 pb-5">
        <div class="owl-carousel header-carousel position-relative mb-5">
            <div class="owl-carousel-item position-relative" style="height: 400px;"> <!-- Adjust the height here -->
                <img class="img-fluid" src="{{ asset('landing/img/book.jpg') }}" alt=""
                    style="object-fit: cover; height: 100%;">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                    style="background: rgba(6, 3, 21, .5);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h5 class="text-white text-uppercase mb-3 animated slideInDown">বাংলাদেশের সকল ধরনের চাকরি
                                    সমাধান</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Question Bank -->
    <div style="background:#d9c9d7bd; padding: 2rem 0; margin-bottom: 6rem;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-wrapper">
                        <div class="section-header text-center">
                            <div style="display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom:10px;">
                                <span style="flex-grow: 1; height: 2px; background-color: #FF3E41;"></span>
                                <h3 style="margin: 0; padding: 0 10px;">প্রশ্ন ব্যাংক</h3>
                                <span style="flex-grow: 1; height: 2px; background-color: #FF3E41;"></span>
                            </div>
                        </div>
                        <div class="section-body">
                            <div class="row">
                                @foreach ($exam_categories as $exam_category)
                                @php
                                    $category_id = encrypt($exam_category->id);
                                @endphp
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div style="border: 1px solid #e0e0e0; border-radius: 10px; overflow: hidden; box-shadow: 0 8px 12px rgba(0, 0, 0, 0.1); background-color: #ffffff; transition: transform 0.3s ease, box-shadow 0.3s ease; margin-bottom:10px;">
                                            <div class="d-flex justify-content-center">
                                                <img src="{{ asset('images/card-image.png') }}" style="width: 130px; height:auto;margin-top:10px;">
                                            </div>
                                            <div style="padding: 20px; text-align: center;">
                                                <h6 style="font-size: 1.5rem; font-weight: bold; color: #333; margin-bottom: 15px;">{{ $exam_category->name }}</h6>
                                                <div class="btn-section btn-single w-100">
                                                    <a href="{{ route('previousJobExams', ['category' => $category_id]) }}"" style="width:100%; display: inline-block; text-decoration: none; color: #000000; background-color: #ffecec; padding: 10px 20px; border-radius: 5px; font-weight: bold; box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2); transition: background-color 0.3s ease, transform 0.3s ease;">
                                                        <span>See List</span> &nbsp;
                                                        <i class="fa-solid fa-arrow-right-to-bracket"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                
                            </div>
                            
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Question Bank -->

    <!-- SubjectWise Question -->
    <div style="background:#c9d6d9; padding: 2rem 0; margin-bottom: 6rem;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-wrapper">
                        <div class="section-header text-center">
                            <div style="display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom:10px;">
                                <span style="flex-grow: 1; height: 2px; background-color: #FF3E41;"></span>
                                <h3 style="margin: 0; padding: 0 10px;">বিষয়ভিত্তিক প্রস্তুতি</h3>
                                <span style="flex-grow: 1; height: 2px; background-color: #FF3E41;"></span>
                            </div>
                        </div>
                        <div class="section-body">
                            <div class="row">
                                @foreach ($subjects as $subject)
                                    @php
                                        $subject_id = encrypt($subject->id);
                                        $subject_slug = encrypt($subject->slug);
                                    @endphp
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div style="border: 1px solid #e0e0e0; border-radius: 10px; overflow: hidden; box-shadow: 0 8px 12px rgba(0, 0, 0, 0.1); background-color: #ffffff; transition: transform 0.3s ease, box-shadow 0.3s ease; margin-bottom:10px;">
                                            <div class="d-flex justify-content-center">
                                                <img src="{{ asset('images/book.png') }}" style="width: 130px; height:auto;">
                                            </div>
                                            <div style="padding: 20px; text-align: center;">
                                                <h6 style="font-size: 1.5rem; font-weight: bold; color: #333; margin-bottom: 15px;">{{ $subject->name }}</h6>
                                                <div class="btn-section btn-single w-100">
                                                    <a href="{{ route('jobSolutionSubjectWise', ['slug' => $subject_slug, 'id' => $subject_id]) }}" style="width:100%; display: inline-block; text-decoration: none; color: #000000; background-color: #ffecec; padding: 10px 20px; border-radius: 5px; font-weight: bold; box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2); transition: background-color 0.3s ease, transform 0.3s ease;">
                                                        <span>See List</span> &nbsp;
                                                        <i class="fa-solid fa-arrow-right-to-bracket"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                
                            </div>
                            
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SubjectWise Question -->


    <!-- Model Test  -->
    <div style="background:#d9c9d7bd; padding: 2rem 0; margin-bottom: 6rem;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-wrapper">
                        <div class="section-header text-center">
                            <div style="display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom:10px;">
                                <span style="flex-grow: 1; height: 2px; background-color: #FF3E41;"></span>
                                <h3 style="margin: 0; padding: 0 10px;">মডেল টেস্ট</h3>
                                <span style="flex-grow: 1; height: 2px; background-color: #FF3E41;"></span>
                            </div>
                        </div>
                        <div class="section-body">
                            <div class="row">
                                @foreach ($custom_exams as $custom_exam)
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div style="border: 1px solid #e0e0e0; border-radius: 10px; overflow: hidden; box-shadow: 0 8px 12px rgba(0, 0, 0, 0.1); background-color: #ffffff; transition: transform 0.3s ease, box-shadow 0.3s ease; margin-bottom:10px;">
                                            <div class="d-flex justify-content-center">
                                                <img src="{{ asset('images/model-test.png') }}" style="width: 130px; height:auto;">
                                            </div>
                                            <div style="padding: 20px; text-align: center;">
                                                <h6 style="font-size: 1.5rem; font-weight: bold; color: #333; margin-bottom: 15px;">{{ $custom_exam->name }}</h6>
                                                <div class="btn-section btn-single w-100">
                                                    <a href="/live_model_test" style="width:100%; display: inline-block; text-decoration: none; color: #000000; background-color: #ffecec; padding: 10px 20px; border-radius: 5px; font-weight: bold; box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2); transition: background-color 0.3s ease, transform 0.3s ease;">
                                                        <span>See List</span> &nbsp;
                                                        <i class="fa-solid fa-arrow-right-to-bracket"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Model Test -->


<!-- Our Team -->
<div style="background: #f4f6f8; padding: 3rem 0;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-wrapper">
                    <div class="section-header text-center mb-5">
                        <div style="display: flex; align-items: center; justify-content: center; gap: 15px; margin-bottom: 20px;">
                            <span style="flex-grow: 1; height: 3px; background-color: #FF3E41;"></span>
                            <h3 style="font-size: 2rem; color: #333; font-weight: 600; margin: 0; padding: 0 15px;">Meet Our Team</h3>
                            <span style="flex-grow: 1; height: 3px; background-color: #FF3E41;"></span>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            @foreach ($team_members as $team_member)
                                <div class="col-lg-3 col-md-6 col-12 mb-4">
                                    <div class="team-card" style="border-radius: 12px; overflow: hidden; box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1); background-color: #fff; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                                        <div class="d-flex justify-content-center" style="padding: 1rem; border-bottom: 1px solid #e0e0e0;">
                                            <img src="{{ asset('images/' . $team_member->image) }}" alt="{{ $team_member->name }}" style="border-radius: 50%; width: 150px; height: 150px; object-fit: cover;">
                                        </div>
                                        <div class="text-center p-3">
                                            <h5 style="font-size: 1.25rem; font-weight: bold; color: #333; margin-bottom: 0.5rem;">{{ $team_member->name }}</h5>
                                            <p style="font-size: 1rem; color: #555; margin: 0;">{{ $team_member->role }}</p>
                                            <p style="font-size: 0.875rem; color: #777;">{{ $team_member->education }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Our Team -->


    {{-- <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@section('custom_scripts')
    <script>
        $(document).ready(function() {
            $('#exampleModal').modal('show');
        });
    </script>
@endsection
