<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Pengaduan Masyarakat</title>

    @include('includes.admin.style')
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            @include('includes.admin.nav')

            <div class="main-sidebar sidebar-style-2">
                @include('includes.admin.sidebar')
            </div>

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>


            @include('includes.admin.footer')
        </div>
    </div>

    @include('includes.admin.script')
    @stack('script')
</body>

</html>
