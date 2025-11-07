@extends('layouts.app')

@section('content')
            <!-- partial -->
            <div class="main-panel">
                {{-- form --}}
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">Daftar Fasilitas Umum</h3>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('fasilitasumum.create') }}" class="btn btn-primary mb-3">+ Tambah
                                Fasilitas Umum</a>

                            {{-- ✅ Flash message success --}}
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Fasilitas</th>
                                            <th>Jenis</th>
                                            <th>Alamat</th>
                                            <th>RT</th>
                                            <th>RW</th>
                                            <th>Kapasitas</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($fasilitas as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->jenis }}</td>
                                                <td>{{ $item->alamat }}</td>
                                                <td>{{ $item->rt }}</td>
                                                <td>{{ $item->rw }}</td>
                                                <td>{{ $item->kapasitas }}</td>
                                                <td>{{ $item->deskripsi }}</td>
                                                <td>
                                                    <a href="{{ route('fasilitasumum.edit', $item) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>

                                                    <form action="{{ route('fasilitasumum.destroy', $item) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center">Belum ada data fasilitas umum
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
@endsection
