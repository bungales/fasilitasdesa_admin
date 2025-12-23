@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Tambah Data Pembayaran Fasilitas</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('pembayaran.index') }}">Pembayaran</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                </ol>
            </nav>
        </div>

        <!-- Alert untuk error validasi -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h5><i class="bi bi-exclamation-triangle-fill me-2"></i> Terdapat kesalahan:</h5>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Pilih Peminjaman --}}
                    <div class="form-group mb-3">
                        <label class="form-label fw-bold">Peminjaman <span class="text-danger">*</span></label>
                        <select name="pinjam_id" class="form-control @error('pinjam_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Peminjaman --</option>
                            @foreach ($peminjaman as $p)
                                <option value="{{ $p->pinjam_id }}" {{ old('pinjam_id') == $p->pinjam_id ? 'selected' : '' }}>
                                    {{ $p->warga->nama ?? 'N/A' }} - {{ $p->fasilitas->nama ?? 'N/A' }}
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
                                <label class="form-label fw-bold">Tanggal Pembayaran <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror"
                                       value="{{ old('tanggal', date('Y-m-d')) }}" required>
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">Jumlah Bayar <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror"
                                           value="{{ old('jumlah') }}" required min="0" step="100">
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
                                <label class="form-label fw-bold">Metode Pembayaran <span class="text-danger">*</span></label>
                                <select name="metode" class="form-control @error('metode') is-invalid @enderror" required>
                                    <option value="">-- Pilih Metode --</option>
                                    <option value="Tunai" {{ old('metode') == 'Tunai' ? 'selected' : '' }}>Tunai</option>
                                    <option value="Transfer" {{ old('metode') == 'Transfer' ? 'selected' : '' }}>Transfer Bank</option>
                                    <option value="QRIS" {{ old('metode') == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                                    <option value="E-Wallet" {{ old('metode') == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
                                </select>
                                @error('metode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label fw-bold">Keterangan</label>
                        <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="3"
                                  placeholder="Tambahkan keterangan jika perlu">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Upload Media -->
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold">Upload Bukti/Dokumen (Opsional)</label>
                        <input type="file" name="files[]" class="form-control @error('files') is-invalid @enderror" multiple
                               accept=".jpg,.jpeg,.png,.pdf" id="fileInput">
                        <div class="form-text">
                            <i class="bi bi-info-circle"></i> Format: JPG, PNG, PDF (Max: 2MB per file)
                        </div>
                        @error('files')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @error('files.*')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div class="mt-2" id="fileList"></div>

                        <div class="mt-2" id="caption-container">
                            <label class="form-label">Keterangan File (Opsional)</label>
                            <input type="text" name="captions[]" class="form-control mt-1"
                                   placeholder="Misal: Bukti Transfer, Kwitansi, dll">
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="bi bi-save me-1"></i> Simpan
                        </button>
                        <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="reset" class="btn btn-light">
                            <i class="bi bi-x-circle me-1"></i> Reset
                        </button>
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
            let listHTML = '<div class="alert alert-info p-2"><h6 class="mb-2"><i class="bi bi-list-check"></i> File yang dipilih (' + files.length + '):</h6>';

            for(let i = 0; i < files.length; i++) {
                const fileSize = (files[i].size / 1024).toFixed(2);
                const fileType = files[i].type;
                const icon = fileType.startsWith('image/') ? 'bi-image' : (fileType === 'application/pdf' ? 'bi-file-pdf' : 'bi-file-earmark');

                listHTML += `
                    <div class="file-info mb-1 d-flex align-items-center">
                        <i class="bi ${icon} me-2"></i>
                        <div class="flex-grow-1">
                            <div class="fw-bold">${files[i].name}</div>
                            <div class="text-muted small">${fileSize} KB</div>
                        </div>
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

        // Validasi file tipe
        const fileInput = document.getElementById('fileInput');
        const files = fileInput.files;
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];

        for(let i = 0; i < files.length; i++) {
            if (!allowedTypes.includes(files[i].type.toLowerCase())) {
                e.preventDefault();
                alert(`File "${files[i].name}" tidak didukung. Hanya JPG, PNG, PDF yang diperbolehkan.`);
                return false;
            }
        }

        // Tampilkan loading
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Menyimpan...';
        submitBtn.disabled = true;

        return true;
    });
</script>

<style>
    .card {
        border-radius: 10px;
    }
    .form-label {
        color: #333;
    }
    .input-group-text {
        background-color: #f8f9fa;
    }
    .file-info {
        background-color: #f8f9fa;
        border-left: 3px solid #0d6efd;
        padding: 8px 12px;
        margin-bottom: 5px;
        border-radius: 5px;
    }
</style>
@endsection
