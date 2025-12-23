@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Tambah Petugas Fasilitas</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('petugas-fasilitas.index') }}">Petugas Fasilitas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Baru</li>
                    </ol>
                </nav>
            </div>

            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">
                                <i class="fas fa-user-plus me-2"></i>Form Tambah Petugas Fasilitas
                            </h4>
                        </div>

                        <div class="card-body">
                            {{-- Flash message --}}
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('warning'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ session('warning') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            {{-- Error message --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <h5><i class="fas fa-exclamation-triangle me-2"></i>Terjadi Kesalahan!</h5>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $err)
                                            <li>{{ $err }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('petugas-fasilitas.store') }}" method="POST" id="petugasForm">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        {{-- Fasilitas --}}
                                        <div class="form-group mb-4">
                                            <label class="form-label fw-bold">
                                                <i class="fas fa-building me-1"></i>Fasilitas
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="fasilitas_id" class="form-control select2" required
                                                    data-placeholder="-- Pilih Fasilitas --">
                                                <option value=""></option>
                                                @foreach ($fasilitasList as $fasilitas)
                                                    <option value="{{ $fasilitas->fasilitas_id }}"
                                                        {{ old('fasilitas_id') == $fasilitas->fasilitas_id ? 'selected' : '' }}>
                                                        {{ $fasilitas->nama }}
                                                        @if($fasilitas->lokasi)
                                                            ({{ $fasilitas->lokasi }})
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('fasilitas_id')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">
                                                Pilih fasilitas yang akan ditugaskan
                                            </small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        {{-- Warga --}}
                                        <div class="form-group mb-4">
                                            <label class="form-label fw-bold">
                                                <i class="fas fa-user me-1"></i>Nama Warga
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="petugas_warga_id" class="form-control select2" required
                                                    data-placeholder="-- Pilih Warga --">
                                                <option value=""></option>
                                                @foreach ($wargaList as $warga)
                                                    <option value="{{ $warga->warga_id }}"
                                                        {{ old('petugas_warga_id') == $warga->warga_id ? 'selected' : '' }}
                                                        data-nik="{{ $warga->nik }}"
                                                        data-alamat="{{ $warga->alamat }}"
                                                        data-nohp="{{ $warga->no_hp }}">
                                                        {{ $warga->nama }} (NIK: {{ $warga->nik }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('petugas_warga_id')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">
                                                Pilih warga yang akan ditugaskan
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                {{-- Info Warga Terpilih --}}
                                <div class="card bg-light mb-4" id="wargaInfo" style="display: none;">
                                    <div class="card-body">
                                        <h6 class="text-primary mb-3">
                                            <i class="fas fa-info-circle me-2"></i>Informasi Warga Terpilih
                                        </h6>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>NIK:</strong> <span id="infoNik">-</span></p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Alamat:</strong> <span id="infoAlamat">-</span></p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>No. HP:</strong> <span id="infoNohp">-</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Peran --}}
                                <div class="form-group mb-4">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-tag me-1"></i>Peran / Jabatan
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="peran" class="form-control" required id="peranSelect">
                                        <option value="">-- Pilih Peran --</option>
                                        <option value="Penanggung jawab" {{ old('peran') == 'Penanggung jawab' ? 'selected' : '' }}>
                                            Penanggung jawab
                                        </option>
                                        <option value="Cleaning Service" {{ old('peran') == 'Cleaning Service' ? 'selected' : '' }}>
                                            Cleaning Service
                                        </option>
                                        <option value="Security" {{ old('peran') == 'Security' ? 'selected' : '' }}>
                                            Security
                                        </option>
                                        <option value="Operator" {{ old('peran') == 'Operator' ? 'selected' : '' }}>
                                            Operator
                                        </option>
                                        <option value="Maintenance" {{ old('peran') == 'Maintenance' ? 'selected' : '' }}>
                                            Maintenance
                                        </option>
                                        <option value="Administrasi" {{ old('peran') == 'Administrasi' ? 'selected' : '' }}>
                                            Administrasi
                                        </option>
                                        <option value="Lainnya" {{ old('peran') == 'Lainnya' ? 'selected' : '' }}>
                                            Lainnya (tulis di bawah)
                                        </option>
                                    </select>
                                    @error('peran')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror

                                    {{-- Input untuk peran lainnya --}}
                                    <div class="mt-3" id="peranLainnya" style="display: none;">
                                        <label class="form-label fw-bold">Tulis Peran Lainnya:</label>
                                        <input type="text" name="peran_lainnya" class="form-control"
                                               placeholder="Masukkan peran lainnya"
                                               value="{{ old('peran_lainnya') }}">
                                        <small class="text-muted">Contoh: Koordinator, Supervisor, Teknisi, dll.</small>
                                    </div>
                                </div>

                                {{-- Warning khusus Penanggung Jawab --}}
                                <div class="alert alert-warning" id="warningPenanggungJawab" style="display: none;">
                                    <h6><i class="fas fa-exclamation-triangle me-2"></i>Perhatian!</h6>
                                    <p class="mb-0">
                                        Pastikan warga belum menjadi Penanggung Jawab di fasilitas lain.
                                        Sistem akan mengecek otomatis saat Anda menyimpan.
                                    </p>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top">
                                    <div>
                                        <a href="{{ route('petugas-fasilitas.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-arrow-left me-1"></i> Kembali
                                        </a>
                                    </div>

                                    <div>
                                        <button type="reset" class="btn btn-outline-secondary me-2">
                                            <i class="fas fa-redo me-1"></i> Reset
                                        </button>
                                        <button type="submit" class="btn btn-success" id="submitBtn">
                                            <i class="fas fa-save me-1"></i> Simpan Data
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Informasi Tambahan --}}
                    <div class="card shadow-sm mt-3">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-lightbulb me-2"></i>Informasi Penting
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="icon-circle-small bg-primary me-3">
                                            <i class="fas fa-check text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Satu Warga Satu Fasilitas</h6>
                                            <p class="text-muted small mb-0">
                                                Satu warga hanya bisa menjadi petugas di satu fasilitas tertentu.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="icon-circle-small bg-warning me-3">
                                            <i class="fas fa-exclamation text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Penanggung Jawab Unik</h6>
                                            <p class="text-muted small mb-0">
                                                Satu warga hanya bisa menjadi Penanggung Jawab di satu fasilitas saja.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Custom CSS --}}
    <style>
        .select2-container .select2-selection--single {
            height: 45px !important;
            border: 1px solid #ced4da !important;
            border-radius: 0.375rem !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 45px !important;
            padding-left: 12px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 45px !important;
        }

        .icon-circle-small {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        #submitBtn {
            padding: 10px 30px;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .col-md-8.mx-auto {
                max-width: 100% !important;
                padding: 0 15px;
            }
        }
    </style>

    {{-- JavaScript --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2({
                theme: 'bootstrap-5',
                width: '100%'
            });

            // Show warga info when selected
            $('select[name="petugas_warga_id"]').on('change', function() {
                const selectedOption = $(this).find('option:selected');
                const nik = selectedOption.data('nik');
                const alamat = selectedOption.data('alamat');
                const nohp = selectedOption.data('nohp');

                if (selectedOption.val()) {
                    $('#infoNik').text(nik || '-');
                    $('#infoAlamat').text(alamat || '-');
                    $('#infoNohp').text(nohp || '-');
                    $('#wargaInfo').show();
                } else {
                    $('#wargaInfo').hide();
                }
            });

            // Show peran lainnya input
            $('#peranSelect').on('change', function() {
                if ($(this).val() === 'Lainnya') {
                    $('#peranLainnya').show();
                    $('input[name="peran_lainnya"]').prop('required', true);
                } else {
                    $('#peranLainnya').hide();
                    $('input[name="peran_lainnya"]').prop('required', false);
                }

                // Show warning for Penanggung Jawab
                if ($(this).val() === 'Penanggung jawab') {
                    $('#warningPenanggungJawab').show();
                } else {
                    $('#warningPenanggungJawab').hide();
                }
            });

            // Handle form submission
            $('#petugasForm').on('submit', function(e) {
                // If peran is Lainnya, set the value from input
                if ($('#peranSelect').val() === 'Lainnya') {
                    const peranLainnya = $('input[name="peran_lainnya"]').val();
                    if (peranLainnya) {
                        $('#peranSelect').val(peranLainnya);
                    }
                }

                // Show loading on button
                $('#submitBtn').html('<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...');
                $('#submitBtn').prop('disabled', true);
            });

            // Trigger change on page load if there's old value
            $('#peranSelect').trigger('change');
            $('select[name="petugas_warga_id"]').trigger('change');
        });
    </script>
@endsection
