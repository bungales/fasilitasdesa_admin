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
                    <i class="fas fa-plus-circle me-1"></i> Tambah Syarat
                </a>

                {{-- Alert --}}
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <h5><strong>🔍 Pencarian & Filter</strong></h5>

                <form action="{{ route('syarat-fasilitas.index') }}" method="GET" class="row g-2 mb-3">
                    {{-- SEARCH --}}
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control"
                            placeholder="Cari nama syarat / fasilitas / deskripsi"
                            value="{{ request('search') }}">
                    </div>

                    {{-- FILTER FASILITAS --}}
                    <div class="col-md-3">
                        <select name="fasilitas_id" class="form-control">
                            <option value="">-- Semua Fasilitas --</option>
                            @foreach($fasilitasList as $fasilitas)
                                <option value="{{ $fasilitas->fasilitas_id }}"
                                    {{ request('fasilitas_id') == $fasilitas->fasilitas_id ? 'selected' : '' }}>
                                    {{ $fasilitas->nama_fasilitas }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- TOMBOL CARI --}}
                    <div class="col-md-2">
                        <button class="btn btn-dark w-100">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>

                    {{-- RESET --}}
                    <div class="col-md-2">
                        <a href="{{ route('syarat-fasilitas.index') }}" class="btn btn-secondary w-100">
                            Reset
                        </a>
                    </div>
                </form>

                {{-- tabel --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>#</th>
                                <th>Nama Fasilitas</th>
                                <th>Nama Syarat</th>
                                <th>Deskripsi</th>
                                <th>Dokumen</th>
                                <th>Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($syaratFasilitas as $syarat)
                                <tr class="{{ $loop->odd ? 'row-pink' : 'row-blue' }}">
                                    <td class="text-center fw-bold">
                                        {{ ($syaratFasilitas->currentPage() - 1) * $syaratFasilitas->perPage() + $loop->iteration }}
                                    </td>

                                    <td class="fw-bold">{{ $syarat->fasilitas->nama_fasilitas ?? '-' }}</td>
                                    <td>{{ $syarat->nama_syarat }}</td>
                                    <td>{{ Str::limit($syarat->deskripsi, 50) }}</td>
                                    <td>
                                        @if($syarat->dokumen_syarat)
                                            <a href="{{ asset('storage/' . $syarat->dokumen_syarat) }}"
                                               target="_blank"
                                               class="btn btn-sm btn-outline-info">
                                                <i class="fas fa-file"></i> Lihat
                                            </a>
                                        @else
                                            <span class="badge bg-secondary">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td>{{ $syarat->created_at->format('d/m/Y') }}</td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            {{-- Edit --}}
                                            <a href="{{ route('syarat-fasilitas.edit', $syarat->syarat_id) }}"
                                                class="btn btn-sm btn-outline-warning rounded-circle action-btn"
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            {{-- Delete --}}
                                            <form action="{{ route('syarat-fasilitas.destroy', $syarat->syarat_id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus syarat ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-outline-danger rounded-circle action-btn"
                                                    title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">
                                        Belum ada data syarat fasilitas
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                <div class="mt-3">
                    {{ $syaratFasilitas->appends(request()->query())->links('pagination::bootstrap-5') }}
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
