@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Tambah Syarat Fasilitas</h3>
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

                    <form action="{{ route('syarat-fasilitas.store') }}" method="POST" enctype="multipart/form-data">
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

                        {{-- Nama Syarat --}}
                        <div class="form-group mb-3">
                            <label class="form-label">Nama Syarat</label>
                            <input type="text" name="nama_syarat" class="form-control" value="{{ old('nama_syarat') }}"
                                required>
                            @error('nama_syarat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="form-group mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Dokumen Syarat --}}
                        <div class="form-group mb-3">
                            <label class="form-label">Dokumen Syarat (Opsional)</label>
                            <input type="file" name="dokumen_syarat" class="form-control"
                                accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                            <small class="text-muted">Format: PDF, JPG, JPEG, PNG, DOC, DOCX (Max: 2MB)</small>
                            @error('dokumen_syarat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Simpan
                            </button>
                            <a href="{{ route('syarat-fasilitas.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
