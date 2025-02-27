@extends('layouts.app')

@section('title', 'Daftar Kandidat BEM')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Daftar Kandidat BEM</h2>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.kandidat.hasil_gap') }}" class="btn btn-outline-secondary btn-md">
                    <i class="bi bi-graph-up"></i> Hasil Perhitungan GAP
                </a>
                <a href="{{ route('admin.kandidat.hasil_penilaian') }}" class="btn btn-outline-primary btn-md">
                    <i class="bi bi-trophy"></i> Hasil Penilaian Kandidat
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-success">
                    <tr>
                        <th>No</th>
                        <th>Ketua</th>
                        <th>Wakil Ketua</th>
                        <th>Usia</th>
                        <th>Status</th>
                        <th>Dokumen</th>
                        <th>Aksi</th>
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
                            @else <19 @endif
                        </td>
                        <td>
                            <span class="badge 
                                @if($kdt->status == 'pending') bg-warning 
                                @elseif($kdt->status == 'approved') bg-success 
                                @else bg-danger 
                                @endif">
                                {{ ucfirst($kdt->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ asset('storage/' . $kdt->transkrip_nilai) }}" target="_blank">Transkrip</a> |
                            <a href="{{ asset('storage/' . $kdt->visi_misi) }}" target="_blank">Visi Misi</a> |
                            <a href="{{ asset('storage/' . $kdt->prestasi_akademik) }}" target="_blank">Akademik</a> |
                            <a href="{{ asset('storage/' . $kdt->surat_rekomendasi) }}" target="_blank">Rekomendasi</a> |
                            <a href="{{ asset('storage/' . $kdt->keikutsertaan_organisasi) }}" target="_blank">Organisasi</a> |
                            <a href="{{ asset('storage/' . $kdt->prestasi_non_akademik) }}" target="_blank">Non-Akademik</a>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.kandidat.edit', $kdt->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.kandidat.destroy', $kdt->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                                <a href="{{ route('admin.kandidat.penilaian', $kdt->id) }}" class="btn btn-primary btn-sm">Penilaian</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada kandidat yang terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
