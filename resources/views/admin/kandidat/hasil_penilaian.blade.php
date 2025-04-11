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
      </tr>
    @endforeach
      </tbody>
      </table>
    </div>
    </div>
  </div>

  <!-- Modal Konfirmasi -->
  <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="confirmModalLabel">Konfirmasi</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      Apakah Anda yakin ingin menambahkan <span id="kandidatName"></span> ke halaman voting?
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      <form id="votingForm" action="{{ route('voting.store') }}" method="POST">
        @csrf
        <input type="hidden" name="kandidat" id="kandidatInput">
        <input type="hidden" name="nilai" id="nilaiInput">
        <button type="submit" class="btn btn-success">Ya, Tambahkan</button>
      </form>
      </div>
    </div>
    </div>
  </div>

@endsection

<script>
  document.addEventListener("DOMContentLoaded", function () {
    var confirmModal = document.getElementById('confirmModal');

    confirmModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget; // Tombol yang diklik
      var kandidat = button.getAttribute('data-kandidat');
      var nilai = button.getAttribute('data-nilai');

      // Set nilai ke dalam modal
      document.getElementById('kandidatName').textContent = kandidat;
      document.getElementById('kandidatInput').value = kandidat;
      document.getElementById('nilaiInput').value = nilai;
    });
  });
</script>