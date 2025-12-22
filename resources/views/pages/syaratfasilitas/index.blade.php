@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Daftar Syarat Fasilitas</h3>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                {{-- Tombol Tambah --}}
                <a href="{{ route('syarat-fasilitas.create') }}" class="btn btn-primary mb-3">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Syarat
                </a>

                {{-- Alert --}}
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                {{-- 🔎 PENCARIAN --}}
                <h5><strong>🔍 Pencarian Data</strong></h5>

                <form action="{{ route('syarat-fasilitas.index') }}" method="GET" class="row g-2 mb-3">
                    {{-- SEARCH --}}
                    <div class="col-md-6">
                        <input type="text" name="search" class="form-control"
                            placeholder="Cari nama syarat / fasilitas / deskripsi"
                            value="{{ request('search') }}">
                    </div>

                    {{-- TOMBOL CARI --}}
                    <div class="col-md-2">
                        <button class="btn btn-dark w-100">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>

                    {{-- RESET --}}
                    <div class="col-md-2">
                        <a href="{{ route('syarat-fasilitas.index') }}" class="btn btn-secondary w-100">
                            Reset
                        </a>
                    </div>
                </form>

                {{-- Tabel --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>#</th>
                                <th>Fasilitas</th>
                                <th>Nama Syarat</th>
                                <th>Deskripsi</th>
                                <th>Dokumen</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($syaratFasilitas as $syarat)
                                <tr class="{{ $loop->odd ? 'row-pink' : 'row-blue' }}">
                                    <td class="text-center fw-bold">
                                        {{ ($syaratFasilitas->currentPage() - 1) * $syaratFasilitas->perPage() + $loop->iteration }}
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-building me-2 text-primary"></i>
                                            <div>
                                                <strong>{{ $syarat->fasilitas->nama ?? '-' }}</strong>
                                                @if($syarat->fasilitas)
                                                <br>
                                                <small class="text-muted">{{ $syarat->fasilitas->jenis ?? '' }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    <td class="fw-bold">{{ $syarat->nama_syarat }}</td>

                                    <td>
                                        @if($syarat->deskripsi)
                                            {{ Str::limit($syarat->deskripsi, 40) }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @if($syarat->dokumen_syarat)
                                            @php
                                                $extension = strtolower(pathinfo($syarat->dokumen_syarat, PATHINFO_EXTENSION));
                                            @endphp
                                            @if(in_array($extension, ['pdf']))
                                                <span class="badge bg-danger">
                                                    <i class="bi bi-file-pdf me-1"></i>PDF
                                                </span>
                                            @elseif(in_array($extension, ['doc', 'docx']))
                                                <span class="badge bg-primary">
                                                    <i class="bi bi-file-word me-1"></i>DOC
                                                </span>
                                            @elseif(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                                <span class="badge bg-success">
                                                    <i class="bi bi-image me-1"></i>GAMBAR
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">
                                                    <i class="bi bi-file me-1"></i>{{ strtoupper($extension) }}
                                                </span>
                                            @endif
                                        @else
                                            <span class="badge bg-warning">Tidak ada</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <span class="badge bg-info">{{ $syarat->created_at->format('d/m/Y') }}</span>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            {{-- TOMBOL SHOW/DETAIL --}}
                                            <a href="{{ route('syarat-fasilitas.show', $syarat->syarat_id) }}"
                                                class="btn btn-sm btn-outline-info rounded-circle"
                                                title="Lihat Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            {{-- Edit --}}
                                            <a href="{{ route('syarat-fasilitas.edit', $syarat->syarat_id) }}"
                                                class="btn btn-sm btn-outline-warning rounded-circle"
                                                title="Edit Syarat">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            {{-- Hapus --}}
                                            <form action="{{ route('syarat-fasilitas.destroy', $syarat->syarat_id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus syarat ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-outline-danger rounded-circle"
                                                    title="Hapus Syarat">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Belum ada data syarat fasilitas</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                <div class="mt-3">
                    {{ $syaratFasilitas->links('pagination::bootstrap-5') }}
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
    .btn-outline-info:hover {
        background-color: #0dcaf0;
        color: #fff;
    }
    .btn-outline-warning:hover {
        background-color: #ffc107;
        color: #fff;
    }
    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: #fff;
    }
    .badge {
        font-size: 0.85em;
    }
</style>
@endsection
