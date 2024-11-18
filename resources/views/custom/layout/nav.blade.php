<nav class="navbar navbar-expand-lg bg-white navbar-light shadow border-top border-5 border-primary sticky-top p-0">
    <a href="/" class="navbar-brand bg-primary d-flex align-items-center px-4 px-lg-5">
        <h2 class="mb-2 text-white">Academy</h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse" style="padding-right: 20px!important;">
        <div class="navbar-nav ms-auto p-4 p-lg-0" style="align-items: center;">
            <a href="{{ route('landingPage') }}" class="nav-item nav-link @if (Request::is('landingPage')) active @endif">Home</a>
            <a href="{{ route('jobSolution') }}"
                class="nav-item nav-link {{ Route::is('jobSolution', 'jobSolutionSubjectWise','jobSolutionSubjectWise','subjectWiseQuestions','lessonWiseQuestions','topicWiseQuestions','subTopicWiseQuestions','singleQuestion') ? 'active' : '' }}">
                Job Solution
            </a>

            <a href="{{ route('previousJobExams') }}"
            class="nav-item nav-link {{ Route::is('previousJobExams', 'previousJobExamsQuestion') ? 'active' : '' }}">Previous Job Exams</a>         
            <a href="{{ route('exams') }}"
                class="nav-item nav-link {{ Route::is('exams', 'customExamsSearch', 'customExamsquestions','seeAllPerformer') ? 'active' : '' }}">Test(Exams)</a>

                

            @if (Auth::check())
                @if (Auth::user()->profile_image != null)
                    <img src="{{ asset('images/' . Auth::user()->profile_image) }}" alt="User Icon"
                        style="width: 30px; height: 30px; border-radius: 50%; min-width: 30px; overflow: hidden;"
                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasUserinfo"
                        aria-controls="offcanvasUserinfo">
                @else
                    <img src="{{ asset('images/man.png') }}" alt="User Icon"
                        style="width: 30px; height: 30px; border-radius: 50%; min-width: 30px; overflow: hidden;"
                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasUserinfo"
                        aria-controls="offcanvasUserinfo">
                @endif
            @else
                <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
                <a href="{{ route('register') }}" class="nav-item nav-link">Register</a>
            @endif

        </div>
    </div>
</nav>
<!-- Navbar End -->

<div class="offcanvas offcanvas-end text-bg-light" tabindex="-1" id="offcanvasUserinfo"
    aria-labelledby="offcanvasUserinfoLabel">
    <div class="offcanvas-header border-bottom">
        <h5 id="offcanvasUserinfoLabel" class="text-primary">User Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        @if (Auth::check())
            <div class="d-flex align-items-center mb-3">
                @if (Auth::user()->profile_image != null)
                    <img src="{{ asset('images/' . Auth::user()->profile_image) }}" style="width: 50px; height: 50px; "
                        class="rounded-circle me-2" alt="{{ Auth::user()->name }}">
                @else
                    <img src="{{ asset('images/man.png') }}" alt="User Icon" class="rounded-circle me-2"
                        style="width: 50px; height: 50px;">
                @endif

                <div>
                    <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                    <small class="text-muted">{{ Auth::user()->email }}</small>
                </div>
            </div>
            <hr>
            <ul class="list-unstyled">
                <li class="mb-2">
                    <a href="{{ route('profile') }}" class="text-decoration-none badge-info">
                        <i class="fas fa-user me-2"></i> View Profile
                    </a>
                </li>
                <hr>
                <li class="mb-2">
                    <a href="{{ route('resume') }}" class="text-decoration-none">
                        <i class="fas fa-star me-2"></i> My Resume
                    </a>
                </li>
                <hr>
                <li class="mb-2">
                    <a href="{{ route('myExam') }}" class="text-decoration-none">
                        <i class="fas fa-star me-2"></i> My Exam
                    </a>
                </li>
                <hr>
                <li class="mb-2">
                    <a href="" class="text-decoration-none">
                        <i class="fas fa-star me-2"></i> Favorites
                    </a>
                </li>
                <hr>
                <li class="mb-2">
                    <a href="" class="text-decoration-none">
                        <i class="fas fa-bookmark me-2"></i> Bookmarks
                    </a>
                </li>
                <hr>
                <li class="mb-2">
                    <a href="" class="text-decoration-none">
                        <i class="fas fa-cog me-2"></i> Settings
                    </a>
                </li>
                <hr>
                <li class="mb-2">
                    <a href="{{ route('logout') }}" class="text-decoration-none text-danger">
                        <i class="fas fa-sign-out-alt me-2"></i> Sign Out
                    </a>
                </li>
            </ul>
        @endif
    </div>

</div>
