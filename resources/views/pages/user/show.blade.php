@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Detail User</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
                </ol>
            </nav>
        </div>

        <!-- Alert Success -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <!-- Left Column - Profile Card -->
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body text-center p-4">
                        <!-- Profile Picture -->
                        <div class="mb-4">
                            <div class="position-relative d-inline-block">
                                @if($user->profile_picture_url)
                                    <img src="{{ $user->profile_picture_url }}"
                                         alt="{{ $user->name }}"
                                         class="rounded-circle border shadow-lg"
                                         style="width: 180px; height: 180px; object-fit: cover;">
                                    <span class="position-absolute top-0 end-0 p-2 bg-success text-white rounded-circle"
                                          style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-check-lg"></i>
                                    </span>
                                @else
                                    <div class="rounded-circle border shadow-lg d-flex align-items-center justify-content-center mx-auto"
                                         style="width: 180px; height: 180px; background: linear-gradient(135deg, {{ $user->avatar_color }} 0%, {{ $user->avatar_color }}80 100%); color: white; font-weight: bold; font-size: 60px;">
                                        {{ $user->initial }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- User Info -->
                        <h4 class="mb-2">{{ $user->name }}</h4>
                        <p class="text-muted mb-3">
                            <i class="bi bi-envelope me-1"></i> {{ $user->email }}
                        </p>

                        <!-- Role Badge -->
                        <div class="mb-4">
                            @php
                                $roleColors = [
                                    'Super Admin' => 'bg-danger',
                                    'Administrator' => 'bg-warning text-dark',
                                    'Pelanggan' => 'bg-success',
                                    'Mitra' => 'bg-info',
                                ];
                                $roleClass = $roleColors[$user->role] ?? 'bg-secondary';
                            @endphp
                            <span class="badge rounded-pill py-2 px-4 fw-normal fs-6 {{ $roleClass }}">
                                <i class="bi bi-shield me-2"></i> {{ $user->role }}
                            </span>
                        </div>

                        <!-- Stats -->
                        <div class="row text-center">
                            <div class="col-6 border-end">
                                <div class="p-2">
                                    <div class="h4 mb-1 text-primary">ID</div>
                                    <div class="text-muted small">#{{ $user->id }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2">
                                    <div class="h4 mb-1 text-success">Status</div>
                                    <div class="text-muted small">Aktif</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title mb-3">
                            <i class="bi bi-lightning-charge me-2"></i> Aksi Cepat
                        </h6>
                        <div class="d-grid gap-2">
                            <a href="{{ route('user.edit', $user) }}" class="btn btn-primary">
                                <i class="bi bi-pencil-square me-2"></i> Edit User
                            </a>
                            <a href="mailto:{{ $user->email }}" class="btn btn-outline-primary">
                                <i class="bi bi-envelope me-2"></i> Kirim Email
                            </a>
                            <button class="btn btn-outline-info" onclick="copyToClipboard('{{ $user->email }}')">
                                <i class="bi bi-clipboard me-2"></i> Salin Email
                            </button>
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="bi bi-trash me-2"></i> Hapus User
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Details -->
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-bottom-0 pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">
                                <i class="bi bi-person-circle me-2 text-primary"></i> Informasi Lengkap
                            </h4>
                            <span class="text-muted small">
                                <i class="bi bi-clock-history me-1"></i> Terakhir diupdate: {{ $user->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Personal Info -->
                            <div class="col-md-6">
                                <h6 class="mb-3 text-uppercase text-muted small fw-bold">
                                    <i class="bi bi-person me-1"></i> Data Pribadi
                                </h6>
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="40%" class="text-muted">Nama Lengkap</td>
                                        <td width="5%">:</td>
                                        <td><strong>{{ $user->name }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Email</td>
                                        <td>:</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-envelope me-2 text-primary"></i>
                                                {{ $user->email }}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Role</td>
                                        <td>:</td>
                                        <td>
                                            @php
                                                $roleColors = [
                                                    'Super Admin' => 'bg-danger',
                                                    'Administrator' => 'bg-warning text-dark',
                                                    'Pelanggan' => 'bg-success',
                                                    'Mitra' => 'bg-info',
                                                ];
                                                $roleClass = $roleColors[$user->role] ?? 'bg-secondary';
                                            @endphp
                                            <span class="badge rounded-pill py-1 px-3 {{ $roleClass }}">
                                                {{ $user->role }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Foto Profil</td>
                                        <td>:</td>
                                        <td>
                                            @if($user->profile_picture_url)
                                                <span class="badge bg-success">
                                                    <i class="bi bi-check-circle me-1"></i> Sudah Upload
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">
                                                    <i class="bi bi-x-circle me-1"></i> Belum Upload
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Account Info -->
                            <div class="col-md-6">
                                <h6 class="mb-3 text-uppercase text-muted small fw-bold">
                                    <i class="bi bi-card-checklist me-1"></i> Informasi Akun
                                </h6>
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="40%" class="text-muted">User ID</td>
                                        <td width="5%">:</td>
                                        <td><code>#{{ $user->id }}</code></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Dibuat Pada</td>
                                        <td>:</td>
                                        <td>
                                            <i class="bi bi-calendar-check me-1 text-success"></i>
                                            {{ $user->created_at->format('d F Y H:i') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Diupdate Pada</td>
                                        <td>:</td>
                                        <td>
                                            <i class="bi bi-calendar-plus me-1 text-warning"></i>
                                            {{ $user->updated_at->format('d F Y H:i') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Status Akun</td>
                                        <td>:</td>
                                        <td>
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle me-1"></i> Aktif
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- Timeline -->
                        <div class="mt-5 pt-4 border-top">
                            <h6 class="mb-3 text-uppercase text-muted small fw-bold">
                                <i class="bi bi-clock-history me-1"></i> Riwayat Aktivitas
                            </h6>
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-primary"></div>
                                    <div class="timeline-content">
                                        <h6 class="mb-1">Akun Dibuat</h6>
                                        <p class="text-muted small mb-0">{{ $user->created_at->format('d F Y, H:i') }}</p>
                                        <small class="text-muted">Akun user berhasil dibuat di sistem</small>
                                    </div>
                                </div>
                                @if($user->updated_at != $user->created_at)
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-warning"></div>
                                    <div class="timeline-content">
                                        <h6 class="mb-1">Update Profil</h6>
                                        <p class="text-muted small mb-0">{{ $user->updated_at->format('d F Y, H:i') }}</p>
                                        <small class="text-muted">Informasi user terakhir diperbarui</small>
                                    </div>
                                </div>
                                @endif
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-success"></div>
                                    <div class="timeline-content">
                                        <h6 class="mb-1">Login Terakhir</h6>
                                        <p class="text-muted small mb-0">Belum ada riwayat login</p>
                                        <small class="text-muted">User belum melakukan login</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="bi bi-exclamation-triangle text-danger me-2"></i> Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="mb-4">
                    <div class="rounded-circle bg-danger bg-opacity-10 d-inline-flex align-items-center justify-content-center p-4 mb-3">
                        <i class="bi bi-trash text-danger" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="mb-2">Hapus User {{ $user->name }}?</h5>
                    <p class="text-muted mb-0">
                        Apakah Anda yakin ingin menghapus user ini? Tindakan ini tidak dapat dibatalkan.
                    </p>
                    <p class="text-danger small mt-2">
                        <i class="bi bi-info-circle me-1"></i> Semua data terkait user ini akan terhapus permanen.
                    </p>
                </div>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('user.destroy', $user) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i> Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .timeline {
        position: relative;
        padding-left: 30px;
    }

    .timeline-item {
        position: relative;
        margin-bottom: 25px;
    }

    .timeline-marker {
        position: absolute;
        left: -30px;
        top: 5px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
    }

    .timeline-content {
        padding-left: 15px;
        border-left: 2px solid #e9ecef;
        padding-bottom: 20px;
    }

    .timeline-item:last-child .timeline-content {
        border-left: none;
        padding-bottom: 0;
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
</style>

<script>
    // Copy to Clipboard
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            // Show toast notification
            const toast = document.createElement('div');
            toast.className = 'position-fixed top-0 end-0 p-3';
            toast.style.zIndex = '9999';
            toast.innerHTML = `
                <div class="toast show" role="alert">
                    <div class="toast-header bg-success text-white">
                        <i class="bi bi-check-circle me-2"></i>
                        <strong class="me-auto">Berhasil!</strong>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body">
                        Email berhasil disalin: <strong>${text}</strong>
                    </div>
                </div>
            `;
            document.body.appendChild(toast);

            // Remove toast after 3 seconds
            setTimeout(() => {
                toast.remove();
            }, 3000);
        }).catch(function(err) {
            console.error('Gagal menyalin: ', err);
            alert('Gagal menyalin email');
        });
    }

    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endsection
