@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Detail Syarat Fasilitas</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('syarat-fasilitas.index') }}">Syarat Fasilitas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-file-alt me-2"></i>Informasi Syarat Fasilitas
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
                                        <i class="fas fa-building me-2"></i>Fasilitas
                                    </h6>
                                    <p class="fw-bold fs-5">
                                        {{ $syaratFasilitas->fasilitas->nama ?? 'Tidak tersedia' }}
                                    </p>
                                </div>

                                <div class="info-item mb-4">
                                    <h6 class="text-muted mb-1">
                                        <i class="fas fa-tag me-2"></i>Nama Syarat
                                    </h6>
                                    <p class="fw-bold fs-5 text-primary">
                                        {{ $syaratFasilitas->nama_syarat }}
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item mb-4">
                                    <h6 class="text-muted mb-1">
                                        <i class="fas fa-calendar me-2"></i>Tanggal Dibuat
                                    </h6>
                                    <p class="fw-bold">
                                        {{ $syaratFasilitas->created_at->translatedFormat('d F Y H:i') }}
                                    </p>
                                </div>

                                <div class="info-item mb-4">
                                    <h6 class="text-muted mb-1">
                                        <i class="fas fa-sync-alt me-2"></i>Terakhir Diperbarui
                                    </h6>
                                    <p class="fw-bold">
                                        {{ $syaratFasilitas->updated_at->translatedFormat('d F Y H:i') }}
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
                                    @if($syaratFasilitas->deskripsi)
                                        <p class="mb-0">{{ $syaratFasilitas->deskripsi }}</p>
                                    @else
                                        <p class="text-muted mb-0"><em>Tidak ada deskripsi</em></p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Dokumen --}}
                        <div class="info-item mb-4">
                            <h6 class="text-muted mb-2">
                                <i class="fas fa-file me-2"></i>Dokumen Syarat
                            </h6>
                            <div class="card bg-light">
                                <div class="card-body">
                                    @if($syaratFasilitas->dokumen_syarat)
                                        <div class="mb-3">
                                            <div class="d-flex align-items-center mb-2">
                                                @php
                                                    $extension = strtolower(pathinfo($syaratFasilitas->dokumen_syarat, PATHINFO_EXTENSION));
                                                    $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']);
                                                @endphp

                                                @if($isImage)
                                                    <i class="fas fa-image text-success fa-2x me-3"></i>
                                                @elseif(in_array($extension, ['pdf']))
                                                    <i class="fas fa-file-pdf text-danger fa-2x me-3"></i>
                                                @elseif(in_array($extension, ['doc', 'docx']))
                                                    <i class="fas fa-file-word text-primary fa-2x me-3"></i>
                                                @else
                                                    <i class="fas fa-file-alt text-secondary fa-2x me-3"></i>
                                                @endif

                                                <div>
                                                    <h6 class="mb-1">{{ basename($syaratFasilitas->dokumen_syarat) }}</h6>
                                                    <small class="text-muted">
                                                        Jenis: {{ strtoupper($extension) }} •
                                                        Upload: {{ $syaratFasilitas->created_at->format('d/m/Y') }}
                                                    </small>
                                                </div>
                                            </div>

                                            {{-- Preview untuk gambar --}}
                                            @if($isImage)
                                                <div class="image-preview mb-3">
                                                    <h6 class="text-muted mb-2">
                                                        <i class="fas fa-image me-2"></i>Preview Gambar
                                                    </h6>
                                                    <div class="text-center">
                                                        <img src="{{ Storage::url($syaratFasilitas->dokumen_syarat) }}"
                                                             alt="{{ $syaratFasilitas->nama_syarat }}"
                                                             class="img-fluid rounded border"
                                                             style="max-height: 400px; max-width: 100%;">
                                                        <p class="text-muted mt-2 small">
                                                            Klik gambar untuk melihat ukuran penuh
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ Storage::url($syaratFasilitas->dokumen_syarat) }}"
                                                   target="_blank"
                                                   class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-eye me-1"></i>
                                                    {{ $isImage ? 'Lihat Gambar' : 'Lihat Dokumen' }}
                                                </a>
                                                <a href="{{ route('syarat-fasilitas.download', $syaratFasilitas->syarat_id) }}"
                                                   class="btn btn-outline-success btn-sm">
                                                    <i class="fas fa-download me-1"></i> Unduh
                                                </a>
                                            </div>

                                            @if($isImage)
                                            <button class="btn btn-outline-info btn-sm" onclick="copyImageLink()">
                                                <i class="fas fa-copy me-1"></i> Salin Link
                                            </button>
                                            @endif
                                        </div>
                                    @else
                                        <p class="text-muted mb-0">
                                            <i class="fas fa-times-circle me-2"></i> Tidak ada dokumen yang diunggah
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                            <div class="btn-group" role="group">
                                <a href="{{ route('syarat-fasilitas.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
                                </a>
                            </div>

                            <div class="btn-group" role="group">
                                <a href="{{ route('syarat-fasilitas.edit', $syaratFasilitas->syarat_id) }}"
                                   class="btn btn-warning me-2">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>

                                <form action="{{ route('syarat-fasilitas.destroy', $syaratFasilitas->syarat_id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus syarat ini?');">
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
                                <i class="fas fa-file-alt fa-2x text-white"></i>
                            </div>
                            <h5 class="mt-3 mb-0">Syarat Fasilitas</h5>
                            <p class="text-muted">ID: {{ $syaratFasilitas->syarat_id }}</p>
                        </div>

                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Status</span>
                                <span class="badge bg-success">Aktif</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Jenis Dokumen</span>
                                <span class="fw-bold">
                                    @if($syaratFasilitas->dokumen_syarat)
                                        @php
                                            $extension = strtolower(pathinfo($syaratFasilitas->dokumen_syarat, PATHINFO_EXTENSION));
                                        @endphp
                                        {{ strtoupper($extension) }}
                                    @else
                                        -
                                    @endif
                                </span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Ukuran File</span>
                                <span class="fw-bold">
                                    @if($syaratFasilitas->dokumen_syarat && Storage::exists($syaratFasilitas->dokumen_syarat))
                                        @php
                                            $size = Storage::size($syaratFasilitas->dokumen_syarat);
                                            if ($size < 1024) {
                                                $sizeText = $size . ' B';
                                            } elseif ($size < 1048576) {
                                                $sizeText = round($size / 1024, 2) . ' KB';
                                            } else {
                                                $sizeText = round($size / 1048576, 2) . ' MB';
                                            }
                                        @endphp
                                        {{ $sizeText }}
                                    @else
                                        -
                                    @endif
                                </span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Total Downloads</span>
                                <span class="fw-bold">0</span>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h6 class="text-muted mb-3">
                                <i class="fas fa-share-alt me-2"></i>Bagikan
                            </h6>
                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-primary btn-sm flex-fill" onclick="shareOnFacebook()">
                                    <i class="fab fa-facebook-f me-1"></i> Facebook
                                </button>
                                <button class="btn btn-outline-info btn-sm flex-fill" onclick="shareOnTwitter()">
                                    <i class="fab fa-twitter me-1"></i> Twitter
                                </button>
                                <button class="btn btn-outline-success btn-sm flex-fill" onclick="shareOnWhatsApp()">
                                    <i class="fab fa-whatsapp me-1"></i> WhatsApp
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Preview Image untuk mobile atau alternatif view --}}
                @if($syaratFasilitas->dokumen_syarat)
                    @php
                        $extension = strtolower(pathinfo($syaratFasilitas->dokumen_syarat, PATHINFO_EXTENSION));
                        $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']);
                    @endphp

                    @if($isImage)
                    <div class="card shadow-sm mt-3">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-mobile-alt me-2"></i>Preview Mobile
                            </h5>
                        </div>
                        <div class="card-body text-center">
                            <div class="mobile-preview">
                                <img src="{{ Storage::url($syaratFasilitas->dokumen_syarat) }}"
                                     alt="{{ $syaratFasilitas->nama_syarat }}"
                                     class="img-fluid rounded"
                                     style="max-height: 200px;">
                            </div>
                            <p class="text-muted small mt-2">
                                Tampilan gambar di perangkat mobile
                            </p>
                        </div>
                    </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Modal untuk gambar full size --}}
