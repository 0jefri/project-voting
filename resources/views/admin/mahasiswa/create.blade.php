@extends('layouts.app')

@section('title', 'Tambah Mahasiswa')

@section('content')
  <h2>Tambah Mahasiswa</h2>

  @if($errors->any())
    <div class="alert alert-danger">
    <ul>
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
  @endforeach
    </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('admin.mahasiswa.store') }}">
    @csrf
    <div class="mb-3">
    <label>Username</label>
    <input type="text" name="username" class="form-control" required>
    </div>
    <div class="mb-3">
    <label>Password</label>
    <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
    <label>Nama</label>
    <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
    <label>NIM</label>
    <input type="text" name="nim" class="form-control" required>
    </div>
    <div class="mb-3">
    <label>Program Studi</label>
    <input type="text" name="prodi" class="form-control" required>
    </div>
    <div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
    <label>No. HP</label>
    <input type="text" name="phone" class="form-control" required>
    </div>
    <div class="mb-3">
    <label>Semester</label>
    <input type="number" name="semester" class="form-control" required>
    </div>
    <div class="mb-3">
    <label>Sosial Media</label>
    <input type="text" name="sosial_media" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
  </form>
@endsection