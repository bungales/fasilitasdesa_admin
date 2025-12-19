@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Tambah Petugas Fasilitas</h3>
            </div>

            <div class="card">
                <div class="card-body">
                    {{-- Flash message --}}
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    {{-- Error message --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('petugas-fasilitas.store') }}" method="POST">
                        @csrf

                        {{-- Fasilitas --}}
                        <div class="form-group mb-3">
                            <label class="form-label">Nama Fasilitas</label>
                            <select name="fasilitas_id" class="form-control" required>
                                <option value="">-- Pilih Fasilitas --</option>
                                @foreach ($fasilitasList as $fasilitas)
                                    <option value="{{ $fasilitas->fasilitas_id }}"
                                        {{ old('fasilitas_id') == $fasilitas->fasilitas_id ? 'selected' : '' }}>
                                        {{ $fasilitas->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('fasilitas_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Warga --}}
                        <div class="form-group mb-3">
                            <label class="form-label">Nama Warga</label>
                            <select name="petugas_warga_id" class="form-control" required>
                                <option value="">-- Pilih Warga --</option>
                                @foreach ($wargaList as $warga)
                                    <option value="{{ $warga->warga_id }}"
                                        {{ old('petugas_warga_id') == $warga->warga_id ? 'selected' : '' }}>
                                        {{ $warga->nama }} (NIK: {{ $warga->nik }})
                                    </option>
                                @endforeach
                            </select>
                            @error('petugas_warga_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Peran --}}
                        <div class="form-group mb-3">
                            <label class="form-label">Peran</label>
                            <input type="text" name="peran" class="form-control"
                                   value="{{ old('peran') }}"
                                   placeholder="Contoh: Penanggung jawab, Cleaning Service, Security, dll."
                                   required>
                            @error('peran')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                <strong>Note:</strong> Jika memilih "Penanggung jawab", pastikan warga belum menjadi penanggung jawab di fasilitas lain.
                            </small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Simpan
                            </button>
                            <a href="{{ route('petugas-fasilitas.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
