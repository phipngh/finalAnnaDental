<!doctype html>
<html lang="en">

<head>
    <title>AnnaDental</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{asset('UserSide/images/favicon.ico')}}">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('UserSide/fonts/icomoon/style.css')}}">
    <link rel="stylesheet" href="{{asset('UserSide/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('UserSide/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('UserSide/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('UserSide/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('UserSide/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('UserSide/css/jquery.fancybox.min.css')}}">
    <link rel="stylesheet" href="{{asset('UserSide/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('UserSide/fonts/flaticon/font/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('UserSide/css/aos.css')}}">
    <link rel="stylesheet" href="{{asset('UserSide/css/style.css')}}">
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

{{--<div id="overlayer"></div>--}}
{{--<div class="loader">--}}
{{--    <div class="spinner-border text-primary" role="status">--}}
{{--        <span class="sr-only">Loading...</span>--}}
{{--    </div>--}}
{{--</div>--}}


<div class="site-wrap">
@include('master.user.header')

    @yield('content')

@include('master.user.footer')
</div> <!-- .site-wrap -->

<script src="{{asset('UserSide/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('UserSide/js/jquery-ui.js')}}"></script>
<script src="{{asset('UserSide/js/popper.min.js')}}"></script>
<script src="{{asset('UserSide/js/bootstrap.min.js')}}"></script>
<script src="{{asset('UserSide/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('UserSide/js/jquery.countdown.min.js')}}"></script>
<script src="{{asset('UserSide/js/jquery.easing.1.3.js')}}"></script>
<script src="{{asset('UserSide/js/aos.js')}}"></script>
<script src="{{asset('UserSide/js/jquery.fancybox.min.js')}}"></script>
<script src="{{asset('UserSide/js/jquery.sticky.js')}}"></script>
<script src="{{asset('UserSide/js/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('UserSide/js/main.js')}}"></script>
</body>
</html>
