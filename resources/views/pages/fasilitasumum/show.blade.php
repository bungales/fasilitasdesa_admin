@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Detail Fasilitas Umum</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('fasilitasumum.index') }}">Fasilitas Umum</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </nav>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h4 class="mb-3">{{ $fasilitasumum->nama }}</h4>
                        <table class="table table-bordered">
                            <tr>
                                <th width="40%">Jenis</th>
                                <td>{{ $fasilitasumum->jenis }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $fasilitasumum->alamat }}</td>
                            </tr>
                            <tr>
                                <th>RT/RW</th>
                                <td>{{ $fasilitasumum->rt }} / {{ $fasilitasumum->rw }}</td>
                            </tr>
                            <tr>
                                <th>Kapasitas</th>
                                <td>{{ $fasilitasumum->kapasitas }} orang</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5>Deskripsi</h5>
                        <div class="p-3 bg-light rounded">
                            {{ $fasilitasumum->deskripsi ?? '-' }}
                        </div>
                    </div>
                </div>

                {{-- File Media Section --}}
                @if($media->count() > 0)
                <div class="mt-5">
                    <h5 class="mb-3">File Pendukung</h5>
                    <div class="row">
                        @foreach($media as $file)
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    @php
                                        $isImage = in_array($file->mime_type, ['image/jpeg', 'image/png', 'image/gif', 'image/jpg']);
                                        $fileUrl = asset('storage/uploads/fasilitas_umum/' . $file->file_name);
                                    @endphp

                                    @if($isImage)
                                        <img src="{{ $fileUrl }}" alt="{{ $file->caption }}"
                                             class="img-fluid rounded mb-2"
                                             style="max-height: 150px; object-fit: cover;">
                                    @else
                                        <div class="file-icon mb-2">
                                            @if($file->mime_type == 'application/pdf')
                                                <i class="bi bi-file-pdf" style="font-size: 64px; color: #dc3545;"></i>
                                            @elseif(strpos($file->mime_type, 'word') !== false)
                                                <i class="bi bi-file-word" style="font-size: 64px; color: #2b579a;"></i>
                                            @else
                                                <i class="bi bi-file-earmark" style="font-size: 64px; color: #6c757d;"></i>
                                            @endif
                                        </div>
                                    @endif

                                    <h6 class="card-title">{{ $file->file_name }}</h6>
                                    @if($file->caption)
                                        <p class="card-text text-muted small">{{ $file->caption }}</p>
                                    @endif
                                    <div class="mt-2">
                                        <a href="{{ $fileUrl }}" target="_blank" class="btn btn-sm btn-primary">
                                            <i class="bi bi-download me-1"></i> Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i> Belum ada file pendukung untuk fasilitas ini.
                </div>
                @endif

                <div class="mt-4">
                    <a href="{{ route('fasilitasumum.edit', $fasilitasumum->fasilitas_id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-1"></i> Edit
                    </a>
                    <a href="{{ route('fasilitasumum.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
