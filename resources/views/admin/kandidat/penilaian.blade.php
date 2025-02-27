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
        <th>Akademik</th>
        <th>Non Akademik</th>
        <th>Sikap & Perilaku</th>
      </tr>
      </thead>
      <tbody>
      @foreach($penilaian as $index => $pn)
      <tr>
      <td>{{ $index + 1 }}</td>
      <td>{{ $pn->kandidat->ketua->name }} & {{ $pn->kandidat->wakilKetua->name }}</td>
      <td>{{ $pn->akademik }}</td>
      <td>{{ $pn->non_akademik }}</td>
      <td>{{ $pn->sikap_perilaku }}</td>
      </tr>
    @endforeach
      </tbody>
    </table>
    </div>
  </div>
@endsection