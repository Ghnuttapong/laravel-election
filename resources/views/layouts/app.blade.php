<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo_cmtc.png') }}" type="image/x-icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- bootstrap icons cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!-- wow animation cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- Jquery cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- owlCarousel cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
</head>

<body>
    <div id="app">
        @auth

            {{-- sidebar admin --}}
            @if (Auth::user()->role === 3)
                @include('layouts.menus.admin_sidebar')
                {{-- btn show offcanvas --}}
                <button class="sidebar-md-container btn btn-primary d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
                    <i class="bi bi-list"></i>
                </button>
                @include('layouts.menus.admin_offcanvas')
            @else
                {{-- sidebar user&candidate --}}
                <nav class="navbar navbar-expand-md navbar-dark bg-base1 shadow-sm">
                    <div class="container">
                        @if (isset(Auth::user()->role))
                            @auth
                                @if (Auth::user()->role == 1)
                                    <a class="navbar-brand" href="{{ url('/users') }}">
                                        {{ config('app.name', 'Laravel') }}
                                    </a>
                                @endif
                                @if (Auth::user()->role == 2)
                                    <a class="navbar-brand" href="{{ url('/voters') }}">
                                        {{ config('app.name', 'Laravel') }}
                                    </a>
                                @endif
                            @endauth
                        @else
                            <a class="navbar-brand" href="{{ url('/') }}">
                                {{ config('app.name', 'Laravel') }}
                            </a>
                        @endif
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav me-auto">
                                @auth
                                    @include('layouts.menus.user_menu')
                                    @include('layouts.menus.voter_menu')
                                @endauth
                            </ul>

                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ms-auto">
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
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                            @if (Auth::user()->role == 1)
                                                @if (session()->get('regis_voter'))
                                                    <button class="dropdown-item" disabled>
                                                        รอผลการคัดเลือก
                                                    </button>
                                                @else
                                                    <a class="dropdown-item" href="{{ route('users.create') }}">
                                                        ลงสมัคร Candidate
                                                    </a>
                                                @endif
                                            @endif

                                            <a class="dropdown-item" href="{{ route('users.edit', Auth::user()->id) }}">
                                                โปรไฟล์
                                            </a>

                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                ออกจากระบบ
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
            @endif
        @endauth



        <main>
            @include('layouts.loader')
            @yield('content')
        </main>
    </div>
</body>

</html>
