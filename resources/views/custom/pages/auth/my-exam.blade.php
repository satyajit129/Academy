@extends('custom.global.master')

@section('custom_css')
    
@endsection

@section('content')
<div class="container-fluid ">
    <div class="row">
        <div class="col-lg-5 bg-light p-3">
            <div class="card rounded-0">
                <div class="card-body">
                    <div class="text-center mb-4 p-4 bg-light rounded shadow-sm">
                        <!-- Profile Image and Info -->
                        <img src="@if (auth()->user()->profile_image == null)
                             {{ asset('images/man.png') }} 
                        @else
                            {{ asset('images/' . auth()->user()->profile_image) }}
                        @endif" alt="Profile Image" class="img-fluid rounded-circle mb-3" style="width: 100px; height: 100px;">
                        <h5>Satyajit Roy (Satyajit)</h5>
                        <p>Member Since: 28 Sep, 2024</p>
                    
                        <!-- Exams Summary Title -->
                        <h4 class="mt-4">My Exams Summary</h4>
                    
                        <!-- Exams Summary Table -->
                        <table class="table table-bordered table-striped table-hover table-sm mt-3">
                            <thead class="table-primary">
                                <tr>
                                    <th class="text-center w-50">Exams</th>
                                    <th class="text-center w-50">1</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center w-50">Passed</td>
                                    <td class="text-center w-50">1</td>
                                </tr>
                                <tr>
                                    <td class="text-center w-50">Failed</td>
                                    <td class="text-center w-50">0</td>
                                </tr>
                            </tbody>
                        </table>
                    
                        <!-- Question Summary Table -->
                        <table class="table table-bordered table-striped table-hover table-sm mt-3">
                            <thead class="table-primary">
                                <tr>
                                    <th class="text-center w-50">Question</th>
                                    <th class="text-center w-50">20</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center w-50">Answered</td>
                                    <td class="text-center w-50">1</td>
                                </tr>
                                <tr>
                                    <td class="text-center w-50">Right Answer</td>
                                    <td class="text-center w-50">0</td>
                                </tr>
                                <tr>
                                    <td class="text-center w-50">Wrong Answer</td>
                                    <td class="text-center w-50">0</td>
                                </tr>
                                <tr>
                                    <td class="text-center w-50">Skipped</td>
                                    <td class="text-center w-50">0</td>
                                </tr>
                            </tbody>
                        </table>
                    
                        <!-- Marks Summary Table -->
                        <table class="table table-bordered table-striped table-hover table-sm mt-3">
                            <thead class="table-primary">
                                <tr>
                                    <th class="text-center w-50">Marks</th>
                                    <th class="text-center w-50">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center w-50">Obtained Marks</td>
                                    <td class="text-center w-50">15</td>
                                </tr>
                                <tr>
                                    <td class="text-center w-50">Negative Marks</td>
                                    <td class="text-center w-50">2</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>

        </div>
        <div class="col-lg-7 bg-light p-3">
            <div class="card rounded-0">
                <div class="card-header">
                    <div class="text-center mb-4 py-2 bg-light">
                        <h4 class="mt-4">My Exams</h4>
                        
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="w-50">Showing 1 - 1 of 1 entries</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionExample">
                        <div class="row">
                            <!-- Accordion Item 1 -->
                            <div class="col-lg-6 mb-3">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Accordion Item #1
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> You can modify this section with the content you want to display.
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                            <!-- Accordion Item 2 -->
                            <div class="col-lg-6 mb-3">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Accordion Item #2
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <strong>This is the second item's accordion body.</strong> You can modify this section with the content you want to display.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                        <div class="row">
                            <!-- Accordion Item 3 -->
                            <div class="col-lg-6 mb-3">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Accordion Item #3
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <strong>This is the third item's accordion body.</strong> You can modify this section with the content you want to display.
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                            <!-- Accordion Item 4 -->
                            <div class="col-lg-6 mb-3">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFour">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            Accordion Item #4
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <strong>This is the fourth item's accordion body.</strong> You can modify this section with the content you want to display.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_scripts')

@endsection