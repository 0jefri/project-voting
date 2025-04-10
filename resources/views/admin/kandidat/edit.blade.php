@extends('layouts.app')

@section('title', 'Edit Status Kandidat')

@section('content')
  <div class="container mt-4">
    <div class="card shadow-sm p-4">
    <h2 class="mb-4 text-center">Edit Status Kandidat</h2>

    <form action="{{ route('admin.kandidat.update', $kandidat->id) }}" method="POST">
      @csrf
      @method('PATCH')

      <div class="mb-3">
      <label class="form-label">Ketua</label>
      <input type="text" class="form-control" value="{{ $kandidat->ketua->name }}" readonly>
      </div>

      <div class="mb-3">
      <label class="form-label">Wakil Ketua</label>
      <input type="text" class="form-control" value="{{ $kandidat->wakilKetua->name }}" readonly>
      </div>

      <div class="mb-3">
      <label for="status" class="form-label">Status</label>
      <select name="status" id="status" class="form-select" required>
        <option value="pending" {{ $kandidat->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="approved" {{ $kandidat->status == 'approved' ? 'selected' : '' }}>Approved</option>
        <option value="rejected" {{ $kandidat->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
      </select>
      </div>

      <div class="text-center">
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a href="{{ route('admin.mahasiswa.kandidat') }}" class="btn btn-secondary">Batal</a>
      </div>
    </form>
    </div>
  </div>
@endsection