<!DOCTYPE html>
<html lang="en">
  <head>
    <title>@if(!is_null($title)) {{ $title }} @else @php config('app.name'); @endphp @endif</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/main/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="assets/main/css/animate.css">
    
    <link rel="stylesheet" href="assets/main/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/main/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/main/css/magnific-popup.css">

    <link rel="stylesheet" href="assets/main/css/aos.css">

    <link rel="stylesheet" href="assets/main/css/ionicons.min.css">

    <link rel="stylesheet" href="assets/main/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="assets/main/css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="assets/main/css/flaticon.css">
    <link rel="stylesheet" href="assets/main/css/icomoon.css">
    <link rel="stylesheet" href="assets/main/css/style.css">
  </head>
  <body>
    
	@include('Layout.navbar')
    <!-- END nav -->
    
    @yield('content')

    @include('Layout.experience')	

    @include('Layout.footer')
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="assets/main/js/jquery.min.js"></script>
  <script src="assets/main/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="assets/main/js/popper.min.js"></script>
  <script src="assets/main/js/bootstrap.min.js"></script>
  <script src="assets/main/js/jquery.easing.1.3.js"></script>
  <script src="assets/main/js/jquery.waypoints.min.js"></script>
  <script src="assets/main/js/jquery.stellar.min.js"></script>
  <script src="assets/main/js/owl.carousel.min.js"></script>
  <script src="assets/main/js/jquery.magnific-popup.min.js"></script>
  <script src="assets/main/js/aos.js"></script>
  <script src="assets/main/js/jquery.animateNumber.min.js"></script>
  <script src="assets/main/js/bootstrap-datepicker.js"></script>
  <script src="assets/main/js/jquery.timepicker.min.js"></script>
  <script src="assets/main/js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="assets/main/js/google-map.js"></script>
  <script src="assets/main/js/main.js"></script>
    
  </body>
</html>