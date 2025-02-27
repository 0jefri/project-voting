@extends('layouts.app')

@section('title', 'Hasil Perhitungan GAP')

@section('content')
  <div class="container mt-4">
    <div class="card shadow-sm p-4">
    <h2 class="mb-4 text-center">Hasil Perhitungan GAP</h2>

    <table class="table table-striped">
      <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Kandidat</th>
        <th>IPK</th>
        <th>Visi & Misi</th>
        <th>Semester</th>
        <th>Prestasi Akademik</th>
        <th>Surat Rekomendasi</th>
        <th>Usia</th>
        <th>Organisasi</th>
        <th>Prestasi Non Akademik</th>
        <th>Kepemimpinan</th>
        <th>Integritas</th>
        <th>Loyalitas</th>
        <th>Kerjasama</th>
      </tr>
      </thead>
      <tbody>
      @foreach($hasil as $index => $gap)
      <tr>
      <td>{{ $index + 1 }}</td>
      <td>{{ $gap['kandidat'] }}</td>
      @foreach($gap as $key => $value)
      @if($key !== 'kandidat')
      <td>{{ $value }}</td>
    @endif
    @endforeach
      </tr>
    @endforeach
      </tbody>
    </table>
    </div>
  </div>
@endsection