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
          <label class="form-label"><i class="fas fa-id-card"></i> Nama:</label>
          <input type="text" name="name" value="{{ old('name', $mahasiswa->name) }}" required class="form-control">
          @error('name')
        <div class="text-danger">{{ $message }}</div>
      @enderror
        </div>

        <div class="mb-3">
          <label class="form-label"><i class="fas fa-address-card"></i> NIM:</label>
          <input type="text" name="nim" value="{{ old('nim', $mahasiswa->detailMahasiswa->nim) }}" required
          class="form-control">
          @error('nim')
        <div class="text-danger">{{ $message }}</div>
      @enderror
        </div>

        <div class="mb-3">
          <label class="form-label"><i class="fas fa-book"></i> Program Studi:</label>
          <input type="text" name="prodi" value="{{ old('prodi', $mahasiswa->detailMahasiswa->prodi) }}" required
          class="form-control">
          @error('prodi')
        <div class="text-danger">{{ $message }}</div>
      @enderror
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

  <!-- Modal Error -->
  <div class="modal fade @if($errors->any()) show @endif" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel"
    aria-hidden="true" @if($errors->any()) style="display: block;" @endif>
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
      <h5 class="modal-title" id="errorModalLabel">Kesalahan Validasi</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <ul>
        @foreach ($errors->all() as $error)
      <li class="text-danger">{{ $error }}</li>
    @endforeach
      </ul>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
    // Jika ada error, otomatis tampilkan modal
    if (@json($errors->any())) {
      var errorModal = new bootstrap.Modal(document.getElementById("errorModal"));
      errorModal.show();
    }
    });
  </script>
@endsection