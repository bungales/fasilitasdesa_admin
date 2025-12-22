@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Edit Syarat Fasilitas</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('syarat-fasilitas.index') }}">Syarat Fasilitas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-warning text-white">
                            <h4 class="mb-0">
                                <i class="fas fa-edit me-2"></i>Edit Data Syarat Fasilitas
                            </h4>
                        </div>

                        <div class="card-body">
                            {{-- Flash message --}}
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            {{-- Error message --}}
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <strong>Terjadi kesalahan:</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach ($errors->all() as $err)
                                            <li>{{ $err }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('syarat-fasilitas.update', $syaratFasilitas->syarat_id) }}" method="POST" enctype="multipart/form-data" id="editForm">
                                @csrf
                                @method('PUT')

                                {{-- Fasilitas --}}
                                <div class="form-group mb-4">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-building me-1"></i>Nama Fasilitas
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="fasilitas_id" class="form-control form-control-lg select2" required>
                                        <option value="">-- Pilih Fasilitas --</option>
                                        @foreach ($fasilitasList as $fasilitas)
                                            <option value="{{ $fasilitas->fasilitas_id }}"
                                                {{ old('fasilitas_id', $syaratFasilitas->fasilitas_id) == $fasilitas->fasilitas_id ? 'selected' : '' }}>
                                                {{ $fasilitas->nama }} (ID: {{ $fasilitas->fasilitas_id }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('fasilitas_id')
                                        <div class="text-danger mt-1">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Nama Syarat --}}
                                <div class="form-group mb-4">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-tag me-1"></i>Nama Syarat
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="nama_syarat" class="form-control form-control-lg"
                                           value="{{ old('nama_syarat', $syaratFasilitas->nama_syarat) }}"
                                           placeholder="Masukkan nama syarat" required>
                                    @error('nama_syarat')
                                        <div class="text-danger mt-1">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Deskripsi --}}
                                <div class="form-group mb-4">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-align-left me-1"></i>Deskripsi
                                    </label>
                                    <textarea name="deskripsi" class="form-control" rows="5"
                                              placeholder="Masukkan deskripsi syarat">{{ old('deskripsi', $syaratFasilitas->deskripsi) }}</textarea>
                                    <div class="form-text">Deskripsi opsional untuk memberikan penjelasan lebih detail tentang syarat ini.</div>
                                    @error('deskripsi')
                                        <div class="text-danger mt-1">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Dokumen Syarat --}}
                                <div class="form-group mb-4">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-file me-1"></i>Dokumen Syarat
                                    </label>

                                    {{-- Tampilkan file yang ada --}}
                                    @if ($syaratFasilitas->dokumen_syarat)
                                        <div class="card bg-light mb-3">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <i class="fas fa-file-pdf text-danger fa-2x me-3"></i>
                                                        <div class="d-inline-block">
                                                            <h6 class="mb-1">File saat ini:</h6>
                                                            <p class="text-muted mb-0 small">{{ basename($syaratFasilitas->dokumen_syarat) }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="btn-group">
                                                        <a href="{{ asset('storage/' . $syaratFasilitas->dokumen_syarat) }}"
                                                           target="_blank"
                                                           class="btn btn-outline-primary btn-sm">
                                                            <i class="fas fa-eye me-1"></i> Lihat
                                                        </a>
                                                        <a href="{{ route('syarat-fasilitas.download', $syaratFasilitas->syarat_id) }}"
                                                           class="btn btn-outline-success btn-sm">
                                                            <i class="fas fa-download me-1"></i> Unduh
                                                        </a>
                                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                                                onclick="confirmRemoveFile()">
                                                            <i class="fas fa-trash me-1"></i> Hapus
                                                        </button>
                                                    </div>
                                                </div>
                                                <small class="text-muted d-block mt-2">
                                                    <i class="fas fa-info-circle me-1"></i> Upload file baru untuk mengganti dokumen ini
                                                </small>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="file-upload-area">
                                        <div class="input-group">
                                            <input type="file" name="dokumen_syarat" class="form-control"
                                                   id="dokumenInput" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                            <button class="btn btn-outline-secondary" type="button" onclick="clearFile()">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="form-text">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Format: PDF, JPG, JPEG, PNG, DOC, DOCX (Maksimal: 2MB)
                                        </div>
                                        <div id="filePreview" class="mt-2 d-none">
                                            <div class="alert alert-info d-flex align-items-center">
                                                <i class="fas fa-file me-3 fa-2x"></i>
                                                <div>
                                                    <strong id="fileName"></strong>
                                                    <div class="small" id="fileSize"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @error('dokumen_syarat')
                                        <div class="text-danger mt-1">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Informasi Metadata --}}
                                <div class="card bg-light mb-4">
                                    <div class="card-body">
                                        <h6 class="fw-bold mb-3">
                                            <i class="fas fa-history me-1"></i>Informasi Sistem
                                        </h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="mb-1"><small>Dibuat:</small></p>
                                                <p class="fw-bold">{{ $syaratFasilitas->created_at->format('d F Y H:i') }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="mb-1"><small>Diperbarui:</small></p>
                                                <p class="fw-bold">{{ $syaratFasilitas->updated_at->format('d F Y H:i') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                    <div>
                                        <button type="submit" class="btn btn-success btn-lg px-4" id="submitBtn">
                                            <i class="fas fa-save me-2"></i> Simpan Perubahan
                                        </button>
                                        <button type="button" class="btn btn-secondary btn-lg px-4" onclick="resetForm()">
                                            <i class="fas fa-redo me-2"></i> Reset
                                        </button>
                                    </div>

                                    <div>
                                        <a href="{{ route('syarat-fasilitas.show', $syaratFasilitas->syarat_id) }}"
                                           class="btn btn-info btn-lg px-4 me-2">
                                            <i class="fas fa-eye me-2"></i> Lihat Detail
                                        </a>
                                        <a href="{{ route('syarat-fasilitas.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                                            <i class="fas fa-arrow-left me-2"></i> Kembali
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Sidebar Panduan --}}
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-lightbulb me-2"></i>Panduan Pengisian
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item">
                                    <h6 class="fw-bold text-primary">
                                        <i class="fas fa-star me-2"></i>Field Wajib
                                    </h6>
                                    <p class="small mb-0">Field dengan tanda <span class="text-danger">*</span> harus diisi</p>
                                </div>

                                <div class="list-group-item">
                                    <h6 class="fw-bold text-primary">
                                        <i class="fas fa-file me-2"></i>Format Dokumen
                                    </h6>
                                    <ul class="small mb-0">
                                        <li>PDF, DOC, DOCX untuk dokumen</li>
                                        <li>JPG, JPEG, PNG untuk gambar</li>
                                        <li>Ukuran maksimal 2MB</li>
                                    </ul>
                                </div>

                                <div class="list-group-item">
                                    <h6 class="fw-bold text-primary">
                                        <i class="fas fa-shield-alt me-2"></i>Keamanan Data
                                    </h6>
                                    <p class="small mb-0">Pastikan data yang diupload tidak mengandung informasi sensitif</p>
                                </div>

                                <div class="list-group-item">
                                    <h6 class="fw-bold text-primary">
                                        <i class="fas fa-clock me-2"></i>Auto Save
                                    </h6>
                                    <p class="small mb-0">Data secara otomatis disimpan saat form di-submit</p>
                                </div>
                            </div>

                            <div class="mt-4">
                                <div class="alert alert-warning">
                                    <h6 class="alert-heading">
                                        <i class="fas fa-exclamation-triangle me-2"></i>Peringatan!
                                    </h6>
                                    <p class="small mb-0">
                                        Pastikan semua data telah dicek kebenarannya sebelum menyimpan perubahan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Quick Actions --}}
                    <div class="card shadow-sm mt-3">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-bolt me-2"></i>Aksi Cepat
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('syarat-fasilitas.create') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-plus-circle me-2"></i>Tambah Syarat Baru
                                </a>
                                <button type="button" class="btn btn-outline-danger"
                                        onclick="confirmDelete()">
                                    <i class="fas fa-trash me-2"></i>Hapus Syarat Ini
                                </button>
                                <a href="{{ route('syarat-fasilitas.index') }}" class="btn btn-outline-info">
                                    <i class="fas fa-list me-2"></i>Lihat Semua Syarat
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Hidden Form for File Removal --}}
    <form id="removeFileForm" action="{{ route('syarat-fasilitas.remove-file', $syaratFasilitas->syarat_id) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    {{-- Delete Confirmation Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus syarat fasilitas ini?</p>
                    <div class="alert alert-danger">
                        <strong>Peringatan:</strong> Tindakan ini tidak dapat dibatalkan. Semua data termasuk dokumen yang terkait akan dihapus secara permanen.
                    </div>
                    <p><strong>Data yang akan dihapus:</strong></p>
                    <ul>
                        <li>Nama: {{ $syaratFasilitas->nama_syarat }}</li>
                        @if($syaratFasilitas->dokumen_syarat)
                        <li>Dokumen: {{ basename($syaratFasilitas->dokumen_syarat) }}</li>
                        @endif
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <form action="{{ route('syarat-fasilitas.destroy', $syaratFasilitas->syarat_id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i> Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Remove File Confirmation Modal --}}
    <div class="modal fade" id="removeFileModal" tabindex="-1" aria-labelledby="removeFileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="removeFileModalLabel">
                        <i class="fas fa-file-exclamation me-2"></i>Hapus Dokumen
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus dokumen ini?</p>
                    <div class="alert alert-warning">
                        <strong>Catatan:</strong> Dokumen akan dihapus dari server dan tidak dapat dikembalikan.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-warning" onclick="removeFile()">Hapus Dokumen</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Custom CSS --}}
    <style>
        .form-control-lg {
            border-radius: 8px;
            padding: 12px 15px;
        }

        .file-upload-area {
            border: 2px dashed #dee2e6;
            border-radius: 10px;
            padding: 20px;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }

        .file-upload-area:hover {
            border-color: #0d6efd;
            background-color: #e7f1ff;
        }

        .select2-container--default .select2-selection--single {
            height: 48px;
            padding: 10px;
            border-radius: 8px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 28px;
        }

        .list-group-item {
            border-left: none;
            border-right: none;
            padding: 15px 0;
        }

        .list-group-item:first-child {
            border-top: none;
            padding-top: 0;
        }

        .list-group-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        #submitBtn {
            position: relative;
            overflow: hidden;
        }

        #submitBtn:after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, .5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%);
            transform-origin: 50% 50%;
        }

        #submitBtn:focus:not(:active)::after {
            animation: ripple 1s ease-out;
        }

        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 1;
            }
            20% {
                transform: scale(25, 25);
                opacity: 1;
            }
            100% {
                opacity: 0;
                transform: scale(40, 40);
            }
        }

        @media (max-width: 768px) {
            .btn-lg {
                width: 100%;
                margin-bottom: 10px;
            }

            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>

    {{-- JavaScript --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script>
        // Initialize Select2
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: '-- Pilih Fasilitas --',
                allowClear: true,
                width: '100%'
            });
        });

        // File input preview
        document.getElementById('dokumenInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('filePreview');
            const fileName = document.getElementById('fileName');
            const fileSize = document.getElementById('fileSize');

            if (file) {
                // Show preview
                preview.classList.remove('d-none');

                // Set file name
                fileName.textContent = file.name;

                // Set file size
                const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
                fileSize.textContent = `Ukuran: ${sizeInMB} MB`;

                // Validate file size
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file melebihi 2MB!');
                    this.value = '';
                    preview.classList.add('d-none');
                }

                // Validate file type
                const allowedTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png',
                                      'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Format file tidak didukung!');
                    this.value = '';
                    preview.classList.add('d-none');
                }
            } else {
                preview.classList.add('d-none');
            }
        });

        // Clear file input
        function clearFile() {
            document.getElementById('dokumenInput').value = '';
            document.getElementById('filePreview').classList.add('d-none');
        }

        // Reset form
        function resetForm() {
            if (confirm('Apakah Anda yakin ingin mereset form? Semua perubahan yang belum disimpan akan hilang.')) {
                document.getElementById('editForm').reset();
                $('.select2').val('').trigger('change');
                clearFile();
            }
        }

        // Confirm delete
        function confirmDelete() {
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }

        // Confirm file removal
        function confirmRemoveFile() {
            const removeFileModal = new bootstrap.Modal(document.getElementById('removeFileModal'));
            removeFileModal.show();
        }

        // Remove file
        function removeFile() {
            document.getElementById('removeFileForm').submit();
        }

        // Form submission
        document.getElementById('editForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Menyimpan...';
            submitBtn.disabled = true;

            // Optional: Add timeout to ensure button state changes
            setTimeout(() => {
                submitBtn.disabled = false;
            }, 5000);
        });

        // Auto-save draft (optional feature)
        let autoSaveTimer;
        const formInputs = document.querySelectorAll('#editForm input, #editForm textarea, #editForm select');

        formInputs.forEach(input => {
            input.addEventListener('input', function() {
                clearTimeout(autoSaveTimer);
                autoSaveTimer = setTimeout(() => {
                    // Save draft logic here if needed
                    console.log('Auto-saving draft...');
                }, 2000);
            });
        });

        // Prevent accidental navigation
        window.addEventListener('beforeunload', function(e) {
            const form = document.getElementById('editForm');
            const formData = new FormData(form);
            let hasChanges = false;

            // Check if form has changes
            formData.forEach((value, key) => {
                if (value !== '' && key !== '_token' && key !== '_method') {
                    hasChanges = true;
                }
            });

            if (hasChanges) {
                e.preventDefault();
                e.returnValue = 'Anda memiliki perubahan yang belum disimpan. Apakah Anda yakin ingin meninggalkan halaman ini?';
            }
        });
    </script>
@endsection
