<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - RuangKu</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Poppins Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-blue: #1A3D7C;
            --secondary-blue: #2D5BFF;
            --accent-gold: #FFD700;
            --light-bg: rgba(255, 255, 255, 0.92);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background:
                linear-gradient(rgba(255, 255, 255, 0.92), rgba(255, 255, 255, 0.92)),
                url('https://images.unsplash.com/photo-1593113630400-ea4288922493?q=80&w=2070&auto=format&fit=crop') center/cover no-repeat,
                linear-gradient(135deg, #e8f4ff 0%, #d4e4ff 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px;
        }

        .login-container {
            display: flex;
            width: 100%;
            max-width: 900px;
            height: 550px;
            background: white;
            border-radius: 18px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.08);
        }

        /* Left Panel - Login Form */
        .login-form-container {
            flex: 0.8;
            padding: 35px 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
        }

        /* Right Panel - Illustration dengan background gambar desa */
        .illustration-container {
            flex: 1.2;
            background:
                linear-gradient(rgba(26, 61, 124, 0.9), rgba(45, 91, 255, 0.9)),
                url('https://images.unsplash.com/photo-1558618666-fcd25c85cd64?q=80&w=2070&auto=format&fit=crop') center/cover no-repeat;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .illustration-container::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 70% 30%, rgba(255, 215, 0, 0.1) 0%, transparent 50%),
                        radial-gradient(circle at 30% 70%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
            top: 0;
            left: 0;
        }

        .logo-admin {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-icon {
            width: 60px;
            height: 60px;
            background: var(--primary-blue);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            color: white;
            font-size: 28px;
            box-shadow: 0 4px 12px rgba(26, 61, 124, 0.3);
        }

        .logo-text {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-blue);
            letter-spacing: 0.5px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .admin-badge {
            display: inline-block;
            background: var(--accent-gold);
            color: var(--primary-blue);
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 18px;
            margin-top: 5px;
            box-shadow: 0 2px 6px rgba(255, 215, 0, 0.3);
        }

        .login-header {
            margin-bottom: 20px;
        }

        .login-header h2 {
            color: var(--primary-blue);
            font-weight: 600;
            margin-bottom: 5px;
            font-size: 20px;
        }

        .login-header p {
            color: #666;
            font-size: 13px;
            line-height: 1.4;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            color: var(--primary-blue);
            font-weight: 500;
            font-size: 13px;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary-blue);
            z-index: 2;
            font-size: 14px;
        }

        .form-control {
            height: 44px;
            border: 1.5px solid #e0e6ff;
            border-radius: 8px;
            padding-left: 40px;
            font-size: 14px;
            transition: all 0.3s;
            background: rgba(248, 250, 255, 0.9);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .form-control:focus {
            border-color: var(--secondary-blue);
            box-shadow: 0 0 0 3px rgba(45, 91, 255, 0.15);
            background: white;
        }

        .btn-login {
            background: var(--secondary-blue);
            border: none;
            height: 44px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 15px;
            letter-spacing: 0.3px;
            transition: all 0.3s;
            margin-top: 8px;
            box-shadow: 0 4px 12px rgba(45, 91, 255, 0.3);
        }

        .btn-login:hover {
            background: var(--primary-blue);
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(26, 61, 124, 0.4);
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            cursor: pointer;
            z-index: 3;
            font-size: 14px;
        }

        .password-toggle:hover {
            color: var(--secondary-blue);
        }

        .illustration-title {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 12px;
            z-index: 1;
            text-align: center;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        .illustration-text {
            font-size: 13px;
            text-align: center;
            margin-bottom: 30px;
            z-index: 1;
            max-width: 380px;
            line-height: 1.5;
            opacity: 0.95;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
        }

        .register-link {
            text-align: center;
            margin-top: 15px;
            font-size: 12px;
            color: #666;
        }

        .alert {
            border-radius: 8px;
            border: none;
            margin-bottom: 18px;
            padding: 10px 15px;
            font-size: 13px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        }

        .alert i {
            font-size: 14px;
        }

        /* Icons Container */
        .icons-container {
            width: 100%;
            max-width: 350px;
            text-align: center;
            z-index: 1;
            margin-bottom: 20px;
        }

        .icon-box {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 12px;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .icon-row {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 15px;
        }

        .icon-item {
            background: rgba(255, 255, 255, 0.2);
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .icon-item:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-5px);
        }

        .icon-item i {
            font-size: 24px;
            color: #FFD700;
        }

        .facilities-text {
            color: #FFD700;
            font-size: 12px;
            font-weight: 600;
            margin-top: 10px;
        }

        .features-text {
            margin-top: 25px;
            font-size: 11px;
            opacity: 0.8;
            text-align: center;
            z-index: 1;
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                background:
                    linear-gradient(rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.95)),
                    url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?q=80&w=2073&auto=format&fit=crop') center/cover no-repeat;
            }

            .login-container {
                max-width: 400px;
                height: auto;
                flex-direction: column;
                margin: 20px;
            }

            .login-form-container {
                flex: 1;
                padding: 30px 25px;
            }

            .illustration-container {
                display: none;
            }
        }

        @media (min-width: 769px) and (max-width: 992px) {
            .login-container {
                max-width: 750px;
                height: 500px;
            }

            .login-form-container {
                padding: 30px 25px;
            }

            .illustration-container {
                padding: 30px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <!-- Left Panel - Login Form -->
        <div class="login-form-container">
            <div class="logo-admin">
                <div class="logo-icon">
                    <i class="fas fa-building"></i>
                </div>
                <div class="logo-text">RuangKu</div>
                <span class="admin-badge">ADMIN</span>
            </div>

            <div class="login-header">
                <h2>Selamat Datang Admin</h2>
                <p>Masuk ke dashboard untuk mengelola fasilitas desa</p>
            </div>

            @if (session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <i class="fas fa-exclamation-circle mr-2"></i> {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('login.store') }}" method="POST" id="loginForm">
                @csrf

                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope mr-2"></i>Email</label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" class="form-control" id="email" name="email"
                               placeholder="admin@desa.example" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password"><i class="fas fa-lock mr-2"></i>Password</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="Masukkan password" required>
                        <span class="password-toggle" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-login btn-block">
                    <i class="fas fa-sign-in-alt mr-2"></i> Masuk ke Dashboard
                </button>

                <div class="register-link">
                    Belum punya akun? Hubungi Super Admin untuk mendapatkan akses.
                </div>
            </form>
        </div>

        <!-- Right Panel - Illustration -->
        <div class="illustration-container">
            <h3 class="illustration-title">Sistem Pengelolaan Fasilitas Desa</h3>
            <p class="illustration-text">
                Kelola peminjaman balai, lapangan, dan fasilitas desa lainnya dengan mudah melalui dashboard admin.
                Pantau jadwal, persetujuan, dan data peminjaman secara real-time.
            </p>

            <!-- Icons for Facilities -->
            <div class="icons-container">
                <div class="icon-box">
                    <div class="icon-row">
                        <div class="icon-item">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="icon-item">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="icon-item">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="facilities-text">
                        <i class="fas fa-building mr-1"></i> Balai Desa
                        <i class="fas fa-futbol mx-2"></i> Lapangan
                        <i class="fas fa-warehouse ml-2"></i> Fasilitas Umum
                    </div>
                </div>
            </div>

            <div class="features-text">
                <i class="fas fa-shield-alt mr-1"></i> Sistem Terjamin |
                <i class="fas fa-clock mx-2"></i> 24/7 Akses |
                <i class="fas fa-chart-line ml-2"></i> Real-time Monitoring
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
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

            // Add focus effect to form inputs
            $('.form-control').focus(function() {
                $(this).parent().find('i').css('color', '#1A3D7C');
            }).blur(function() {
                $(this).parent().find('i').css('color', '#2D5BFF');
            });

            // Auto focus on email field if empty
            @if(!old('email'))
                $('#email').focus();
            @endif
        });
    </script>
</body>

</html>
