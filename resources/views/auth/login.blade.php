@extends('layouts.app')

@section('title', 'Login')

@section('content')
  <div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4 border-0" style="width: 100%; max-width: 400px; border-radius: 12px;">
    <div class="card-body">
      <!-- Judul -->
      <h4 class="text-center mb-3">Login</h4>

      <!-- Alert Error -->
      @if($errors->any())
      <div class="alert alert-danger text-center">{{ $errors->first() }}</div>
    @endif

      <!-- Form Login -->
      <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" class="form-control" name="username" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
      </form>
    </div>
    </div>
  </div>
@endsection