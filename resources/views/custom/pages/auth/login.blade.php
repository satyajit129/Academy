<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="{{ asset('js/color-modes.js') }}"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Signin </title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }

        html,
        body {
            height: 100%;
        }

        .form-signin {
            max-width: 500px;
            padding: 1rem;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
        }
    </style>
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">

    <main class="form-signin w-100 m-auto">
        <div class="card rounded-0 p-5">
            <div class="card-body">
                <form action="{{ route('loginRequest') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('custom.global.alert')
                    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
                    <!-- Unified input for email or phone -->
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" name="identifier" id="floatingInput" placeholder="Email or Phone" required>
                        <label for="floatingInput">Email or Phone</label>
                    </div>
                    
                    <div class="form-floating">
                        <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password" required>
                        <label for="floatingPassword">Password</label>
                    </div>
                    
                    <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>

                    <p class="mt-3">
                        <a href="{{ route('redirectToGoogle') }}" class="google-signin-btn btn d-flex align-items-center justify-content-center rounded-0" style="padding: 10px; text-decoration: none; border: 1px solid #0d6efd">
                            Continue with &nbsp; 
                            <span style="padding: 5px;">
                                <img src="{{ asset('images/google.png') }}" alt="" style="width: 20px; height: 20px;">
                            </span>
                        </a>
                    </p>
                    <p class="mt-3 text-center">Don't have an account? <a href="{{ route('register') }}">Register</a></p>
                </form>
            </div>
        </div>
        
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

</body>

</html>
