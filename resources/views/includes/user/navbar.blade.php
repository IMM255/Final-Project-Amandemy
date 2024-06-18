<header class="site-navbar js-sticky-header site-navbar-target" role="banner">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-6 col-lg-2">
                <h1 class="mb-0 site-logo" data-aos="fade-down">
                    <a href="{{ route('home') }}" class="mb-0" style="font-weight: bold">P - MAS</a>
                </h1>
            </div>

            <div class="col-12 col-md-10 d-none d-lg-block" data-aos="fade-down">
                <nav id="navbar" class="site-navigation position-relative text-right" role="navigation">
                    <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                        <li class="{{ Request::is('/') ? 'active' : '' }}">
                            <a href="{{ route('home') }}" class="nav-link" style="font-weight: bold">Home</a>
                        </li>
                        <li class="{{ Request::is('pengaduan') ? 'active' : '' }}">
                            <a href="{{route('home')}}#pengaduan" class="nav-link" style="font-weight: bold">Pengaduan</a>
                        </li>
                        <li class="{{ Request::is('contact') ? 'active' : '' }}">
                            <a href="{{route('home')}}#contact" class="nav-link" style="font-weight: bold">Contact</a>
                        </li>
                        @if (Auth::check())
                            <li class="{{ Request::is('contact') ? 'active' : '' }}">
                                <a href="{{route('buat.pengaduan')}}" class="nav-link">Buat Pengaduan</a>
                            </li>
                            <li class="nav-item dropdown">

                                <a id="btn-dropdown" class="nav-link" href="#" role="button">
                                    @if(Auth::user()->image)
                                        <img class="w-100 rounded-circle" style="height: 50px" src="{{Storage::url(Auth::user()->image)}}" alt="">
                                    @else
                                        <img class="w-100 rounded-circle" style="height: 50px" src="{{ asset('frontend/assets/img/nophoto.jpg') }}" alt="">
                                    @endif
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="btn-dropdown">
                                    <li><a class="dropdown-item" href="{{route('profile.index')}}">Profile</a></li>
                                    <li><a class="dropdown-item" href="{{route('pengaduanku')}}">Pengaduan Saya</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}">
                                            Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('login') }}" class="nav-link btn btn-outline-danger">Log In</a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>


            <div class="col-6 d-inline-block d-lg-none ml-md-0 py-3" style="position: relative; top: 3px">
                <a href="#" class="burger site-menu-toggle js-menu-toggle" data-toggle="collapse"
                    data-target="#main-navbar">
                    <span></span>
                </a>
            </div>
        </div>
    </div>
</header>
