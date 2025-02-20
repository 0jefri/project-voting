@extends('layouts.app')

@section('title', 'Pendaftaran Kandidat')

@section('content')
<div class="container">
    <h2>Pendaftaran Kandidat</h2>
    <form action="{{ route('kandidat.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Pilihan Ketua dan Wakil Ketua -->
        <div class="mb-3">
            <label for="id_user" class="form-label">Ketua</label>
            <select name="id_user" id="id_user" class="form-control" required>
                <option value="">Pilih Ketua</option>
                @foreach($mahasiswa as $mhs)
                    <option value="{{ $mhs->id_user }}">{{ $mhs->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="wakil_ketua" class="form-label">Wakil Ketua</label>
            <select name="wakil_ketua" id="wakil_ketua" class="form-control" required>
                <option value="">Pilih Wakil Ketua</option>
                @foreach($mahasiswa as $mhs)
                    <option value="{{ $mhs->id_user }}">{{ $mhs->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Upload Berkas -->
        <div class="mb-3">
            <label class="form-label">Transkrip Nilai (PDF)</label>
            <input type="file" name="transkrip_nilai" class="form-control" accept=".pdf" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Visi Misi (PDF)</label>
            <input type="file" name="visi_misi" class="form-control" accept=".pdf" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Prestasi Akademik (PDF)</label>
            <input type="file" name="prestasi_akademik" class="form-control" accept=".pdf" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Surat Rekomendasi (PDF)</label>
            <input type="file" name="surat_rekomendasi" class="form-control" accept=".pdf" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Keikutsertaan dalam Organisasi (PDF)</label>
            <input type="file" name="keikutsertaan_organisasi" class="form-control" accept=".pdf" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Prestasi Non Akademik (PDF)</label>
            <input type="file" name="prestasi_non_akademik" class="form-control" accept=".pdf" required>
        </div>

        <!-- Pilihan Usia -->
        <div class="mb-3">
            <label class="form-label">Usia</label>
            <select name="usia" class="form-control" required>
                <option value="">Pilih Usia</option>
                <option value="1">19-24</option>
                <option value="2">>24</option>
                <option value="3"><19</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Daftar</button>
    </form>
</div>
@endsection
