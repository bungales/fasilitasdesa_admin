<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - RuangKu</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --primary-blue: #1A3D7C;
            --secondary-blue: #2D5BFF;
            --accent-gold: #FFD700;
        }

        body {
            background: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 20px;
        }

        .register-container {
            max-width: 500px;
            margin: 0 auto;
            width: 100%;
        }

        .register-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .register-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: white;
            padding: 30px;
            text-align: center;
        }

        .logo-register {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .logo-icon {
            font-size: 48px;
            margin-bottom: 15px;
            color: var(--accent-gold);
        }

        .register-body {
            padding: 30px;
        }

        .form-group label {
            color: var(--primary-blue);
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-control {
            border: 1.5px solid #e0e6ff;
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 15px;
        }

        .form-control:focus {
            border-color: var(--secondary-blue);
            box-shadow: 0 0 0 3px rgba(45, 91, 255, 0.1);
        }

        .btn-register {
            background: var(--secondary-blue);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            font-size: 16px;
            width: 100%;
            transition: all 0.3s;
        }

        .btn-register:hover {
            background: var(--primary-blue);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(26, 61, 124, 0.2);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }

        .login-link a {
            color: var(--secondary-blue);
            font-weight: 600;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .password-toggle {
            cursor: pointer;
            color: #666;
        }

        .password-toggle:hover {
            color: var(--secondary-blue);
        }

        .alert {
            border-radius: 8px;
            border: none;
        }

        @media (max-width: 576px) {
            .register-header {
                padding: 20px;
            }

            .register-body {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <div class="logo-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="logo-register">RuangKu</div>
                <p>Buat Akun Admin Baru</p>
            </div>

            <div class="register-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle mr-2"></i> Terjadi kesalahan:
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('user.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name"><i class="fas fa-user mr-2"></i>Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name"
                               value="{{ old('name') }}" required placeholder="Masukkan nama lengkap">
                    </div>

                    <div class="form-group">
                        <label for="email"><i class="fas fa-envelope mr-2"></i>Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                               value="{{ old('email') }}" required placeholder="contoh@desa.id">
                    </div>

                    <div class="form-group">
                        <label for="password"><i class="fas fa-lock mr-2"></i>Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password"
                                   required placeholder="Minimal 6 karakter">
                            <div class="input-group-append">
                                <span class="input-group-text password-toggle" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation"><i class="fas fa-lock mr-2"></i>Konfirmasi Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password_confirmation"
                                   name="password_confirmation" required placeholder="Ulangi password">
                            <div class="input-group-append">
                                <span class="input-group-text password-toggle" id="toggleConfirmPassword">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="role"><i class="fas fa-user-tag mr-2"></i>Role</label>
                        <select class="form-control" id="role" name="role" required>
                            <option value="">Pilih Role</option>
                            <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="Operator" {{ old('role') == 'Operator' ? 'selected' : '' }}>Operator</option>
                            <option value="User" {{ old('role') == 'User' ? 'selected' : '' }}>User</option>
                        </select>
                        <small class="text-muted">Pilih peran pengguna dalam sistem</small>
                    </div>

                    <button type="submit" class="btn btn-register mt-3">
                        <i class="fas fa-user-plus mr-2"></i> Buat Akun
                    </button>

                    <div class="login-link">
                        Sudah punya akun? <a href="{{ route('login.index') }}">Login di sini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Toggle password visibility
            $('#togglePassword').click(function() {
                const passwordInput = $('#password');
                const icon = $(this).find('i');

                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordInput.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });

            $('#toggleConfirmPassword').click(function() {
                const confirmInput = $('#password_confirmation');
                const icon = $(this).find('i');

                if (confirmInput.attr('type') === 'password') {
                    confirmInput.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    confirmInput.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });

            // Validasi form
            $('form').submit(function(e) {
                const password = $('#password').val();
                const confirmPassword = $('#password_confirmation').val();

                if (password !== confirmPassword) {
                    e.preventDefault();
                    alert('Password dan Konfirmasi Password tidak cocok!');
                    $('#password').focus();
                }
            });
        });
    </script>
</body>
</html>
