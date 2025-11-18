@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Tambah Peminjaman Fasilitas</h3>
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

                <form action="{{ route('peminjaman.store') }}" method="POST">
                    @csrf

                    {{-- Fasilitas --}}
                    <div class="form-group">
                        <label>Nama Fasilitas</label>
                        <select name="fasilitas_id" class="form-control" required>
                            <option value="">-- Pilih Fasilitas --</option>
                            @foreach ($fasilitas as $item)
                                <option value="{{ $item->fasilitas_id }}">
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Warga --}}
                    <div class="form-group">
                        <label>Nama Warga</label>
                        <select name="warga_id" class="form-control" required>
                            <option value="">-- Pilih Warga --</option>
                            @foreach ($warga as $item)
                                <option value="{{ $item->warga_id }}">
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Tujuan</label>
                        <input type="text" name="tujuan" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="Pending">Pending</option>
                            <option value="Disetujui">Disetujui</option>
                            <option value="Ditolak">Ditolak</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Total Biaya (Rp)</label>
                        <input type="number" name="total_biaya" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
                </form>

            </div>
        </div>
    </div>
@endsection
