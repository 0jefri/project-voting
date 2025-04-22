@extends('layouts.app')

@section('title', 'Kelola Mahasiswa')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Daftar Mahasiswa</h2>
    <div class="d-flex gap-2">
    <a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-success btn-md">Tambah Mahasiswa</a>
    <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#importModal">
      Import Mahasiswa
    </button>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success mb-4">{{ session('success') }}</div>
  @endif

  <div class="d-flex justify-content-center mb-4">
    <form action="{{ route('admin.mahasiswa.index') }}" method="GET" class="d-flex" style="width: 400px;">
    <input type="text" name="search" class="form-control me-2" placeholder="Cari nama atau NIM..."
      value="{{ request('search') }}">
    <button class="btn btn-outline-primary" type="submit">Cari</button>
    </form>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-hover">
    <thead class="table-success">
      <tr>
      <th>No</th>
      <th>NIM</th>
      <th>Nama</th>
      <th>Program Studi</th>
      <th>Aksi</th> <!-- Kolom Aksi -->
      </tr>
    </thead>
    <tbody>
      @foreach($mahasiswa as $index => $mhs)
      @isset($mhs->detailMahasiswa)
      <tr>
      <td>{{ $loop->iteration + ($mahasiswa->currentPage() - 1) * $mahasiswa->perPage() }}</td>
      <td>{{ $mhs->detailMahasiswa->nim }}</td>
      <td>{{ $mhs->detailMahasiswa->name }}</td>
      <td>{{ $mhs->detailMahasiswa->prodi }}</td>
      <td>
      <a href="{{ route('admin.mahasiswa.edit', $mhs->id) }}" class="btn btn-warning btn-sm">Edit</a>
      <form action="{{ route('admin.mahasiswa.destroy', $mhs->id) }}" method="POST" class="d-inline"
      onsubmit="return confirm('Yakin ingin menghapus mahasiswa ini?')">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
      </form>
      </td>
      </tr>
    @endisset
    @endforeach
    </tbody>
    </table>
  </div>

  <div class="d-flex justify-content-center mt-3">
    <nav aria-label="Page navigation">
    {{ $mahasiswa->links('vendor.pagination.bootstrap-5') }}
    </nav>
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
      <form action="{{ route('admin.mahasiswa.import.process') }}" method="POST" enctype="multipart/form-data">
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