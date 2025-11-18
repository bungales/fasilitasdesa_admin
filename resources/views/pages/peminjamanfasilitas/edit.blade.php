@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Edit Peminjaman Fasilitas</h3>
        </div>

        <div class="card">
            <div class="card-body">

                <form action="{{ route('peminjaman.update', $peminjaman->pinjam_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Pilih Warga --}}
                    <div class="form-group mb-3">
                        <label>Nama Peminjam</label>
                        <select name="warga_id" class="form-control" required>
                            <option value="">-- Pilih Peminjam --</option>
                            @foreach($warga as $w)
                                <option value="{{ $w->warga_id }}"
                                    {{ $peminjaman->warga_id == $w->warga_id ? 'selected' : '' }}>
                                    {{ $w->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Pilih Fasilitas --}}
                    <div class="form-group mb-3">
                        <label>Nama Fasilitas</label>
                        <select name="fasilitas_id" class="form-control" required>
                            <option value="">-- Pilih Fasilitas --</option>
                            @foreach($fasilitas as $f)
                                <option value="{{ $f->fasilitas_id }}"
                                    {{ $peminjaman->fasilitas_id == $f->fasilitas_id ? 'selected' : '' }}>
                                    {{ $f->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tanggal Mulai --}}
                    <div class="form-group mb-3">
                        <label>Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" class="form-control"
                               value="{{ $peminjaman->tanggal_mulai }}" required>
                    </div>

                    {{-- Tanggal Selesai --}}
                    <div class="form-group mb-3">
                        <label>Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" class="form-control"
                               value="{{ $peminjaman->tanggal_selesai }}" required>
                    </div>

                    {{-- Tujuan --}}
                    <div class="form-group mb-3">
                        <label>Tujuan</label>
                        <textarea name="tujuan" class="form-control" required>{{ $peminjaman->tujuan }}</textarea>
                    </div>

                    {{-- Status --}}
                    <div class="form-group mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="pending" {{ $peminjaman->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="disetujui" {{ $peminjaman->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="ditolak" {{ $peminjaman->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    {{-- Total Biaya --}}
                    <div class="form-group mb-3">
                        <label>Total Biaya</label>
                        <input type="number" name="total_biaya" class="form-control"
                               value="{{ $peminjaman->total_biaya }}" required>
                    </div>

                    <button type="submit" class="btn btn-success">Perbarui</button>
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
