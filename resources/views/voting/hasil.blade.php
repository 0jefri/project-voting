@extends('layouts.app')

@section('title', 'Halaman Hasil Voting')

@section('content')
  <div class="container mt-4">
    <div class="card shadow-sm p-4">
    <h2 class="text-center mb-3">🗳️ Hasil Voting</h2>
    <table class="table table-bordered">
      <thead>
      <tr>
        <th scope="col">Nama Kandidat</th>
        <th scope="col">Total Suara</th>
      </tr>
      </thead>
      <tbody>
      @foreach($hasilVoting as $item)
      <tr>
      <td>{{ $item->kandidat->ketua->name }} / {{ $item->kandidat->wakilKetua->name }}</td>
      <td>{{ $item->total_suara }}</td>
      </tr>
    @endforeach

      </tbody>
    </table>
    </div>
  </div>
@endsection