@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Daftar Petugas Fasilitas</h3>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">

                    <a href="{{ route('petugas-fasilitas.create') }}" class="btn btn-primary mb-3">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Petugas
                    </a>

                    {{-- Alert Success --}}
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif


                    {{-- 🔎 SEARCH & FILTER --}}

                    <h5><strong>🔍 Pencarian & Filter Data</strong></h5>

                    <form action="{{ route('petugas-fasilitas.index') }}" method="GET" class="row g-2 mb-3">

                        {{-- SEARCH --}}
                        <div class="col-md-4">
                            <input type="text" name="search" value="{{ request('search') }}"
                                   class="form-control" placeholder="Cari berdasarkan nama warga...">
                        </div>

                        {{-- FILTER PERAN --}}
                        <div class="col-md-3">
                            <select name="peran" class="form-control">
                                <option value="">Semua Peran</option>
                                <option value="Penanggung jawab" {{ request('peran') == 'Penanggung jawab' ? 'selected' : '' }}>Penanggung jawab</option>
                                <option value="Cleaning Service" {{ request('peran') == 'Cleaning Service' ? 'selected' : '' }}>Cleaning Service</option>
                                <option value="Security" {{ request('peran') == 'Security' ? 'selected' : '' }}>Security</option>
                            </select>
                        </div>

                        {{-- SUBMIT --}}
                        <div class="col-md-2">
                            <button class="btn btn-dark w-100">Filter</button>
                        </div>

                        {{-- RESET --}}
                        <div class="col-md-2">
                            <a href="{{ route('petugas-fasilitas.index') }}" class="btn btn-secondary w-100">Reset</a>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Fasilitas</th>
                                    <th>Nama Warga</th>
                                    <th>Peran</th>
                                    <th>Tanggal Ditugaskan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($petugasFasilitas as $item)
                                    <tr class="{{ $loop->odd ? 'row-pink' : 'row-blue' }}">
                                        <td class="text-center fw-bold">{{ $loop->iteration + ($petugasFasilitas->currentPage() - 1) * $petugasFasilitas->perPage() }}</td>
                                        <td class="fw-bold">{{ $item->fasilitas->nama ?? '-' }}</td>
                                        <td>
                                            {{ $item->warga->nama ?? '-' }}<br>
                                            <small class="text-muted">NIK: {{ $item->warga->nik ?? '-' }}</small>
                                        </td>
                                        <td class="text-center">
                                            @if($item->peran == 'Penanggung jawab')
                                                <span class="badge bg-danger">{{ $item->peran }}</span>
                                            @elseif($item->peran == 'Cleaning Service')
                                                <span class="badge bg-info">{{ $item->peran }}</span>
                                            @elseif($item->peran == 'Security')
                                                <span class="badge bg-warning text-dark">{{ $item->peran }}</span>
                                            @else
                                                <span class="badge bg-primary">{{ $item->peran }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $item->created_at->format('d/m/Y') }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">

                                                {{-- TOMBOL SHOW/DETAIL --}}
                                                <a href="{{ route('petugas-fasilitas.show', $item->petugas_id) }}"
                                                    class="btn btn-sm btn-outline-info rounded-circle action-btn"
                                                    title="Lihat Detail">
                                                    <i class="bi bi-eye"></i>
                                                </a>

                                                {{-- Edit --}}
                                                <a href="{{ route('petugas-fasilitas.edit', $item->petugas_id) }}"
                                                    class="btn btn-sm btn-outline-warning rounded-circle action-btn"
                                                    title="Edit Petugas">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                                {{-- Hapus --}}
                                                <form action="{{ route('petugas-fasilitas.destroy', $item->petugas_id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-danger rounded-circle action-btn"
                                                        title="Hapus Petugas">
                                                        <i class="bi bi-trash3"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">Belum ada data petugas fasilitas</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>


                    {{-- PAGINATION --}}

                    <div class="mt-3">
                        {{ $petugasFasilitas->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- custom style --}}
    <style>
        .row-pink { background-color: #ffe6f2 !important; }
        .row-blue { background-color: #e6f3ff !important; }

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
        .btn-outline-info:hover { background-color: #17a2b8; color: #fff !important; }
        .btn-outline-warning:hover { background-color: #ffc107; color: #fff !important; }
        .btn-outline-danger:hover { background-color: #dc3545; color: #fff !important; }

        /* Style untuk badge */
        .badge {
            font-size: 0.85em;
            padding: 5px 10px;
        }
    </style>
@endsection
