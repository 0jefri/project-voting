@extends('layouts.app')

@section('title', 'Kelola Mahasiswa')

@section('content')
  <!-- Menyusun H2 dan tombol dengan jarak yang rapi dan responsif -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Daftar Mahasiswa</h2>
    <div class="d-flex gap-2">
    <!-- Tombol Tambah Mahasiswa tetap seperti biasa -->
    <a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-success btn-md">Tambah Mahasiswa</a>

    <!-- Tombol untuk membuka modal -->
    <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#importModal">
      Import Mahasiswa
    </button>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success mb-4">{{ session('success') }}</div>
  @endif

  <div class="table-responsive">
    <table class="table table-bordered table-hover">
    <thead class="table-success" style="background-color: #d4edda;">
      <tr>
      <th>NIM</th>
      <th>Nama</th>
      <th>Program Studi</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Semester</th>
      <th>Sosial Media</th>
      </tr>
    </thead>
    <tbody>
      @foreach($mahasiswa as $mhs)
      <tr>
      <td>{{ $mhs->detailMahasiswa->nim }}</td>
      <td>{{ $mhs->detailMahasiswa->name }}</td>
      <td>{{ $mhs->detailMahasiswa->prodi }}</td>
      <td>{{ $mhs->detailMahasiswa->email }}</td>
      <td>{{ $mhs->detailMahasiswa->phone }}</td>
      <td>{{ $mhs->detailMahasiswa->semester }}</td>
      <td>{{ $mhs->detailMahasiswa->sosial_media }}</td>
      </tr>
    @endforeach
    </tbody>
    </table>
  </div>

  <!-- Modal Import Mahasiswa -->
  <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="importModalLabel">Import Data Mahasiswa</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="{{ route('admin.mahasiswa.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
        <label for="file" class="form-label">Pilih File Excel</label>
        <input type="file" name="file" required class="form-control">
        </div>
        <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Import</button>
        </div>
      </form>
      </div>
    </div>
    </div>
  </div>
@endsection