@extends('layouts.app')

@section('title', 'Halaman Voting')

@section('content')
  <div class="container mt-4">
    <div class="card shadow-sm p-4">
    <h2 class="mb-4 text-center">Daftar Kandidat Voting</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

    <div class="table-responsive">
      <table class="table table-bordered table-hover">
      <thead class="table-primary">
        <tr>
        <th>No</th>
        <th>Kandidat</th>
        <th>Nilai Akhir</th>
        </tr>
      </thead>
      <tbody>
        @foreach($voting as $index => $data)
      <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $data->kandidat }}</td>
      <td>{{ $data->nilai }}</td>
      </tr>
    @endforeach
      </tbody>
      </table>
    </div>
    </div>
  </div>
@endsection