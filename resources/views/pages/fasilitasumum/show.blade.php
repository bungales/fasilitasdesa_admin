@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Detail Fasilitas Umum</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('fasilitasumum.index') }}">Fasilitas Umum</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-building me-2"></i>Informasi Fasilitas
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

                        {{-- Detail Informasi --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-item mb-4">
                                    <h6 class="text-muted mb-1">
                                        <i class="fas fa-tag me-2"></i>Nama Fasilitas
                                    </h6>
                                    <p class="fw-bold fs-5 text-primary">
                                        {{ $fasilitasumum->nama }}
                                    </p>
                                </div>

                                <div class="info-item mb-4">
                                    <h6 class="text-muted mb-1">
                                        <i class="fas fa-list me-2"></i>Jenis Fasilitas
                                    </h6>
                                    <p class="fw-bold">
                                        {{ $fasilitasumum->jenis }}
                                    </p>
                                </div>

                                <div class="info-item mb-4">
                                    <h6 class="text-muted mb-1">
                                        <i class="fas fa-users me-2"></i>Kapasitas
                                    </h6>
                                    <p class="fw-bold">
                                        {{ $fasilitasumum->kapasitas }} orang
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item mb-4">
                                    <h6 class="text-muted mb-1">
                                        <i class="fas fa-map-marker-alt me-2"></i>Alamat
                                    </h6>
                                    <p class="fw-bold">
                                        {{ $fasilitasumum->alamat }}
                                    </p>
                                </div>

                                <div class="info-item mb-4">
                                    <h6 class="text-muted mb-1">
                                        <i class="fas fa-location-dot me-2"></i>RT/RW
                                    </h6>
                                    <p class="fw-bold">
                                        {{ $fasilitasumum->rt }} / {{ $fasilitasumum->rw }}
                                    </p>
                                </div>

                                <div class="info-item mb-4">
                                    <h6 class="text-muted mb-1">
                                        <i class="fas fa-calendar me-2"></i>Terakhir Diperbarui
                                    </h6>
                                    <p class="fw-bold">
                                        {{ $fasilitasumum->updated_at->translatedFormat('d F Y H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="info-item mb-4">
                            <h6 class="text-muted mb-2">
                                <i class="fas fa-align-left me-2"></i>Deskripsi
                            </h6>
                            <div class="card bg-light">
                                <div class="card-body">
                                    @if($fasilitasumum->deskripsi)
                                        <p class="mb-0">{{ $fasilitasumum->deskripsi }}</p>
                                    @else
                                        <p class="text-muted mb-0"><em>Tidak ada deskripsi</em></p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Galeri Gambar --}}
                        @if($media->whereIn('mime_type', ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'])->count() > 0)
                        <div class="info-item mb-4">
                            <h6 class="text-muted mb-3">
                                <i class="fas fa-images me-2"></i>Galeri Fasilitas
                            </h6>
                            <div class="row g-3">
                                @foreach($media->whereIn('mime_type', ['image/jpeg', 'image/png', 'image/gif', 'image/jpg']) as $image)
                                <div class="col-md-4 col-sm-6">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <a href="{{ asset('storage/uploads/fasilitas_umum/' . $image->file_name) }}"
                                           data-fancybox="gallery"
                                           data-caption="{{ $image->caption ?? $fasilitasumum->nama }}">
                                            <img src="{{ asset('storage/uploads/fasilitas_umum/' . $image->file_name) }}"
                                                 class="card-img-top"
                                                 alt="{{ $image->caption ?? 'Gambar fasilitas' }}"
                                                 style="height: 180px; object-fit: cover;">
                                        </a>
                                        <div class="card-body p-2 text-center">
                                            @if($image->caption)
                                            <p class="card-text small text-muted mb-0">{{ $image->caption }}</p>
                                            @endif
                                            <div class="mt-1">
                                                <a href="{{ asset('storage/uploads/fasilitas_umum/' . $image->file_name) }}"
                                                   target="_blank"
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-download me-1"></i> Unduh
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        {{-- Dokumen Lainnya --}}
                        @if($media->whereNotIn('mime_type', ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'])->count() > 0)
                        <div class="info-item mb-4">
                            <h6 class="text-muted mb-3">
                                <i class="fas fa-file me-2"></i>Dokumen Pendukung
                            </h6>
                            <div class="list-group">
                                @foreach($media->whereNotIn('mime_type', ['image/jpeg', 'image/png', 'image/gif', 'image/jpg']) as $file)
                                <div class="list-group-item">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            @if($file->mime_type == 'application/pdf')
                                                <i class="fas fa-file-pdf text-danger me-3 fs-4"></i>
                                            @elseif(strpos($file->mime_type, 'word') !== false)
                                                <i class="fas fa-file-word text-primary me-3 fs-4"></i>
                                            @elseif(strpos($file->mime_type, 'excel') !== false || strpos($file->mime_type, 'spreadsheet') !== false)
                                                <i class="fas fa-file-excel text-success me-3 fs-4"></i>
                                            @else
                                                <i class="fas fa-file text-secondary me-3 fs-4"></i>
                                            @endif
                                            <div>
                                                <h6 class="mb-0">{{ $file->file_name }}</h6>
                                                @if($file->caption)
                                                <small class="text-muted">{{ $file->caption }}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="btn-group" role="group">
                                            <a href="{{ asset('storage/uploads/fasilitas_umum/' . $file->file_name) }}"
                                               target="_blank"
                                               class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-eye me-1"></i> Lihat
                                            </a>
                                            <a href="{{ asset('storage/uploads/fasilitas_umum/' . $file->file_name) }}"
                                               download
                                               class="btn btn-outline-success btn-sm">
                                                <i class="fas fa-download me-1"></i> Unduh
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        {{-- Tombol Aksi --}}
                        <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                            <div class="btn-group" role="group">
                                <a href="{{ route('fasilitasumum.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
                                </a>
                            </div>

                            <div class="btn-group" role="group">
                                <a href="{{ route('fasilitasumum.edit', $fasilitasumum->fasilitas_id) }}"
                                   class="btn btn-warning me-2">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>

                                <form action="{{ route('fasilitasumum.destroy', $fasilitasumum->fasilitas_id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus fasilitas ini?');">
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
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle me-2"></i>Informasi Singkat
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <div class="icon-circle bg-primary">
                                <i class="fas fa-building fa-2x text-white"></i>
                            </div>
                            <h5 class="mt-3 mb-0">Fasilitas Umum</h5>
                            <p class="text-muted">ID: {{ $fasilitasumum->fasilitas_id }}</p>
                        </div>

                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Status</span>
                                <span class="badge bg-success">Aktif</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Jumlah Gambar</span>
                                <span class="fw-bold">
                                    {{ $media->whereIn('mime_type', ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'])->count() }}
                                </span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Jumlah Dokumen</span>
                                <span class="fw-bold">
                                    {{ $media->whereNotIn('mime_type', ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'])->count() }}
                                </span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Tanggal Dibuat</span>
                                <span class="fw-bold">
                                    {{ $fasilitasumum->created_at->translatedFormat('d F Y') }}
                                </span>
                            </div>
                        </div>

                        {{-- Preview Gambar Utama --}}
                        @if($media->whereIn('mime_type', ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'])->first())
                        <div class="mt-4">
                            <h6 class="text-muted mb-3">
                                <i class="fas fa-image me-2"></i>Preview Gambar
                            </h6>
                            @php
                                $firstImage = $media->whereIn('mime_type', ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'])->first();
                            @endphp
                            <div class="text-center">
                                <img src="{{ asset('storage/uploads/fasilitas_umum/' . $firstImage->file_name) }}"
                                     class="img-fluid rounded shadow-sm"
                                     alt="Preview fasilitas"
                                     style="max-height: 200px; object-fit: cover;">
                                @if($firstImage->caption)
                                <p class="small text-muted mt-2 mb-0">{{ $firstImage->caption }}</p>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- QR Code --}}
                <div class="card shadow-sm mt-3">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-qrcode me-2"></i>QR Code Fasilitas
                        </h5>
                    </div>
                    <div class="card-body text-center">
                        <div id="qrcode" class="mb-3"></div>
                        <p class="text-muted small">
                            Scan untuk melihat informasi fasilitas
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Custom CSS --}}
<style>
    .info-item {
        padding: 10px 0;
        border-bottom: 1px solid #eee;
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
    }

    .card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
    }

    .card-header {
        border-radius: 10px 10px 0 0 !important;
    }

    #qrcode {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 150px;
        background: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
    }

    .btn-group .btn {
        border-radius: 6px;
    }

    .gallery-item {
        transition: transform 0.3s ease;
    }

    .gallery-item:hover {
        transform: scale(1.05);
    }

    @media (max-width: 768px) {
        .row {
            flex-direction: column;
        }

        .col-md-8, .col-md-4 {
            width: 100%;
            margin-bottom: 20px;
        }
    }
</style>

{{-- JavaScript untuk QR Code dan Lightbox --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi Fancybox untuk galeri gambar
        Fancybox.bind("[data-fancybox]", {
            Thumbs: {
                autoStart: true,
            },
            Toolbar: {
                display: {
                    left: [],
                    middle: [],
                    right: ["close"],
                },
            },
        });

        // Generate QR Code
        var fasilitasUrl = "{{ route('fasilitasumum.show', $fasilitasumum->fasilitas_id) }}";
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: fasilitasUrl,
            width: 128,
            height: 128,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
    });
</script>
@endsection
