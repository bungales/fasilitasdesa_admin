@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Edit Data Pembayaran Fasilitas</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('pembayaran.index') }}">Pembayaran</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('pembayaran.show', $pembayaran->bayar_id) }}">Detail</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('pembayaran.update', $pembayaran->bayar_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Pilih Peminjaman --}}
                    <div class="form-group mb-3">
                        <label>Peminjaman *</label>
                        <select name="pinjam_id" class="form-control @error('pinjam_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Peminjaman --</option>
                            @foreach ($peminjaman as $p)
                                <option value="{{ $p->pinjam_id }}"
                                    {{ $p->pinjam_id == old('pinjam_id', $pembayaran->pinjam_id) ? 'selected' : '' }}>
                                    {{ $p->warga->nama ?? '-' }} - {{ $p->fasilitas->nama ?? '-' }}
                                    ({{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d/m/Y') }})
                                </option>
                            @endforeach
                        </select>
                        @error('pinjam_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Tanggal Pembayaran *</label>
                                <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror"
                                       value="{{ old('tanggal', $pembayaran->tanggal) }}" required>
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Jumlah Bayar *</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror"
                                           value="{{ old('jumlah', $pembayaran->jumlah) }}" required min="0" step="100">
                                </div>
                                @error('jumlah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Metode Pembayaran *</label>
                                <select name="metode" class="form-control @error('metode') is-invalid @enderror" required>
                                    <option value="">-- Pilih Metode --</option>
                                    <option value="Tunai" {{ old('metode', $pembayaran->metode) == 'Tunai' ? 'selected' : '' }}>Tunai</option>
                                    <option value="Transfer" {{ old('metode', $pembayaran->metode) == 'Transfer' ? 'selected' : '' }}>Transfer Bank</option>
                                    <option value="QRIS" {{ old('metode', $pembayaran->metode) == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                                    <option value="E-Wallet" {{ old('metode', $pembayaran->metode) == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
                                </select>
                                @error('metode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="3">{{ old('keterangan', $pembayaran->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Upload Media Baru -->
                    <div class="form-group mb-4">
                        <label class="fw-bold">Tambah Bukti/Dokumen Baru (Opsional)</label>
                        <input type="file" name="files[]" class="form-control @error('files') is-invalid @enderror" multiple
                               accept=".jpg,.jpeg,.png,.pdf" id="fileInput">
                        <small class="text-muted">Format: JPG, PNG, PDF (Max: 2MB per file)</small>
                        @error('files')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div class="mt-2" id="fileList"></div>

                        <div class="mt-2" id="caption-container">
                            <label class="form-label">Keterangan File (Opsional)</label>
                            <input type="text" name="captions[]" class="form-control mt-1" placeholder="Keterangan file...">
                        </div>
                    </div>

                    <!-- Tampilkan Media yang Sudah Ada -->
                    @if($pembayaran->media->count() > 0)
                        <div class="form-group mb-4">
                            <label class="fw-bold">Dokumen Terlampir</label>
                            <div class="row">
                                @foreach($pembayaran->media as $item)
                                    <div class="col-md-3 mb-2">
                                        <div class="card border p-2">
                                            @if(strpos($item->mime_type, 'image/') === 0)
                                                <!-- Tampilkan gambar dari STORAGE -->
                                                <img src="{{ Storage::url($item->path) }}"
                                                     class="img-fluid rounded"
                                                     alt="{{ $item->caption }}"
                                                     style="height: 100px; object-fit: cover;"
                                                     onerror="this.onerror=null; this.src='https://via.placeholder.com/200x100?text=Gambar+Tidak+Ditemukan';">
                                            @else
                                                <div class="text-center py-3">
                                                    <i class="bi bi-file-earmark-text text-primary" style="font-size: 2rem;"></i>
                                                    <p class="small mb-0">{{ $item->caption ?: 'Dokumen' }}</p>
                                                </div>
                                            @endif

                                            <div class="mt-2 text-center">
                                                <a href="{{ route('pembayaran.deleteMedia', [$pembayaran->bayar_id, $item->media_id]) }}"
                                                   class="btn btn-sm btn-danger"
                                                   onclick="return confirm('Hapus file ini?')">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-success" id="submitBtn">
                            <i class="bi bi-check-circle"></i> Perbarui
                        </button>
                        <a href="{{ route('pembayaran.show', $pembayaran->bayar_id) }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali ke Detail
                        </a>
                        <a href="{{ route('pembayaran.index') }}" class="btn btn-light">
                            <i class="bi bi-x-circle"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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

            // Dynamic caption fields
            const captionContainer = document.getElementById('caption-container');
            const existingCaptions = captionContainer.querySelectorAll('input[name="captions[]"]');

            // Clear existing caption fields except first one
            for(let i = 1; i < existingCaptions.length; i++) {
                existingCaptions[i].parentNode.remove();
            }

            // Add caption fields for each file
            for(let i = 0; i < files.length; i++) {
                if(i === 0) continue;

                const div = document.createElement('div');
                div.className = 'mt-1';
                div.innerHTML = `
                    <input type="text" name="captions[]" class="form-control" placeholder="Keterangan file ${i+1}...">
                `;
                captionContainer.appendChild(div);
            }
        }
    });

    // Validasi form sebelum submit
    document.querySelector('form').addEventListener('submit', function(e) {
        // Validasi jumlah bayar
        const jumlahInput = document.querySelector('input[name="jumlah"]');
        if (parseFloat(jumlahInput.value) <= 0) {
            e.preventDefault();
            alert('Jumlah bayar harus lebih dari 0!');
            jumlahInput.focus();
            return false;
        }

        // Tampilkan loading
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Menyimpan...';
        submitBtn.disabled = true;

        return true;
    });
</script>

<style>
    .file-info {
        background-color: #f8f9fa;
        border-left: 3px solid #0d6efd;
        padding: 5px 10px;
        margin-bottom: 5px;
        border-radius: 3px;
    }
    .card {
        border-radius: 10px;
    }
</style>
@endsection
