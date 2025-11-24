@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Daftar Peminjaman Fasilitas</h3>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">

                    {{-- Tombol Tambah --}}
                    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary mb-3">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Peminjaman
                    </a>

                    {{-- Alert --}}
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif



                    <h5><strong>🔍 Pencarian & Filter</strong></h5>

                    <form action="{{ route('peminjaman.index') }}" method="GET" class="row g-2 mb-3">

                        {{-- SEARCH --}}
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control"
                                placeholder="Cari nama peminjam / fasilitas / tujuan / status"
                                value="{{ request('search') }}">
                        </div>

                        {{-- FILTER STATUS --}}
                        <div class="col-md-3">
                            <select name="status" class="form-control">
                                <option value="">-- Semua Status --</option>
                                <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu
                                </option>
                                <option value="Disetujui" {{ request('status') == 'Disetujui' ? 'selected' : '' }}>Disetujui
                                </option>
                                <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak
                                </option>
                            </select>
                        </div>

                        {{-- TOMBOL CARI --}}
                        <div class="col-md-2">
                            <button class="btn btn-dark w-100">
                                <i class="bi bi-search"></i> Cari
                            </button>
                        </div>

                        {{-- RESET --}}
                        <div class="col-md-2">
                            <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary w-100">
                                Reset
                            </a>
                        </div>
                    </form>


                    {{-- tabel  --}}
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
                                        <td class="text-center fw-bold">
                                            {{ ($peminjaman->currentPage() - 1) * $peminjaman->perPage() + $loop->iteration }}
                                        </td>

                                        <td class="fw-bold">{{ $p->warga->nama ?? '-' }}</td>
                                        <td>{{ $p->fasilitas->nama ?? '-' }}</td>
                                        <td>{{ $p->tanggal_mulai }}</td>
                                        <td>{{ $p->tanggal_selesai }}</td>
                                        <td>{{ $p->tujuan }}</td>
                                        <td>
                                            @php
                                                $statusClass = match ($p->status) {
                                                    'Menunggu' => 'bg-warning',
                                                    'Disetujui' => 'bg-success',
                                                    'Ditolak' => 'bg-danger',
                                                    default => 'bg-secondary',
                                                };
                                            @endphp
                                            <span class="badge {{ $statusClass }}">{{ $p->status }}</span>
                                        </td>
                                        <td><span class="badge bg-secondary">{{ number_format($p->total_biaya) }}</span>
                                        </td>

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

                    {{-- PAGINATION --}}
                    <div class="mt-3">
                        {{ $peminjaman->appends(request()->query())->links('pagination::bootstrap-5') }}
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
