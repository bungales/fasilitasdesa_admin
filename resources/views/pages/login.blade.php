<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - RuangKu</title>
    <meta name="description" content="Sistem pengelolaan fasilitas desa. Login admin untuk mengelola peminjaman balai, lapangan, dan fasilitas desa lainnya.">

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
                linear-gradient(rgba(255, 255, 255, 0.96), rgba(255, 255, 255, 0.96)),
                url('https://images.unsplash.com/photo-1593113630400-ea4288922493?q=80&w=2070&auto=format&fit=crop') center/cover no-repeat,
                linear-gradient(135deg, #e8f4ff 0%, #d4e4ff 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            font-size: 14px;
        }

        .login-container {
            display: flex;
            width: 100%;
            max-width: 780px;
            height: 440px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.04);
        }

        /* Left Panel - Login Form */
        .login-form-container {
            flex: 0.85;
            padding: 22px 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: white;
        }

        /* Right Panel - Illustration */
        .illustration-container {
            flex: 1.15;
            background:
                linear-gradient(rgba(26, 61, 124, 0.86), rgba(45, 91, 255, 0.82)),
                url('https://images.unsplash.com/photo-1558618666-fcd25c85cd64?q=80&w=2070&auto=format&fit=crop') center/cover no-repeat;
            padding: 26px 22px;
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
            background: radial-gradient(circle at 70% 30%, rgba(255, 215, 0, 0.06) 0%, transparent 50%),
                        radial-gradient(circle at 30% 70%, rgba(255, 255, 255, 0.02) 0%, transparent 50%);
            top: 0;
            left: 0;
        }

        /* Logo dengan gambar dan teks besar */
        .logo-admin {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .logo-img {
            width: 55px;
            height: 55px;
            object-fit: contain;
            display: block;
            background-color: transparent;
            border-radius: 8px;
            border: 2px solid var(--accent-gold);
            padding: 3px;
        }

        /* Placeholder jika gambar tidak ditemukan */
        .logo-placeholder {
            width: 55px;
            height: 55px;
            background: linear-gradient(135deg, #1A3D7C 0%, #2D5BFF 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 20px;
            border: 2px solid var(--accent-gold);
        }

        .logo-text-container {
            display: flex;
            flex-direction: column;
        }

        .logo-text {
            font-size: 26px;
            font-weight: 800;
            color: var(--primary-blue);
            line-height: 1;
            margin-bottom: 3px;
        }

        .admin-badge {
            display: inline-block;
            background: var(--accent-gold);
            color: var(--primary-blue);
            font-size: 9px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 10px;
            align-self: flex-start;
            box-shadow: 0 1px 3px rgba(255, 215, 0, 0.18);
        }

        .login-header {
            margin-bottom: 14px;
            padding: 0 1px;
        }

        .login-header h2 {
            color: var(--primary-blue);
            font-weight: 600;
            margin-bottom: 2px;
            font-size: 16px;
            padding: 1px 0;
        }

        .login-header p {
            color: #666;
            font-size: 11px;
            line-height: 1.3;
            padding: 0;
        }

        .form-group {
            margin-bottom: 12px;
            padding: 0 1px;
        }

        .form-group label {
            color: var(--primary-blue);
            font-weight: 500;
            font-size: 11.5px;
            margin-bottom: 3px;
            display: flex;
            align-items: center;
            padding: 0;
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon i {
            position: absolute;
            left: 9px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary-blue);
            z-index: 2;
            font-size: 11.5px;
        }

        .form-control {
            height: 38px;
            border: 1.1px solid #e6ebff;
            border-radius: 6px;
            padding-left: 32px;
            font-size: 12px;
            transition: all 0.2s;
            background: rgba(248, 250, 255, 0.9);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.02);
        }

        .form-control:focus {
            border-color: var(--secondary-blue);
            box-shadow: 0 0 0 1.5px rgba(45, 91, 255, 0.08);
            background: white;
        }

        .btn-login {
            background: var(--secondary-blue);
            border: none;
            height: 38px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 12.5px;
            letter-spacing: 0.1px;
            transition: all 0.2s;
            margin-top: 4px;
            box-shadow: 0 2px 6px rgba(45, 91, 255, 0.18);
            padding: 0;
        }

        .btn-login:hover {
            background: var(--primary-blue);
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(26, 61, 124, 0.2);
        }

        /* Tombol Masuk ke Dashboard */
        .btn-login-text {
            font-size: 11.5px;
        }

        .password-toggle {
            position: absolute;
            right: 9px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            cursor: pointer;
            z-index: 3;
            font-size: 11.5px;
            padding: 2px;
        }

        .password-toggle:hover {
            color: var(--secondary-blue);
        }

        .illustration-title {
            font-size: 17px;
            font-weight: 600;
            margin-bottom: 7px;
            z-index: 1;
            text-align: center;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.15);
            padding: 1px 6px;
        }

        .illustration-text {
            font-size: 11px;
            text-align: center;
            margin-bottom: 18px;
            z-index: 1;
            max-width: 320px;
            line-height: 1.4;
            opacity: 0.88;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.08);
            padding: 0 8px;
        }

        /* Register Section */
        .register-option {
            text-align: center;
            margin-top: 16px;
            padding-top: 14px;
            border-top: 1px solid #eee;
        }

        .register-title {
            font-size: 11.5px;
            color: #666;
            margin-bottom: 8px;
            font-weight: 500;
            padding: 0;
        }

        .btn-register {
            background: transparent;
            border: 1.3px solid var(--secondary-blue);
            color: var(--secondary-blue);
            height: 34px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 12px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            width: 100%;
            padding: 0;
        }

        .btn-register:hover {
            background: var(--secondary-blue);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(45, 91, 255, 0.18);
            text-decoration: none;
        }

        .admin-note {
            text-align: center;
            margin-top: 8px;
            font-size: 9.5px;
            color: #888;
            padding: 0;
            line-height: 1.2;
        }

        .alert {
            border-radius: 6px;
            border: none;
            margin-bottom: 12px;
            padding: 7px 10px;
            font-size: 11px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }

        .alert i {
            font-size: 11.5px;
        }

        /* Icons Container */
        .icons-container {
            width: 100%;
            max-width: 280px;
            text-align: center;
            z-index: 1;
            margin-bottom: 14px;
            padding: 0 6px;
        }

        .icon-box {
            background: rgba(255, 255, 255, 0.06);
            padding: 14px;
            border-radius: 8px;
            backdrop-filter: blur(2px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .icon-row {
            display: flex;
            justify-content: center;
            gap: 14px;
            margin-bottom: 9px;
        }

        .icon-item {
            background: rgba(255, 255, 255, 0.14);
            width: 48px;
            height: 48px;
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            padding: 2px;
        }

        .icon-item:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .icon-item i {
            font-size: 19px;
            color: #FFD700;
        }

        .facilities-text {
            color: #FFD700;
            font-size: 10px;
            font-weight: 600;
            margin-top: 6px;
            padding: 0;
            line-height: 1.2;
        }

        .features-text {
            margin-top: 16px;
            font-size: 9.5px;
            opacity: 0.7;
            text-align: center;
            z-index: 1;
            color: white;
            padding: 0 8px;
            line-height: 1.2;
        }

        /* Footer Credits */
        .footer-credits {
            position: fixed;
            bottom: 10px;
            right: 15px;
            font-size: 10px;
            color: #666;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.8);
            padding: 4px 8px;
            border-radius: 4px;
            backdrop-filter: blur(5px);
        }

        .footer-credits a {
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 500;
        }

        .footer-credits a:hover {
            color: var(--secondary-blue);
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 6px;
                font-size: 13px;
                background:
                    linear-gradient(rgba(255, 255, 255, 0.98), rgba(255, 255, 255, 0.98)),
                    url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?q=80&w=2073&auto=format&fit=crop') center/cover no-repeat;
            }

            .login-container {
                max-width: 340px;
                height: auto;
                flex-direction: column;
                margin: 10px;
            }

            .login-form-container {
                flex: 1;
                padding: 20px 18px;
            }

            .logo-admin {
                flex-direction: column;
                text-align: center;
                gap: 8px;
            }

            .logo-img {
                width: 50px;
                height: 50px;
            }

            .logo-placeholder {
                width: 50px;
                height: 50px;
                font-size: 18px;
            }

            .logo-text {
                font-size: 24px;
            }

            .logo-text-container {
                align-items: center;
            }

            .illustration-container {
                display: none;
            }

            .register-option {
                margin-top: 14px;
                padding-top: 12px;
            }

            /* Optimasi untuk mobile */
            .login-form-container input,
            .login-form-container select,
            .login-form-container textarea {
                font-size: 16px !important;
            }

            .btn-login, .btn-register {
                min-height: 44px;
            }

            .footer-credits {
                bottom: 5px;
                right: 5px;
                font-size: 9px;
                padding: 3px 6px;
            }
        }

        @media (min-width: 769px) and (max-width: 992px) {
            .login-container {
                max-width: 650px;
                height: 420px;
            }

            .login-form-container {
                padding: 20px 18px;
            }

            .illustration-container {
                padding: 22px 18px;
            }

            .logo-img {
                width: 50px;
                height: 50px;
            }

            .logo-text {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <!-- Left Panel - Login Form -->
        <div class="login-form-container">
            <!-- Logo dengan gambar dan teks RUANGKU besar -->
            <div class="logo-admin">
                <!-- COBA SEMUA KEMUNGKINAN PATH UNTUK LOGO -->
                <!-- Pilih salah satu yang berhasil -->

                <!-- Option 1: Path relatif dari assets-admin -->
                <img src="images/Hijau Kuning Moden KKN Logo.png" class="logo-img" alt="RuangKu Logo" id="logoImage">

                <!-- Option 2: Jika tidak ditemukan, gunakan placeholder -->
                <!-- <div class="logo-placeholder" id="logoPlaceholder">RK</div> -->

                <div class="logo-text-container">
                    <div class="logo-text">RuangKu</div>
                    <span class="admin-badge">ADMIN</span>
                </div>
            </div>

            <div class="login-header">
                <h2>Selamat Datang Admin</h2>
                <p>Masuk ke dashboard untuk mengelola fasilitas desa</p>
            </div>

            <!-- Jika menggunakan Laravel Blade -->
            @if (session('error'))
                <div class="alert alert-danger" role="alert" aria-live="assertive">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success" role="alert" aria-live="polite">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger" role="alert" aria-live="assertive">
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
                               placeholder="admin@desa.example" value="{{ old('email') }}"
                               required autofocus pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                               title="Masukkan alamat email yang valid">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password"><i class="fas fa-lock mr-2"></i>Password</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="Masukkan password" required minlength="6"
                               title="Password minimal 6 karakter">
                        <span class="password-toggle" id="togglePassword" role="button"
                              aria-label="Tampilkan/sembunyikan password" tabindex="0">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-login btn-block" id="submitBtn">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    <span class="btn-login-text">Masuk ke Dashboard</span>
                </button>

                <!-- Register Option -->
                <div class="register-option">
                    <div class="register-title">Belum punya akun?</div>
                    <a href="{{ route('user.create') }}" class="btn btn-register">
                        <i class="fas fa-user-plus mr-2"></i> Buat Akun Baru
                    </a>
                    <div class="admin-note">
                        <i class="fas fa-info-circle mr-1"></i> Akun baru akan diverifikasi oleh Super Admin
                    </div>
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

    <!-- Footer Credits -->
    <div class="footer-credits">
        <i class="fas fa-code"></i> Sistem Pengelolaan Fasilitas Desa <strong>RuangKu</strong> |
        <i class="fas fa-user-shield"></i> Admin Panel
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            console.log("=== SISTEM RUANGKU - ADMIN LOGIN ===");

            // ========== LOGO HANDLING ==========
            const logoImage = $('#logoImage');
            const logoPaths = [
                'images/Hijau Kuning Moden KKN Logo.png',
                './images/Hijau Kuning Moden KKN Logo.png',
                'Hijau Kuning Moden KKN Logo.png',
                '../assets-admin/images/Hijau Kuning Moden KKN Logo.png',
                'assets-admin/images/Hijau Kuning Moden KKN Logo.png'
            ];

            let currentPathIndex = 0;

            // Fungsi untuk coba path berikutnya
            function tryNextLogoPath() {
                if (currentPathIndex < logoPaths.length) {
                    const newPath = logoPaths[currentPathIndex];
                    console.log('Mencoba path logo:', newPath);
                    logoImage.attr('src', newPath);
                    currentPathIndex++;
                } else {
                    console.log('Semua path dicoba, menggunakan placeholder');
                    // Ganti dengan placeholder yang bagus
                    logoImage.replaceWith('<div class="logo-placeholder">RK</div>');
                }
            }

            // Cek jika gambar error
            logoImage.on('error', function() {
                console.log('Logo tidak ditemukan di path:', $(this).attr('src'));
                tryNextLogoPath();
            });

            // Jika berhasil load
            logoImage.on('load', function() {
                console.log('✅ Logo berhasil dimuat dari:', $(this).attr('src'));
            });

            // ========== TOGGLE PASSWORD ==========
            $('#togglePassword').click(function() {
                const passwordInput = $('#password');
                const icon = $(this).find('i');

                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                    $(this).attr('aria-label', 'Sembunyikan password');
                } else {
                    passwordInput.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                    $(this).attr('aria-label', 'Tampilkan password');
                }
            });

            // Enter key support for password toggle
            $('#togglePassword').keypress(function(e) {
                if (e.which === 13 || e.which === 32) {
                    $(this).click();
                    e.preventDefault();
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

            // Loading state untuk tombol login
            $('#loginForm').submit(function() {
                const submitBtn = $('#submitBtn');
                submitBtn.prop('disabled', true);
                submitBtn.html('<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...');
            });

            // Validasi form client-side
            $('#loginForm').on('submit', function(e) {
                const email = $('#email').val();
                const password = $('#password').val();

                // Validasi email pattern
                const emailPattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i;
                if (!emailPattern.test(email)) {
                    e.preventDefault();
                    alert('Masukkan alamat email yang valid');
                    $('#email').focus();
                    return false;
                }

                // Validasi panjang password
                if (password.length < 6) {
                    e.preventDefault();
                    alert('Password minimal 6 karakter');
                    $('#password').focus();
                    return false;
                }

                return true;
            });

            // Console greeting
            console.log('%c🔐 RUANGKU ADMIN PANEL 🔐', 'color: #1A3D7C; font-size: 14px; font-weight: bold;');
            console.log('%cSistem Pengelolaan Fasilitas Desa', 'color: #2D5BFF;');
            console.log('===================================');
        });
    </script>
</body>
</html>
