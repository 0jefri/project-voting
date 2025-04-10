@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')

@section('content')
  <h2>Dashboard Mahasiswa</h2>
  <p>Selamat datang, {{ Auth::user()->name }}!</p>
@endsection