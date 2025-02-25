@extends('layouts.app')

@section('title', 'Pendaftaran Kandidat')
<!-- Tambahkan ini sebelum </body> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm p-4">
            <h2 class="mb-4 text-center">Pendaftaran Kandidat</h2>
            <form action="{{ route('mahasiswa.pendaftaran') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Mengambil Data Mahasiswa dari Database -->
                @php
                    $mahasiswa = \App\Models\User::where('role', 'mahasiswa')->get();
                @endphp

                <!-- Pilihan Ketua dan Wakil Ketua -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ketua</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                        <input type="hidden" name="id_user" value="{{ Auth::id() }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="wakil_ketua" class="form-label">Wakil Ketua</label>
                        <select name="wakil_ketua" id="wakil_ketua" class="form-select" required>
                            <option value="">Pilih Wakil Ketua</option>
                            @foreach($mahasiswa as $mhs)
                                @if($mhs->id !== Auth::id())
                                    <option value="{{ $mhs->id }}">{{ $mhs->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Upload Berkas -->
                <div class="row">
                    @foreach(['transkrip_nilai' => 'Transkrip Nilai', 'visi_misi' => 'Visi Misi', 'prestasi_akademik' => 'Prestasi Akademik', 'surat_rekomendasi' => 'Surat Rekomendasi', 'keikutsertaan_organisasi' => 'Keikutsertaan dalam Organisasi', 'prestasi_non_akademik' => 'Prestasi Non Akademik'] as $name => $label)
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ $label }} (PDF)</label>
                            <input type="file" name="{{ $name }}" class="form-control" accept=".pdf" required>
                        </div>
                    @endforeach
                </div>

                <!-- Pilihan Usia -->
                <div class="mb-3">
                    <label class="form-label">Usia</label>
                    <select name="usia" class="form-select" required>
                        <option value="">Pilih Usia</option>
                        <option value="1">19-24</option>
                        <option value="2">>24</option>
                        <option value="3">&lt;19</option>
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-50">Daftar</button>
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

    @if(session('error'))
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();
            });
        </script>
    @endif



    <!-- Modal Notifikasi Pendaftaran Berhasil -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Pendaftaran Berhasil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Selamat! Anda telah berhasil mendaftar sebagai kandidat Ketua BEM.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Notifikasi Error -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="errorModalLabel">Pendaftaran Gagal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ session('error') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Prevent Ketua dan Wakil Ketua being the same -->
    <script>
        document.getElementById('id_user').addEventListener('change', function () {
            let ketua = this.value;
            let wakilKetua = document.getElementById('wakil_ketua');
            let options = wakilKetua.getElementsByTagName('option');

            for (let i = 0; i < options.length; i++) {
                options[i].disabled = false;
                if (options[i].value === ketua && ketua !== '') {
                    options[i].disabled = true;
                }
            }
        });

        document.getElementById('wakil_ketua').addEventListener('change', function () {
            let wakilKetua = this.value;
            let ketua = document.getElementById('id_user');
            let options = ketua.getElementsByTagName('option');

            for (let i = 0; i < options.length; i++) {
                options[i].disabled = false;
                if (options[i].value === wakilKetua && wakilKetua !== '') {
                    options[i].disabled = true;
                }
            }
        });
    </script>
@endsection