@extends('layouts.admin.app')

@section('content')

    <div class="content-wrapper">

        <div class="page-header">
            <h3 class="page-title">Edit User</h3>
        </div>

        <div class="card">
            <div class="card-body">

                <form action="{{ route('user.update', $user) }}" method="POST">
                    @csrf @method('PUT')

                    <label>Nama</label>
                    <input type="text" name="name" class="form-control mb-2" value="{{ $user->name }}" required>

                    <label>Email</label>
                    <input type="email" name="email" class="form-control mb-2" value="{{ $user->email }}" required>

                    <label>Password (isi jika ingin ganti)</label>
                    <input type="password" name="password" class="form-control mb-2">

                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control mb-3">

                    <button class="btn btn-primary">Update</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
