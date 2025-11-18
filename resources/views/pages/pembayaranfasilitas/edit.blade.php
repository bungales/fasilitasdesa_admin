@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Edit Data Pembayaran Fasilitas</h3>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('pembayaran.update', $pembayaran->bayar_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Pilih Peminjaman --}}
                    <div class="form-group">
                        <label>Peminjaman</label>
                        <select name="pinjam_id" class="form-control" required>
                            <option value="">-- Pilih Peminjaman --</option>
                            @foreach ($peminjaman as $p)
                                <option value="{{ $p->pinjam_id }}"
                                    {{ $p->pinjam_id == old('pinjam_id', $pembayaran->pinjam_id) ? 'selected' : '' }}>
                                    {{ $p->warga->nama ?? '-' }} - {{ $p->fasilitas->nama ?? '-' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Pembayaran</label>
                        <input type="date" name="tanggal" class="form-control"
                               value="{{ old('tanggal', $pembayaran->tanggal) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Bayar</label>
                        <input type="number" name="jumlah" class="form-control"
                               value="{{ old('jumlah', $pembayaran->jumlah) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Metode Pembayaran</label>
                        <input type="text" name="metode" class="form-control"
                               value="{{ old('metode', $pembayaran->metode) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control">{{ old('keterangan', $pembayaran->keterangan) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Perbarui</button>
                    <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
