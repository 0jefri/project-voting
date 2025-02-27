@extends('layouts.app')

@section('title', 'Penilaian Kandidat')

@section('content')
  <div class="container mt-4">
    <div class="card shadow-sm p-4">
    <h2 class="mb-4 text-center">Daftar Penilaian Kandidat</h2>

    <a href="{{ route('admin.penilaian.create') }}" class="btn btn-primary mb-3">+ Tambah Penilaian</a>

    <table class="table table-striped">
      <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Kandidat</th>
        <th>IPK</th>
        <th>Visi & Misi</th>
        <th>Semester</th> <!-- Tambahkan -->
        <th>Prestasi Akademik</th>
        <th>Surat Rekomendasi</th>
        <th>Usia</th>
        <th>Keikutsertaan dalam Organisasi</th>
        <th>Prestasi Non Akademik</th>
        <th>Kepemimpinan</th>
        <th>Integritas</th>
        <th>Loyalitas</th>
        <th>Kerjasama</th>
      </tr>
      </thead>
      <tbody>
      @foreach($penilaian as $index => $pn)
      <tr>
      <td>{{ $index + 1 }}</td>
      <td>{{ $pn->kandidat->ketua->name }} & {{ $pn->kandidat->wakilKetua->name }}</td>
      <td>{{ $pn->ipk }}</td>
      <td>{{ $pn->visi_misi }}</td>
      <td>{{ $pn->semester }}</td> <!-- Tambahkan -->
      <td>{{ $pn->prestasi_akademik }}</td>
      <td>{{ $pn->surat_rekomendasi }}</td>
      <td>{{ $pn->usia }}</td>
      <td>{{ $pn->keikutsertaan_organisasi }}</td>
      <td>{{ $pn->prestasi_non_akademik }}</td>
      <td>{{ $pn->kepemimpinan }}</td>
      <td>{{ $pn->integritas }}</td>
      <td>{{ $pn->loyalitas }}</td>
      <td>{{ $pn->kerjasama }}</td>
      </tr>
    @endforeach
      </tbody>

    </table>
    </div>
  </div>
@endsection