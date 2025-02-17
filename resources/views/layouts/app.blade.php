<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    @yield('content')
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>