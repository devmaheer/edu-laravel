<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @include('layouts.partials.frontend-head')
    <style>
        .card {
            border: none;
            padding: 10px 50px;
        }

        .card::after {
            position: absolute;
            z-index: -1;
            opacity: 0;
            -webkit-transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
            transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .card:hover {


            transform: scale(1.02, 1.02);
            -webkit-transform: scale(1.02, 1.02);
            backface-visibility: hidden;
            will-change: transform;
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .75) !important;
        }

        .card:hover::after {
            opacity: 1;
        }

        .card:hover .btn-outline-primary {
            color: white;
            background: #007bff;
        }
    </style>
</head>

<body>
    <!--begin::Root-->
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    @include('layouts.partials.frontend-navbar')
    <!-- Navbar End -->

    @yield('content')
    <!--end::Root-->

    @include('layouts.partials.frontend-footer')
    @include('layouts.partials.frontend-script')
    @yield('script')

    <script>
        var queryParams = new URLSearchParams(window.location.search);
        const param = queryParams.get('success');

        if (param) {
            Swal.fire({
                title: "Success!",
                text: "We will contact you soon",
                icon: "success"
            });

            let url = window.location.href;
            let baseUrl = url.split('?')[0];
            window.history.replaceState(null, null, baseUrl);
        }
    </script>
</body>

</html>
