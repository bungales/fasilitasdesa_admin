@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Daftar Peminjaman Fasilitas</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Peminjaman Fasilitas</li>
                    </ol>
                </nav>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">

                    {{-- Tombol Tambah --}}
                    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary mb-3">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Peminjaman
                    </a>

                    {{-- Alert Success --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Alert Error --}}
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- 🔎 SEARCH & FILTER --}}
                    <h5><strong>🔍 Pencarian & Filter Data</strong></h5>

                    <form action="{{ route('peminjaman.index') }}" method="GET" class="row g-2 mb-3">

                        {{-- SEARCH --}}
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control"
                                placeholder="Cari nama peminjam / fasilitas / tujuan"
                                value="{{ request('search') }}">
                        </div>

                        {{-- FILTER STATUS --}}
                        <div class="col-md-3">
                            <select name="status" class="form-control">
                                <option value="">Semua Status</option>
                                <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="Disetujui" {{ request('status') == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>

                        {{-- FILTER BULAN --}}
                        <div class="col-md-3">
                            <input type="month" name="month" class="form-control"
                                   value="{{ request('month') }}">
                        </div>

                        {{-- SUBMIT --}}
                        <div class="col-md-1">
                            <button class="btn btn-dark w-100">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>

                        {{-- RESET --}}
                        <div class="col-md-1">
                            <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary w-100">
                                <i class="bi bi-arrow-clockwise"></i>
                            </a>
                        </div>
                    </form>

                    {{-- Statistik Cepat --}}
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-light border-0">
                                <div class="card-body text-center py-3">
                                    <h6 class="text-muted mb-1">Total Peminjaman</h6>
                                    <h4 class="fw-bold text-primary">{{ $total ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-light border-0">
                                <div class="card-body text-center py-3">
                                    <h6 class="text-muted mb-1">Menunggu</h6>
                                    <h4 class="fw-bold text-warning">{{ $waiting ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-light border-0">
                                <div class="card-body text-center py-3">
                                    <h6 class="text-muted mb-1">Disetujui</h6>
                                    <h4 class="fw-bold text-success">{{ $approved ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-light border-0">
                                <div class="card-body text-center py-3">
                                    <h6 class="text-muted mb-1">Ditolak</h6>
                                    <h4 class="fw-bold text-danger">{{ $rejected ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tabel Data --}}
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
                                    <th>Media</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($peminjaman as $p)
                                    @php
                                        $mediaCount = $p->media_count ?? ($p->media ? $p->media->count() : 0);
                                    @endphp

                                    <tr class="{{ $loop->odd ? 'row-pink' : 'row-blue' }}">
                                        <td class="text-center fw-bold">{{ $loop->iteration + ($peminjaman->currentPage() - 1) * $peminjaman->perPage() }}</td>

                                        {{-- Nama Peminjam --}}
                                        <td>
                                            <div>
                                                <h6 class="mb-0">{{ $p->warga->nama ?? '-' }}</h6>
                                                @if(isset($p->warga->no_identitas))
                                                    <small class="text-muted">{{ $p->warga->no_identitas ?? '-' }}</small>
                                                @endif
                                            </div>
                                        </td>

                                        {{-- Fasilitas --}}
                                        <td>
                                            <strong>{{ $p->fasilitas->nama ?? '-' }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $p->fasilitas->jenis ?? '' }}</small>
                                        </td>

                                        {{-- Tanggal Mulai --}}
                                        <td class="text-center">
                                            <span class="badge bg-info">
                                                {{ date('d/m/Y', strtotime($p->tanggal_mulai)) }}
                                            </span>
                                        </td>

                                        {{-- Tanggal Selesai --}}
                                        <td class="text-center">
                                            <span class="badge bg-primary">
                                                {{ date('d/m/Y', strtotime($p->tanggal_selesai)) }}
                                            </span>
                                        </td>

                                        {{-- Tujuan --}}
                                        <td>
                                            <div class="truncate-text" title="{{ $p->tujuan }}">
                                                {{ Str::limit($p->tujuan, 40) }}
                                            </div>
                                        </td>

                                        {{-- Status --}}
                                        <td class="text-center">
                                            @php
                                                $statusClass = match ($p->status) {
                                                    'Menunggu' => 'bg-warning',
                                                    'Disetujui' => 'bg-success',
                                                    'Ditolak' => 'bg-danger',
                                                    'Selesai' => 'bg-info',
                                                    default => 'bg-secondary',
                                                };
                                            @endphp
                                            <span class="badge {{ $statusClass }} p-2">
                                                {{ $p->status }}
                                            </span>
                                        </td>

                                        {{-- Total Biaya --}}
                                        <td class="text-center">
                                            <span class="badge bg-secondary">
                                                Rp {{ number_format($p->total_biaya, 0, ',', '.') }}
                                            </span>
                                        </td>

                                        {{-- Media --}}
                                        <td class="text-center">
                                            @if($mediaCount > 0)
                                                <span class="badge bg-info">
                                                    <i class="bi bi-paperclip me-1"></i>
                                                    {{ $mediaCount }}
                                                </span>
                                            @else
                                                <span class="badge bg-light text-dark">
                                                    <i class="bi bi-file-x me-1"></i>
                                                    Kosong
                                                </span>
                                            @endif
                                        </td>

                                        {{-- Aksi --}}
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">

                                                {{-- TOMBOL SHOW/DETAIL --}}
                                                <a href="{{ route('peminjaman.show', $p->pinjam_id) }}"
                                                    class="btn btn-sm btn-outline-info rounded-circle action-btn"
                                                    title="Lihat Detail"
                                                    data-bs-toggle="tooltip">
                                                    <i class="bi bi-eye"></i>
                                                </a>

                                                {{-- Edit --}}
                                                <a href="{{ route('peminjaman.edit', $p->pinjam_id) }}"
                                                    class="btn btn-sm btn-outline-warning rounded-circle action-btn"
                                                    title="Edit Peminjaman"
                                                    data-bs-toggle="tooltip">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                                {{-- Media --}}
                                                <a href="{{ route('peminjaman.show', $p->pinjam_id) }}#media"
                                                    class="btn btn-sm btn-outline-primary rounded-circle action-btn"
                                                    title="Media"
                                                    data-bs-toggle="tooltip">
                                                    <i class="bi bi-images"></i>
                                                </a>

                                                {{-- Hapus --}}
                                                <form action="{{ route('peminjaman.destroy', $p->pinjam_id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-danger rounded-circle action-btn"
                                                        title="Hapus Peminjaman"
                                                        data-bs-toggle="tooltip">
                                                        <i class="bi bi-trash3"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-muted py-4">
                                            <div class="empty-state">
                                                <i class="bi bi-clipboard-x display-4 text-muted"></i>
                                                <h5 class="mt-3 text-muted">Tidak ada data peminjaman</h5>
                                                <p class="text-muted">
                                                    @if(request()->has('search') || request()->has('status'))
                                                        Data tidak ditemukan dengan filter yang dipilih
                                                    @else
                                                        Belum ada data peminjaman fasilitas
                                                    @endif
                                                </p>
                                                <a href="{{ route('peminjaman.create') }}" class="btn btn-primary mt-2">
                                                    <i class="bi bi-plus-circle me-1"></i> Tambah Peminjaman
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- PAGINATION --}}
                    @if($peminjaman->hasPages())
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="text-muted">
                                Menampilkan {{ $peminjaman->firstItem() ?? 0 }} - {{ $peminjaman->lastItem() ?? 0 }}
                                dari {{ $peminjaman->total() ?? 0 }} data
                            </div>
                            <div>
                                {{ $peminjaman->appends(request()->query())->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    {{-- custom style --}}
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
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .action-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .btn-outline-info:hover {
            background-color: #17a2b8;
            color: #fff !important;
        }
        .btn-outline-warning:hover {
            background-color: #ffc107;
            color: #fff !important;
        }
        .btn-outline-primary:hover {
            background-color: #0d6efd;
            color: #fff !important;
        }
        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: #fff !important;
        }

        /* Style untuk badge */
        .badge {
            font-size: 0.85em;
            padding: 5px 10px;
        }

        .truncate-text {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .empty-state {
            padding: 20px 0;
        }

        .table tbody tr:hover {
            background-color: rgba(0,0,0,.03) !important;
        }

        .card.bg-light {
            border-radius: 8px;
            border: 1px solid rgba(0,0,0,.1);
        }
    </style>

    <script>
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>
@endsection
