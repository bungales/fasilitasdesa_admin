@extends('layouts.app')

@section('content')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">Tambah Data Warga</h3>
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

                            <form action="{{ route('warga.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control"
                                        value="{{ old('nama') }}" required>
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
                                    <label>Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Laki-laki"
                                            {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                        </option>
                                        <option value="Perempuan"
                                            {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>No HP</label>
                                    <input type="text" name="no_hp" class="form-control"
                                        value="{{ old('no_hp') }}" required>
                                </div>

                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="{{ route('warga.index') }}" class="btn btn-secondary">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
@endsection
