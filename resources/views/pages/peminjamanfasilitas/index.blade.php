@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Daftar Peminjaman Fasilitas</h3>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                <a href="{{ route('peminjaman.create') }}" class="btn btn-primary mb-3">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Peminjaman
                </a>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>#</th>
                                <th>Nama Peminjam</th>
                                <th>Fasilitas</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Tujuan</th>
                                <th>Status</th>
                                <th>Total Biaya</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($peminjaman as $p)
                                <tr class="{{ $loop->odd ? 'row-pink' : 'row-blue' }}">
                                    <td class="text-center fw-bold">{{ $loop->iteration }}</td>

                                    {{-- Relasi warga --}}
                                    <td class="fw-bold">{{ $p->warga->nama ?? '-' }}</td>

                                    {{-- Relasi fasilitas --}}
                                    <td>{{ $p->fasilitas->nama ?? '-' }}</td>

                                    <td>{{ $p->tanggal_mulai }}</td>
                                    <td>{{ $p->tanggal_selesai }}</td>
                                    <td>{{ $p->tujuan }}</td>
                                    <td><span class="badge bg-info">{{ $p->status }}</span></td>
                                    <td><span class="badge bg-secondary">{{ number_format($p->total_biaya) }}</span></td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">

                                            {{-- Edit --}}
                                            <a href="{{ route('peminjaman.edit', $p->pinjam_id) }}"
                                               class="btn btn-sm btn-outline-warning rounded-circle action-btn"
                                               title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            {{-- Delete --}}
                                            <form action="{{ route('peminjaman.destroy', $p->pinjam_id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-outline-danger rounded-circle action-btn"
                                                    title="Hapus">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted">
                                        Belum ada data peminjaman fasilitas
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- Custom CSS --}}
<style>
    .row-pink {
        background-color: #ffe6f2 !important;
    }
    .row-blue {
        background-color: #e6f3ff !important;
    }
    .action-btn {
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .action-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
    .btn-outline-warning:hover {
        background-color: #ffc107;
        color: #fff;
    }
    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: #fff;
    }
</style>
@endsection
