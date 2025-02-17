@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
  <h2>Dashboard Admin</h2>
  <p>Selamat datang, {{ Auth::user()->name }}!</p>
  <!-- <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-primary">Kelola Mahasiswa</a> -->
@endsection