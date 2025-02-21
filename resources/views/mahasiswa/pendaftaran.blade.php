@extends('layouts.app')

@section('title', 'Pendaftaran Kandidat')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm p-4">
        <h2 class="mb-4 text-center">Pendaftaran Kandidat</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('kandidat.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Pilihan Ketua dan Wakil Ketua -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="id_user" class="form-label">Ketua</label>
                    <select name="id_user" id="id_user" class="form-select @error('id_user') is-invalid @enderror" required>
                        <option value="">Pilih Ketua</option>
                        @foreach($mahasiswa as $mhs)
                            <option value="{{ $mhs->id_user }}" {{ old('id_user') == $mhs->id_user ? 'selected' : '' }}>
                                {{ $mhs->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_user')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="wakil_ketua" class="form-label">Wakil Ketua</label>
                    <select name="wakil_ketua" id="wakil_ketua" class="form-select @error('wakil_ketua') is-invalid @enderror" required>
                        <option value="">Pilih Wakil Ketua</option>
                        @foreach($mahasiswa as $mhs)
                            <option value="{{ $mhs->id_user }}" {{ old('wakil_ketua') == $mhs->id_user ? 'selected' : '' }}>
                                {{ $mhs->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('wakil_ketua')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Upload Berkas -->
            <div class="row">
                @foreach([
                    'transkrip_nilai' => 'Transkrip Nilai',
                    'visi_misi' => 'Visi Misi',
                    'prestasi_akademik' => 'Prestasi Akademik',
                    'surat_rekomendasi' => 'Surat Rekomendasi',
                    'keikutsertaan_organisasi' => 'Keikutsertaan dalam Organisasi',
                    'prestasi_non_akademik' => 'Prestasi Non Akademik'
                ] as $name => $label)
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ $label }} (PDF)</label>
                    <input type="file" name="{{ $name }}" class="form-control @error($name) is-invalid @enderror" accept=".pdf" required>
                    @error($name)
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @endforeach
            </div>

            <!-- Pilihan Usia -->
            <div class="mb-3">
                <label class="form-label">Usia</label>
                <select name="usia" class="form-select @error('usia') is-invalid @enderror" required>
                    <option value="">Pilih Usia</option>
                    <option value="19-24" {{ old('usia') == '19-24' ? 'selected' : '' }}>19-24 tahun</option>
                    <option value=">24" {{ old('usia') == '>24' ? 'selected' : '' }}>Lebih dari 24 tahun</option>
                    <option value="<19" {{ old('usia') == '<19' ? 'selected' : '' }}>Kurang dari 19 tahun</option>
                </select>
                @error('usia')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary w-50">Daftar</button>
            </div>
        </form>
    </div>
</div>
@endsection
