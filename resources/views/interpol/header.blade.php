<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>EAPCCO Login and Register.</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('bootstrap/js/bootstrap.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ url('asset/style/css/custom.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="banner" style="text-align: center">
                <img src="{{ asset('asset/images/hlogo.png') }}" class="img-fluid" usemap="#hlogo-map"
                    alt="East African Police Chiefs Cooperation Organization Logo">
                <map name="hlogo-map">
                    <area target="_blank" title="East African Police Chiefs Cooperation Organization Logo"
                        coords="1,1,1900,190" shape="rect"
                        href="http://www.federalpolice.gov.et/am/federal/police/home">
                </map>
            </div>
            {{-- <div class="container align-center">
                <a class="navbar-brand" href="{{ url('https://www.interpol.int/') }}"
                    style="text-align: center;margin-left: 0px;">
                    <img src="{{ url('asset/images/interpol/eapcco1.jpg') }}" alt="INTERPOL" class="rounded-circle"
                        width="100px;" height="100px;">
                </a>
                <a class="navbar-brand" href="{{ url('https://www.interpol.int/') }}"
                    style="text-align: center;margin-left: 0px;">
                    <img src="{{ url('asset/images/interpol/federalLogo.png') }}" alt="Federal Police"
                        class="rounded-circle" width="100px;" height="100px;">
                </a>
            </div> --}}
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
