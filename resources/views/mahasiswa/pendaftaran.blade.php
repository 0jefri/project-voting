<!-- @extends('layouts.app')

@section('title', 'Pendaftaran Kandidat')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm p-4">
            <h2 class="mb-4 text-center">Pendaftaran Kandidat</h2>
            <form action="{{ route('mahasiswa.pendaftaran') }}" method="POST" enctype="multipart/form-data">
                @csrf -->

<!-- Pilihan Ketua dan Wakil Ketua -->
<!-- <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="id_user" class="form-label">Ketua</label>
                        <select name="id_user" id="id_user" class="form-select" required>
                            <option value="">Pilih Ketua</option>
                            @foreach($mahasiswa as $kdt)
                                <option value="{{ $kdt->id_user }}">{{ $kdt->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="wakil_ketua" class="form-label">Wakil Ketua</label>
                        <select name="wakil_ketua" id="wakil_ketua" class="form-select" required>
                            <option value="">Pilih Wakil Ketua</option>
                            @foreach($mahasiswa as $kdt)
                                <option value="{{ $kdt->id_user }}">{{ $kdt->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> -->

<!-- Upload Berkas -->
<!-- <div class="row">
                    @foreach(['transkrip_nilai' => 'Transkrip Nilai', 'visi_misi' => 'Visi Misi', 'prestasi_akademik' => 'Prestasi Akademik', 'surat_rekomendasi' => 'Surat Rekomendasi', 'keikutsertaan_organisasi' => 'Keikutsertaan dalam Organisasi', 'prestasi_non_akademik' => 'Prestasi Non Akademik'] as $name => $label)
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ $label }} (PDF)</label>
                            <input type="file" name="{{ $name }}" class="form-control" accept=".pdf" required>
                        </div>
                    @endforeach
                </div> -->

<!-- Pilihan Usia -->
<!-- <div class="mb-3">
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
@endsection -->

@extends('layouts.app')

@section('title', 'Pendaftaran Kandidat')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm p-4">
            <h2 class="mb-4 text-center">Pendaftaran Kandidat</h2>
            <form action="{{ route('mahasiswa.pendaftaran') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Data Dummy -->
                @php
                    $kandidatDummy = [
                        (object) ['id_user' => 1, 'name' => 'Budi Santoso'],
                        (object) ['id_user' => 2, 'name' => 'Siti Aminah'],
                        (object) ['id_user' => 3, 'name' => 'Joko Widodo'],
                        (object) ['id_user' => 4, 'name' => 'Megawati Soekarnoputri'],
                    ];
                @endphp

                <!-- Pilihan Ketua dan Wakil Ketua -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="id_user" class="form-label">Ketua</label>
                        <select name="id_user" id="id_user" class="form-select" required>
                            <option value="">Pilih Ketua</option>
                            @foreach($kandidatDummy as $kdt)
                                <option value="{{ $kdt->id_user }}">{{ $kdt->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="wakil_ketua" class="form-label">Wakil Ketua</label>
                        <select name="wakil_ketua" id="wakil_ketua" class="form-select" required>
                            <option value="">Pilih Wakil Ketua</option>
                            @foreach($kandidatDummy as $kdt)
                                <option value="{{ $kdt->id_user }}">{{ $kdt->name }}</option>
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
@endsection
