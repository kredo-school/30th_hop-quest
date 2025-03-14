<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>HopQuest | @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/takeshi.style.css') }}">
    
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar-style.css') }}">
    @yield('css')
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
            <div class="container">
                <!-- left: LOGO -->
                    <a class="navbar-brand me-lg-5" href="{{ route('home') }}">
                        <img src="{{ asset('images/logo/HopQuest1.png') }}" alt="HopQuest LOGO" class="nav-img me-lg-5">
                    </a>
                        
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                    {{-- Search bar here --}}
                    <ul class="navbar-nav mx-auto">
                            <form action="" class="nav-search d-flex align-items-center justify-content-between ms-md-5">
                                <input type="search" name="search" placeholder="Search..." class="form-control form-control-sm">
                            </form>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-lg-5">
                    <!-- Authentication Links -->
                    {{-- @guest
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
                    @else --}}
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link" href="">HOME</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link btn " href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>+Add</a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                
                                <a href="#" class="dropdown-item text-dark">
                                    <i class="fa-solid fa-circle-plus icon-sm"></i> Add Quest
                                </a>
                                {{-- if 必要 --}}
                                <a href="#" class="dropdown-item text-dark">
                                    <i class="fa-solid fa-circle-plus icon-sm"></i> Add Spot
                                </a>
                                {{-- if 必要 --}}
                                <a href="#" class="dropdown-item text-dark">
                                    <i class="fa-solid fa-circle-plus icon-sm"></i> Add Business
                                </a>
                                <a href="{{ route('profile.promotion.create') }}" class="dropdown-item text-dark">
                                    <i class="fa-solid fa-circle-plus icon-sm"></i> Add Promotion
                                </a>

                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" href="">FAQ</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link d-xl-block d-none" href="">For Business</a>
                            <a class="nav-link d-block d-xl-none text-center business"><img src="{{asset('images/navbar/icomoon-free--office.svg')}}" alt="For business"><br>business</a>
                        </li>
                        <li class="nav-item dropdown">
                            <!-- ICON -->
                            <a id="navbarDropdown" class="nav-link btn " href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{-- {{ Auth::user()->name }} --}}

                                {{-- DROPDOWN --}}
                                {{-- @if(Auth::user()->avatar)
                                    <img src="{{Auth::user()->avatar}}" alt="" class="rounded-circle avatar-sm">
                                @else --}}
                                    <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                                {{-- @endif --}}
                            </a>
                            <!-- Dropdown menu -->
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                {{-- PROFILE --}}
                                <a href="#" class="dropdown-item">
                                    <i class="fa-solid fa-circle-user"></i> Profile
                                </a>
                                <hr class="dropdown-divider">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i> {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        {{-- @endguest --}}
                    </ul>
                </div>
            </div>
        </nav>
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>




