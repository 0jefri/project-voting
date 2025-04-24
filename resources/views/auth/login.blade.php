@extends('layouts.app')

@section('title', 'Login')

@section('content')
  <style>
    body {
    background: linear-gradient(to right, #2c3e50, #3498db);
    background-image: url('{{ asset('images/background.jpeg') }}');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    }

    .login-wrapper {
    min-height: 90vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding-top: 40px;
    }

    .login-container {
    display: flex;
    flex-wrap: wrap;
    width: 90%;
    max-width: 1100px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(255, 255, 255, 0.2);
    animation: fadeIn 1s ease-in-out;
    }

    .login-left {
    flex: 1 1 50%;
    padding: 60px;
    color: white;
    background: rgba(0, 0, 0, 0.4);
    backdrop-filter: blur(10px);
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: center;
    }

    .login-left h1 {
    font-size: 56px;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 15px;
    }

    .login-left p {
    font-size: 18px;
    font-weight: 300;
    }

    .login-right {
    flex: 1 1 50%;
    padding: 50px 40px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(15px);
    border-left: 1px solid rgba(255, 255, 255, 0.3);
    display: flex;
    flex-direction: column;
    justify-content: center;
    color: #fff;
    }


    .login-title {
    font-size: 30px;
    font-weight: 700;
    text-align: center;
    margin-bottom: 30px;
    color: #333;
    }

    .form-control {
    background: rgba(255, 255, 255, 0.3);
    color: #fff;
    border: none;
    border-radius: 30px;
    padding: 12px 20px;
    box-shadow: inset 0 0 5px rgba(255, 255, 255, 0.1);
    }

    .form-control::placeholder {
    color: rgba(255, 255, 255, 0.7);
    }

    .form-label {
    color: #fff;
    }

    .btn-login {
    border-radius: 30px;
    padding: 12px;
    font-weight: 600;
    transition: all 0.3s ease-in-out;
    }

    .btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .error-message {
    color: red;
    text-align: center;
    margin-bottom: 15px;
    font-weight: bold;
    }

    @keyframes fadeIn {
    from {
      opacity: 0;
      transform: translateY(20px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
    }

    @media (max-width: 768px) {
    .login-container {
      flex-direction: column;
    }

    .login-left,
    .login-right {
      flex: 1 1 100%;
      padding: 40px;
    }

    .login-left h1 {
      font-size: 42px;
    }
    }
  </style>

  <div class="login-wrapper">
    <div class="login-container">
    <div class="login-left">
      <div style="display: flex; justify-content: center; align-items: center; margin-bottom: 20px;">
      <div style="
    width: 100px;
    height: 100px;
    border-radius: 50%;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.4);
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    padding: 5px;
    ">
        <img src="{{ asset('images/photo.jpg') }}" alt="Logo Universitas"
        style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
      </div>
      </div>

      <h5>Sistem Pemilihan Kandidat Ketua BEM</h5>
      <p>Universitas Muhammadiyah Banjarmasin</p>
    </div>
    <div class=" login-right">
      <div class="login-title">Silakan Login</div>

      @if($errors->any())
      <div class="error-message">{{ $errors->first() }}</div>
    @endif

      <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary btn-login w-100 mt-2">Login</button>
      </form>
    </div>
    </div>
  </div>
@endsection