<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Navbar dengan shadow dan transparan */
    .navbar {
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      background: rgba(33, 37, 41, 0.95);
      /* Warna dark dengan sedikit transparansi */
    }

    /* Container utama dengan shadow dan border-radius */
    .content-container {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      padding: 20px;
    }

    /* Efek hover untuk navbar link */
    .navbar-nav .nav-link {
      transition: all 0.3s ease-in-out;
    }

    .navbar-nav .nav-link:hover {
      color: #ffc107 !important;
      /* Warna kuning Bootstrap */
    }

    /* Tombol Logout dengan efek hover */
    .btn-outline-danger {
      transition: all 0.3s ease-in-out;
    }

    .btn-outline-danger:hover {
      background-color: #dc3545;
      color: #fff;
    }
  </style>

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="max-height: 40px;">
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto gap-2">
          @auth
        <li class="nav-item">
        <a class="nav-link" href="{{ route(Auth::user()->role . '.dashboard') }}">Dashboard</a>
        </li>
        @if(Auth::user()->role === 'admin')
      <li class="nav-item">
      <a class="nav-link" href="{{ route(Auth::user()->role . '.mahasiswa.index') }}">Data Mahasiswa</a>
      </li>
    @endif
        @if(Auth::user()->role === 'mahasiswa')
      <li class="nav-item">
      <a class="nav-link" href="{{ route(Auth::user()->role . '.pendaftaran') }}">Pendaftaran</a>
      </li>
    @endif
        <li class="nav-item">
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
          @csrf
          <button type="submit" class="btn btn-sm btn-outline-danger">Logout</button>
        </form>
        </li>
      @else
      <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
    @endauth
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-4">
    <div class="content-container">
      @yield('content')
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>