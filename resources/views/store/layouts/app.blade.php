<!doctype html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>aranoz</title>
    <link rel="icon" href="img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('store/css/bootstrap.min.css')}}">
    <!-- animate CSS -->
    <link rel="stylesheet" href="{{asset('store/css/animate.css')}}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{asset('store/css/owl.carousel.min.css')}}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{asset('store/css/all.css')}}">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="{{asset('store/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('store/css/themify-icons.css')}}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{asset('store/css/magnific-popup.css')}}">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="{{asset('store/css/slick.css')}}">
    <!-- style CSS -->
    <link rel="stylesheet" href="{{asset('store/css/style.css')}}">
</head>
<body>
@include('store.layouts.navbar')

@yield('content')


@include('store.layouts.footer')

    <!-- jquery plugins here-->
    <script src="{{asset('store/js/jquery-1.12.1.min.js')}}"></script>
    <!-- popper js -->
    <script src="{{asset('store/js/popper.min.js')}}"></script>
    <!-- bootstrap js -->
    <script src="{{asset('store/js/bootstrap.min.js')}}"></script>
    <!-- easing js -->
    <script src="{{asset('store/js/jquery.magnific-popup.js')}}"></script>
    <!-- swiper js -->
    <script src="{{asset('store/js/swiper.min.js')}}"></script>
    <!-- swiper js -->
    <script src="{{asset('store/js/masonry.pkgd.js')}}"></script>
    <!-- particles js -->
    <script src="{{asset('store/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('store/js/jquery.nice-select.min.js')}}"></script>
    <!-- slick js -->
    <script src="{{asset('store/js/slick.min.js')}}"></script>
    <script src="{{asset('store/js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('store/js/waypoints.min.js')}}"></script>
    <script src="{{asset('store/js/contact.js')}}"></script>
    <script src="{{asset('store/js/jquery.ajaxchimp.min.js')}}"></script>
    <script src="{{asset('store/js/jquery.form.js')}}"></script>
    <script src="{{asset('store/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('store/js/mail-script.js')}}"></script>
    <!-- custom js -->
    <script src="{{asset('store/js/custom.js')}}"></script>
</body>
</html>
