@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Daftar User</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Users</li>
                </ol>
            </nav>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                {{-- Tombol Tambah & Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="card-title mb-0">Data Users</h4>
                        <p class="text-muted mb-0">Total {{ $users->total() }} user ditemukan</p>
                    </div>
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

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-circle me-2"></i> {{ session('error') }}
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
                                <button type="submit" class="btn btn-dark w-100">
                                    <i class="bi bi-filter me-1"></i> Filter
                                </button>
                            </div>

                            <div class="col-md-2">
                                <a href="{{ route('user.index') }}" class="btn btn-outline-secondary w-100">
                                    <i class="bi bi-arrow-clockwise me-1"></i> Reset
                                </a>
                            </div>

                            @if(request()->has('search') || request()->has('role'))
                            <div class="col-12 mt-2">
                                <div class="alert alert-info py-2 mb-0">
                                    <i class="bi bi-info-circle me-2"></i>
                                    Menampilkan hasil pencarian:
                                    @if(request('search'))
                                        <span class="badge bg-info ms-2">"{{ request('search') }}"</span>
                                    @endif
                                    @if(request('role'))
                                        <span class="badge bg-info ms-2">Role: {{ request('role') }}</span>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>

                {{-- STATISTICS --}}
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title text-white mb-1">Total Users</h6>
                                        <h3 class="mb-0">{{ $users->total() }}</h3>
                                    </div>
                                    <i class="bi bi-people fs-1 opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title text-white mb-1">Super Admin</h6>
                                        <h3 class="mb-0">{{ \App\Models\User::where('role', 'Super Admin')->count() }}</h3>
                                    </div>
                                    <i class="bi bi-shield-check fs-1 opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-dark">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title text-dark mb-1">Administrator</h6>
                                        <h3 class="mb-0">{{ \App\Models\User::where('role', 'Administrator')->count() }}</h3>
                                    </div>
                                    <i class="bi bi-person-badge fs-1 opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title text-white mb-1">Mitra & Pelanggan</h6>
                                        <h3 class="mb-0">{{ \App\Models\User::whereIn('role', ['Mitra', 'Pelanggan'])->count() }}</h3>
                                    </div>
                                    <i class="bi bi-people-fill fs-1 opacity-50"></i>
                                </div>
                            </div>
                        </div>
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
                                <th width="150" class="text-center">Tanggal Dibuat</th>
                                <th width="140" class="text-center">Aksi</th>
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
                                             title="{{ $item->name }}"
                                             onclick="window.location.href='{{ route('user.show', $item) }}'">
                                            @if($item->profile_picture)
                                                <img src="{{ asset('storage/' . $item->profile_picture) }}"
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
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <strong>
                                                    <a href="{{ route('user.show', $item) }}" class="text-decoration-none text-dark">
                                                        {{ $item->name }}
                                                    </a>
                                                </strong>
                                                <div class="small text-muted">
                                                    <i class="bi bi-person me-1"></i> ID: {{ $item->id }}
                                                </div>
                                            </div>
                                            @if($item->role == 'Super Admin')
                                            <span class="badge bg-danger ms-2">SU</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-envelope me-2 text-primary"></i>
                                            <div>
                                                {{ $item->email }}
                                                @if($item->created_at->diffInDays(now()) < 7)
                                                <div class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 small">
                                                    <i class="bi bi-star-fill me-1"></i> Baru
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $roleColors = [
                                                'Super Admin' => 'bg-danger',
                                                'Administrator' => 'bg-warning text-dark',
                                                'Pelanggan' => 'bg-success',
                                                'Mitra' => 'bg-info',
                                            ];
                                            $roleClass = $roleColors[$item->role] ?? 'bg-secondary';
                                        @endphp
                                        <span class="badge rounded-pill py-2 px-3 fw-normal {{ $roleClass }}">
                                            <i class="bi bi-shield me-1"></i> {{ $item->role }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="small">
                                            <div>{{ $item->created_at->format('d/m/Y') }}</div>
                                            <div class="text-muted">{{ $item->created_at->format('H:i') }}</div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <!-- TOMBOL DETAIL -->
                                            <a href="{{ route('user.show', $item) }}"
                                               class="btn btn-sm btn-outline-info"
                                               data-bs-toggle="tooltip" title="Lihat Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <!-- TOMBOL EDIT -->
                                            <a href="{{ route('user.edit', $item) }}"
                                               class="btn btn-sm btn-outline-warning"
                                               data-bs-toggle="tooltip" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <!-- TOMBOL HAPUS -->
                                            <button type="button"
                                                    class="btn btn-sm btn-outline-danger delete-btn"
                                                    data-user-id="{{ $item->id }}"
                                                    data-user-name="{{ $item->name }}"
                                                    title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="bi bi-people display-4 d-block mb-3"></i>
                                            <h5>Belum ada data user</h5>
                                            <p class="mb-3">Tidak ada user yang ditemukan</p>
                                            <a href="{{ route('user.create') }}" class="btn btn-primary">
                                                <i class="bi bi-person-plus me-1"></i> Tambah User Pertama
                                            </a>
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
                        Menampilkan <strong>{{ $users->firstItem() ?: 0 }}</strong> -
                        <strong>{{ $users->lastItem() ?: 0 }}</strong> dari
                        <strong>{{ $users->total() }}</strong> user
                    </div>
                    <div>
                        <nav aria-label="Page navigation">
                            {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
                        </nav>
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
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .btn-group .btn {
        border-radius: 6px !important;
        margin: 0 2px;
        padding: 6px 12px;
        transition: all 0.2s ease;
    }

    .btn-group .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .badge {
        font-size: 0.85em;
        letter-spacing: 0.5px;
    }

    .bg-danger { background: linear-gradient(135deg, #FF6B6B 0%, #EE5A24 100%) !important; }
    .bg-warning { background: linear-gradient(135deg, #FFD166 0%, #FF9F43 100%) !important; }
    .bg-info { background: linear-gradient(135deg, #4ECDC4 0%, #45B7D1 100%) !important; }
    .bg-success { background: linear-gradient(135deg, #06D6A0 0%, #1DD1A1 100%) !important; }
    .bg-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important; }

    .card.bg-primary,
    .card.bg-success,
    .card.bg-info {
        transition: all 0.3s ease;
        border: none;
    }

    .card.bg-primary:hover,
    .card.bg-success:hover,
    .card.bg-info:hover,
    .card.bg-warning:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }
</style>

<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Delete functionality
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-user-id');
                const userName = this.getAttribute('data-user-name');

                if (confirm(`Yakin ingin menghapus user "${userName}"?`)) {
                    console.log('Deleting user ID:', userId);

                    // Create form
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/user/${userId}`;

                    // Add CSRF token
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    // Add method spoofing
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';

                    form.appendChild(csrfToken);
                    form.appendChild(methodInput);

                    // Submit form
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });

    // Auto-hide success alert after 5 seconds
    setTimeout(function() {
        var alert = document.querySelector('.alert-success');
        if (alert) {
            var bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }
    }, 5000);
</script>
@endsection
