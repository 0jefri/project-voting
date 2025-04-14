<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <style>
    body {
      padding-top: 100px;
      /* Sesuaikan dengan tinggi navbar */
    }

    /* Navbar dengan efek glassmorphism */
    .navbar {
      background: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(10px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.3);
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Hover efek dengan animasi underline */
    .navbar-nav .nav-link {
      color: #007bff;
      font-weight: 500;
      position: relative;
      transition: color 0.3s ease-in-out;
    }

    .navbar-nav .nav-link::after {
      content: "";
      display: block;
      height: 2px;
      width: 0;
      background: #007bff;
      transition: width 0.3s ease-in-out;
      position: absolute;
      bottom: -5px;
      left: 50%;
      transform: translateX(-50%);
    }

    .navbar-nav .nav-link:hover::after {
      width: 100%;
    }

    /* Hover efek untuk tombol logout */
    .btn-danger {
      transition: background 0.3s ease-in-out, transform 0.2s ease-in-out;
    }

    .btn-danger:hover {
      background-color: #c82333;
      transform: scale(1.05);
    }

    .header-title {
      font-size: 16px;
      color: #FF0000;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="max-height: 40px;">
        <span class="header-title">Universitas Muhammadiyah Banjarmasin</span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto gap-3 align-items-center">
          @auth
            <li class="nav-item">
            <a class="nav-link" href="{{ route(Auth::user()->role . '.dashboard') }}">
              <i class="bi bi-house-door"></i> Dashboard
            </a>
            </li>
            @if(Auth::user()->role === 'admin')
        <li class="nav-item">
        <a class="nav-link" href="{{ route(Auth::user()->role . '.mahasiswa.index') }}">
          <i class="bi bi-people"></i> Data Mahasiswa
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.kandidat.index') }}">
          <i class="bi bi-person-badge"></i> Daftar Kandidat
        </a>
        </li>
      @endif
            @php
        $status = \App\Models\VotingStatus::where('name', 'registration_open')->first();
        @endphp

            @if(Auth::user()->role === 'mahasiswa' && $status && $status->is_active)
        <li class="nav-item">
        <a class="nav-link" href="{{ route('mahasiswa.pendaftaran.form') }}">
          <i class="bi bi-pencil-square"></i> Pendaftaran
        </a>
        </li>
      @endif

            <li class="nav-item">
            <a class="nav-link" href="{{ route('voting.index') }}">
              <i class="bi bi-check2-circle"></i> Voting
            </a>
            </li>

            <li class="nav-item">
            <a class="nav-link" href="{{ route('voting.hasil') }}">
              <i class="bi bi-bar-chart-line"></i> Hasil Voting
            </a>
            </li>

            <!-- Tombol Logout -->
            <li class="nav-item">
            <button type="button" class="btn btn-danger btn-sm d-flex align-items-center gap-2" data-bs-toggle="modal"
              data-bs-target="#logoutModal">
              <i class="bi bi-box-arrow-right"></i> Logout
            </button>
            </li>
      @else
      <li class="nav-item">
      <a class="nav-link" href="{{ route('login') }}">
        <i class="bi bi-box-arrow-in-right"></i> Login
      </a>
      </li>
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

  <!-- Modal Logout -->
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Apakah Anda yakin ingin logout?
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


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  @hasSection('footer')
    <footer class="text-center py-4 mt-5 bg-primary text-black border-top">
    @yield('footer')
    </footer>
  @endif
</body>

</body>

</html>