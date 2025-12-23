@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Edit Peminjaman Fasilitas</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('peminjaman.index') }}">Peminjaman</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>

        {{-- Alert Messages --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            {{-- Form Edit Peminjaman --}}
            <div class="col-md-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Edit Data Peminjaman</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('peminjaman.update', $peminjaman->pinjam_id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                {{-- Nama Peminjam --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Nama Peminjam <span class="text-danger">*</span></label>
                                        <select name="warga_id" class="form-select" required>
                                            <option value="">-- Pilih Peminjam --</option>
                                            @foreach($warga as $w)
                                                <option value="{{ $w->warga_id }}"
                                                    {{ $peminjaman->warga_id == $w->warga_id ? 'selected' : '' }}>
                                                    {{ $w->nama }} - {{ $w->nik }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('warga_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Fasilitas --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Fasilitas <span class="text-danger">*</span></label>
                                        <select name="fasilitas_id" class="form-select" required>
                                            <option value="">-- Pilih Fasilitas --</option>
                                            @foreach($fasilitas as $f)
                                                <option value="{{ $f->fasilitas_id }}"
                                                    {{ $peminjaman->fasilitas_id == $f->fasilitas_id ? 'selected' : '' }}>
                                                    {{ $f->nama }} ({{ $f->jenis }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('fasilitas_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                {{-- Tanggal Mulai --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Tanggal Mulai <span class="text-danger">*</span></label>
                                        <input type="date" name="tanggal_mulai" class="form-control"
                                               value="{{ date('Y-m-d', strtotime($peminjaman->tanggal_mulai)) }}" required>
                                        @error('tanggal_mulai')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Tanggal Selesai --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Tanggal Selesai <span class="text-danger">*</span></label>
                                        <input type="date" name="tanggal_selesai" class="form-control"
                                               value="{{ date('Y-m-d', strtotime($peminjaman->tanggal_selesai)) }}" required>
                                        @error('tanggal_selesai')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Tujuan --}}
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">Tujuan <span class="text-danger">*</span></label>
                                <textarea name="tujuan" class="form-control" rows="3" required>{{ $peminjaman->tujuan }}</textarea>
                                @error('tujuan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                {{-- Status --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                                        <select name="status" class="form-select" required>
                                            <option value="Menunggu" {{ $peminjaman->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                            <option value="Disetujui" {{ $peminjaman->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                            <option value="Ditolak" {{ $peminjaman->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                            <option value="Selesai" {{ $peminjaman->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                        @error('status')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Total Biaya --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Total Biaya (Rp) <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" name="total_biaya" class="form-control"
                                                   value="{{ $peminjaman->total_biaya }}" required>
                                        </div>
                                        @error('total_biaya')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Catatan Tambahan --}}
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">Catatan Tambahan</label>
                                <textarea name="catatan" class="form-control" rows="2">{{ $peminjaman->catatan ?? '' }}</textarea>
                                <small class="text-muted">Opsional: Tambahkan catatan khusus jika diperlukan</small>
                            </div>

                            {{-- Error Summary --}}
                            @if($errors->any())
                                <div class="alert alert-danger mb-3">
                                    <h6><i class="bi bi-exclamation-triangle me-2"></i> Terdapat kesalahan:</h6>
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {{-- Action Buttons --}}
                            <div class="d-flex justify-content-between border-top pt-3">
                                <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left me-1"></i> Kembali
                                </a>
                                <div>
                                    <a href="{{ route('peminjaman.show', $peminjaman->pinjam_id) }}"
                                       class="btn btn-info me-2">
                                        <i class="bi bi-eye me-1"></i> Lihat Detail
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Form Upload Media & Daftar Media --}}
            <div class="col-md-4">
                {{-- Form Upload Media --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="bi bi-upload me-2"></i>Tambah Media</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('peminjaman.upload-media', $peminjaman->pinjam_id) }}"
                              method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-bold">Pilih File</label>
                                <input type="file" name="files[]"
                                       class="form-control"
                                       multiple
                                       required
                                       accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx">
                                <small class="text-muted">
                                    Maksimal 5MB per file. Format: JPG, PNG, PDF, DOC, XLS
                                </small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Keterangan (opsional)</label>
                                <input type="text" name="captions[]"
                                       class="form-control"
                                       placeholder="Masukkan keterangan file">
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-cloud-upload me-1"></i> Upload File
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Media Terlampir --}}
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">
                            <i class="bi bi-paperclip me-2"></i>Media Terlampir
                            <span class="badge bg-primary float-end">{{ $media->count() }}</span>
                        </h6>
                    </div>
                    <div class="card-body">
                        @if($media->count() > 0)
                            <div class="list-group">
                                @foreach($media as $item)
                                    <div class="list-group-item mb-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                @if(str_contains($item->mime_type, 'image'))
                                                    <i class="bi bi-image text-primary me-2"></i>
                                                @elseif(str_contains($item->mime_type, 'pdf'))
                                                    <i class="bi bi-file-pdf text-danger me-2"></i>
                                                @elseif(str_contains($item->mime_type, 'word'))
                                                    <i class="bi bi-file-word text-info me-2"></i>
                                                @elseif(str_contains($item->mime_type, 'excel'))
                                                    <i class="bi bi-file-excel text-success me-2"></i>
                                                @else
                                                    <i class="bi bi-file-earmark me-2"></i>
                                                @endif
                                                <div>
                                                    <p class="mb-0">
                                                        <strong>{{ Str::limit($item->caption ?: 'Tanpa Keterangan', 20) }}</strong>
                                                    </p>
                                                    <small class="text-muted">
                                                        {{ date('d/m/Y', strtotime($item->created_at)) }}
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ asset('storage/uploads/peminjaman_fasilitas/' . $item->file_name) }}"
                                                   class="btn btn-outline-primary"
                                                   download
                                                   title="Download">
                                                    <i class="bi bi-download"></i>
                                                </a>
                                                <a href="{{ route('peminjaman.delete-media', [$peminjaman->pinjam_id, $item->media_id]) }}"
                                                   class="btn btn-outline-danger"
                                                   onclick="return confirm('Hapus file ini?')"
                                                   title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-3">
                                <i class="bi bi-folder-x text-muted display-6 mb-2"></i>
                                <p class="text-muted mb-0">Belum ada media</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #333;
    }

    .form-control, .form-select {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 0.5rem 0.75rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    .card {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        margin-bottom: 1rem;
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e0e0e0;
        padding: 1rem 1.25rem;
    }

    .card-body {
        padding: 1.25rem;
    }

    .list-group-item {
        border: 1px solid #e0e0e0;
        border-radius: 4px;
        padding: 0.75rem;
    }

    .text-danger {
        color: #dc3545 !important;
    }

    .text-muted {
        color: #6c757d !important;
        font-size: 0.875rem;
    }

    .alert {
        border-radius: 6px;
        border: none;
    }

    .btn {
        padding: 0.5rem 1rem;
        border-radius: 4px;
        font-weight: 500;
    }

    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-secondary:hover {
        background-color: #5c636a;
        border-color: #565e64;
    }

    .btn-outline-primary, .btn-outline-danger {
        padding: 0.25rem 0.5rem;
    }

    .badge {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Validasi tanggal
        const tanggalMulai = document.querySelector('input[name="tanggal_mulai"]');
        const tanggalSelesai = document.querySelector('input[name="tanggal_selesai"]');

        if (tanggalMulai && tanggalSelesai) {
            tanggalMulai.addEventListener('change', function() {
                tanggalSelesai.min = this.value;
                if (tanggalSelesai.value && tanggalSelesai.value < this.value) {
                    tanggalSelesai.value = this.value;
                }
            });

            tanggalSelesai.addEventListener('change', function() {
                if (this.value < tanggalMulai.value) {
                    alert('Tanggal selesai tidak boleh lebih awal dari tanggal mulai');
                    this.value = tanggalMulai.value;
                }
            });
        }

        // Validasi file upload
        const fileInput = document.querySelector('input[type="file"]');
        if (fileInput) {
            fileInput.addEventListener('change', function() {
                const files = this.files;
                const maxSize = 5 * 1024 * 1024; // 5MB

                for (let i = 0; i < files.length; i++) {
                    if (files[i].size > maxSize) {
                        alert(`File "${files[i].name}" terlalu besar. Maksimal 5MB.`);
                        this.value = '';
                        return;
                    }

                    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf',
                                          'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                          'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

                    if (!allowedTypes.includes(files[i].type)) {
                        alert(`Format file "${files[i].name}" tidak didukung.`);
                        this.value = '';
                        return;
                    }
                }
            });
        }
    });
</script>
@endsection
