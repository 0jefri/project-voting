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

    @if($kandidat->isEmpty())
    <p class="text-center text-muted">Belum ada kandidat yang di-ACC.</p>
  @else
  <div class="table-responsive">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    @foreach($kandidat as $item)
    <div class="col">
    <div class="card h-100">
    @if($item->foto)
    <img src="{{ asset('storage/' . $item->foto) }}" class="card-img-top"
      style="height: 200px; object-fit: cover;">
  @endif
    <div class="card-body">
      <h5 class="card-title">{{ $item->ketua->name }}</h5>
      <p class="card-text">
      Wakil: {{ $item->wakilKetua->name }}<br>
      </p>
    </div>
    </div>
    </div>
  @endforeach
    </div>
  </div>
@endif

    </div>
  </div>
@endsection