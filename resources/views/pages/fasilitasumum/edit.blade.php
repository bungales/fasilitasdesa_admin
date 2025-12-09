@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Edit Data Fasilitas Umum</h3>
            </div>

            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('fasilitasumum.update', $fasilitasumum->fasilitas_id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Nama Fasilitas <span class="text-danger">*</span></label>
                                    <input type="text" name="nama" class="form-control"
                                        value="{{ old('nama', $fasilitasumum->nama) }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Jenis Fasilitas <span class="text-danger">*</span></label>
                                    <select name="jenis" class="form-control" required>
                                        <option value="">-- Pilih Jenis --</option>
                                        <option value="Aula"
                                            {{ old('jenis', $fasilitasumum->jenis) == 'Aula' ? 'selected' : '' }}>Aula
                                        </option>
                                        <option value="Lapangan"
                                            {{ old('jenis', $fasilitasumum->jenis) == 'Lapangan' ? 'selected' : '' }}>
                                            Lapangan</option>
                                        <option value="Tempat Ibadah"
                                            {{ old('jenis', $fasilitasumum->jenis) == 'Tempat Ibadah' ? 'selected' : '' }}>
                                            Tempat Ibadah</option>
                                        <option value="Lainnya"
                                            {{ old('jenis', $fasilitasumum->jenis) == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Alamat <span class="text-danger">*</span></label>
                            <textarea name="alamat" class="form-control" rows="2" required>{{ old('alamat', $fasilitasumum->alamat) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label>RT <span class="text-danger">*</span></label>
                                    <input type="text" name="rt" class="form-control"
                                        value="{{ old('rt', $fasilitasumum->rt) }}" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label>RW <span class="text-danger">*</span></label>
                                    <input type="text" name="rw" class="form-control"
                                        value="{{ old('rw', $fasilitasumum->rw) }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Kapasitas <span class="text-danger">*</span></label>
                                    <input type="number" name="kapasitas" class="form-control"
                                        value="{{ old('kapasitas', $fasilitasumum->kapasitas) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $fasilitasumum->deskripsi) }}</textarea>
                        </div>

                        {{-- Existing Files Section --}}
                        @if ($media->count() > 0)
                            <div class="form-group mb-4">
                                <label class="form-label">File yang Sudah Diupload</label>
                                <div class="border rounded p-3 bg-light">
                                    @foreach ($media as $file)
                                        <div class="existing-file-item mb-3 p-3 border rounded bg-white">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    @php
                                                        $isImage = in_array($file->mime_type, [
                                                            'image/jpeg',
                                                            'image/png',
                                                            'image/gif',
                                                            'image/jpg',
                                                        ]);
                                                        $fileUrl = asset(
                                                            'storage/uploads/fasilitas_umum/' . $file->file_name,
                                                        );
                                                    @endphp

                                                    @if ($isImage)
                                                        <img src="{{ $fileUrl }}" alt="{{ $file->caption }}"
                                                            style="width: 80px; height: 80px; object-fit: cover;"
                                                            class="rounded me-3 border">
                                                    @else
                                                        <div class="file-icon me-3 text-center" style="width: 80px;">
                                                            @if ($file->mime_type == 'application/pdf')
                                                                <i class="bi bi-file-pdf"
                                                                    style="font-size: 48px; color: #dc3545;"></i>
                                                            @elseif(strpos($file->mime_type, 'word') !== false)
                                                                <i class="bi bi-file-word"
                                                                    style="font-size: 48px; color: #2b579a;"></i>
                                                            @else
                                                                <i class="bi bi-file-earmark"
                                                                    style="font-size: 48px; color: #6c757d;"></i>
                                                            @endif
                                                            <small
                                                                class="d-block">{{ strtoupper($file->extension) }}</small>
                                                        </div>
                                                    @endif

                                                    <div>
                                                        <div class="mb-1">
                                                            <strong class="d-block">{{ $file->file_name }}</strong>
                                                            <small class="text-muted">{{ $file->mime_type }}</small>
                                                        </div>
                                                        <input type="text"
                                                            name="existing_captions[{{ $file->media_id }}]"
                                                            class="form-control form-control-sm"
                                                            value="{{ $file->caption }}" placeholder="Keterangan file"
                                                            style="width: 300px;">
                                                    </div>
                                                </div>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ $fileUrl }}" target="_blank"
                                                        class="btn btn-sm btn-info" title="Lihat File">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-danger delete-media-btn"
                                                        data-media-id="{{ $file->media_id }}" title="Hapus File">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- New Files Upload Section --}}
                        <div class="form-group mb-4">
                            <label class="form-label">Tambah File Baru</label>
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
                                <i class="bi bi-save me-1"></i> Perbarui Data
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
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Fungsi untuk handle file upload
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

            // Handle delete media button
            document.querySelectorAll('.delete-media-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const mediaId = this.getAttribute('data-media-id');
                    const fasilitasId = {{ $fasilitasumum->fasilitas_id }};

                    if (confirm('Apakah Anda yakin ingin menghapus file ini?')) {
                        // Kirim request DELETE
                        fetch(`/fasilitasumum/${fasilitasId}/media/${mediaId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    this.closest('.existing-file-item').remove();
                                } else {
                                    alert('Gagal menghapus file');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Terjadi kesalahan saat menghapus file');
                            });
                    }
                });
            });

            // Update tombol hapus pertama kali
            updateRemoveButtons();
        });
    </script>

    <style>
        .existing-file-item {
            transition: all 0.3s ease;
        }

        .existing-file-item:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .file-icon {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #dee2e6;
        }
    </style>
@endsection
