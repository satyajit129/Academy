<header
    class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
    <div class="col-md-3 mb-2 mb-md-0">
        <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
            <h2>Logo</h2>
        </a>
    </div>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="/" class="nav-link px-2 ">Home</a></li>
        <li><a href="{{ route('admission') }}" class="nav-link px-2">Admission</a></li>
        <li><a href="{{ route('jobSolution') }}" class="nav-link px-2">Job Solution</a></li>
        <li><a href="{{ route('programming') }}" class="nav-link px-2">Programming</a></li>
        <li><a href="{{ route('exams') }}" class="nav-link px-2">Exams</a></li>
    </ul>

    <div class="col-md-3 text-end">

        @if (Auth::check())
            @if (Auth::user()->profile_image != null)
                <img src="{{ asset('images/' . Auth::user()->profile_image) }}" alt="User Icon"
                    style="width: 30px; height: 30px; border-radius: 50%; min-width: 30px; overflow: hidden;"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasUserinfo" aria-controls="offcanvasUserinfo">
            @else
                <img src="{{ asset('images/man.png') }}" alt="User Icon"
                    style="width: 30px; height: 30px; border-radius: 50%; min-width: 30px; overflow: hidden;"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasUserinfo" aria-controls="offcanvasUserinfo">
            @endif
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm me-2 rounded-0">Login</a>
            <a href="{{ route('register') }}" class="btn btn-outline-primary btn-sm me-2 rounded-0">Register</a>
        @endif

    </div>

    <!-- Offcanvas Structure -->
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
                        <img src="{{ asset('images/' . Auth::user()->profile_image) }}" style="width: 50px; height: 50px; " class="rounded-circle me-2" alt="{{ Auth::user()->name }}">
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




</header>
