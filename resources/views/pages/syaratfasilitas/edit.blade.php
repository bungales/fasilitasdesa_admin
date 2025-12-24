@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="page-title">Edit Syarat Fasilitas</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('syarat-fasilitas.index') }}">Syarat Fasilitas</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('syarat-fasilitas.show', $syaratFasilitas->syarat_id) }}" class="btn btn-info">
                    <i class="fas fa-eye"></i> Lihat Detail
                </a>
                <a href="{{ route('syarat-fasilitas.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-edit"></i> Form Edit Syarat Fasilitas</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <h5><i class="fas fa-exclamation-triangle"></i> Terjadi kesalahan:</h5>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('syarat-fasilitas.update', $syaratFasilitas->syarat_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Fasilitas -->
                        <div class="form-group">
                            <label for="fasilitas_id" class="font-weight-bold">
                                <i class="fas fa-building text-primary"></i> Fasilitas
                                <span class="text-danger">*</span>
                            </label>
                            <select name="fasilitas_id" id="fasilitas_id" class="form-control select2" required>
                                <option value="">-- Pilih Fasilitas --</option>
                                @foreach($fasilitasList as $fasilitas)
                                    <option value="{{ $fasilitas->fasilitas_id }}"
                                        {{ old('fasilitas_id', $syaratFasilitas->fasilitas_id) == $fasilitas->fasilitas_id ? 'selected' : '' }}>
                                        {{ $fasilitas->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('fasilitas_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Nama Syarat -->
                        <div class="form-group">
                            <label for="nama_syarat" class="font-weight-bold">
                                <i class="fas fa-tag text-primary"></i> Nama Syarat
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="nama_syarat" id="nama_syarat"
                                   class="form-control @error('nama_syarat') is-invalid @enderror"
                                   value="{{ old('nama_syarat', $syaratFasilitas->nama_syarat) }}"
                                   placeholder="Masukkan nama syarat" required>
                            @error('nama_syarat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="form-group">
                            <label for="deskripsi" class="font-weight-bold">
                                <i class="fas fa-align-left text-primary"></i> Deskripsi
                            </label>
                            <textarea name="deskripsi" id="deskripsi" rows="4"
                                      class="form-control @error('deskripsi') is-invalid @enderror"
                                      placeholder="Masukkan deskripsi syarat (opsional)">{{ old('deskripsi', $syaratFasilitas->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Dokumen -->
                        <div class="form-group">
                            <label class="font-weight-bold">
                                <i class="fas fa-file text-primary"></i> Dokumen Syarat
                            </label>

                            @if($syaratFasilitas->dokumen_syarat)
                                <div class="mb-3 p-3 bg-light rounded border">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6><i class="fas fa-file-pdf text-danger"></i> Dokumen Saat Ini</h6>
                                            <p class="mb-1 text-muted">{{ basename($syaratFasilitas->dokumen_syarat) }}</p>
                                            <small class="text-muted">Diupload: {{ $syaratFasilitas->updated_at->format('d/m/Y H:i') }}</small>
                                        </div>
                                        <div>
                                            <a href="{{ asset('storage/' . $syaratFasilitas->dokumen_syarat) }}"
                                               target="_blank"
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i> Lihat
                                            </a>
                                            <a href="{{ route('syarat-fasilitas.download', $syaratFasilitas->syarat_id) }}"
                                               class="btn btn-sm btn-outline-success">
                                                <i class="fas fa-download"></i> Unduh
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="hapus_dokumen" id="hapus_dokumen" value="1">
                                    <label class="form-check-label text-danger" for="hapus_dokumen">
                                        <i class="fas fa-trash"></i> Hapus dokumen saat ini
                                    </label>
                                </div>
                            @endif

                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('dokumen_syarat') is-invalid @enderror"
                                       id="dokumen_syarat" name="dokumen_syarat"
                                       accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                <label class="custom-file-label" for="dokumen_syarat">
                                    @if($syaratFasilitas->dokumen_syarat)
                                        Ganti dokumen...
                                    @else
                                        Upload dokumen...
                                    @endif
                                </label>
                            </div>
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle"></i> Format: PDF, JPG, PNG, DOC, DOCX (Maks: 2MB)
                            </small>
                            @error('dokumen_syarat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Informasi Sistem -->
                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h6 class="font-weight-bold text-muted">
                                    <i class="fas fa-info-circle"></i> Informasi Sistem
                                </h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="mb-1"><small>Dibuat:</small></p>
                                        <p class="font-weight-bold">{{ $syaratFasilitas->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-1"><small>Diperbarui:</small></p>
                                        <p class="font-weight-bold">{{ $syaratFasilitas->updated_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <div>
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                                <button type="reset" class="btn btn-outline-secondary btn-lg">
                                    <i class="fas fa-redo"></i> Reset
                                </button>
                            </div>
                            <a href="{{ route('syarat-fasilitas.index') }}" class="btn btn-outline-danger btn-lg">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <!-- Panduan -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-lightbulb"></i> Panduan Pengisian</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="text-primary"><i class="fas fa-star"></i> Field Wajib</h6>
                        <p class="small mb-0">Field dengan tanda <span class="text-danger">*</span> harus diisi</p>
                    </div>
                    <div class="mb-3">
                        <h6 class="text-primary"><i class="fas fa-file"></i> Dokumen</h6>
                        <p class="small mb-0">Upload dokumen format PDF, JPG, PNG, DOC/DOCX maksimal 2MB</p>
                    </div>
                    <div class="mb-3">
                        <h6 class="text-primary"><i class="fas fa-exclamation-triangle"></i> Perhatian</h6>
                        <p class="small mb-0">Pastikan data yang dimasukkan sudah benar sebelum disimpan</p>
                    </div>
                </div>
            </div>

            <!-- Statistik -->
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Statistik</h5>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <h1 class="display-4 text-primary">#{{ $syaratFasilitas->syarat_id }}</h1>
                        <p class="text-muted">ID Syarat</p>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div class="text-center">
                            <h4 class="text-success">{{ $fasilitasList->count() }}</h4>
                            <small class="text-muted">Total Fasilitas</small>
                        </div>
                        <div class="text-center">
                            <h4 class="text-info">{{ \App\Models\SyaratFasilitas::count() }}</h4>
                            <small class="text-muted">Total Syarat</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .select2-container .select2-selection--single {
        height: 45px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 45px;
    }
    .custom-file-label::after {
        content: "Pilih File";
    }
    .card {
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }
    .page-header {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2({
            placeholder: '-- Pilih Fasilitas --',
            allowClear: true
        });

        // Custom file input
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });

        // Reset checkbox when new file selected
        $('#dokumen_syarat').on('change', function() {
            if ($(this).val() !== '') {
                $('#hapus_dokumen').prop('checked', false);
            }
        });

        // Form validation
        $('form').on('submit', function(e) {
            const fileInput = $('#dokumen_syarat')[0];
            const hapusDokumen = $('#hapus_dokumen').is(':checked');

            if (fileInput && fileInput.files.length > 0) {
                const file = fileInput.files[0];
                const maxSize = 2 * 1024 * 1024; // 2MB

                if (file.size > maxSize) {
                    e.preventDefault();
                    alert('Ukuran file melebihi 2MB!');
                    return false;
                }

                const allowedTypes = [
                    'application/pdf',
                    'image/jpeg',
                    'image/jpg',
                    'image/png',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                ];

                if (!allowedTypes.includes(file.type)) {
                    e.preventDefault();
                    alert('Format file tidak didukung!');
                    return false;
                }
            }

            if (!hapusDokumen && !fileInput.files.length && !$('#hapus_dokumen').length) {
                // Jika tidak ada file baru dan tidak ada checkbox hapus
                $('#dokumen_syarat').removeAttr('required');
            }

            return true;
        });
    });
</script>
@endpush
