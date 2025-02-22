<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <style>
    /* Navbar dengan shadow dan transparan */
    .navbar {
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      background: rgba(255, 255, 255, 0.9);
      /* Warna putih dengan transparansi */
    }

    /* Mengubah warna teks navbar menjadi biru */
    .navbar-nav .nav-link {
      color: #007bff;
      /* Warna biru Bootstrap */
      transition: all 0.3s ease-in-out;
    }

    /* Efek hover untuk navbar link */
    .navbar-nav .nav-link:hover {
      /* border: 1px solid #3782fa; */
      color: #3782fa !important;
      /* Background biru pada hover */
      transform: translateY(-3px);
      /* Efek timbul */
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      /* Efek shadow timbul */
      border-radius: 10px;
    }

    /* Container utama dengan shadow dan border-radius */
    .content-container {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      padding: 20px;
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
  <nav class="navbar navbar-expand-lg navbar-light">
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
        <!-- Tombol Logout dengan Modal -->
        <li class="nav-item">
        <button type="button" class="btn btn-sm btn-outline-danger d-flex align-items-center gap-1"
          data-bs-toggle="modal" data-bs-target="#logoutModal">
          <i class="bi bi-box-arrow-right"></i>
        </button>
        </li>

        <!-- Modal Konfirmasi Logout -->
        <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Apakah kamu yakin ingin logout?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
            </form>
          </div>
          </div>
        </div>
        </div>

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