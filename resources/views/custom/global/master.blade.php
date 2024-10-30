<!doctype html>
<html lang="en">

@include('custom.global.css_support')
@yield('custom_css')

<body>
    <div class="container-fluid">
        @include('custom.layout.header')
        
        @yield('content')

        @include('custom.layout.footer')
    </div>

    @include('custom.global.js_support')
    @yield('custom_scripts')
</body>

</html>
