@extends('layouts.app')

@section('title', 'Halaman Voting')

@section('content')
  <div class="container mt-4">
    <div class="card shadow-sm p-4">
    <h2 class="text-center mb-3">🗳️ Halaman Voting</h2>
    <p class="text-center text-muted">Silakan pilih kandidat yang Anda inginkan.</p>

    @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

    {{-- Admin Only: Form Atur Status Voting --}}
    @auth
    @if(auth()->user()->role === 'admin')
    <form method="POST" action="{{ route('admin.voting-status.update') }}" class="mb-4">
      @csrf
      <div class="row g-2 align-items-end">
      <div class="col-md-8">
      <label for="status_name" class="form-label fw-bold">Atur Status Voting:</label>
      <select class="form-select" name="status_name" id="status_name">
      @foreach ($statuses as $status)
      <option value="{{ $status->name }}" {{ $status->is_active ? 'selected' : '' }}>
      {{ ucfirst(str_replace('_', ' ', $status->name)) }}
      </option>
    @endforeach
      </select>
      </div>
      <div class="col-md-4 text-end">
      <button type="submit" class="btn btn-primary w-100">Update Status</button>
      </div>
      </div>
    </form>
  @endif
  @endauth

    {{-- Tampilkan Kandidat --}}
    @if($kandidat->isEmpty())
    <div class="text-center text-muted">
      <i class="bi bi-info-circle-fill"></i> Belum ada kandidat yang di-ACC.
    </div>
  @else
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    @foreach($kandidat as $item)
      <div class="col">
      <div class="card h-100 shadow-sm">
      @if($item->foto)
      <img src="{{ asset('storage/' . $item->foto) }}" class="card-img-top"
      style="height: 220px; object-fit: cover;" alt="Foto Kandidat">
    @endif
      <div class="card-body d-flex flex-column">
      <h5 class="card-title text-center">{{ $item->ketua->name }}</h5>
      <p class="card-text text-center mb-3">Wakil: {{ $item->wakilKetua->name }}</p>
      @php
      $sudahVote = \App\Models\Voting::where('user_id', auth()->id())->exists();
    @endphp

      @if(auth()->user()->role === 'mahasiswa')
      @if($sudahVote)
      <button type="button" class="btn btn-secondary w-100" disabled>
      <i class="bi bi-check-circle-fill me-1"></i> Anda sudah vote
      </button>
    @else
      <form action="{{ route('voting.store') }}" method="POST" class="mt-auto">
      @csrf
      <input type="hidden" name="kandidat_id" value="{{ $item->id }}">
      <button type="submit" class="btn btn-success w-100">
      <i class="bi bi-check-circle-fill me-1"></i> Vote
      </button>
      </form>
    @endif
    @endif

      </div>
      </div>
      </div>
  @endforeach
  </div>
@endif
    </div>
  </div>

  <!-- Modal: Sudah Voting -->
  @if(session('already_voted'))
    <div class="modal fade" id="alreadyVotedModal" tabindex="-1" aria-labelledby="alreadyVotedLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content bg-warning text-dark">
      <div class="modal-header">
      <h5 class="modal-title" id="alreadyVotedLabel">🛑 Sudah Voting</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
      Anda sudah melakukan voting sebelumnya. Terima kasih 🙏
      </div>
    </div>
    </div>
    </div>
  @endif

  <!-- Modal: Sukses Voting -->
  @if(session('voted_successfully'))
    <div class="modal fade" id="successVoteModal" tabindex="-1" aria-labelledby="successVoteLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content bg-success text-white">
      <div class="modal-header">
      <h5 class="modal-title" id="successVoteLabel">✅ Voting Berhasil</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
      Terima kasih! Suara Anda sudah tercatat 🎉
      </div>
    </div>
    </div>
    </div>
  @endif
@endsection
<!-- Bootstrap Bundle with Popper (required for modal) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    @if(session('already_voted'))
    new bootstrap.Modal(document.getElementById('alreadyVotedModal')).show();
  @elseif(session('voted_successfully'))
  new bootstrap.Modal(document.getElementById('successVoteModal')).show();
@endif
  });
</script>