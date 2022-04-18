<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="/">Vehi<span>Rent</span></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active"><a href="/" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="/about" class="nav-link">About</a></li>
          <li class="nav-item"><a href="/services" class="nav-link">Services</a></li>
          <li class="nav-item"><a href="/rental" class="nav-link">Rental</a></li>
          <li class="nav-item"><a href="/blog" class="nav-link">Blog</a></li>
          <li class="nav-item"><a href="/contact" class="nav-link">Contact</a></li>
        </ul>
        <ul class="navbar-nav mr-auto">
          @auth   
          <li class="nav-item"><a href="{{ route('redirects') }}" class="nav-link btn btn-secondary btn-sm py-1 px-3">Dashboard</a></li>
          <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link btn btn-sm py-1 px-3">Logout</a></li>
          @endauth
          @if (!auth()->check())
          <li class="nav-item"><a href="{{ route('register') }}" class="nav-link btn btn-sm py-1 px-3">Register</a></li>
          <li class="nav-item"><a href="{{ route('login') }}" class="nav-link btn btn-secondary btn-sm py-1 px-3">Login</a></li>
          @endif
        </ul>
      </div>
    </div>
  </nav>