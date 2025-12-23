@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Detail Peminjaman Fasilitas</h3>
        </div>

        <div class="row">
            <!-- Informasi Peminjaman -->
            <div class="col-md-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Informasi Peminjaman</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5><strong>Data Peminjam</strong></h5>
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="40%"><strong>Nama Peminjam</strong></td>
                                        <td>: {{ $peminjaman->warga->nama ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Fasilitas</strong></td>
                                        <td>: {{ $peminjaman->fasilitas->nama ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tanggal Mulai</strong></td>
                                        <td>: {{ date('d-m-Y', strtotime($peminjaman->tanggal_mulai)) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tanggal Selesai</strong></td>
                                        <td>: {{ date('d-m-Y', strtotime($peminjaman->tanggal_selesai)) }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h5><strong>Detail Lainnya</strong></h5>
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="40%"><strong>Tujuan</strong></td>
                                        <td>: {{ $peminjaman->tujuan }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status</strong></td>
                                        <td>
                                            @php
                                                $statusClass = match ($peminjaman->status) {
                                                    'Menunggu' => 'badge bg-warning',
                                                    'Disetujui' => 'badge bg-success',
                                                    'Ditolak' => 'badge bg-danger',
                                                    default => 'badge bg-secondary',
                                                };
                                            @endphp
                                            <span class="{{ $statusClass }}">{{ $peminjaman->status }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total Biaya</strong></td>
                                        <td>: Rp {{ number_format($peminjaman->total_biaya, 0, ',', '.') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upload Media -->
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0">Tambah Media</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('peminjaman.upload-media', $peminjaman->pinjam_id) }}"
                              method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label>Pilih File</label>
                                <input type="file" name="files[]"
                                       class="form-control" multiple required>
                                <small class="text-muted">
                                    Maksimal 5MB per file. Format: JPG, PNG, PDF, DOC, XLS
                                </small>
                            </div>
                            <div class="form-group mb-3">
                                <label>Keterangan (opsional)</label>
                                <input type="text" name="captions[]"
                                       class="form-control"
                                       placeholder="Keterangan file">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-upload"></i> Upload File
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gallery Media -->
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">
                    <i class="bi bi-images"></i> Media Terlampir
                    <span class="badge bg-light text-dark">{{ $peminjaman->media->count() }}</span>
                </h4>
            </div>
            <div class="card-body">
                @if($peminjaman->media->count() > 0)
                    <div class="row">
                        @foreach($peminjaman->media as $media)
                            <div class="col-md-3 col-sm-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body text-center p-3">
                                        @if(in_array($media->mime_type, ['image/jpeg', 'image/png', 'image/gif']))
                                            <!-- Gambar -->
                                            <img src="{{ asset('storage/uploads/peminjaman_fasilitas/' . $media->file_name) }}"
                                                 class="img-fluid rounded mb-2"
                                                 alt="{{ $media->caption }}"
                                                 style="max-height: 150px; object-fit: cover;">
                                        @else
                                            <!-- File dokumen -->
                                            <div class="file-icon mb-2">
                                                <i class="bi bi-file-earmark-text display-4 text-primary"></i>
                                            </div>
                                        @endif

                                        <p class="mb-1 small">
                                            <strong>{{ $media->caption ?? 'Tanpa Keterangan' }}</strong>
                                        </p>
                                        <p class="text-muted small mb-2">
                                            {{ $media->file_name }}
                                        </p>

                                        <div class="d-flex justify-content-center gap-2">
                                            <!-- Download -->
                                            <a href="{{ asset('storage/uploads/peminjaman_fasilitas/' . $media->file_name) }}"
                                               class="btn btn-sm btn-outline-primary"
                                               download>
                                                <i class="bi bi-download"></i>
                                            </a>
                                            <!-- View -->
                                            <a href="{{ asset('storage/uploads/peminjaman_fasilitas/' . $media->file_name) }}"
                                               class="btn btn-sm btn-outline-info"
                                               target="_blank">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <!-- Delete -->
                                            <form action="{{ route('peminjaman.delete-media', [$peminjaman->pinjam_id, $media->media_id]) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Hapus file ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-folder-x display-1 text-muted"></i>
                        <h4 class="text-muted mt-3">Belum ada media</h4>
                        <p class="text-muted">Upload file untuk melampirkan dokumen atau gambar</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="mt-4">
            <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar
            </a>
            <a href="{{ route('peminjaman.edit', $peminjaman->pinjam_id) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Edit
            </a>
        </div>
    </div>
</div>

<style>
    .file-icon {
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        border-radius: 8px;
    }
    .card:hover {
        transform: translateY(-5px);
        transition: transform 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
</style>
@endsection
