<!doctype html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cireng Momoii</title>
    <link rel="icon" href="img/favicon.png">
    <link rel="stylesheet" href="{{asset('assets/css/lightslider.min.css')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <!-- animate CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/animate.css')}}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
      <!-- nice select CSS -->
    <link rel="stylesheet" href="{{asset('assets/ccss/nice-select.css')}}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/all.css')}}">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/themify-icons.css')}}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/price_rangs.css')}}">
    <!-- style CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>

<body>
    <!--::header part start::-->
    @include('layouts.navbar')
    <!-- Header part end-->

    @yield('content')


    <!--::footer_part start::-->
    @include('layouts.footer')
    <!--::footer_part end::-->

    <!-- jquery plugins here-->
    <script src="{{asset('assets/js/jquery-1.12.1.min.js')}}"></script>
    <script src="{{asset('assets/js/lightslider.min.js')}}"></script>
    <!-- popper js -->
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <!-- bootstrap js -->
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <!-- easing js -->
    <script src="{{asset('assets/js/jquery.magnific-popup.js')}}"></script>
    <!-- swiper js -->
    <script src="{{asset('assets/js/swiper.min.js')}}"></script>
    <!-- swiper js -->
    <script src="{{asset('assets/js/masonry.pkgd.js')}}"></script>
    <!-- particles js -->
    <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.nice-select.min.js')}}"></script>
    <!-- slick js -->
    <script src="{{asset('assets/js/slick.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('assets/js/waypoints.min.js')}}"></script>
    <script src="{{asset('assets/js/contact.js')}}"></script>
    <script src="{{asset('assets/js/jquery.ajaxchimp.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.form.js')}}"></script>
    <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/js/mail-script.js')}}"></script>
    <!-- custom js -->
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <script src="{{asset('assets/js/stellar.js')}}"></script>
    <script src="{{asset('assets/js/price_rangs.js')}}"></script>
    <!-- custom js -->
    <script src="{{asset('assets/js/theme.js')}}"></script>
</body>

</html>