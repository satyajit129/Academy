<!DOCTYPE html>
<html lang="en">

    @include('custom.global.css_support')
    @yield('custom_css')

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    @include('custom.layout.nav')


    @yield('content')

    @include('custom.layout.footer')


    @include('custom.global.js_support')
    @yield('custom_scripts')
</body>

</html>
