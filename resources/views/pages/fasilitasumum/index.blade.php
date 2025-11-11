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

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

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
                                        <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                        <td class="fw-bold">{{ $item->nama }}</td>
                                        <td>{{ $item->jenis }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td><span class="badge bg-info text-dark">{{ $item->rt }}</span></td>
                                        <td><span class="badge bg-primary">{{ $item->rw }}</span></td>
                                        <td><span class="badge bg-secondary">{{ $item->kapasitas }}</span></td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                {{-- Tombol Edit --}}
                                                <a href="{{ route('fasilitasumum.edit', $item) }}"
                                                    class="btn btn-sm btn-outline-warning rounded-circle action-btn"
                                                    title="Edit Fasilitas">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                                {{-- Tombol Hapus --}}
                                                <form action="{{ route('fasilitasumum.destroy', $item) }}" method="POST"
                                                    class="d-inline"
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
                </div>
            </div>
        </div>
    </div>

    {{-- custom style --}}
    <style>
        .row-pink {
            background-color: #ffe6f2 !important; /* pink lembut */
        }

        .row-blue {
            background-color: #e6f3ff !important; /* biru lembut */
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
