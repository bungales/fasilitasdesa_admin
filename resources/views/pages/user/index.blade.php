@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Daftar User</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Users</li>
                </ol>
            </nav>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                {{-- Tombol Tambah --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title mb-0">Data Users</h4>
                    <a href="{{ route('user.create') }}" class="btn btn-primary">
                        <i class="bi bi-person-plus me-1"></i> Tambah User
                    </a>
                </div>

                {{-- Alert Success --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- 🔎 SEARCH & FILTER --}}
                <div class="card mb-4 border">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-search me-2"></i> Pencarian & Filter Data
                        </h5>
                        <form action="{{ route('user.index') }}" method="GET" class="row g-3">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                                    <input type="text" name="search" value="{{ request('search') }}"
                                           class="form-control" placeholder="Cari nama atau email...">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-funnel"></i></span>
                                    <select name="role" class="form-select">
                                        <option value="">Semua Role</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role }}" {{ request('role') == $role ? 'selected' : '' }}>
                                                {{ $role }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <button class="btn btn-dark w-100">
                                    <i class="bi bi-filter me-1"></i> Filter
                                </button>
                            </div>

                            <div class="col-md-2">
                                <a href="{{ route('user.index') }}" class="btn btn-outline-secondary w-100">
                                    <i class="bi bi-arrow-clockwise me-1"></i> Reset
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- TABEL --}}
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th width="50" class="text-center">#</th>
                                <th width="80" class="text-center">Foto</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th width="150" class="text-center">Role</th>
                                <th width="120" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $item)
                                <tr>
                                    <td class="text-center fw-bold">
                                        {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="text-center">
                                        <div class="avatar-wrapper position-relative mx-auto"
                                             style="width: 50px; height: 50px; cursor: pointer;"
                                             data-bs-toggle="tooltip"
                                             title="{{ $item->name }}">
                                            @if($item->profile_picture)
                                                <img src="{{ $item->profile_picture_url }}"
                                                     alt="{{ $item->name }}"
                                                     class="rounded-circle border shadow-sm"
                                                     style="width: 100%; height: 100%; object-fit: cover;">
                                            @else
                                                <div class="rounded-circle border shadow-sm d-flex align-items-center justify-content-center"
                                                     style="width: 100%; height: 100%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-weight: bold; font-size: 18px;">
                                                    {{ strtoupper(substr($item->name, 0, 1)) }}
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <strong>{{ $item->name }}</strong>
                                        <div class="small text-muted">
                                            <i class="bi bi-person me-1"></i> ID: {{ $item->id }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-envelope me-2 text-primary"></i>
                                            {{ $item->email }}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill py-2 px-3 fw-normal
                                            {{ $item->role == 'Super Admin' ? 'bg-danger' :
                                               ($item->role == 'Administrator' ? 'bg-warning text-dark' :
                                               ($item->role == 'Mitra' ? 'bg-info' : 'bg-success')) }}">
                                            <i class="bi bi-shield me-1"></i> {{ $item->role }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('user.edit', $item) }}"
                                               class="btn btn-sm btn-outline-warning"
                                               data-bs-toggle="tooltip" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('user.destroy', $item) }}" method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus user {{ $item->name }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    data-bs-toggle="tooltip" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="bi bi-people display-4 d-block mb-3"></i>
                                            <h5>Belum ada data user</h5>
                                            <p class="mb-0">Klik tombol "Tambah User" untuk menambahkan data baru</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                @if($users->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="text-muted small">
                        Menampilkan {{ $users->firstItem() }} - {{ $users->lastItem() }} dari {{ $users->total() }} data
                    </div>
                    <div>
                        {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .table th {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        font-weight: 600;
        padding: 12px 16px;
    }

    .table td {
        padding: 12px 16px;
        vertical-align: middle;
    }

    .table tbody tr {
        transition: all 0.2s ease;
        border-left: 3px solid transparent;
    }

    .table tbody tr:hover {
        background-color: rgba(102, 126, 234, 0.1);
        border-left: 3px solid #667eea;
        transform: translateX(2px);
    }

    .avatar-wrapper {
        transition: all 0.3s ease;
    }

    .avatar-wrapper:hover {
        transform: scale(1.1);
    }

    .btn-group .btn {
        border-radius: 6px !important;
        margin: 0 2px;
        padding: 6px 12px;
    }

    .badge {
        font-size: 0.85em;
        letter-spacing: 0.5px;
    }

    .bg-danger { background: linear-gradient(135deg, #FF6B6B 0%, #EE5A24 100%) !important; }
    .bg-warning { background: linear-gradient(135deg, #FFD166 0%, #FF9F43 100%) !important; }
    .bg-info { background: linear-gradient(135deg, #4ECDC4 0%, #45B7D1 100%) !important; }
    .bg-success { background: linear-gradient(135deg, #06D6A0 0%, #1DD1A1 100%) !important; }
</style>

<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
@endsection
