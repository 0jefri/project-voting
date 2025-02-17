@extends('layouts.app')

@section('title', 'Kelola Mahasiswa')

@section('content')
  <!-- Menyusun H2 dan tombol dengan jarak yang rapi dan responsif -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Daftar Mahasiswa</h2>
    <div class="d-flex gap-2">
    <!-- Menambahkan sedikit jarak antar tombol dengan menggunakan gap-2 -->
    <a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-success btn-md">Tambah Mahasiswa</a>
    <a href="{{ route('admin.mahasiswa.import') }}" class="btn btn-primary btn-md">Import Mahasiswa</a>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success mb-4">{{ session('success') }}</div>
  @endif

  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
    <thead class="thead-dark">
      <tr>
      <th>NIM</th>
      <th>Nama</th>
      <th>Program Studi</th>
      <th>Email</th>
      <th>Semester</th>
      </tr>
    </thead>
    <tbody>
      @foreach($mahasiswa as $mhs)
      <tr>
      <td>{{ $mhs->detailMahasiswa->nim }}</td>
      <td>{{ $mhs->detailMahasiswa->name }}</td>
      <td>{{ $mhs->detailMahasiswa->prodi }}</td>
      <td>{{ $mhs->detailMahasiswa->email }}</td>
      <td>{{ $mhs->detailMahasiswa->semester }}</td>
      </tr>
    @endforeach
    </tbody>
    </table>
  </div>
@endsection