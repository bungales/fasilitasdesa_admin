@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Tambah Data Fasilitas Umum</h3>
            </div>

            <div class="card">
                <div class="card-body">
                    {{-- ✅ Flash message success & error --}}
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('fasilitasumum.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Nama Fasilitas <span class="text-danger">*</span></label>
                                    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Jenis Fasilitas <span class="text-danger">*</span></label>
                                    <select name="jenis" class="form-control" required>
                                        <option value="">-- Pilih Jenis --</option>
                                        <option value="Aula" {{ old('jenis') == 'Aula' ? 'selected' : '' }}>Aula</option>
                                        <option value="Lapangan" {{ old('jenis') == 'Lapangan' ? 'selected' : '' }}>Lapangan
                                        </option>
                                        <option value="Tempat Ibadah"
                                            {{ old('jenis') == 'Tempat Ibadah' ? 'selected' : '' }}>Tempat Ibadah</option>
                                        <option value="Lainnya" {{ old('jenis') == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Alamat <span class="text-danger">*</span></label>
                            <textarea name="alamat" class="form-control" rows="2" required>{{ old('alamat') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label>RT <span class="text-danger">*</span></label>
                                    <input type="text" name="rt" class="form-control" value="{{ old('rt') }}"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label>RW <span class="text-danger">*</span></label>
                                    <input type="text" name="rw" class="form-control" value="{{ old('rw') }}"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Kapasitas <span class="text-danger">*</span></label>
                                    <input type="number" name="kapasitas" class="form-control"
                                        value="{{ old('kapasitas') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi') }}</textarea>
                        </div>

                        {{-- Multiple File Upload Section --}}
                        <div class="form-group mb-4">
                            <label class="form-label">Upload File Pendukung</label>
                            <div class="border rounded p-3 bg-light">
                                <div id="fileUploadContainer">
                                    <div class="file-input-group mb-3">
                                        <div class="row g-2 align-items-center">
                                            <div class="col-md-6">
                                                <input type="file" name="files[]" class="form-control"
                                                    accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" name="captions[]" class="form-control"
                                                    placeholder="Keterangan file (opsional)">
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-danger btn-sm remove-file-btn"
                                                    disabled>
                                                    <i class="bi bi-x"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" id="addMoreFiles" class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-plus-circle me-1"></i> Tambah File Lain
                                </button>

                                <small class="form-text text-muted d-block mt-2">
                                    <i class="bi bi-info-circle me-1"></i> Format: JPG, PNG, PDF, DOC, DOCX | Maksimal 2MB
                                    per file
                                </small>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save me-1"></i> Simpan
                            </button>
                            <a href="{{ route('fasilitasumum.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Template untuk file input baru --}}
    <template id="fileInputTemplate">
        <div class="file-input-group mb-3">
            <div class="row g-2 align-items-center">
                <div class="col-md-6">
                    <input type="file" name="files[]" class="form-control" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                </div>
                <div class="col-md-5">
                    <input type="text" name="captions[]" class="form-control"
                        placeholder="Keterangan file (opsional)">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger btn-sm remove-file-btn">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
            </div>
        </div>
    </template>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileUploadContainer = document.getElementById('fileUploadContainer');
            const addMoreBtn = document.getElementById('addMoreFiles');
            const fileInputTemplate = document.getElementById('fileInputTemplate');

            // Fungsi untuk enable/disable tombol hapus pada file pertama
            function updateRemoveButtons() {
                const fileGroups = fileUploadContainer.querySelectorAll('.file-input-group');
                fileGroups.forEach((group, index) => {
                    const removeBtn = group.querySelector('.remove-file-btn');
                    if (fileGroups.length === 1) {
                        removeBtn.disabled = true;
                        removeBtn.classList.add('disabled');
                    } else {
                        removeBtn.disabled = false;
                        removeBtn.classList.remove('disabled');
                    }
                });
            }

            // Tambah file input baru
            addMoreBtn.addEventListener('click', function() {
                const newFileInput = fileInputTemplate.content.cloneNode(true);
                fileUploadContainer.appendChild(newFileInput);
                updateRemoveButtons();
            });

            // Hapus file input
            fileUploadContainer.addEventListener('click', function(e) {
                if (e.target.closest('.remove-file-btn') && !e.target.closest('.remove-file-btn')
                    .disabled) {
                    e.target.closest('.file-input-group').remove();
                    updateRemoveButtons();
                }
            });

            // Update tombol hapus pertama kali
            updateRemoveButtons();
        });
    </script>

    <style>
        .file-input-group {
            padding: 10px;
            background-color: #fff;
            border-radius: 5px;
            border: 1px solid #dee2e6;
        }
    </style>
@endsection
