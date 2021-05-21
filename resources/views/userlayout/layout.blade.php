<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <title>SIG Potensi Desa | Peta Potensi Desa</title>
    <meta name="author" content="luckynvic@gmail.com" />
    <link href="{{asset('assets/p/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('leaflet/leaflet.css')}}"/>
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <script src="{{asset('leaflet/leaflet.js')}}"></script>
    @yield('add_css')
    <link href="{{asset('assets/p/ext/customScroll/css/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/p/css/style.default.css')}}" rel="stylesheet" />
</head>
<body>
    @include('userlayout.navbar')

    @yield('content')
    <!-- Modal Desa-->
    <!-- Bootstrap core JavaScript
        ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{asset('assets/p/js/jquery-1.10.2.min.js')}}"></script>
    <script src="{{asset('assets/p/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/p/ext/customScroll/js/jquery.mCustomScrollbar.min.js')}}"></script>
    <script src="{{asset('assets/p/ext/customScroll/js/jquery.mousewheel.min.js')}}"></script>
    <script src="{{asset('assets/p/js/application.js')}}"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
    @yield('add_js')
</body>
</html>
