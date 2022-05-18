<!DOCTYPE html>
<html lang="en">
  <head>
    <title>@if(!is_null($title)) {{ $title }} @else @php config('app.name'); @endphp @endif</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Primary Meta Tags -->
  <meta name="title" content="{{ $title }}">
  <meta name="description" content="{{ config('app.name') }} since 2022 specializing in the rental of cars, motorcyle, bicyle and commercial vehicles in The Java. With offices in The Jepara and Krasak, {{ config('app.name') }} is one of the larger rental companies in the region. For both individuals and companies {{ config('app.name') }} offers a solution for almost all (temporary) traffic requirements.">
  <meta name="author" content="{{ $title }}">
  <link rel="shortcut icon" href="{{ url('/') }}/assets/favicon.png" type="image/x-icon">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url('/') }}">
  <meta property="og:title" content="{{ $title }}">
  <meta property="og:description" content="{{ config('app.name') }} since 2022 specializing in the rental of cars, motorcyle, bicyle and commercial vehicles in The Java. With offices in The Jepara and Krasak, {{ config('app.name') }} is one of the larger rental companies in the region. For both individuals and companies {{ config('app.name') }} offers a solution for almost all (temporary) traffic requirements.">
  <meta property="og:image" content="{{ url('/') }}/assets/main/images/ferrari.jpg">

  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="{{ url('/') }}">
  <meta property="twitter:title" content="{{ $title }}">
  <meta property="twitter:description" content="{{ config('app.name') }} since 2022 specializing in the rental of cars, motorcyle, bicyle and commercial vehicles in The Java. With offices in The Jepara and Krasak, {{ config('app.name') }} is one of the larger rental companies in the region. For both individuals and companies {{ config('app.name') }} offers a solution for almost all (temporary) traffic requirements.">
  <meta property="twitter:image" content="{{ url('/') }}/assets/main/images/ferrari.jpg">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="/assets/main/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="/assets/main/css/animate.css">
    
    <link rel="stylesheet" href="/assets/main/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/main/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/assets/main/css/magnific-popup.css">

    <link rel="stylesheet" href="/assets/main/css/aos.css">

    <link rel="stylesheet" href="/assets/main/css/ionicons.min.css">

    <link rel="stylesheet" href="/assets/main/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="/assets/main/css/jquery.timepicker.css">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    
    <link rel="stylesheet" href="/assets/main/css/flaticon.css">
    <link rel="stylesheet" href="/assets/main/css/icomoon.css">
    <link rel="stylesheet" href="/assets/main/css/style.css">

  <script src="/assets/main/js/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

  </head>
  <body>
    
	@include('Layouts.Guest.navbar')
    <!-- END nav -->
    
    @yield('content')	

    @include('Layouts.Guest.footer')
    
    @include('Partials.alert')
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="/assets/main/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="/assets/main/js/popper.min.js"></script>
  <script src="/assets/main/js/bootstrap.min.js"></script>
  <script src="/assets/main/js/jquery.easing.1.3.js"></script>
  <script src="/assets/main/js/jquery.waypoints.min.js"></script>
  <script src="/assets/main/js/jquery.stellar.min.js"></script>
  <script src="/assets/main/js/owl.carousel.min.js"></script>
  <script src="/assets/main/js/jquery.magnific-popup.min.js"></script>
  <script src="/assets/main/js/aos.js"></script>
  <script src="/assets/main/js/jquery.animateNumber.min.js"></script>
  <script src="/assets/main/js/bootstrap-datepicker.js"></script>
  <script src="/assets/main/js/jquery.timepicker.min.js"></script>
  <script src="/assets/main/js/scrollax.min.js"></script>
  <script scr="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"></script>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="/assets/main/js/google-map.js"></script>
  <script src="/assets/main/js/main.js"></script>
    
  </body>
</html>