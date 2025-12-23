@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Edit Petugas Fasilitas</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('petugas-fasilitas.index') }}">Petugas Fasilitas</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('petugas-fasilitas.show', $petugasFasilitas->petugas_id) }}">Detail</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>

            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">
                                <i class="bi bi-pencil-square me-2"></i>Form Edit Petugas Fasilitas
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

                            <form action="{{ route('petugas-fasilitas.update', $petugasFasilitas->petugas_id) }}" method="POST" id="editPetugasForm">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6">
                                        {{-- Fasilitas --}}
                                        <div class="form-group mb-4">
                                            <label class="form-label fw-bold">
                                                <i class="bi bi-building me-1"></i>Fasilitas
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="fasilitas_id" class="form-control select2" required
                                                    data-placeholder="-- Pilih Fasilitas --">
                                                <option value=""></option>
                                                @foreach ($fasilitasList as $fasilitas)
                                                    <option value="{{ $fasilitas->fasilitas_id }}"
                                                        {{ $petugasFasilitas->fasilitas_id == $fasilitas->fasilitas_id ? 'selected' : '' }}>
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
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        {{-- Warga --}}
                                        <div class="form-group mb-4">
                                            <label class="form-label fw-bold">
                                                <i class="bi bi-person me-1"></i>Nama Warga
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="petugas_warga_id" class="form-control select2" required
                                                    data-placeholder="-- Pilih Warga --">
                                                <option value=""></option>
                                                @foreach ($wargaList as $warga)
                                                    <option value="{{ $warga->warga_id }}"
                                                        {{ $petugasFasilitas->petugas_warga_id == $warga->warga_id ? 'selected' : '' }}
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
                                        </div>
                                    </div>
                                </div>

                                {{-- Info Warga Saat Ini --}}
                                <div class="card bg-light mb-4">
                                    <div class="card-body">
                                        <h6 class="text-primary mb-3">
                                            <i class="bi bi-info-circle me-2"></i>Informasi Warga Saat Ini
                                        </h6>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>NIK:</strong>
                                                    {{ $petugasFasilitas->warga->nik ?? '-' }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Alamat:</strong>
                                                    {{ $petugasFasilitas->warga->alamat ?? '-' }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>No. HP:</strong>
                                                    {{ $petugasFasilitas->warga->no_hp ?? '-' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Peran --}}
                                <div class="form-group mb-4">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-tag me-1"></i>Peran / Jabatan
                                        <span class="text-danger">*</span>
                                    </label>
                                    @php
                                        $currentPeran = $petugasFasilitas->peran;
                                        $isLainnya = !in_array($currentPeran, ['Penanggung jawab', 'Cleaning Service', 'Security', 'Operator', 'Maintenance', 'Administrasi']);
                                    @endphp

                                    <select name="peran" class="form-control" required id="peranSelectEdit">
                                        <option value="">-- Pilih Peran --</option>
                                        <option value="Penanggung jawab" {{ $currentPeran == 'Penanggung jawab' ? 'selected' : '' }}>
                                            Penanggung jawab
                                        </option>
                                        <option value="Cleaning Service" {{ $currentPeran == 'Cleaning Service' ? 'selected' : '' }}>
                                            Cleaning Service
                                        </option>
                                        <option value="Security" {{ $currentPeran == 'Security' ? 'selected' : '' }}>
                                            Security
                                        </option>
                                        <option value="Operator" {{ $currentPeran == 'Operator' ? 'selected' : '' }}>
                                            Operator
                                        </option>
                                        <option value="Maintenance" {{ $currentPeran == 'Maintenance' ? 'selected' : '' }}>
                                            Maintenance
                                        </option>
                                        <option value="Administrasi" {{ $currentPeran == 'Administrasi' ? 'selected' : '' }}>
                                            Administrasi
                                        </option>
                                        <option value="Lainnya" {{ $isLainnya ? 'selected' : '' }}>
                                            Lainnya (tulis di bawah)
                                        </option>
                                    </select>
                                    @error('peran')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror

                                    {{-- Input untuk peran lainnya --}}
                                    <div class="mt-3" id="peranLainnyaEdit" style="{{ $isLainnya ? 'display: block;' : 'display: none;' }}">
                                        <label class="form-label fw-bold">Tulis Peran Lainnya:</label>
                                        <input type="text" name="peran_lainnya" class="form-control"
                                               placeholder="Masukkan peran lainnya"
                                               value="{{ $isLainnya ? $currentPeran : old('peran_lainnya') }}">
                                        <small class="text-muted">Contoh: Koordinator, Supervisor, Teknisi, dll.</small>
                                    </div>
                                </div>

                                {{-- Warning khusus Penanggung Jawab --}}
                                <div class="alert alert-warning" id="warningPenanggungJawabEdit"
                                     style="{{ $currentPeran == 'Penanggung jawab' ? 'display: block;' : 'display: none;' }}">
                                    <h6><i class="bi bi-exclamation-triangle me-2"></i>Perhatian!</h6>
                                    <p class="mb-0">
                                        Jika mengubah peran ini, pastikan warga belum menjadi Penanggung Jawab di fasilitas lain.
                                        Sistem akan mengecek otomatis saat Anda menyimpan.
                                    </p>
                                </div>

                                {{-- Informasi Data Saat Ini --}}
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">
                                        <h6 class="mb-3">
                                            <i class="bi bi-clock-history me-2"></i>Data Saat Ini
                                        </h6>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1">
                                                    <strong>Fasilitas:</strong><br>
                                                    {{ $petugasFasilitas->fasilitas->nama ?? '-' }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1">
                                                    <strong>Warga:</strong><br>
                                                    {{ $petugasFasilitas->warga->nama ?? '-' }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1">
                                                    <strong>Peran:</strong><br>
                                                    <span class="badge bg-light text-dark">
                                                        {{ $currentPeran }}
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top">
                                    <div>
                                        <a href="{{ route('petugas-fasilitas.show', $petugasFasilitas->petugas_id) }}" class="btn btn-secondary me-2">
                                            <i class="bi bi-eye me-1"></i> Lihat Detail
                                        </a>
                                        <a href="{{ route('petugas-fasilitas.index') }}" class="btn btn-outline-secondary">
                                            <i class="bi bi-arrow-left me-1"></i> Kembali
                                        </a>
                                    </div>

                                    <div>
                                        <button type="reset" class="btn btn-outline-primary me-2">
                                            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                                        </button>
                                        <button type="submit" class="btn btn-primary" id="updateBtn">
                                            <i class="bi bi-save me-1"></i> Perbarui Data
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .select2-container--default .select2-selection--single {
            border: 1px solid #ced4da;
            height: 38px;
            border-radius: 0.375rem;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }

        .form-control:focus, .select2-container--focus .select2-selection--single {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
    </style>

    <script>
        // Toggle input untuk peran lainnya
        document.getElementById('peranSelectEdit').addEventListener('change', function() {
            const peranLainnyaDiv = document.getElementById('peranLainnyaEdit');
            const warningDiv = document.getElementById('warningPenanggungJawabEdit');

            if (this.value === 'Lainnya') {
                peranLainnyaDiv.style.display = 'block';
            } else {
                peranLainnyaDiv.style.display = 'none';
            }

            // Tampilkan warning untuk Penanggung Jawab
            if (this.value === 'Penanggung jawab') {
                warningDiv.style.display = 'block';
            } else {
                warningDiv.style.display = 'none';
            }
        });

        // Inisialisasi Select2
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap-5',
                width: '100%'
            });
        });
    </script>
@endsection
