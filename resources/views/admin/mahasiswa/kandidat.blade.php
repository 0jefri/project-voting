@extends('layouts.app')

@section('title', 'Daftar Kandidat BEM')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm p-4">
        <h2 class="mb-4 text-center">Daftar Kandidat BEM</h2>

        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Ketua</th>
                    <th>Wakil Ketua</th>
                    <th>Usia</th>
                    <th>Dokumen</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kandidat as $index => $kdt)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $kdt->ketua->name }}</td>
                    <td>{{ $kdt->wakilKetua->name }}</td>
                    <td>
                        @if($kdt->usia == 1) 19-24 
                        @elseif($kdt->usia == 2) >24
                        @else <19 
                        @endif
                    </td>
                    <td>
                        <a href="{{ asset('storage/' . $kdt->transkrip_nilai) }}" target="_blank">Transkrip</a> |
                        <a href="{{ asset('storage/' . $kdt->visi_misi) }}" target="_blank">Visi Misi</a> |
                        <a href="{{ asset('storage/' . $kdt->prestasi_akademik) }}" target="_blank">Akademik</a> |
                        <a href="{{ asset('storage/' . $kdt->surat_rekomendasi) }}" target="_blank">Rekomendasi</a> |
                        <a href="{{ asset('storage/' . $kdt->keikutsertaan_organisasi) }}" target="_blank">Organisasi</a> |
                        <a href="{{ asset('storage/' . $kdt->prestasi_non_akademik) }}" target="_blank">Non-Akademik</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada kandidat yang terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
