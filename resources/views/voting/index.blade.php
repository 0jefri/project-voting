@extends('layouts.app')

@section('title', 'Halaman Voting')

@section('content')
  <div class="container mt-4">
    <div class="card shadow-sm p-4">
    <h2 class="mb-0">Halaman Voting</h2>
    <p class="text-center">Silakan pilih kandidat yang Anda inginkan.</p>

    @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

    @if($votingData->isEmpty())
    <p class="text-center text-muted">Belum ada kandidat yang di-ACC.</p>
  @else
  <div class="table-responsive">
    <table class="table table-bordered table-hover">
    <thead class="table-primary">
    <tr>
    <th>No</th>
    <th>Kandidat</th>
    <th>Nilai Akhir</th>
    <th>Pilih</th>
    </tr>
    </thead>
    <tbody>
    @foreach($votingData as $index => $data)
    <tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $data->kandidat }}</td>
    <td>{{ $data->nilai }}</td>
    <td>
      <button class="btn btn-primary btn-sm">Vote</button>
    </td>
    </tr>
  @endforeach
    </tbody>
    </table>
  </div>
@endif

    </div>
  </div>
@endsection