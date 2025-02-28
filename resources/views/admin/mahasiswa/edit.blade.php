@extends('layouts.app')

@section('content')
  <div class="container">
    <h2>Edit Mahasiswa</h2>
    <form action="{{ route('admin.mahasiswa.update', $mahasiswa->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label>Username:</label>
      <input type="text" name="username" value="{{ $mahasiswa->username }}" required class="form-control">
    </div>

    <div class="mb-3">
      <label>Nama:</label>
      <input type="text" name="name" value="{{ $mahasiswa->name }}" required class="form-control">
    </div>

    <div class="mb-3">
      <label>NIM:</label>
      <input type="text" name="nim" value="{{ $mahasiswa->detailMahasiswa->nim }}" required class="form-control">
    </div>

    <div class="mb-3">
      <label>Program Studi:</label>
      <input type="text" name="prodi" value="{{ $mahasiswa->detailMahasiswa->prodi }}" required class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
@endsection