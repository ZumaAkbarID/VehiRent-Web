<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <img src="/assets/icon.png" width="100px">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item @if(Request::segment(1) == 'home' || is_null(Request::segment(1))) active @endif"><a href="/" class="nav-link">Home</a></li>
          <li class="nav-item @if(Request::segment(1) == 'about') active @endif"><a href="/about" class="nav-link">About</a></li>
          <li class="nav-item @if(Request::segment(1) == 'services') active @endif"><a href="/services" class="nav-link">Services</a></li>
          <li class="nav-item @if(Request::segment(1) == 'rental') active @endif"><a href="/rental" class="nav-link">Rental</a></li>
          <li class="nav-item @if(Request::segment(1) == 'contact') active @endif"><a href="/contact" class="nav-link">Contact</a></li>
        </ul>
        <ul class="navbar-nav mr-auto">
          @auth   
          <li class="nav-item"><a href="{{ route('redirects') }}" class="nav-link btn btn-secondary btn-sm py-1 px-3" style="color: #fff !important;">Dashboard</a></li>
          <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link btn btn-sm py-1 px-3">Logout</a></li>
          @endauth
          @if (!auth()->check())
          <li class="nav-item"><a href="{{ route('register') }}" class="nav-link btn btn-sm py-1 px-3">Register</a></li>
          <li class="nav-item"><a href="{{ route('login') }}" class="nav-link btn btn-secondary btn-sm py-1 px-3" style="color: #fff !important;">Login</a></li>
          @endif
        </ul>
      </div>
    </div>
  </nav>