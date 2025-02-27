@extends('layouts.app')

@section('title', 'Tambah Penilaian Kandidat')

@section('content')
  <div class="container mt-4">
    <div class="card shadow-sm p-4">
    <h2 class="mb-4 text-center">Penilaian Kandidat</h2>

    <form action="{{ route('admin.penilaian.store') }}" method="POST">
      @csrf
      <input type="hidden" name="kandidat_id" value="{{ $kandidat->id }}">

      @foreach(['ipk' => 'IPK', 'visi_misi' => 'Visi & Misi', 'prestasi_akademik' => 'Prestasi Akademik', 'surat_rekomendasi' => 'Surat Rekomendasi', 'usia' => 'Usia', 'keikutsertaan_organisasi' => 'Keikutsertaan dalam Organisasi', 'prestasi_non_akademik' => 'Prestasi Non Akademik', 'kepemimpinan' => 'Kepemimpinan', 'integritas' => 'Integritas', 'loyalitas' => 'Loyalitas', 'kerjasama' => 'Kerjasama'] as $name => $label)
      <div class="mb-3">
      <label class="form-label">{{ $label }} (1-5)</label>
      <input type="number" name="{{ $name }}" class="form-control" min="1" max="5" required>
      </div>
    @endforeach

      <div class="text-center">
      <button type="submit" class="btn btn-primary w-50">Simpan</button>
      <a href="{{ route('admin.penilaian.index') }}" class="btn btn-secondary">Batal</a>
      </div>
    </form>
    </div>
  </div>
@endsection