@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Detail Petugas Fasilitas</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('petugas-fasilitas.index') }}">Petugas Fasilitas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-user-tie me-2"></i>Informasi Petugas Fasilitas
                        </h4>
                    </div>

                    <div class="card-body">
                        {{-- Alert --}}
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('warning'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{ session('warning') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        {{-- Detail Informasi --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-item mb-4">
                                    <h6 class="text-muted mb-1">
                                        <i class="fas fa-id-badge me-2"></i>ID Petugas
                                    </h6>
                                    <p class="fw-bold fs-5 text-primary">
                                        #{{ str_pad($petugasFasilitas->petugas_id, 5, '0', STR_PAD_LEFT) }}
                                    </p>
                                </div>

                                <div class="info-item mb-4">
                                    <h6 class="text-muted mb-1">
                                        <i class="fas fa-building me-2"></i>Fasilitas
                                    </h6>
                                    <p class="fw-bold fs-5">
                                        {{ $petugasFasilitas->fasilitas->nama ?? 'Tidak tersedia' }}
                                    </p>
                                    <small class="text-muted">
                                        ID: {{ $petugasFasilitas->fasilitas_id }}
                                    </small>
                                </div>

                                <div class="info-item mb-4">
                                    <h6 class="text-muted mb-1">
                                        <i class="fas fa-calendar me-2"></i>Tanggal Ditugaskan
                                    </h6>
                                    <p class="fw-bold">
                                        {{ $petugasFasilitas->created_at->translatedFormat('d F Y') }}
                                    </p>
                                    <small class="text-muted">
                                        {{ $petugasFasilitas->created_at->format('H:i:s') }}
                                    </small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item mb-4">
                                    <h6 class="text-muted mb-1">
                                        <i class="fas fa-user me-2"></i>Nama Warga
                                    </h6>
                                    <p class="fw-bold fs-5">
                                        {{ $petugasFasilitas->warga->nama ?? 'Tidak tersedia' }}
                                    </p>
                                    <small class="text-muted">
                                        NIK: {{ $petugasFasilitas->warga->nik ?? '-' }}
                                    </small>
                                </div>

                                <div class="info-item mb-4">
                                    <h6 class="text-muted mb-1">
                                        <i class="fas fa-tag me-2"></i>Peran
                                    </h6>
                                    <p class="fw-bold">
                                        @if($petugasFasilitas->peran == 'Penanggung jawab')
                                            <span class="badge bg-danger fs-6 p-2">{{ $petugasFasilitas->peran }}</span>
                                        @elseif($petugasFasilitas->peran == 'Cleaning Service')
                                            <span class="badge bg-info fs-6 p-2">{{ $petugasFasilitas->peran }}</span>
                                        @elseif($petugasFasilitas->peran == 'Security')
                                            <span class="badge bg-warning fs-6 p-2">{{ $petugasFasilitas->peran }}</span>
                                        @else
                                            <span class="badge bg-secondary fs-6 p-2">{{ $petugasFasilitas->peran }}</span>
                                        @endif
                                    </p>
                                </div>

                                <div class="info-item mb-4">
                                    <h6 class="text-muted mb-1">
                                        <i class="fas fa-sync-alt me-2"></i>Terakhir Diperbarui
                                    </h6>
                                    <p class="fw-bold">
                                        {{ $petugasFasilitas->updated_at->translatedFormat('d F Y') }}
                                    </p>
                                    <small class="text-muted">
                                        {{ $petugasFasilitas->updated_at->format('H:i:s') }}
                                    </small>
                                </div>
                            </div>
                        </div>

                        {{-- Informasi Detail Warga --}}
                        <div class="card bg-light mb-4">
                            <div class="card-header bg-info text-white">
                                <h6 class="mb-0">
                                    <i class="fas fa-id-card me-2"></i>Detail Warga
                                </h6>
                            </div>
                            <div class="card-body">
                                @if($petugasFasilitas->warga)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <h6 class="text-muted mb-1">Alamat</h6>
                                                <p class="mb-1">{{ $petugasFasilitas->warga->alamat ?? '-' }}</p>
                                                <small class="text-muted">
                                                    RT: {{ $petugasFasilitas->warga->rt ?? '-' }} /
                                                    RW: {{ $petugasFasilitas->warga->rw ?? '-' }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <h6 class="text-muted mb-1">Kontak</h6>
                                                <p class="mb-1">
                                                    <i class="fas fa-phone me-2"></i>
                                                    {{ $petugasFasilitas->warga->no_hp ?? '-' }}
                                                </p>
                                                <small class="text-muted">
                                                    Jenis Kelamin: {{ $petugasFasilitas->warga->jenis_kelamin ?? '-' }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <p class="text-muted mb-0">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        Data warga tidak tersedia
                                    </p>
                                @endif
                            </div>
                        </div>

                        {{-- Informasi Detail Fasilitas --}}
                        <div class="card bg-light mb-4">
                            <div class="card-header bg-success text-white">
                                <h6 class="mb-0">
                                    <i class="fas fa-info-circle me-2"></i>Detail Fasilitas
                                </h6>
                            </div>
                            <div class="card-body">
                                @if($petugasFasilitas->fasilitas)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <h6 class="text-muted mb-1">Jenis Fasilitas</h6>
                                                <p class="mb-1">{{ $petugasFasilitas->fasilitas->jenis ?? '-' }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <h6 class="text-muted mb-1">Lokasi</h6>
                                                <p class="mb-1">{{ $petugasFasilitas->fasilitas->lokasi ?? '-' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @if($petugasFasilitas->fasilitas->deskripsi)
                                        <div class="mb-3">
                                            <h6 class="text-muted mb-1">Deskripsi</h6>
                                            <p class="mb-0">{{ $petugasFasilitas->fasilitas->deskripsi }}</p>
                                        </div>
                                    @endif
                                @else
                                    <p class="text-muted mb-0">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        Data fasilitas tidak tersedia
                                    </p>
                                @endif
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                            <div class="btn-group" role="group">
                                <a href="{{ route('petugas-fasilitas.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
                                </a>
                                <button onclick="window.print()" class="btn btn-outline-primary ms-2">
                                    <i class="fas fa-print me-1"></i> Cetak
                                </button>
                            </div>

                            <div class="btn-group" role="group">
                                <a href="{{ route('petugas-fasilitas.edit', $petugasFasilitas->petugas_id) }}"
                                   class="btn btn-warning me-2">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>

                                <form action="{{ route('petugas-fasilitas.destroy', $petugasFasilitas->petugas_id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus petugas ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash me-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar Informasi --}}
            <div class="col-md-4">
                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle me-2"></i>Status & Info
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <div class="icon-circle bg-primary">
                                <i class="fas fa-user-tie fa-2x text-white"></i>
                            </div>
                            <h5 class="mt-3 mb-0">Petugas Fasilitas</h5>
                            <p class="text-muted">ID: #{{ str_pad($petugasFasilitas->petugas_id, 5, '0', STR_PAD_LEFT) }}</p>
                        </div>

                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Status Penugasan</span>
                                <span class="badge bg-success">Aktif</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Jenis Peran</span>
                                <span class="fw-bold">
                                    @if($petugasFasilitas->peran == 'Penanggung jawab')
                                        <span class="text-danger">Utama</span>
                                    @else
                                        <span class="text-primary">Pendukung</span>
                                    @endif
                                </span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Durasi Penugasan</span>
                                <span class="fw-bold">
                                    @php
                                        $days = $petugasFasilitas->created_at->diffInDays(now());
                                    @endphp
                                    {{ $days }} hari
                                </span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Total Petugas Fasilitas</span>
                                <span class="fw-bold">
                                    {{ \App\Models\PetugasFasilitas::count() }} orang
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-bolt me-2"></i>Aksi Cepat
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('petugas-fasilitas.edit', $petugasFasilitas->petugas_id) }}"
                               class="btn btn-warning">
                                <i class="fas fa-edit me-2"></i> Edit Petugas
                            </a>

                            @if($petugasFasilitas->warga)
                                <a href="#" class="btn btn-outline-primary"
                                   onclick="copyToClipboard('{{ $petugasFasilitas->warga->no_hp }}', 'Nomor HP')">
                                    <i class="fas fa-copy me-2"></i> Salin Nomor HP
                                </a>
                            @endif

                            <button class="btn btn-outline-info" onclick="shareData()">
                                <i class="fas fa-share-alt me-2"></i> Bagikan
                            </button>

                            <a href="mailto:?subject=Petugas Fasilitas {{ $petugasFasilitas->fasilitas->nama ?? '' }}&body=Detail Petugas:%0A%0ANama: {{ $petugasFasilitas->warga->nama ?? '' }}%0APeran: {{ $petugasFasilitas->peran }}%0AFasilitas: {{ $petugasFasilitas->fasilitas->nama ?? '' }}%0A%0ALihat detail: {{ url()->current() }}"
                               class="btn btn-outline-secondary">
                                <i class="fas fa-envelope me-2"></i> Kirim Email
                            </a>
                        </div>
                    </div>
                </div>

                {{-- QR Code untuk Mobile --}}
                <div class="card shadow-sm mt-3">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-qrcode me-2"></i>QR Code Akses Cepat
                        </h5>
                    </div>
                    <div class="card-body text-center">
                        <div id="qrcode" class="mb-3"></div>
                        <p class="text-muted small mb-2">
                            Scan untuk mengakses detail petugas
                        </p>
                        <button class="btn btn-sm btn-outline-primary" onclick="downloadQRCode()">
                            <i class="fas fa-download me-1"></i> Unduh QR Code
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Custom CSS --}}
<style>
    .info-item {
        padding: 12px 0;
        border-bottom: 1px solid #eee;
        transition: background-color 0.3s ease;
    }

    .info-item:hover {
        background-color: #f8f9fa;
        border-radius: 5px;
        padding-left: 10px;
        padding-right: 10px;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .icon-circle {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        background: linear-gradient(45deg, #6a11cb 0%, #2575fc 100%);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .list-group-item {
        background-color: transparent;
        border-color: rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .list-group-item:hover {
        background-color: #f8f9fa;
        transform: translateX(5px);
    }

    .card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .card-header {
        border-radius: 10px 10px 0 0 !important;
        padding: 15px 20px;
    }

    #qrcode {
        margin: 0 auto;
        padding: 10px;
        background: white;
        border-radius: 8px;
        display: inline-block;
        border: 2px solid #dee2e6;
    }

    #qrcode canvas {
        width: 150px !important;
        height: 150px !important;
    }

    @media (max-width: 768px) {
        .row {
            flex-direction: column;
        }

        .col-md-8, .col-md-4 {
            width: 100%;
            margin-bottom: 20px;
        }

        .btn-group {
            flex-direction: column;
            gap: 10px;
        }

        .btn-group .btn {
            width: 100%;
            margin: 5px 0 !important;
        }

        .d-flex.justify-content-between {
            flex-direction: column;
            gap: 15px;
        }
    }

    @media print {
        .col-md-4,
        .btn,
        .card-header,
        .breadcrumb,
        .page-header {
            display: none !important;
        }

        .col-md-8 {
            width: 100% !important;
        }

        .card {
            border: 1px solid #000 !important;
            box-shadow: none !important;
        }

        .info-item {
            page-break-inside: avoid;
        }
    }
</style>

{{-- JavaScript --}}
<script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js"></script>
<script>
    // Generate QR Code
    document.addEventListener('DOMContentLoaded', function() {
        const qrcodeElement = document.getElementById('qrcode');
        const currentUrl = window.location.href;

        QRCode.toCanvas(qrcodeElement, currentUrl, {
            width: 150,
            height: 150,
            margin: 1,
            color: {
                dark: '#000000',
                light: '#ffffff'
            }
        }, function(error) {
            if (error) console.error(error);
        });
    });

    // Copy to clipboard function
    function copyToClipboard(text, label) {
        navigator.clipboard.writeText(text).then(() => {
            alert(label + ' berhasil disalin!');
        }).catch(err => {
            console.error('Gagal menyalin: ', err);
            // Fallback for older browsers
            const textArea = document.createElement('textarea');
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            alert(label + ' berhasil disalin!');
        });
    }

    // Share data function
    function shareData() {
        const shareData = {
            title: 'Petugas Fasilitas: ' + '{{ $petugasFasilitas->warga->nama ?? "" }}',
            text: 'Detail petugas fasilitas:\n\nNama: {{ $petugasFasilitas->warga->nama ?? "" }}\nPeran: {{ $petugasFasilitas->peran }}\nFasilitas: {{ $petugasFasilitas->fasilitas->nama ?? "" }}',
            url: window.location.href
        };

        if (navigator.share) {
            navigator.share(shareData)
                .then(() => console.log('Berhasil dibagikan'))
                .catch((error) => console.log('Error sharing:', error));
        } else {
            // Fallback
            copyToClipboard(window.location.href, 'Link detail');
        }
    }

    // Download QR Code
    function downloadQRCode() {
        const canvas = document.querySelector('#qrcode canvas');
        const link = document.createElement('a');
        link.download = 'petugas-fasilitas-{{ $petugasFasilitas->petugas_id }}-qrcode.png';
        link.href = canvas.toDataURL('image/png');
        link.click();
    }

    // Print styles
    function printDetail() {
        window.print();
    }
</script>
@endsection
