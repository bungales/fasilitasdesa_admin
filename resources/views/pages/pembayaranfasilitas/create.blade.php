@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Tambah Pembayaran Fasilitas</h3>
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

                <form action="{{ route('pembayaran.store') }}" method="POST">
                    @csrf

                    {{-- PILIH PEMINJAMAN --}}
                    <div class="form-group">
                        <label>Peminjaman</label>
                        <select name="pinjam_id" class="form-control" required>
                            <option value="">-- Pilih Peminjaman --</option>
                            @foreach ($peminjaman as $p)
                                <option value="{{ $p->pinjam_id }}">
                                    {{ $p->warga->nama }} - {{ $p->fasilitas->nama }}
                                    ({{ $p->tanggal_mulai }} s/d {{ $p->tanggal_selesai }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- TANGGAL PEMBAYARAN --}}
                    <div class="form-group">
                        <label>Tanggal Pembayaran</label>
                        <input type="date" name="tanggal" class="form-control"
                            value="{{ old('tanggal') }}" required>
                    </div>

                    {{-- METODE PEMBAYARAN --}}
                    <div class="form-group">
                        <label>Metode Pembayaran</label>
                        <select name="metode" class="form-control" required>
                            <option value="">-- Pilih Metode --</option>
                            <option value="cash">Cash</option>
                            <option value="transfer">Transfer</option>
                            <option value="qris">QRIS</option>
                        </select>
                    </div>

                    {{-- NAMA PEMBAYAR --}}
                    <div class="form-group">
                        <label>Nama Pembayar</label>
                        <input type="text" name="nama_pembayar" class="form-control"
                            value="{{ old('nama_pembayar') }}" required>
                    </div>

                    {{-- JUMLAH --}}
                    <div class="form-group">
                        <label>Jumlah Pembayaran (Rp)</label>
                        <input type="number" name="jumlah" class="form-control"
                            value="{{ old('jumlah') }}" required>
                    </div>

                    {{-- KETERANGAN --}}
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">Kembali</a>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
