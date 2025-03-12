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
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('css')
    
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-0">
            <div class="container d-flex align-items-center justify-content-between">
                    <!-- left: LOGO -->
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{ asset('images/logo/HopQuest1.png') }}" alt="" class="nav-img me-5">
                        </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-between align-items-center" id="navbarSupportedContent">
                        <div class="col d-flex justify-content-between">
                        {{-- Search bar here --}}
                            <ul class="navbar-nav ms-auto">
                                <form action="" class="nav-search">
                                    <input type="search" name="search" placeholder="Search..." class="form-control form-cotrol-sm input-box">
                                </form>
                            </ul>
                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav d-flex flex-row gap-1 ms-auto">
                                <li class="nav-link">HOME</li>
                                <li class="nav-link">+Add</li>
                                <li class="nav-link">For Business</li>
                                <li class="nav-link">FAQ</li>
                                <li class="nav-link">Icon</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>




