@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Daftar Pembayaran Fasilitas</h3>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <a href="{{ route('pembayaran.create') }}" class="btn btn-primary mb-3">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Pembayaran
                </a>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>#</th>
                                <th>Nama Peminjam</th>
                                <th>Nama Fasilitas</th>
                                <th>Tgl Pembayaran</th>
                                <th>Jumlah Bayar</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($pembayaran as $item)
                                <tr class="{{ $loop->odd ? 'row-pink' : 'row-blue' }}">
                                    <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                    <td>{{ $item->peminjaman->warga->nama ?? '-' }}</td>
                                    <td>{{ $item->peminjaman->fasilitas->nama ?? '-' }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ number_format($item->jumlah) }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('pembayaran.edit', $item->bayar_id) }}"
                                               class="btn btn-sm btn-outline-warning rounded-circle"
                                               title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <form action="{{ route('pembayaran.destroy', $item->bayar_id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger rounded-circle"
                                                        title="Hapus">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">
                                        Belum ada data pembayaran fasilitas
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- Custom CSS --}}
<style>
    .row-pink {
        background-color: #ffe6f2 !important;
    }
    .row-blue {
        background-color: #e6f3ff !important;
    }
    .btn-outline-warning:hover {
        background-color: #ffc107;
        color: #fff;
    }
    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: #fff;
    }
</style>
@endsection
