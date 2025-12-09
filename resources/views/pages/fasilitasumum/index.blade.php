@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Daftar Fasilitas Umum</h3>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">

                    <a href="{{ route('fasilitasumum.create') }}" class="btn btn-primary mb-3">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Fasilitas Umum
                    </a>

                    {{-- Alert Success --}}
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif


                    {{-- 🔎 SEARCH & FILTER --}}

                    <h5><strong>🔍 Pencarian & Filter Data</strong></h5>

                    <form action="{{ route('fasilitasumum.index') }}" method="GET" class="row g-2 mb-3">

                        {{-- SEARCH --}}
                        <div class="col-md-4">
                            <input type="text" name="search" value="{{ request('search') }}"
                                   class="form-control" placeholder="Cari nama / alamat...">
                        </div>

                        {{-- FILTER JENIS --}}
                        <div class="col-md-3">
                            <select name="jenis" class="form-control">
                                <option value="">Semua Jenis</option>
                                <option value="aula" {{ request('jenis') == 'aula' ? 'selected' : '' }}>Aula</option>
                                <option value="lapangan" {{ request('jenis') == 'lapangan' ? 'selected' : '' }}>Lapangan</option>
                                <option value="gor-mini" {{ request('jenis') == 'gor-mini' ? 'selected' : '' }}>GOR Mini</option>
                                <option value="ruang-rapat" {{ request('jenis') == 'ruang-rapat' ? 'selected' : '' }}>Ruang Rapat</option>
                                <option value="gedung" {{ request('jenis') == 'gedung' ? 'selected' : '' }}>Gedung</option>
                                <option value="pendopo" {{ request('jenis') == 'pendopo' ? 'selected' : '' }}>Pendopo</option>
                            </select>
                        </div>

                        {{-- SUBMIT --}}
                        <div class="col-md-2">
                            <button class="btn btn-dark w-100">Filter</button>
                        </div>

                        {{-- RESET --}}
                        <div class="col-md-2">
                            <a href="{{ route('fasilitasumum.index') }}" class="btn btn-secondary w-100">Reset</a>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Fasilitas</th>
                                    <th>Jenis</th>
                                    <th>Alamat</th>
                                    <th>RT</th>
                                    <th>RW</th>
                                    <th>Kapasitas</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($fasilitas as $item)
                                    <tr class="{{ $loop->odd ? 'row-pink' : 'row-blue' }}">
                                        <td class="text-center fw-bold">{{ $loop->iteration + ($fasilitas->currentPage() - 1) * $fasilitas->perPage() }}</td>
                                        <td class="fw-bold">{{ $item->nama }}</td>
                                        <td><span class="badge bg-success">{{ $item->jenis }}</span></td>
                                        <td>{{ Str::limit($item->alamat, 30) }}</td>
                                        <td class="text-center"><span class="badge bg-info">{{ $item->rt }}</span></td>
                                        <td class="text-center"><span class="badge bg-primary">{{ $item->rw }}</span></td>
                                        <td class="text-center"><span class="badge bg-secondary">{{ $item->kapasitas }}</span></td>
                                        <td>{{ Str::limit($item->deskripsi, 40) }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">

                                                {{-- TOMBOL SHOW/DETAIL --}}
                                                <a href="{{ route('fasilitasumum.show', $item->fasilitas_id) }}"
                                                    class="btn btn-sm btn-outline-info rounded-circle action-btn"
                                                    title="Lihat Detail">
                                                    <i class="bi bi-eye"></i>
                                                </a>

                                                {{-- Edit --}}
                                                <a href="{{ route('fasilitasumum.edit', $item->fasilitas_id) }}"
                                                    class="btn btn-sm btn-outline-warning rounded-circle action-btn"
                                                    title="Edit Fasilitas">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                                {{-- Hapus --}}
                                                <form action="{{ route('fasilitasumum.destroy', $item->fasilitas_id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-danger rounded-circle action-btn"
                                                        title="Hapus Fasilitas">
                                                        <i class="bi bi-trash3"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted">Belum ada data fasilitas umum</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>


                    {{-- PAGINATION --}}

                    <div class="mt-3">
                        {{ $fasilitas->links('pagination::bootstrap-5') }}
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
