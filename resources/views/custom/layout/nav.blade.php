<div style="background: #c9d6d9;">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light border-5 sticky-top p-0" >
            <a href="/" class="navbar-brand d-flex align-items-center text-white" style="font-weight: 600; letter-spacing: 1px;">
                <h2 class="mb-0">একাডেমী</h2>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation" style="border: none;">
                <span class="navbar-toggler-icon" style="background-color: #fff;"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse" style="padding-right: 20px!important;">
                <div class="navbar-nav ms-auto p-4 p-lg-0 text-white">
                    <a href="{{ route('landingPage') }}" class="nav-item nav-link px-3 py-2 rounded @if (Request::is('landingPage')) active @endif" >হোম</a>
                    <a href="{{ route('about') }}" class="nav-item nav-link px-3 py-2 rounded @if (Request::is('about')) active @endif" >আমাদের সম্পর্কে</a>
                    <a href="{{ route('contact') }}" class="nav-item nav-link px-3 py-2 rounded @if (Request::is('contact')) active @endif" >যোগাযোগ</a>
                    
                    @if (Auth::check())
                        <div class="nav-item">
                            @if (Auth::user()->profile_image != null)
                                <img src="{{ asset('images/' . Auth::user()->profile_image) }}" alt="User Icon" class="rounded-circle" style="width: 35px; height: 35px; cursor: pointer; transition: all 0.3s ease;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasUserinfo" aria-controls="offcanvasUserinfo">
                            @else
                                <img src="{{ asset('images/man.png') }}" alt="User Icon" class="rounded-circle" style="width: 35px; height: 35px; cursor: pointer; transition: all 0.3s ease;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasUserinfo" aria-controls="offcanvasUserinfo">
                            @endif
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="nav-item nav-link px-3 py-2 rounded" >Login</a>
                        <a href="{{ route('register') }}" class="nav-item nav-link px-3 py-2 rounded" >Register</a>
                    @endif
                </div>
            </div>
        </nav>
    </div>
</div>

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
                    <a href="{{ route('myExam') }}" class="text-decoration-none">
                        <i class="fas fa-star me-2"></i> My Exam
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
