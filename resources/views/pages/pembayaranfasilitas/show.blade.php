@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Detail Pembayaran Fasilitas</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('pembayaran.index') }}">Pembayaran</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <!-- Informasi Pembayaran -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="bi bi-receipt"></i> Informasi Pembayaran</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th width="40%">ID Pembayaran</th>
                                <td class="fw-bold">#{{ $pembayaran->bayar_id }}</td>
                            </tr>
                            <tr>
                                <th>Peminjam</th>
                                <td>{{ $pembayaran->peminjaman->warga->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Fasilitas</th>
                                <td>{{ $pembayaran->peminjaman->fasilitas->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Pembayaran</th>
                                <td>{{ \Carbon\Carbon::parse($pembayaran->tanggal)->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Jumlah Bayar</th>
                                <td class="fw-bold text-success">Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Metode Pembayaran</th>
                                <td>
                                    <span class="badge bg-info">{{ $pembayaran->metode }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td>{{ $pembayaran->keterangan ?? '-' }}</td>
                            </tr>
                        </table>

                        <div class="mt-4 d-flex gap-2">
                            <a href="{{ route('pembayaran.edit', $pembayaran->bayar_id) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Edit Pembayaran
                            </a>
                            <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Media Upload & Display -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0"><i class="bi bi-paperclip"></i> Bukti Pembayaran & Dokumen</h4>
                    </div>
                    <div class="card-body">
                        <!-- Form Upload Media -->
                        <div class="mb-4 p-3 border rounded bg-light">
                            <h5 class="mb-3"><i class="bi bi-plus-circle text-success"></i> Tambah Bukti/Dokumen</h5>
                            <form action="{{ route('pembayaran.uploadMedia', $pembayaran->bayar_id) }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Pilih File <span class="text-danger">*</span></label>
                                    <input type="file" name="files[]" class="form-control" multiple required
                                           accept=".jpg,.jpeg,.png,.pdf" id="fileInput">
                                    <div class="form-text">
                                        <i class="bi bi-info-circle"></i> Format: JPG, PNG, PDF (Max: 2MB per file)
                                    </div>
                                    <div id="fileList" class="mt-2"></div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Keterangan File (Opsional)</label>
                                    <input type="text" name="captions[]" class="form-control" placeholder="Contoh: Bukti Transfer, Kwitansi, dll">
                                </div>

                                <button type="submit" class="btn btn-success" id="uploadBtn">
                                    <i class="bi bi-upload me-1"></i> Upload File
                                </button>
                            </form>
                        </div>

                        <!-- Daftar Media -->
                        <div class="mt-4">
                            <h5 class="d-flex justify-content-between align-items-center border-bottom pb-2">
                                <span><i class="bi bi-files"></i> Dokumen Terlampir ({{ $pembayaran->media->count() }})</span>
                            </h5>

                            @if($pembayaran->media->count() > 0)
                                <div class="row mt-3">
                                    @foreach($pembayaran->media as $media)
                                        <div class="col-md-6 mb-3">
                                            <div class="card border hover-shadow">
                                                <div class="card-body p-3">
                                                    @if(strpos($media->mime_type, 'image/') === 0)
                                                        <!-- Tampilkan gambar dari STORAGE -->
                                                        <div class="text-center">
                                                            <img src="{{ Storage::url($media->path) }}"
                                                                 class="img-fluid rounded mb-2"
                                                                 alt="{{ $media->caption }}"
                                                                 style="max-height: 150px; object-fit: contain; width: 100%;"
                                                                 onerror="this.onerror=null; this.src='https://via.placeholder.com/300x150?text=Gambar+Tidak+Ditemukan';">
                                                        </div>
                                                    @elseif($media->mime_type === 'application/pdf')
                                                        <!-- Tampilkan icon PDF -->
                                                        <div class="text-center py-3">
                                                            <i class="bi bi-file-pdf text-danger" style="font-size: 3rem;"></i>
                                                            <p class="mt-2 fw-bold">PDF Document</p>
                                                            <small class="text-muted">{{ Str::limit($media->file_name, 20) }}</small>
                                                        </div>
                                                    @else
                                                        <!-- Tampilkan icon file umum -->
                                                        <div class="text-center py-3">
                                                            <i class="bi bi-file-earmark-text text-primary" style="font-size: 3rem;"></i>
                                                            <p class="mt-2 fw-bold">Document</p>
                                                            <small class="text-muted">{{ Str::limit($media->file_name, 20) }}</small>
                                                        </div>
                                                    @endif

                                                    <h6 class="mt-2 mb-1 text-truncate" title="{{ $media->caption ?: $media->file_name }}">
                                                        <i class="bi bi-paperclip"></i>
                                                        {{ $media->caption ?: 'File ' . $loop->iteration }}
                                                    </h6>

                                                    <div class="d-flex justify-content-between mt-3">
                                                        <a href="{{ Storage::url($media->path) }}"
                                                           target="_blank"
                                                           class="btn btn-sm btn-outline-primary"
                                                           title="Lihat">
                                                            <i class="bi bi-eye"></i>
                                                        </a>

                                                        <a href="{{ Storage::url($media->path) }}"
                                                           download="{{ $media->original_name }}"
                                                           class="btn btn-sm btn-outline-success"
                                                           title="Download">
                                                            <i class="bi bi-download"></i>
                                                        </a>

                                                        <form action="{{ route('pembayaran.deleteMedia', [$pembayaran->bayar_id, $media->media_id]) }}"
                                                              method="POST"
                                                              onsubmit="return confirm('Yakin ingin menghapus file ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>

                                                    <div class="mt-2 text-center">
                                                        <small class="text-muted">
                                                            <i class="bi bi-info-circle me-1"></i>
                                                            @php
                                                                $bytes = $media->size;
                                                                if ($bytes >= 1048576) {
                                                                    echo number_format($bytes / 1048576, 2) . ' MB';
                                                                } elseif ($bytes >= 1024) {
                                                                    echo number_format($bytes / 1024, 2) . ' KB';
                                                                } else {
                                                                    echo $bytes . ' bytes';
                                                                }
                                                            @endphp
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-5 border rounded bg-light mt-3">
                                    <i class="bi bi-folder-x display-4 text-muted"></i>
                                    <p class="mt-3 text-muted fw-bold">Belum ada dokumen terlampir</p>
                                    <p class="text-muted small">Upload bukti pembayaran menggunakan form di atas</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Peminjaman -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h4 class="mb-0"><i class="bi bi-calendar-check"></i> Detail Peminjaman</h4>
                    </div>
                    <div class="card-body">
                        @php
                            $peminjaman = $pembayaran->peminjaman;
                        @endphp

                        @if($peminjaman)
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <h6 class="fw-bold text-muted">Tanggal Peminjaman</h6>
                                    <p class="h5">{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d F Y') }}</p>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <h6 class="fw-bold text-muted">Tanggal Pengembalian</h6>
                                    <p class="h5">{{ $peminjaman->tanggal_kembali ? \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d F Y') : 'Belum dikembalikan' }}</p>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <h6 class="fw-bold text-muted">Status Peminjaman</h6>
                                    <span class="badge bg-{{ $peminjaman->status == 'selesai' ? 'success' : ($peminjaman->status == 'dipinjam' ? 'warning' : 'secondary') }} fs-6 p-2">
                                        {{ ucfirst($peminjaman->status) }}
                                    </span>
                                </div>
                            </div>

                            @if($peminjaman->keterangan)
                                <div class="mt-3 pt-3 border-top">
                                    <h6 class="fw-bold text-muted">Keterangan Peminjaman</h6>
                                    <p class="text-muted">{{ $peminjaman->keterangan }}</p>
                                </div>
                            @endif
                        @else
                            <p class="text-muted">Data peminjaman tidak ditemukan</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    .card-header {
        border-radius: 10px 10px 0 0 !important;
    }
    .badge {
        font-size: 0.9em;
        padding: 5px 12px;
        border-radius: 20px;
    }
    .hover-shadow:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }
    .btn-outline-primary:hover {
        background-color: #0d6efd;
        color: white;
    }
    .btn-outline-success:hover {
        background-color: #198754;
        color: white;
    }
    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
    }
</style>

<script>
    // Menampilkan nama file yang dipilih
    document.getElementById('fileInput').addEventListener('change', function(e) {
        const files = e.target.files;
        const fileList = document.getElementById('fileList');
        fileList.innerHTML = '';

        if (files.length > 0) {
            let listHTML = '<div class="alert alert-info p-2"><h6 class="mb-2">File yang dipilih:</h6>';

            for(let i = 0; i < files.length; i++) {
                const fileSize = (files[i].size / 1024).toFixed(2);
                listHTML += `
                    <div class="file-info mb-1">
                        <i class="bi bi-file-earmark me-1"></i>
                        ${files[i].name}
                        <span class="badge bg-secondary float-end">${fileSize} KB</span>
                    </div>
                `;
            }

            listHTML += `</div>`;
            fileList.innerHTML = listHTML;
        }
    });

    // Validasi form sebelum submit
    document.getElementById('uploadForm').addEventListener('submit', function(e) {
        const fileInput = document.getElementById('fileInput');
        const files = fileInput.files;

        if (files.length === 0) {
            e.preventDefault();
            alert('Pilih minimal 1 file untuk diupload!');
            fileInput.focus();
            return false;
        }

        // Validasi tipe file
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];
        for(let i = 0; i < files.length; i++) {
            if (!allowedTypes.includes(files[i].type.toLowerCase())) {
                e.preventDefault();
                alert(`File "${files[i].name}" tidak didukung. Hanya JPG, PNG, PDF yang diperbolehkan.`);
                return false;
            }
        }

        // Tampilkan loading
        const uploadBtn = document.getElementById('uploadBtn');
        uploadBtn.innerHTML = '<i class="bi bi-arrow-clockwise me-1"></i> Uploading...';
        uploadBtn.disabled = true;

        return true;
    });
</script>
@endsection
