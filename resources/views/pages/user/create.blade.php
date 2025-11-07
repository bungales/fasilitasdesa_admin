@extends('layouts.app')

@section('content')

    <div class="content-wrapper">

        <div class="page-header">
            <h3 class="page-title">Tambah User</h3>
        </div>

        <div class="card">
            <div class="card-body">

                <form action="{{ route('user.store') }}" method="POST">
                    @csrf

                    <label>Nama</label>
                    <input type="text" name="name" class="form-control mb-2" required>

                    <label>Email</label>
                    <input type="email" name="email" class="form-control mb-2" required>

                    <label>Password</label>
                    <input type="password" name="password" class="form-control mb-2" required>

                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control mb-3" required>

                    <button class="btn btn-primary">Simpan</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