@if($syaratFasilitas->dokumen_syarat)
    @php
        $extension = strtolower(pathinfo($syaratFasilitas->dokumen_syarat, PATHINFO_EXTENSION));
        $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']);
    @endphp

    @if($isImage)
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="imageModalLabel">
                        <i class="fas fa-expand-alt me-2"></i>Preview Gambar
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ Storage::url($syaratFasilitas->dokumen_syarat) }}"
                         alt="{{ $syaratFasilitas->nama_syarat }}"
                         class="img-fluid"
                         id="fullSizeImage">
                </div>
                <div class="modal-footer">
                    <a href="{{ route('syarat-fasilitas.download', $syaratFasilitas->syarat_id) }}"
                       class="btn btn-success">
                        <i class="fas fa-download me-1"></i> Unduh
                    </a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
@endif

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

    .image-preview img {
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .image-preview img:hover {
        transform: scale(1.02);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .mobile-preview {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 15px;
        border: 2px dashed #dee2e6;
    }

    #fullSizeImage {
        max-height: 70vh;
        max-width: 100%;
    }

    @media (max-width: 768px) {
        .row {
            flex-direction: column;
        }

        .col-md-8, .col-md-4 {
            width: 100%;
            margin-bottom: 20px;
        }

        .image-preview img {
            max-height: 300px;
        }
    }
</style>

{{-- JavaScript --}}
<script>
    @if($syaratFasilitas->dokumen_syarat)
        @php
            $extension = strtolower(pathinfo($syaratFasilitas->dokumen_syarat, PATHINFO_EXTENSION));
            $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']);
        @endphp

        @if($isImage)
        // Open image in modal when clicked
        document.querySelector('.image-preview img').addEventListener('click', function() {
            const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
            imageModal.show();
        });

        // Copy image link to clipboard
        function copyImageLink() {
            const imageUrl = "{{ Storage::url($syaratFasilitas->dokumen_syarat) }}";
            navigator.clipboard.writeText(imageUrl).then(() => {
                alert('Link gambar berhasil disalin!');
            }).catch(err => {
                console.error('Gagal menyalin link: ', err);
                alert('Gagal menyalin link. Silakan salin secara manual.');
            });
        }

        // Share functions
        function shareOnFacebook() {
            const url = encodeURIComponent(window.location.href);
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
        }

        function shareOnTwitter() {
            const text = encodeURIComponent("Lihat dokumen syarat: {{ $syaratFasilitas->nama_syarat }}");
            const url = encodeURIComponent(window.location.href);
            window.open(`https://twitter.com/intent/tweet?text=${text}&url=${url}`, '_blank');
        }

        function shareOnWhatsApp() {
            const text = encodeURIComponent("Lihat dokumen syarat: {{ $syaratFasilitas->nama_syarat }}\n\n" + window.location.href);
            window.open(`https://wa.me/?text=${text}`, '_blank');
        }
        @endif
    @endif
</script>
@endsection
