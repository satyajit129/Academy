@extends('custom.global.master')

@section('custom_css')
    
@endsection

@section('content')
<div class="container-fluid ">
    <div class="row">
        <div class="col-lg-3 bg-light p-3 rounded-0">
            <div class="card rounded-0">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="@if (auth()->user()->profile_image != null)
                            {{ asset('images/' . auth()->user()->profile_image) }}
                        @else
                            {{ asset('images/man.png') }}
                        @endif" alt="Profile Image"
                            class="img-fluid rounded-circle" style="width: 100px; height: 100px;">
                    </div>

                    <!-- Basic Info -->
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="text-center">John Doe</h5>
                        <i class="fas fa-pen cursor-pointer" onclick="editSection('basicInfo')"
                            title="Edit Basic Info"></i>
                    </div>
                    <p>Web Developer</p>
                    <hr>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>Contact Information</h6>
                            <i class="fas fa-pen cursor-pointer" onclick="editSection('contactInfo')"
                                title="Edit Contact Information"></i>
                        </div>
                        <p>Email: johndoe@example.com</p>
                        <p>Phone: +1 123 456 7890</p>
                        <p>Address: 123 Main St, City, Country</p>
                    </div>
                    <hr>

                    <!-- Additional Skills -->
                    <div>
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>Skills</h6>
                            <i class="fas fa-pen cursor-pointer" onclick="editSection('skills')"
                                title="Edit Skills"></i>
                        </div>
                        <ul>
                            <li>JavaScript</li>
                            <li>HTML & CSS</li>
                            <li>React & Redux</li>
                            <li>Laravel</li>
                            <li>Version Control (Git)</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Side - Career Objective, Experience, Education, etc. -->
        <div class="col-lg-9 bg-light p-3 ">
            <div class="card rounded-0">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Career Objective</h5>
                            <i class="fas fa-pen cursor-pointer" onclick="editSection('careerObjective')"
                                title="Edit Career Objective"></i>
                        </div>
                        <p>A highly motivated web developer with a passion for creating responsive and
                            user-friendly websites. Seeking a position where I can leverage my skills to
                            contribute to dynamic web projects.</p>
                    </div>

                    <!-- Work Experience -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Work Experience</h5>
                            <i class="fas fa-pen cursor-pointer" onclick="editSection('workExperience')"
                                title="Edit Work Experience"></i>
                        </div>
                        <ul>
                            <li>
                                <strong>Front-end Developer</strong> - ABC Company (Jan 2020 - Present)
                                <p>Developed and maintained the front end of the company's main product,
                                    ensuring high performance and responsiveness.</p>
                            </li>
                            <li>
                                <strong>Web Developer Intern</strong> - XYZ Inc. (June 2019 - Dec 2019)
                                <p>Assisted in building dynamic web applications using JavaScript and PHP.
                                </p>
                            </li>
                        </ul>
                    </div>

                    <!-- Education -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Education</h5>
                            <i class="fas fa-pen cursor-pointer" onclick="editSection('education')"
                                title="Edit Education"></i>
                        </div>
                        <ul>
                            <li><strong>Bachelor of Science in Computer Science</strong> - University Name
                                (2016 - 2020)</li>
                        </ul>
                    </div>

                    <!-- Training -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Training & Certifications</h5>
                            <i class="fas fa-pen cursor-pointer" onclick="editSection('training')"
                                title="Edit Training"></i>
                        </div>
                        <ul>
                            <li>Full-Stack Web Development Certification - Online Course Provider</li>
                        </ul>
                    </div>

                    <!-- Language -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Languages</h5>
                            <i class="fas fa-pen cursor-pointer" onclick="editSection('languages')"
                                title="Edit Languages"></i>
                        </div>
                        <p>English (Fluent), Spanish (Intermediate)</p>
                    </div>

                    <!-- Reference -->
                    <div>
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>References</h5>
                            <i class="fas fa-pen cursor-pointer" onclick="editSection('references')"
                                title="Edit References"></i>
                        </div>
                        <p>Available upon request</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 bg-light p-3 " style="text-align: right;">
            <a href="#" class="btn btn-outline-primary rounded-0">Download Resume</a>
        </div>
    </div>
    
</div>
@endsection

@section('custom_scripts')

@endsection