@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Tambah Peminjaman Fasilitas Baru</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('peminjaman.index') }}">Peminjaman</a></li>
                        <li class="breadcrumb-item active">Tambah Baru</li>
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
                {{-- Form Peminjaman --}}
                <div class="col-md-8">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Form Peminjaman Fasilitas</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('peminjaman.store') }}" method="POST" id="peminjamanForm"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3">
                                    {{-- Nama Peminjam --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label fw-bold">Nama Peminjam <span
                                                    class="text-danger">*</span></label>
                                            <select name="warga_id"
                                                class="form-select @error('warga_id') is-invalid @enderror" required>
                                                <option value="">-- Pilih Peminjam --</option>
                                                @foreach ($warga as $item)
                                                    <option value="{{ $item->warga_id }}"
                                                        {{ old('warga_id') == $item->warga_id ? 'selected' : '' }}
                                                        {{ request('warga_id') == $item->warga_id ? 'selected' : '' }}>
                                                        {{ $item->nama }}
                                                        @if (isset($item->nik) && !empty($item->nik))
                                                            - {{ $item->nik }}
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('warga_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Fasilitas --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label fw-bold">Fasilitas <span
                                                    class="text-danger">*</span></label>
                                            <select name="fasilitas_id"
                                                class="form-select @error('fasilitas_id') is-invalid @enderror" required>
                                                <option value="">-- Pilih Fasilitas --</option>
                                                @foreach ($fasilitas as $item)
                                                    <option value="{{ $item->fasilitas_id }}"
                                                        {{ old('fasilitas_id') == $item->fasilitas_id ? 'selected' : '' }}
                                                        {{ request('fasilitas_id') == $item->fasilitas_id ? 'selected' : '' }}
                                                        data-biaya="{{ $item->biaya_sewa ?? 0 }}">
                                                        {{ $item->nama }} ({{ $item->jenis ?? '' }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('fasilitas_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    {{-- Tanggal Mulai --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label fw-bold">Tanggal Mulai <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                                <input type="date" name="tanggal_mulai"
                                                    class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                                    value="{{ old('tanggal_mulai', date('Y-m-d')) }}"
                                                    min="{{ date('Y-m-d') }}" required>
                                            </div>
                                            @error('tanggal_mulai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Tanggal Selesai --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label fw-bold">Tanggal Selesai <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-calendar-check"></i></span>
                                                <input type="date" name="tanggal_selesai"
                                                    class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                                    value="{{ old('tanggal_selesai') }}" min="{{ date('Y-m-d') }}"
                                                    required>
                                            </div>
                                            @error('tanggal_selesai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Tujuan --}}
                                <div class="form-group mb-3">
                                    <label class="form-label fw-bold">Tujuan <span class="text-danger">*</span></label>
                                    <textarea name="tujuan" class="form-control @error('tujuan') is-invalid @enderror" rows="3"
                                        placeholder="Masukkan tujuan peminjaman fasilitas" required>{{ old('tujuan') }}</textarea>
                                    @error('tujuan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row mb-3">
                                    {{-- Status --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label fw-bold">Status <span
                                                    class="text-danger">*</span></label>
                                            <select name="status" class="form-select @error('status') is-invalid @enderror"
                                                required>
                                                <option value="Menunggu"
                                                    {{ old('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                                <option value="Disetujui"
                                                    {{ old('status') == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                                <option value="Ditolak"
                                                    {{ old('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                                <option value="Selesai"
                                                    {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Total Biaya --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label fw-bold">Total Biaya (Rp) <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">Rp</span>
                                                <input type="number" name="total_biaya"
                                                    class="form-control @error('total_biaya') is-invalid @enderror"
                                                    id="total_biaya" value="{{ old('total_biaya', 0) }}" min="0"
                                                    step="any" required>
                                            </div>
                                            @error('total_biaya')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted mt-1">Biaya akan otomatis terisi saat memilih
                                                fasilitas</small>
                                        </div>
                                    </div>
                                </div>

                                {{-- Upload Media Langsung --}}
                                <div class="card border mb-4">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0"><i class="bi bi-images me-2"></i>Upload Media/Dokumen Pendukung
                                        </h6>
                                        <small class="text-muted">Upload surat permohonan, KTP, atau dokumen pendukung
                                            lainnya</small>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">File Dokumen <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" name="files[]"
                                                class="form-control @error('files') is-invalid @enderror @error('files.*') is-invalid @enderror"
                                                multiple accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" id="mediaInput">
                                            <small class="text-muted">Format: PDF, JPG, PNG, DOC (Max: 5MB per
                                                file)</small>

                                            @error('media')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @error('media.*')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Preview Area --}}
                                        <div id="mediaPreview" class="mt-3" style="display: none;">
                                            <h6 class="mb-2">Preview File:</h6>
                                            <div class="row" id="previewContainer"></div>
                                        </div>

                                        {{-- Multiple Upload Instructions --}}
                                        <div class="alert alert-info mt-3">
                                            <i class="bi bi-info-circle me-2"></i>
                                            <small>
                                                Anda bisa upload maksimal 5 file sekaligus. Dokumen pendukung akan langsung
                                                tersimpan bersama data peminjaman.
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                {{-- Catatan Tambahan --}}
                                <div class="form-group mb-3">
                                    <label class="form-label fw-bold">Catatan Tambahan</label>
                                    <textarea name="catatan" class="form-control" rows="2"
                                        placeholder="Opsional: Tambahkan catatan khusus jika diperlukan">{{ old('catatan') }}</textarea>
                                    <small class="text-muted">Catatan tambahan khusus jika diperlukan</small>
                                </div>

                                {{-- Error Summary --}}
                                @if ($errors->any())
                                    <div class="alert alert-danger mb-3">
                                        <h6><i class="bi bi-exclamation-triangle me-2"></i> Terdapat kesalahan:</h6>
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
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
                                        <button type="reset" class="btn btn-outline-secondary me-2">
                                            <i class="bi bi-arrow-clockwise me-1"></i> Reset
                                        </button>
                                        <button type="submit" class="btn btn-primary px-4" id="submitBtn">
                                            <i class="bi bi-save me-1"></i> Simpan Data & Media
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Sidebar Kanan --}}
                <div class="col-md-4">
                    {{-- Informasi Upload --}}
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="bi bi-cloud-upload me-2"></i>Informasi Upload Media</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 text-center">
                                <i class="bi bi-file-earmark-text display-4 text-info mb-3"></i>
                                <h6>Upload Sekarang!</h6>
                                <p class="text-muted small mb-3">Anda bisa langsung upload dokumen pendukung bersamaan
                                    dengan data peminjaman</p>
                            </div>

                            <div class="alert alert-success">
                                <i class="bi bi-check-circle me-2"></i>
                                <strong>Fitur Baru!</strong> Upload media langsung saat buat data baru.
                            </div>

                            <h6 class="mt-3 mb-2">Dokumen yang bisa diupload:</h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-0 py-2 border-0">
                                    <i class="bi bi-file-text text-primary me-2"></i> Surat Permohonan
                                </li>
                                <li class="list-group-item px-0 py-2 border-0">
                                    <i class="bi bi-person-badge text-success me-2"></i> KTP/Surat Pengenal
                                </li>
                                <li class="list-group-item px-0 py-2 border-0">
                                    <i class="bi bi-file-pdf text-danger me-2"></i> Dokumen Pendukung Lainnya
                                </li>
                            </ul>
                        </div>
                    </div>

                    {{-- Informasi Penting --}}
                    <div class="card shadow-sm">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i class="bi bi-info-circle me-2"></i> Informasi Penting</h6>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-warning mb-3">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                <small class="fw-bold">Pastikan dokumen yang diupload jelas dan terbaca</small>
                            </div>

                            <ul class="list-group list-group-flush bg-transparent">
                                <li class="list-group-item px-0 py-2 border-0">
                                    <i class="bi bi-check-circle text-success me-2"></i>
                                    <small>File maksimal 5MB per dokumen</small>
                                </li>
                                <li class="list-group-item px-0 py-2 border-0">
                                    <i class="bi bi-check-circle text-success me-2"></i>
                                    <small>Format: PDF, JPG, PNG, DOC/DOCX</small>
                                </li>
                                <li class="list-group-item px-0 py-2 border-0">
                                    <i class="bi bi-check-circle text-success me-2"></i>
                                    <small>Upload maksimal 5 file sekaligus</small>
                                </li>
                                <li class="list-group-item px-0 py-2 border-0">
                                    <i class="bi bi-check-circle text-success me-2"></i>
                                    <small>Dokumen langsung tersimpan ke sistem</small>
                                </li>
                                <li class="list-group-item px-0 py-2 border-0">
                                    <i class="bi bi-check-circle text-success me-2"></i>
                                    <small>Tanggal selesai ≥ tanggal mulai</small>
                                </li>
                            </ul>
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
            font-size: 0.9rem;
        }

        .form-control,
        .form-select {
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .form-control.is-invalid,
        .form-select.is-invalid {
            border-color: #dc3545;
        }

        .card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin-bottom: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            padding: 1rem 1.25rem;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
            transform: translateY(-1px);
            transition: all 0.2s;
        }

        .btn-primary:disabled {
            opacity: 0.65;
            cursor: not-allowed;
        }

        /* Preview File Styles */
        .file-preview-card {
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 10px;
            margin-bottom: 10px;
            background: #f8f9fa;
        }

        .file-icon {
            font-size: 2rem;
            color: #6c757d;
        }

        .file-name {
            font-size: 0.8rem;
            word-break: break-all;
        }

        .file-size {
            font-size: 0.7rem;
            color: #6c757d;
        }

        .remove-file {
            cursor: pointer;
            color: #dc3545;
        }

        .remove-file:hover {
            color: #b02a37;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Script loaded'); // Debug

            // Elements
            const tanggalMulai = document.querySelector('input[name="tanggal_mulai"]');
            const tanggalSelesai = document.querySelector('input[name="tanggal_selesai"]');
            const fasilitasSelect = document.querySelector('select[name="fasilitas_id"]');
            const totalBiayaInput = document.getElementById('total_biaya');
            const form = document.getElementById('peminjamanForm');
            const mediaInput = document.getElementById('mediaInput');
            const mediaPreview = document.getElementById('mediaPreview');
            const previewContainer = document.getElementById('previewContainer');
            const submitBtn = document.getElementById('submitBtn');

            // Set default tanggal mulai ke hari ini
            if (tanggalMulai && !tanggalMulai.value) {
                tanggalMulai.value = new Date().toISOString().split('T')[0];
            }

            // Auto-set tanggal selesai minimal = tanggal mulai
            if (tanggalMulai && tanggalSelesai) {
                tanggalMulai.addEventListener('change', function() {
                    if (this.value) {
                        tanggalSelesai.min = this.value;
                        // Jika tanggal selesai lebih awal dari tanggal mulai yang baru
                        if (tanggalSelesai.value && tanggalSelesai.value < this.value) {
                            tanggalSelesai.value = this.value;
                        }
                    }
                });

                tanggalSelesai.addEventListener('change', function() {
                    if (tanggalMulai.value && this.value < tanggalMulai.value) {
                        alert('⚠️ Tanggal selesai tidak boleh lebih awal dari tanggal mulai');
                        this.value = tanggalMulai.value;
                    }
                });
            }

            // Auto-fill biaya berdasarkan fasilitas yang dipilih
            if (fasilitasSelect && totalBiayaInput) {
                fasilitasSelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    if (selectedOption && selectedOption.dataset.biaya) {
                        const biaya = parseInt(selectedOption.dataset.biaya);
                        if (biaya > 0) {
                            totalBiayaInput.value = biaya;
                        }
                    }
                });
            }

            // File Preview Functionality
            if (mediaInput) {
                console.log('Media input found'); // Debug

                mediaInput.addEventListener('change', function(e) {
                    console.log('File input changed'); // Debug
                    const files = e.target.files;
                    console.log('Files selected:', files.length); // Debug

                    if (files.length > 0) {
                        mediaPreview.style.display = 'block';
                        previewContainer.innerHTML = '';

                        for (let i = 0; i < files.length; i++) {
                            const file = files[i];
                            const fileSize = (file.size / (1024 * 1024)).toFixed(2); // MB

                            // Create preview card
                            const card = document.createElement('div');
                            card.className = 'col-md-6 mb-2';
                            card.innerHTML = `
                            <div class="file-preview-card">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            ${getFileIcon(file.type)}
                                        </div>
                                        <div>
                                            <div class="file-name">${file.name}</div>
                                            <div class="file-size">${fileSize} MB</div>
                                        </div>
                                    </div>
                                    <div class="remove-file" data-index="${i}">
                                        <i class="bi bi-x-circle"></i>
                                    </div>
                                </div>
                            </div>
                        `;

                            previewContainer.appendChild(card);
                        }

                        // Add remove file functionality
                        document.querySelectorAll('.remove-file').forEach(btn => {
                            btn.addEventListener('click', function() {
                                const index = parseInt(this.dataset.index);
                                removeFileFromInput(index);
                            });
                        });
                    } else {
                        mediaPreview.style.display = 'none';
                    }
                });
            }

            // Function to remove file from input
            function removeFileFromInput(index) {
                const dt = new DataTransfer();
                const files = mediaInput.files;

                // Add all files except the one to remove
                for (let i = 0; i < files.length; i++) {
                    if (i !== index) {
                        dt.items.add(files[i]);
                    }
                }

                // Update input files
                mediaInput.files = dt.files;

                // Trigger change event to update preview
                const event = new Event('change');
                mediaInput.dispatchEvent(event);
            }

            // Function to get file icon based on type
            function getFileIcon(fileType) {
                if (fileType.includes('pdf')) {
                    return '<i class="bi bi-file-pdf text-danger file-icon"></i>';
                } else if (fileType.includes('image')) {
                    return '<i class="bi bi-file-image text-success file-icon"></i>';
                } else if (fileType.includes('word') || fileType.includes('document')) {
                    return '<i class="bi bi-file-word text-primary file-icon"></i>';
                } else {
                    return '<i class="bi bi-file-earmark text-secondary file-icon"></i>';
                }
            }

            // Form validation sebelum submit - FIXED VERSION
            if (form) {
                console.log('Form found, adding submit listener'); // Debug

                form.addEventListener('submit', function(e) {
                    console.log('Form submit triggered'); // Debug

                    // Validasi tanggal
                    if (tanggalMulai && tanggalSelesai) {
                        const startDate = new Date(tanggalMulai.value);
                        const endDate = new Date(tanggalSelesai.value); // FIXED: typo "tanggalSelasai"

                        if (endDate < startDate) {
                            e.preventDefault();
                            alert('⚠️ Tanggal selesai tidak boleh lebih awal dari tanggal mulai');
                            return false;
                        }
                    }

                    // Validasi file size (max 5MB per file)
                    if (mediaInput && mediaInput.files.length > 0) {
                        const maxSize = 5 * 1024 * 1024; // 5MB in bytes
                        for (let i = 0; i < mediaInput.files.length; i++) {
                            if (mediaInput.files[i].size > maxSize) {
                                e.preventDefault();
                                alert(
                                    `File "${mediaInput.files[i].name}" melebihi 5MB. Mohon kompres atau pilih file lain.`
                                );
                                return false;
                            }
                        }

                        // Validasi maksimal 5 file
                        if (mediaInput.files.length > 5) {
                            e.preventDefault();
                            alert('Maksimal upload 5 file sekaligus');
                            return false;
                        }
                    }

                    // Validasi input required
                    const requiredInputs = form.querySelectorAll('[required]');
                    let isValid = true;
                    let firstInvalid = null;

                    requiredInputs.forEach(input => {
                        if (!input.value.trim()) {
                            isValid = false;
                            if (!firstInvalid) firstInvalid = input;
                            input.classList.add('is-invalid');
                        } else {
                            input.classList.remove('is-invalid');
                        }
                    });

                    if (!isValid) {
                        e.preventDefault();
                        if (firstInvalid) {
                            firstInvalid.focus();
                            firstInvalid.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                        }
                        alert('Harap isi semua field yang wajib diisi');
                        return false;
                    }

                    // Show loading state
                    if (submitBtn) {
                        submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-1"></i> Menyimpan...';
                        submitBtn.disabled = true;
                    }

                    // Jika semua valid, form akan submit
                    console.log('Form validation passed, submitting...');
                    return true;
                });
            }

            // Format input biaya dengan separator ribuan (optional)
            if (totalBiayaInput) {
                totalBiayaInput.addEventListener('blur', function() {
                    if (this.type === 'number') return;

                    const value = parseInt(this.value.replace(/\D/g, ''));
                    if (!isNaN(value)) {
                        this.value = value.toLocaleString('id-ID');
                    }
                });

                totalBiayaInput.addEventListener('focus', function() {
                    const value = parseInt(this.value.replace(/\D/g, ''));
                    if (!isNaN(value)) {
                        this.value = value;
                    }
                });
            }

            // Fix untuk handle form reset
            form.querySelector('button[type="reset"]').addEventListener('click', function() {
                mediaPreview.style.display = 'none';
                if (submitBtn) {
                    submitBtn.innerHTML = '<i class="bi bi-save me-1"></i> Simpan Data & Media';
                    submitBtn.disabled = false;
                }
            });
        });
    </script>
@endsection
