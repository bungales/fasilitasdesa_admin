@extends('layouts.admin.app')

@section('content')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">Edit Data Warga</h3>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('warga.update', $warga->warga_id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control"
                                        value="{{ old('nama', $warga->nama) }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control" required>{{ old('alamat', $warga->alamat) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>RT</label>
                                    <input type="text" name="rt" class="form-control"
                                        value="{{ old('rt', $warga->rt) }}" required>
                                </div>

                                <div class="form-group">
                                    <label>RW</label>
                                    <input type="text" name="rw" class="form-control"
                                        value="{{ old('rw', $warga->rw) }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Laki-laki"
                                            {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                            Laki-laki</option>
                                        <option value="Perempuan"
                                            {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>No HP</label>
                                    <input type="text" name="no_hp" class="form-control"
                                        value="{{ old('no_hp', $warga->no_hp) }}" required>
                                </div>
                                <button type="submit" class="btn btn-success">Perbarui</button>
                                <a href="{{ route('warga.index') }}" class="btn btn-secondary">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
@endsection
