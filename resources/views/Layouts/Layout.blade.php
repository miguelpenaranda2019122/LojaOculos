<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>OptiVision - by Miguel Peñaranda</title>
</head>
<body class="bg-success bg-opacity-25 h-100 w-100">
  <header class="p-3 border-bottom bg-light" id="header">
    <div class="ms-2 me-2">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none me-3">
            <img src="/assets/logo.png" width="80" height="50" alt="" style="filter: invert(36%) sepia(95%) saturate(377%) hue-rotate(100deg) brightness(94%) contrast(88%);">
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 gap-1">
          <a href="/" class="nav-link px-2 link-success links-navbar">Home</a>
          <a href="/oculos" class="nav-link px-2 link-success links-navbar">Oculos</a>
          <a href="/vender" class="nav-link px-2 link-success links-navbar">Vende Oculos</a>
          <a href="/contactos" class="nav-link px-2 link-success links-navbar">Contactos</a>
        </ul>
        <div class="col-md-3 text-end">
            @guest
              <a href="/login" class="btn btn-outline-success me-2">Login</a>
              <a href="/register" class="btn btn-outline-success me-2">Sign-up</a>
            @endguest
        </div>

        @auth
        <a href="/shoppingcart" class="link-success"><i class="fa-solid fa-cart-shopping fs-4 px-3"></i></a>
       
          <div class="dropdown text-end d-flex align-items-center">
            <a class="d-block link-success text-decoration-none dropdown-toggle text-success" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="../assets/profile.svg" width="40" height="40"  alt="" style="filter: invert(36%) sepia(95%) saturate(377%) hue-rotate(100deg) brightness(94%) contrast(88%);">
            </a>
            <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1" style="">
              <li><a href="/profile" class="dropdown-item">Profile</a></li>
              @if (Auth::user() && Auth::user()->is_admin)
                <li><a href="/administration" class="dropdown-item">Administrador</a></li>
              @endif
              <li><hr class="dropdown-divider"></li>
              <li style="cursor: pointer;">
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <a :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="dropdown-item">Sign out</a>
                </form>
              </li>
            </ul>
          </div>
        @endauth
      </div>
    </div>
  </header>
  <div id="app">
    @yield('content')
  </div>
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 border-top bg-light ps-2 pe-2" id="footer">
    <p class="col-md-4 mb-0 text-muted">©OptiVision 2023 Miguel Peñaranda, Inc</p>

    <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <img src="/assets/logo.png" width="140" height="80" alt="" style="filter: invert(36%) sepia(95%) saturate(377%) hue-rotate(100deg) brightness(94%) contrast(88%);">
    </a>

    <ul class="nav col-md-4 justify-content-end">
        <a href="/" class="nav-link px-2 link-success links-navbar">Home</a>
        <a href="/oculos" class="nav-link px-2 link-success links-navbar">Oculos</a>
        <a href="/vender" class="nav-link px-2 link-success links-navbar">Vende Oculos</a>
        <a href="/contactos" class="nav-link px-2 link-success links-navbar">Contactos</a>
        @guest
          <a href="/login" class="nav-link px-2 link-success links-navbar">Login</a>
          <a href="/register" class="nav-link px-2 link-success links-navbar">Sign Up</a>
        @endguest
    </ul>
</footer>
</body>

<script src="https://kit.fontawesome.com/99635f9b16.js" crossorigin="anonymous"></script>
</html>