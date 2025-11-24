@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Daftar Warga</h3>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                <a href="{{ route('warga.create') }}" class="btn btn-primary mb-3">
                    <i class="bi bi-person-plus me-1"></i> Tambah Warga
                </a>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                {{-- 🔎 Search & Filter --}}
                <form action="{{ route('warga.index') }}" method="GET" class="row g-2 mb-3">
                    <div class="col-md-4">
                        <input type="text" name="search" value="{{ request('search') }}"
                               class="form-control" placeholder="Cari nama / alamat...">
                    </div>

                    <div class="col-md-2">
                        <select name="rt" class="form-control">
                            <option value="">Semua RT</option>
                            @foreach($rtList as $rt)
                                <option value="{{ $rt }}" {{ request('rt') == $rt ? 'selected' : '' }}>{{ $rt }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <select name="rw" class="form-control">
                            <option value="">Semua RW</option>
                            @foreach($rwList as $rw)
                                <option value="{{ $rw }}" {{ request('rw') == $rw ? 'selected' : '' }}>{{ $rw }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-dark w-100"><i class="bi bi-search"></i> Filter</button>
                    </div>

                    <div class="col-md-2">
                        <a href="{{ route('warga.index') }}" class="btn btn-secondary w-100">Reset</a>
                    </div>
                </form>

                {{-- Tabel --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>RT</th>
                                <th>RW</th>
                                <th>Jenis Kelamin</th>
                                <th>No HP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($warga as $item)
                                <tr class="{{ $loop->odd ? 'row-pink' : 'row-blue' }}">
                                    <td class="text-center fw-bold">{{ ($warga->currentPage()-1) * $warga->perPage() + $loop->iteration }}</td>
                                    <td class="fw-bold">{{ $item->nama }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td><span class="badge bg-info text-dark">{{ $item->rt }}</span></td>
                                    <td><span class="badge bg-primary">{{ $item->rw }}</span></td>
                                    <td>
                                        @if($item->jenis_kelamin == 'Laki-laki')
                                            <span class="badge bg-success">Laki-laki</span>
                                        @else
                                            <span class="badge bg-danger">Perempuan</span>
                                        @endif
                                    </td>
                                    <td><span class="badge bg-secondary">{{ $item->no_hp }}</span></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('warga.edit', $item->warga_id) }}"
                                               class="btn btn-sm btn-outline-warning rounded-circle action-btn"
                                               title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST" class="d-inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle action-btn" title="Hapus">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">Belum ada data warga</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-3">
                    {{ $warga->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Custom CSS --}}
<style>
.row-pink { background-color: #ffe6f2 !important; }
.row-blue { background-color: #e6f3ff !important; }
.action-btn {
    transition: all 0.3s ease;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}
.action-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}
.btn-outline-warning:hover { background-color: #ffc107; color: #fff; }
.btn-outline-danger:hover { background-color: #dc3545; color: #fff; }
</style>
@endsection
