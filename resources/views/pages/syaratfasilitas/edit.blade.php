@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Edit Syarat Fasilitas</h3>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('syarat-fasilitas.update', $syaratFasilitas->syarat_id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Fasilitas --}}
                        <div class="form-group mb-3">
                            <label class="form-label">Nama Fasilitas</label>
                            <select name="fasilitas_id" class="form-control" required>
                                <option value="">-- Pilih Fasilitas --</option>
                                @foreach ($fasilitasList as $fasilitas)
                                    <option value="{{ $fasilitas->fasilitas_id }}"
                                        {{ $syaratFasilitas->fasilitas_id == $fasilitas->fasilitas_id ? 'selected' : '' }}>
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
                            <input type="text" name="nama_syarat" class="form-control"
                                value="{{ old('nama_syarat', $syaratFasilitas->nama_syarat) }}" required>
                            @error('nama_syarat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="form-group mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $syaratFasilitas->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Dokumen Syarat --}}
                        <div class="form-group mb-3">
                            <label class="form-label">Dokumen Syarat</label>

                            {{-- Tampilkan file yang ada --}}
                            @if ($syaratFasilitas->dokumen_syarat)
                                <div class="mb-2">
                                    <p class="mb-1">File saat ini:</p>
                                    <a href="{{ asset('storage/' . $syaratFasilitas->dokumen_syarat) }}" target="_blank"
                                        class="btn btn-sm btn-info">
                                        <i class="fas fa-eye me-1"></i> Lihat Dokumen
                                    </a>
                                    <small class="text-muted d-block mt-1">
                                        Upload file baru untuk mengganti dokumen ini
                                    </small>
                                </div>
                            @endif

                            <input type="file" name="dokumen_syarat" class="form-control"
                                accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                            <small class="text-muted">Format: PDF, JPG, JPEG, PNG, DOC, DOCX (Max: 2MB)</small>
                            @error('dokumen_syarat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Perbarui
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
