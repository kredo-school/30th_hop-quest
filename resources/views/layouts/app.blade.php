<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>HopQuest | @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom CSS -->
    
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar-style.css') }}">
    @yield('css')

    <!-- jQuery -->
    <script src="{{ asset('js/home/jquery-3.6.0.min.js') }}"></script>

    <!-- CSS of slick -->
    <link rel="stylesheet" href="{{ asset('css/slick/slick.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/slick/slick-theme.css')}}" />

    <!-- JS of slick -->
    <script src="{{ asset('js/home/slick.min.js') }}"></script>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom CSS -->
    
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar-style.css') }}">
    @yield('css')

    <!-- jQuery -->
    <script src="{{ asset('js/home/jquery-3.6.0.min.js') }}"></script>

    <!-- CSS of slick -->
    <link rel="stylesheet" href="{{ asset('css/slick/slick.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/slick/slick-theme.css')}}" />

    <!-- JS of slick -->
    <script src="{{ asset('js/home/slick.min.js') }}"></script>
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
            <div class="container">
                <!-- left: LOGO -->
                @guest
                    <a class="navbar-brand me-lg-5" href="{{ route('home') }}">
                        <img src="{{ asset('images/logo/HopQuest1.png') }}" alt="HopQuest LOGO" class="nav-img me-lg-5"></a>
                @else
                    @if (Auth::user()->role_id == 1)
                        <a class="navbar-brand me-lg-5" href="{{ route('home') }}">
                        <img src="{{ asset('images/logo/HopQuest1.png') }}" alt="HopQuest LOGO" class="nav-img me-lg-5"></a>
                    @elseif(Auth::user()->role_id == 2)
                        <a class="navbar-brand me-lg-5" href="{{ route('home') }}">
                        <img src="{{ asset('images/logo/HopQuest_Business_38px.png') }}" alt="HopQuest LOGO for Business" class="nav-img me-lg-5"></a>
                    @elseif(Auth::user()->role_id == 3)
                        <a class="navbar-brand me-lg-5" href="{{ route('home') }}">
                        <img src="{{ asset('images/logo/HopQuest_Admin.png') }}" alt="HopQuest LOGO" class="nav-img me-lg-5"><span class="color-navy fw-bold"></span></a>
                    @endif
                @endguest
                

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                    {{-- Search bar here --}}
                    <ul class="navbar-nav mx-auto">
                            {{-- <form action="" class="nav-search d-flex align-items-center justify-content-between ms-md-5 my-auto"> --}}
                            <form action="{{ route('search') }}" class="nav-search d-flex align-items-center justify-content-between ms-md-5 my-auto">
                                <input type="search" name="search" placeholder="Search..." class="form-control form-control-sm">
                            </form>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-lg-5">
                        <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item my-auto">
                            <a href="{{ route('home') }}" class="nav-link" href="">HOME</a>
                        </li>

                        <li class="nav-item dropdown my-auto">
                            @if(Auth::user()->role_id == 3)
                            @else
                                <a id="navbarDropdown" class="nav-link btn " href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>+Add</a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->role_id == 1)
                                        <a href="#" class="dropdown-item text-dark">
                                            <i class="fa-solid fa-circle-plus icon-sm"></i> Add Quest
                                        </a>                              
                                        <a href="#" class="dropdown-item text-dark">
                                            <i class="fa-solid fa-circle-plus icon-sm"></i> Add Spot
                                        </a>
                                    @elseif(Auth::user()->role_id == 2)
                                        <a href="#" class="dropdown-item text-dark">
                                            <i class="fa-solid fa-circle-plus icon-sm"></i> Add Business
                                        </a>
                                        <a href="{{ route('promotions.create') }}" class="dropdown-item text-dark ">
                                            <i class="fa-solid fa-circle-plus icon-sm"></i> Add Promotion
                                        </a>
                                        <a href="#" class="dropdown-item text-dark">
                                            <i class="fa-solid fa-circle-plus icon-sm"></i> Add Quest
                                        </a>  
                                    @endif
                                </div>    
                            @endif                       
                    </li>
                    <li class="nav-item my-auto">
                        <li class="nav-item my-auto">
                            <a href="#" class="nav-link" href="">FAQ</a>
                        </li>
                        <li class="nav-item my-auto">
                            {{-- @if (Auth::user()->role_id == 1)
                        <li class="nav-item my-auto">
                            <a href="" class="nav-link d-xl-block d-none" href="">For Business</a>
                            <a class="nav-link d-block d-xl-none text-center business"><img src="{{asset('images/navbar/icomoon-free--office.svg')}}" alt="For business"><br>business</a>
                        </li>
                    @endif --}}
                        <li class="nav-item dropdown my-auto">
                            <!-- ICON -->
                            <a id="navbarDropdown" class="nav-link btn " href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{-- {{ Auth::user()->name }} --}}

                            {{-- DROPDOWN --}}
                            @if(Auth::user()->avatar)
                                <img src="{{Auth::user()->avatar}}" alt="" class="rounded-circle avatar-sm">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                            @endif
                            </a>
                        <!-- Dropdown menu -->
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            {{-- PROFILE --}}
                            @if(Auth::user()->role_id == 1)
                                <a href="#" class="dropdown-item">
                                    <i class="fa-solid fa-circle-user"></i> Profile
                                </a>
                            @elseif(Auth::user()->role_id == 2)
                                <a href="{{route('profile.header', Auth::user()->id)}}" class="dropdown-item">
                                    <i class="fa-solid fa-circle-user"></i> Profile
                                </a>
                            @elseif(Auth::user()->role_id == 3)
                                @can('admin')
                                <a href="{{route('admin.users.business', Auth::user()->id)}}" class="dropdown-item">
                                    <i class="fa-solid fa-circle-user"></i> Admin
                                </a>
                                @endcan
                            @endif
                            <hr class="dropdown-divider">
                            <a class="dropdown-item" href="{{ route('home') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i> {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="pt-5">           
            @yield('content') 
        </main>
    </div>
    @yield('js')
</body>
</html>