@extends('layouts.app')

@section('title', 'Tambah Penilaian Kandidat')

@section('content')
  <div class="container mt-4">
    <div class="card shadow-sm p-4">
    <h2 class="mb-4 text-center">Penilaian Kandidat</h2>

    <form action="{{ route('admin.penilaian.store') }}" method="POST">
      @csrf
      <input type="hidden" name="kandidat_id" value="{{ $kandidat->id }}">

      @foreach(['ipk' => 'IPK', 'visi_misi' => 'Visi & Misi', 'semester' => 'Semester', 'prestasi_akademik' => 'Prestasi Akademik', 'surat_rekomendasi' => 'Surat Rekomendasi', 'usia' => 'Usia', 'keikutsertaan_organisasi' => 'Keikutsertaan dalam Organisasi', 'prestasi_non_akademik' => 'Prestasi Non Akademik', 'kepemimpinan' => 'Kepemimpinan', 'integritas' => 'Integritas', 'loyalitas' => 'Loyalitas', 'kerjasama' => 'Kerjasama'] as $name => $label)
      <div class="mb-3">
      <label class="form-label">{{ $label }} (1-5)</label>
      <input type="number" name="{{ $name }}" class="form-control" min="1" max="5" required>
      </div>
    @endforeach

      <div class="text-center">
      <button type="submit" class="btn btn-primary w-50">Simpan</button>
      <a href="{{ route('admin.penilaian.index') }}" class="btn btn-secondary">Batal</a>
      </div>
    </form>
    </div>
  </div>

  @if(session('success'))
    <script>
    document.addEventListener("DOMContentLoaded", function () {
    var successModal = new bootstrap.Modal(document.getElementById('successModal'));
    successModal.show();
    });
    </script>
  @endif

  <!-- Modal Notifikasi Penilaian Berhasil -->
  <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="successModalLabel">Penilaian Berhasil</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      Penilaian kandidat telah berhasil disimpan!
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
    </div>
  </div>

  @if(session('already_scored'))
    <script>
    document.addEventListener("DOMContentLoaded", function () {
    var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
    errorModal.show();
    });
    </script>
  @endif

  <!-- Modal Notifikasi Kandidat Sudah Dinilai -->
  <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title text-danger" id="errorModalLabel">Peringatan</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      Kandidat ini sudah dinilai sebelumnya dan tidak dapat dinilai lagi!
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
    </div>
  </div>

@endsection