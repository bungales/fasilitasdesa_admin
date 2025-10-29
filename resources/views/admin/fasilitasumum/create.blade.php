@extends('layouts.admin.app')

@section('content')
            <!-- partial -->
            {{-- form --}}
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">Tambah Data Fasilitas Umum</h3>
                    </div>

                    <div class="card">
                        <div class="card-body">

                            {{-- ✅ Flash message success & error --}}
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $err)
                                            <li>{{ $err }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('fasilitasumum.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label>Nama Fasilitas</label>
                                    <input type="text" name="nama" class="form-control"
                                        value="{{ old('nama') }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Jenis Fasilitas</label>
                                    <select name="jenis" class="form-control" required>
                                        <option value="">-- Pilih Jenis --</option>
                                        <option value="Aula" {{ old('jenis') == 'Aula' ? 'selected' : '' }}>Aula
                                        </option>
                                        <option value="Lapangan" {{ old('jenis') == 'Lapangan' ? 'selected' : '' }}>
                                            Lapangan</option>
                                        <option value="Tempat Ibadah"
                                            {{ old('jenis') == 'Tempat Ibadah' ? 'selected' : '' }}>Tempat Ibadah
                                        </option>
                                        <option value="Lainnya" {{ old('jenis') == 'Lainnya' ? 'selected' : '' }}>
                                            Lainnya</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control" required>{{ old('alamat') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>RT</label>
                                    <input type="text" name="rt" class="form-control"
                                        value="{{ old('rt') }}" required>
                                </div>

                                <div class="form-group">
                                    <label>RW</label>
                                    <input type="text" name="rw" class="form-control"
                                        value="{{ old('rw') }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Kapasitas</label>
                                    <input type="number" name="kapasitas" class="form-control"
                                        value="{{ old('kapasitas') }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control">{{ old('deskripsi') }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="{{ route('fasilitasumum.index') }}" class="btn btn-secondary">Kembali</a>
                            </form>

                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
@endsection
