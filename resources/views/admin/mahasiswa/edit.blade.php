@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-lg border-0 rounded-lg">
      <div class="card-header bg-primary text-white text-center">
        <h3><i class="fas fa-user-edit"></i> Edit Mahasiswa</h3>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.mahasiswa.update', $mahasiswa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label class="form-label"><i class="fas fa-user"></i> Username:</label>
          <input type="text" name="username" value="{{ $mahasiswa->username }}" required class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label"><i class="fas fa-id-card"></i> Nama:</label>
          <input type="text" name="name" value="{{ $mahasiswa->name }}" required class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label"><i class="fas fa-address-card"></i> NIM:</label>
          <input type="text" name="nim" value="{{ $mahasiswa->detailMahasiswa->nim }}" required
          class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label"><i class="fas fa-book"></i> Program Studi:</label>
          <input type="text" name="prodi" value="{{ $mahasiswa->detailMahasiswa->prodi }}" required
          class="form-control">
        </div>

        <div class="d-flex justify-content-between">
          <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i>
          Kembali</a>
          <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Perubahan</button>
        </div>
        </form>
      </div>
      </div>
    </div>
    </div>
  </div>
@endsection