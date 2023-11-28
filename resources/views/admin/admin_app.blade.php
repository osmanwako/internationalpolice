<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>EAPCCO | @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('asset/style/css/custom.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app">
        <div class="banner" style="text-align: center">
            <img src="{{ asset('asset/images/hlogo.png') }}" class="img-fluid" usemap="#hlogo-map"
                alt="East African Police Chiefs Cooperation Organization Logo">
            <map name="hlogo-map">
                <area target="_blank" title="East African Police Chiefs Cooperation Organization Logo"
                    coords="1,1,1900,190" shape="rect" href="http://www.federalpolice.gov.et/am/federal/police/home">
            </map>
        </div>
        <nav class="navbar navbar-expand-md navbar-light shadow-sm nav-style">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <form class="d-flex nav-link" method="get" action="{{ route('adminmemberlist') }}">
                                <button class="nav-link btn btn-link header-link" type="submit">Member</button>
                            </form>
                        </li>
                        <li class="nav-item">
                            <form class="d-flex nav-link" method="get" action="{{ route('adminmemberflight') }}">
                                <button class="nav-link btn btn-link header-link" type="submit">Flight</button>
                            </form>
                        </li>

                        <!-- Authentication Links -->

                        @if (Auth::guard('admin')->check())
                            <li class="nav-item dropdown">
                                <div class="d-flex nav-link">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" v-pre>
                                        <i class="bi bi-person-circle"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <form id="logout-form" action="{{ route('adminlogout') }}" method="POST">
                                            <button class="dropdown-item btn-link">Logout</button>
                                            @csrf
                                        </form>
                                        <a class="dropdown-item btn-link" href="{{ route('admindashboard') }}">Profile
                                        </a>
                                        @if (Auth::guard('admin')->user()->create)
                                            <a class="dropdown-item btn-link"
                                                href="{{ route('adminaccountlist') }}">Account </a>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @else
                            <li class="nav-item"><a class="nav-link">Uknown User </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
