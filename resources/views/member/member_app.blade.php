<!doctype html>
<html lang="en">

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
    <!-- icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('asset/style/css/custom.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app" style="margin: 0;padding:0;">
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
                            <form class="d-flex nav-link" method="get" action="{{ route('memberhome') }}">
                                <button class="nav-link btn btn-link header-link" type="submit">Home</button>
                            </form>
                            {{-- <a class="nav-link" href="{{ route('memberhome') }}">Home</a> --}}
                        </li>
                        {{-- /////////////////////////////////////////////////////// --}}
                        <li class="nav-item dropdown">
                            <div class="d-flex nav-link">
                                <button id="dropdowninfobtn" class="btn btn-link nav-link header-link" href="#"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Information
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdowninfobtn">
                                    <a class="dropdown-item btn-link" href="{{ route('covidinformation') }}">COVID</a>
                                    <a class="dropdown-item btn-link" href="{{ route('currencyinformation') }}">Bank
                                        Currency </a>
                                    <a class="dropdown-item btn-link" href="{{ route('tourisminformation') }}">Tourism
                                    </a>
                                </div>
                            </div>
                        </li>
                        {{-- ////////////////////////////////////////////////// --}}
                        <li class="nav-item">
                            <form class="d-flex nav-link" method="get" action="{{ route('memberdashboard') }}">
                                <button class="nav-link btn btn-link header-link" type="submit">Register</button>
                            </form>
                            {{-- <a class="nav-link" href="{{ route('memberdashboard') }}">Register</a> --}}
                        </li>
                        <li class="nav-item">
                            <form class="d-flex nav-link" method="get" action="{{ route('memberflight') }}">
                                <button class="nav-link btn btn-link header-link" type="submit">Flight</button>
                            </form>
                            {{-- <a class="nav-link" href="{{ route('memberdashboard') }}">Register</a> --}}
                        </li>
                        <li class="nav-item">
                            <form class="d-flex nav-link" method="get" action="{{ route('membersearchpage') }}">
                                <button class="nav-link btn btn-link header-link" type="submit">Edit profile</button>
                            </form>
                            {{-- <a class="nav-link" href="{{ route('membersearchpage') }}">Edit profile</a> --}}
                        </li>
                        <li class="nav-item">
                            <form class="d-flex nav-link" id="logout-form" action="{{ route('memberlogout') }}"
                                method="POST">
                                @csrf
                                <button class="nav-link btn  button header-link">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4" style="min-height: 52vh">
            @yield('content')
        </main>
        <nav class="navbar navbar-expand-md navbar-light shadow-sm nav-style">
            <div class="container">
                <div class="row content-center">
                    <div class="col-md-4">
                        <h4 style="font-size:20px;color:white;">Visit Ethiopian Federal Police Social Midea</h4>
                    </div>
                    <div class="col-md-4">
                        <a class="visit-ethiopia" style="font-size:20px;color:white;"
                            href="{{ url('https://visitethiopia.travel/') }}">Let us get to know Ethiopian</a>
                    </div>
                    <div class="col-md-4">
                        <a class="visit-ethiopia" style="font-size:20px;color:white;"
                            href="{{ url('https://www.google.com/maps/place/Ethiopian+Federal+Police+commision+Headquarters+%7C+%E1%8D%8C%E1%8B%B5%E1%88%AB%E1%88%8D+%E1%8D%96%E1%88%8A%E1%88%B5+%E1%8B%8B%E1%8A%93+%E1%88%98%E1%88%B5%E1%88%AD%E1%8B%AB+%E1%89%A4%E1%89%B5+%7C+%E1%88%9C%E1%8A%AD%E1%88%B2%E1%8A%AE/@9.0096444,38.7435243,17z/data=!3m1!4b1!4m5!3m4!1s0x164b85da73bc9cd7:0x4c5ba0a6184c1fa8!8m2!3d9.0095561!4d38.7434367') }}">Location
                            of Ethiopian Federal Police</a>
                    </div>
                    <div class="col-md-12">
                        <div class="footer-container">
                            <a class="fa fa-twitter  navbar-brand footer-icon"
                                href="{{ url('https://twitter.com/EthiopiaPolice') }}"
                                style="color: white !important"></a>
                            <a class="fa fa-facebook navbar-brand footer-icon"
                                href="{{ url('https://www.facebook.com/EthiopianFederalPolice1') }}"
                                style="color: white !important"></a>
                            <a class="fa fa-youtube  navbar-brand footer-icon"
                                href="{{ url('https://www.youtube.com/c/ethiopianfederalpolice') }}"
                                style="color: white !important"></a>
                            <a class="fa fa-telegram navbar-brand footer-icon"
                                href="{{ url('https://t.me/efp2014') }}" style="color: white !important"></a>
                            <a class="fa fa-globe navbar-brand footer-icon"
                                href="{{ url('http://www.federalpolice.gov.et') }}"
                                style="color: white !important"></a>
                        </div>
                    </div>

                </div>
            </div>
        </nav>
    </div>
</body>

</html>
