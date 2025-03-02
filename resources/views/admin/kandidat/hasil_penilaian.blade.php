@extends('layouts.app')

@section('title', 'Hasil Perhitungan Penilaian')

@section('content')
  <div class="container mt-4">
    <div class="card shadow-sm p-4">
    <h2 class="mb-4 text-center">Hasil Perhitungan Penilaian Kandidat</h2>

    <div class="table-responsive">
      <table class="table table-bordered table-hover">
      <thead class="table-success">
        <tr>
        <th>No</th>
        <th>Kandidat</th>
        <th>Core Factor (CF)</th>
        <th>Secondary Factor (SF)</th>
        <th>Nilai Akhir</th>
        <th>Aksi</th> <!-- Tambahkan kolom Aksi -->
        </tr>
      </thead>
      <tbody>
        @foreach($hasil as $index => $data)
      <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $data['kandidat'] }}</td>
      @foreach($data as $key => $value)
      @if($key !== 'kandidat')
      <td>{{ $value }}</td>
    @endif
    @endforeach
      <td>
        <!-- Tombol untuk mengirim kandidat ke halaman voting -->
        <form action="{{ route('voting.store') }}" method="POST">
        @csrf
        <input type="hidden" name="kandidat" value="{{ $data['kandidat'] }}">
        <input type="hidden" name="nilai" value="{{ $data['nilai_akhir'] }}">
        <button type="submit" class="btn btn-success btn-sm">Acc</button>
        </form>
      </td>
      </tr>
    @endforeach
      </tbody>
      </table>
    </div>
    </div>
  </div>
@endsection