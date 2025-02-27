@extends('layouts.app')

@section('title', 'Detail Penilaian Kandidat')

@section('content')
  <div class="container mt-4">
    <div class="card shadow-sm p-4">
    <h2 class="mb-4 text-center">Detail Penilaian Kandidat</h2>

    @if(!isset($penilaian))
    <!-- Modal Data Tidak Tersedia -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      <div class="modal-header bg-danger text-white">
      <h5 class="modal-title" id="errorModalLabel">Peringatan</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      Data penilaian belum tersedia untuk kandidat ini.
      </div>
      <div class="modal-footer">
      <a href="{{ route('admin.kandidat.index') }}" class="btn btn-primary">Kembali</a>
      </div>
      </div>
      </div>
    </div>

    <!-- Script untuk menampilkan modal otomatis -->
    <script>
      document.addEventListener("DOMContentLoaded", function () {
      var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
      errorModal.show();
      });
    </script>

  @else
  <table class="table table-bordered">
    <tr>
    <th>IPK</th>
    <td>{{ $penilaian->ipk }}</td>
    </tr>
    <tr>
    <th>Visi & Misi</th>
    <td>{{ $penilaian->visi_misi }}</td>
    </tr>
    <tr>
    <th>Semester</th>
    <td>{{ $penilaian->semester }}</td>
    </tr>
    <tr>
    <th>Prestasi Akademik</th>
    <td>{{ $penilaian->prestasi_akademik }}</td>
    </tr>
    <tr>
    <th>Surat Rekomendasi</th>
    <td>{{ $penilaian->surat_rekomendasi }}</td>
    </tr>
    <tr>
    <th>Usia</th>
    <td>{{ $penilaian->usia }}</td>
    </tr>
    <tr>
    <th>Keikutsertaan dalam Organisasi</th>
    <td>{{ $penilaian->keikutsertaan_organisasi }}</td>
    </tr>
    <tr>
    <th>Prestasi Non Akademik</th>
    <td>{{ $penilaian->prestasi_non_akademik }}</td>
    </tr>
    <tr>
    <th>Kepemimpinan</th>
    <td>{{ $penilaian->kepemimpinan }}</td>
    </tr>
    <tr>
    <th>Integritas</th>
    <td>{{ $penilaian->integritas }}</td>
    </tr>
    <tr>
    <th>Loyalitas</th>
    <td>{{ $penilaian->loyalitas }}</td>
    </tr>
    <tr>
    <th>Kerjasama</th>
    <td>{{ $penilaian->kerjasama }}</td>
    </tr>
  </table>
@endif

    <div class="text-center mt-3">
      <a href="{{ route('admin.kandidat.index') }}" class="btn btn-primary">Kembali</a>
    </div>
    </div>
  </div>
@endsection