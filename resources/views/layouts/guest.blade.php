<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Pengaduan Masyarakat</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="" name="keywords" />
    <meta content="" name="description" />
    @include('includes.user.style')
    @stack('css')
    <style>
        .search-input {
            border-radius: 50px;
            height: 100%;
        }

        .search-icon {
            border-radius: 0 50px 50px 0;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #fff;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            z-index: 1000;
            list-style: none;
            padding: 0.5rem 0;
        }

        .dropdown-menu.show {
            display: block;
        }
    </style>
</head>

<body>
    <div class="site-wrap">
        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icofont-close js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>

        @include('includes.user.navbar')

        <main id="main">

            @yield('content')

        </main>

        @include('includes.user.footer')
    </div>
    <!-- .site-wrap -->

    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

    @include('includes.user.script')
        <!-- Template Main JS File -->
        <script src="{{ asset('frontend/assets/js/main.js') }}"></script>

    @stack('script')


</body>

</html>
