<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{ $title }} &mdash; SIMS Web App</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('template/dist') }}/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('template/dist') }}/assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('template/dist') }}/assets/css/style.css">
  <link rel="stylesheet" href="{{ asset('template/dist') }}/assets/css/components.css">

  @stack('css')
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar bg-white">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg text-dark"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
      </nav>
      <div class="main-sidebar sidebar-style-2 bg-danger">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{ route('product.index') }}"><span class="text-white"><i class="fas fa-shopping-bag"></i> SIMS Web App</span></a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('product.index') }}" class="text-white"><i class="fas fa-shopping-bag"></i></a>
          </div>
          <ul class="sidebar-menu">
            <li class="{{ $active == "product" ? "active" : "" }}"><a class="nav-link" href="{{ route('product.index') }}"><i class="fas fa-box"></i> <span>Produk</span></a></li>
            <li class="{{ $active == "profile" ? "active" : "" }}"><a class="nav-link" href="{{ route('profile') }}"><i class="fas fa-user"></i> <span>Profil</span></a></li>
            <li class=""><a class="nav-link" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
          </ul>
    </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        @yield('content')
      </div>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('template/dist') }}/assets/modules/jquery.min.js"></script>
  <script src="{{ asset('template/dist') }}/assets/modules/popper.js"></script>
  <script src="{{ asset('template/dist') }}/assets/modules/tooltip.js"></script>
  <script src="{{ asset('template/dist') }}/assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="{{ asset('template/dist') }}/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="{{ asset('template/dist') }}/assets/modules/moment.min.js"></script>
  <script src="{{ asset('template/dist') }}/assets/js/stisla.js"></script>
  
  <!-- JS Libraies -->

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="{{ asset('template/dist') }}/assets/js/scripts.js"></script>
  <script src="{{ asset('template/dist') }}/assets/js/custom.js"></script>
  @stack('js')
</body>
</html>