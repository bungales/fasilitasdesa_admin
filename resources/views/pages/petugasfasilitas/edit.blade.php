@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Edit Petugas Fasilitas</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('petugas-fasilitas.index') }}">Petugas Fasilitas</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('petugas-fasilitas.show', ['petugas_fasilita' => $petugasFasilitas->getKey()]) }}">
                            Detail
                        </a>
                    </li>
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

                        {{-- ALERT --}}
                        @foreach (['success','error','warning'] as $msg)
                            @if (session($msg))
                                <div class="alert alert-{{ $msg == 'success' ? 'success' : ($msg == 'error' ? 'danger' : 'warning') }}">
                                    {{ session($msg) }}
                                </div>
                            @endif
                        @endforeach

                        {{-- FORM --}}
                        <form action="{{ route('petugas-fasilitas.update', ['petugas_fasilita' => $petugasFasilitas->getKey()]) }}"
                              method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                {{-- FASILITAS --}}
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-bold">Fasilitas <span class="text-danger">*</span></label>
                                    <select name="fasilitas_id" class="form-control select2" required>
                                        <option value="">-- Pilih Fasilitas --</option>
                                        @foreach ($fasilitasList as $fasilitas)
                                            <option value="{{ $fasilitas->fasilitas_id }}"
                                                {{ $petugasFasilitas->fasilitas_id == $fasilitas->fasilitas_id ? 'selected' : '' }}>
                                                {{ $fasilitas->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- WARGA --}}
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-bold">Nama Warga <span class="text-danger">*</span></label>
                                    <select name="petugas_warga_id" class="form-control select2" required>
                                        <option value="">-- Pilih Warga --</option>
                                        @foreach ($wargaList as $warga)
                                            <option value="{{ $warga->warga_id }}"
                                                {{ $petugasFasilitas->petugas_warga_id == $warga->warga_id ? 'selected' : '' }}>
                                                {{ $warga->nama }} ({{ $warga->nik }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- INFO WARGA --}}
                            <div class="card bg-light mb-4">
                                <div class="card-body">
                                    <strong>Info Warga</strong>
                                    <p class="mb-1">NIK: {{ $petugasFasilitas->warga->nik ?? '-' }}</p>
                                    <p class="mb-0">Alamat: {{ $petugasFasilitas->warga->alamat ?? '-' }}</p>
                                </div>
                            </div>

                            {{-- PERAN --}}
                            @php
                                $currentPeran = $petugasFasilitas->peran;
                                $isLainnya = !in_array($currentPeran, [
                                    'Penanggung jawab','Cleaning Service','Security',
                                    'Operator','Maintenance','Administrasi'
                                ]);
                            @endphp

                            <div class="mb-4">
                                <label class="form-label fw-bold">Peran <span class="text-danger">*</span></label>
                                <select name="peran" class="form-control" id="peranSelectEdit" required>
                                    <option value="">-- Pilih Peran --</option>
                                    @foreach ([
                                        'Penanggung jawab','Cleaning Service','Security',
                                        'Operator','Maintenance','Administrasi'
                                    ] as $role)
                                        <option value="{{ $role }}" {{ $currentPeran == $role ? 'selected' : '' }}>
                                            {{ $role }}
                                        </option>
                                    @endforeach
                                    <option value="Lainnya" {{ $isLainnya ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>

                            {{-- PERAN LAINNYA --}}
                            <div class="mb-4" id="peranLainnyaEdit"
                                 style="{{ $isLainnya ? 'display:block' : 'display:none' }}">
                                <label class="form-label fw-bold">Peran Lainnya</label>
                                <input type="text" name="peran_lainnya" class="form-control"
                                       value="{{ $isLainnya ? $currentPeran : '' }}">
                            </div>

                            {{-- ACTION --}}
                            <div class="d-flex justify-content-between border-top pt-3">
                                <div>
                                    <a href="{{ route('petugas-fasilitas.show', ['petugas_fasilita' => $petugasFasilitas->getKey()]) }}"
                                       class="btn btn-secondary">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                    <a href="{{ route('petugas-fasilitas.index') }}"
                                       class="btn btn-outline-secondary ms-2">
                                        Kembali
                                    </a>
                                </div>

                                <button class="btn btn-primary">
                                    <i class="bi bi-save"></i> Simpan Perubahan
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script>
    document.getElementById('peranSelectEdit').addEventListener('change', function () {
        document.getElementById('peranLainnyaEdit').style.display =
            this.value === 'Lainnya' ? 'block' : 'none';
    });

    $(document).ready(function () {
        $('.select2').select2({ width: '100%' });
    });
</script>
@endsection
