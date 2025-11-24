@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Daftar User</h3>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                {{-- Tombol Tambah --}}
                <a href="{{ route('user.create') }}" class="btn btn-primary mb-3">
                    <i class="bi bi-person-plus me-1"></i> Tambah User
                </a>

                {{-- Alert Success --}}
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                {{-- 🔎 SEARCH --}}
                <h5><strong>🔍 Pencarian Data</strong></h5>
                <form action="{{ route('user.index') }}" method="GET" class="row g-2 mb-3">

                    {{-- SEARCH --}}
                    <div class="col-md-4">
                        <input type="text" name="search" value="{{ request('search') }}"
                               class="form-control" placeholder="Cari nama / email...">
                    </div>

                    {{-- SUBMIT --}}
                    <div class="col-md-2">
                        <button class="btn btn-dark w-100">Cari</button>
                    </div>

                    {{-- RESET --}}
                    <div class="col-md-2">
                        <a href="{{ route('user.index') }}" class="btn btn-secondary w-100">Reset</a>
                    </div>
                </form>

                {{-- TABEL --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $item)
                                <tr class="{{ $loop->odd ? 'row-pink' : 'row-blue' }}">
                                    <td class="text-center fw-bold">
                                        {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            {{-- Edit --}}
                                            <a href="{{ route('user.edit', $item) }}"
                                               class="btn btn-sm btn-outline-warning rounded-circle action-btn"
                                               title="Edit User">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            {{-- Hapus --}}
                                            <form action="{{ route('user.destroy', $item) }}" method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-outline-danger rounded-circle action-btn"
                                                    title="Hapus User">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Belum ada user</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                <div class="mt-3">
                    {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
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
