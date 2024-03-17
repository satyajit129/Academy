<!DOCTYPE html>
<html lang="en">

<head>

    @include('frontend.global.css_support')

    @yield('frontend_custom_stylesheet')

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('frontend.layout.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                {{-- header section --}}
                @include('frontend.layout.header')
                {{-- header section --}}

                <!-- Main Content -->
                @yield('frontend_content')
                <!-- End of Main Content -->

            </div>

            <!-- Footer -->
            @include('frontend.layout.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Bootstrap core JavaScript-->
    @include('frontend.global.js_support')

    @yield('frontend_custom_scripts')

</body>

</html>
