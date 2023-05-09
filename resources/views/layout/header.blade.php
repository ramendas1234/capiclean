<!-- ======= Header ======= -->
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="{{ route('home') }}" class="logo d-flex align-items-center">
        <h1>NosyBee</h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li class="{{ Request::routeIs('home') ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a></li>
          <li class="{{ Request::routeIs('posts.index') ? 'active' : '' }}"><a href="{{ route('posts.index') }}">Blog</a></li>
          <li class="dropdown"><a href="#"><span>Categories</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul class="dropdown">
                <li><a href="#">Entertainment</a></li>
                <li><a href="#">Health</a></li>
                <li><a href="#">Bollywood</a></li>
            </ul>
          </li>

          <li class="{{ Request::routeIs('posts.create') ? 'active' : '' }}"><a href="{{ route('posts.create') }}">Add</a></li>
          <li><a href="{{ route('contact') }}">Contact</a></li>

          @guest
              @if (Route::has('register'))
                  <li class="{{ Request::routeIs('register') ? 'active' : '' }}"><a class="p-2 text-dark" href="{{ route('register') }}">Register</a></li>
              @endif
                  <li class="{{ Request::routeIs('login') ? 'active' : '' }}"><a class="p-2 text-dark" href="{{ route('login') }}">Login</a></li>
          @else

              <li><a class="p-2 text-dark" href="{{ route('logout') }}"
                  onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                  >Logout ({{ Auth::user()->name }})</a></li>

              <form id="logout-form" action={{ route('logout') }} method="POST"
                  style="display: none;">
                  @csrf
              </form>
          @endguest


        </ul>
      </nav><!-- .navbar -->

      <div class="position-relative">
        <a href="#" class="mx-2"><span class="bi-facebook"></span></a>
        <a href="#" class="mx-2"><span class="bi-twitter"></span></a>
        <a href="#" class="mx-2"><span class="bi-instagram"></span></a>

        <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>
        <i class="bi bi-list mobile-nav-toggle"></i>

        <!-- ======= Search Form ======= -->
        <div class="search-form-wrap js-search-form-wrap">
          <form action="search-result.html" class="search-form">
            <span class="icon bi-search"></span>
            <input type="text" placeholder="Search" class="form-control">
            <button class="btn js-search-close"><span class="bi-x"></span></button>
          </form>
        </div><!-- End Search Form -->

      </div>

    </div>

  </header><!-- End Header -->