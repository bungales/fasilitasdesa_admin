@extends('layouts.admin.app')

@section('content')
            <!-- partial -->
            {{-- form --}}
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">Edit Data Fasilitas Umum</h3>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('fasilitasumum.update', $fasilitasumum->fasilitas_id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Nama Fasilitas</label>
                                    <input type="text" name="nama" class="form-control"
                                        value="{{ old('nama', $fasilitasumum->nama) }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Jenis Fasilitas</label>
                                    <select name="jenis" class="form-control" required>
                                        <option value="">-- Pilih Jenis --</option>
                                        <option value="Aula"
                                            {{ old('jenis', $fasilitasumum->jenis) == 'Aula' ? 'selected' : '' }}>Aula
                                        </option>
                                        <option value="Lapangan"
                                            {{ old('jenis', $fasilitasumum->jenis) == 'Lapangan' ? 'selected' : '' }}>
                                            Lapangan</option>
                                        <option value="Tempat Ibadah"
                                            {{ old('jenis', $fasilitasumum->jenis) == 'Tempat Ibadah' ? 'selected' : '' }}>
                                            Tempat Ibadah</option>
                                        <option value="Lainnya"
                                            {{ old('jenis', $fasilitasumum->jenis) == 'Lainnya' ? 'selected' : '' }}>
                                            Lainnya</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control" required>{{ old('alamat', $fasilitasumum->alamat) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>RT</label>
                                    <input type="text" name="rt" class="form-control"
                                        value="{{ old('rt', $fasilitasumum->rt) }}" required>
                                </div>

                                <div class="form-group">
                                    <label>RW</label>
                                    <input type="text" name="rw" class="form-control"
                                        value="{{ old('rw', $fasilitasumum->rw) }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Kapasitas</label>
                                    <input type="number" name="kapasitas" class="form-control"
                                        value="{{ old('kapasitas', $fasilitasumum->kapasitas) }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $fasilitasumum->deskripsi) }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-success">Perbarui</button>
                                <a href="{{ route('fasilitasumum.index') }}" class="btn btn-secondary">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
@endsection
