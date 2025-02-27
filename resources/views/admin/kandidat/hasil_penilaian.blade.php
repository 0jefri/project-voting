@extends('layouts.app')

@section('title', 'Hasil Perhitungan Penilaian')

@section('content')
  <div class="container mt-4">
    <div class="card shadow-sm p-4">
    <h2 class="mb-4 text-center">Hasil Perhitungan Penilaian Kandidat</h2>

    <table class="table table-striped">
      <thead class="table-dark">
      <tr>
        <th>Ranking</th>
        <th>Kandidat</th>
        <th>Core Factor (CF)</th>
        <th>Secondary Factor (SF)</th>
        <th>Nilai Akhir</th>
      </tr>
      </thead>
      <tbody>
      @foreach($hasil as $index => $data)
      <tr>
      <td>{{ $index + 1 }}</td>
      <td>{{ $data['kandidat'] }}</td>
      <td>{{ $data['CF'] }}</td>
      <td>{{ $data['SF'] }}</td>
      <td><strong>{{ $data['nilai_akhir'] }}</strong></td>
      </tr>
    @endforeach
      </tbody>
    </table>
    </div>
  </div>
@endsection