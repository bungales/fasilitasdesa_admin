<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RuangKu - Login Admin</title>
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
            --success-green: #28a745;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.95)),
                        url('https://images.unsplash.com/photo-1593113630400-ea4288922493?q=80&w=2070&auto=format&fit=crop') center/cover no-repeat;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px;
            margin: 0;
        }

        .login-container {
            width: 100%;
            max-width: 800px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            display: flex;
            min-height: 460px;
        }

        /* Login Form Section */
        .login-form-section {
            flex: 0.85;
            padding: 30px;
            display: flex;
            flex-direction: column;
        }

        /* Logo Container - Diperbaiki */
        .logo-container {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            gap: 12px;
        }

        .logo-img {
            width: 70px; /* Diperbesar */
            height: 70px; /* Diperbesar */
            object-fit: contain; /* Pastikan gambar tidak terdistorsi */
            border-radius: 8px;
            border: 2px solid var(--accent-gold);
            background: white;
            padding: 5px;
            display: block; /* Pastikan display block */
        }

        .logo-placeholder {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #1A3D7C 0%, #2D5BFF 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 24px;
            border-radius: 8px;
            border: 2px solid var(--accent-gold);
        }

        .logo-text {
            font-size: 32px; /* Diperbesar */
            font-weight: 800;
            color: var(--primary-blue);
            line-height: 1;
            margin-bottom: 5px;
        }

        .admin-badge {
            background: var(--accent-gold);
            color: var(--primary-blue);
            font-size: 12px; /* Diperbesar */
            font-weight: 700;
            padding: 4px 12px; /* Diperbesar */
            border-radius: 12px;
            display: inline-block;
        }

        /* Header */
        .welcome-header {
            margin-bottom: 20px;
        }

        .welcome-header h1 {
            font-size: 20px; /* Diperbesar */
            color: var(--primary-blue);
            font-weight: 600;
            margin-bottom: 5px;
        }

        .welcome-header p {
            font-size: 13px; /* Diperbesar */
            color: #666;
            margin: 0;
        }

        /* Notifications */
        .logout-success {
            background: linear-gradient(to right, #d4edda, #c3e6cb);
            border: 1px solid #b1d8b7;
            color: #155724;
            padding: 12px 15px; /* Diperbesar */
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 13px; /* Diperbesar */
            display: flex;
            align-items: center;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from { transform: translateY(-10px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .logout-success i {
            color: var(--success-green);
            margin-right: 8px;
            font-size: 16px; /* Diperbesar */
        }

        /* Form */
        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            font-size: 13px; /* Diperbesar */
            color: var(--primary-blue);
            font-weight: 500;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
        }

        .form-label i {
            margin-right: 6px;
            font-size: 12px; /* Diperbesar */
        }

        .input-group-custom {
            position: relative;
        }

        .input-group-custom i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary-blue);
            font-size: 13px; /* Diperbesar */
            z-index: 2;
        }

        .form-control-custom {
            width: 100%;
            height: 44px; /* Diperbesar */
            padding: 0 12px 0 40px; /* Diperbesar */
            border: 1.5px solid #e0e7ff;
            border-radius: 6px;
            font-size: 14px; /* Diperbesar */
            color: #333;
            background: #f8faff;
            transition: all 0.3s;
        }

        .form-control-custom:focus {
            border-color: var(--secondary-blue);
            box-shadow: 0 0 0 3px rgba(45, 91, 255, 0.1);
            background: white;
            outline: none;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            cursor: pointer;
            font-size: 13px; /* Diperbesar */
            background: none;
            border: none;
            padding: 0;
            z-index: 3;
        }

        /* Login Button */
        .login-btn {
            width: 100%;
            height: 44px; /* Diperbesar */
            background: linear-gradient(135deg, var(--secondary-blue), var(--primary-blue));
            border: none;
            border-radius: 6px;
            color: white;
            font-weight: 600;
            font-size: 14px; /* Diperbesar */
            margin-top: 10px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(45, 91, 255, 0.2);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        /* Register Section */
        .register-section {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .register-text {
            font-size: 13px; /* Diperbesar */
            color: #666;
            margin-bottom: 10px;
        }

        .register-btn {
            display: block;
            width: 100%;
            height: 40px; /* Diperbesar */
            background: transparent;
            border: 2px solid var(--secondary-blue);
            border-radius: 6px;
            color: var(--secondary-blue);
            font-weight: 600;
            font-size: 13px; /* Diperbesar */
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .register-btn:hover {
            background: var(--secondary-blue);
            color: white;
            text-decoration: none;
        }

        .admin-note {
            font-size: 11px; /* Diperbesar */
            color: #888;
            margin-top: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        /* Illustration Section */
        .illustration-section {
            flex: 1.15;
            background: linear-gradient(rgba(26, 61, 124, 0.9), rgba(45, 91, 255, 0.85)),
                        url('https://images.unsplash.com/photo-1558618666-fcd25c85cd64?q=80&w=2070&auto=format&fit=crop') center/cover;
            padding: 30px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
        }

        .illustration-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 80%, rgba(255, 215, 0, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        .system-title {
            font-size: 22px; /* Diperbesar */
            font-weight: 600;
            margin-bottom: 10px;
            z-index: 1;
        }

        .system-description {
            font-size: 13px; /* Diperbesar */
            line-height: 1.5;
            max-width: 350px;
            margin-bottom: 25px;
            opacity: 0.9;
            z-index: 1;
        }

        /* Facilities Icons */
        .facilities-icons {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            z-index: 1;
        }

        .facility-icon {
            width: 55px; /* Diperbesar */
            height: 55px; /* Diperbesar */
            background: rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px; /* Diperbesar */
            color: var(--accent-gold);
            transition: all 0.3s;
        }

        .facility-icon:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-3px);
        }

        .facilities-names {
            font-size: 12px; /* Diperbesar */
            color: var(--accent-gold);
            font-weight: 600;
            margin-bottom: 20px;
            z-index: 1;
        }

        .features {
            font-size: 12px; /* Diperbesar */
            color: rgba(255, 255, 255, 0.85);
            z-index: 1;
            display: flex;
            gap: 15px;
        }

        .features span {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Footer */
        .footer-credits {
            position: fixed;
            bottom: 10px;
            right: 15px;
            font-size: 11px; /* Diperbesar */
            color: #666;
            background: rgba(255, 255, 255, 0.9);
            padding: 6px 12px; /* Diperbesar */
            border-radius: 4px;
            backdrop-filter: blur(5px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 10px;
                background: #f8faff;
            }

            .login-container {
                flex-direction: column;
                max-width: 400px;
            }

            .illustration-section {
                display: none;
            }

            .login-form-section {
                padding: 25px;
            }

            .logo-container {
                justify-content: center;
                flex-direction: column;
                text-align: center;
            }

            .logo-img {
                width: 80px;
                height: 80px;
            }

            .logo-placeholder {
                width: 80px;
                height: 80px;
                font-size: 28px;
            }

            .logo-text {
                font-size: 28px;
            }

            .footer-credits {
                position: static;
                margin-top: 20px;
                text-align: center;
                background: transparent;
            }
        }

        @media (max-width: 480px) {
            .login-form-section {
                padding: 20px;
            }

            .logo-text {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Login Form Section -->
        <div class="login-form-section">
            <!-- Logo -->
            <div class="logo-container">
                <!-- LOGO dengan absolute path untuk testing -->
                <img src="/images/Hijau%20Kuning%20Moden%20KKN%20Logo.png"
                     class="logo-img"
                     alt="RuangKu Logo"
                     id="logoImage"
                     onerror="handleLogoError(this)">
                <div>
                    <div class="logo-text">RuangKu</div>
                    <span class="admin-badge">ADMIN</span>
                </div>
            </div>

            <!-- Welcome Header -->
            <div class="welcome-header">
                <h1>Selamat Datang Admin</h1>
                <p>Masuk ke dashboard untuk mengelola fasilitas desa</p>
            </div>

            <!-- Logout Success Notification -->
            @if (session('logout'))
                <div class="logout-success">
                    <i class="fas fa-check-circle"></i>
                    <span>Berhasil Logout - Anda telah keluar dari sistem</span>
                </div>
            @endif

            <!-- Other Notifications -->
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        <i class="fas fa-exclamation-circle mr-2"></i> {{ $error }}<br>
                    @endforeach
                </div>
            @endif


            <form action="{{ route('login.store') }}" method="POST" id="loginForm">
                @csrf


                <div class="form-group">
                    <label class="form-label" for="email">
                        <i class="fas fa-envelope"></i> Email
                    </label>
                    <div class="input-group-custom">
                        <i class="fas fa-envelope"></i>
                        <input type="email"
                               class="form-control-custom"
                               id="email"
                               name="email"
                               placeholder="admin@desa.example"
                               value="{{ old('email') }}"
                               required
                               autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">
                        <i class="fas fa-lock"></i> Password
                    </label>
                    <div class="input-group-custom">
                        <i class="fas fa-lock"></i>
                        <input type="password"
                               class="form-control-custom"
                               id="password"
                               name="password"
                               placeholder="Masukkan password"
                               required
                               minlength="6">
                        <button type="button" class="password-toggle" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Login Button -->
                <button type="submit" class="login-btn" id="submitBtn">
                    <i class="fas fa-sign-in-alt"></i>
                    Masuk ke Dashboard
                </button>
            </form>

            <!-- Register Section -->
            <div class="register-section">
                <div class="register-text">Belum punya akun?</div>
                <a href="{{ route('user.create') }}" class="register-btn">
                    <i class="fas fa-user-plus"></i> Buat Akun Baru
                </a>
                <div class="admin-note">
                    <i class="fas fa-info-circle"></i>
                    Akun baru akan diverifikasi oleh Super Admin
                </div>
            </div>
        </div>

        <!-- Illustration Section -->
        <div class="illustration-section">
            <h2 class="system-title">Sistem Pengelolaan Fasilitas Desa</h2>
            <p class="system-description">
                Kelola peminjaman balai, lapangan, dan fasilitas desa lainnya dengan mudah melalui dashboard admin.
                Pantau jadwal, persetujuan, dan data peminjaman secara real-time.
            </p>

            <!-- Facilities Icons -->
            <div class="facilities-icons">
                <div class="facility-icon">
                    <i class="fas fa-home"></i>
                </div>
                <div class="facility-icon">
                    <i class="fas fa-futbol"></i>
                </div>
                <div class="facility-icon">
                    <i class="fas fa-warehouse"></i>
                </div>
            </div>

            <div class="facilities-names">
                <i class="fas fa-building"></i> Balai Desa •
                <i class="fas fa-futbol"></i> Lapangan •
                <i class="fas fa-warehouse"></i> Fasilitas Umum
            </div>

            <div class="features">
                <span><i class="fas fa-shield-alt"></i> Sistem Terjamin</span>
                <span><i class="fas fa-clock"></i> 24/7 Akses</span>
                <span><i class="fas fa-chart-line"></i> Real-time Monitoring</span>
            </div>
        </div>
    </div>

    <!-- Footer Credits -->
    <div class="footer-credits">
        <i class="fas fa-code"></i> Sistem Pengelolaan Fasilitas Desa <strong>RuangKu</strong> |
        <i class="fas fa-user-shield"></i> Admin Panel
    </div>

    <!-- Bootstrap & jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Fungsi untuk menangani error logo
        function handleLogoError(img) {
            console.log('Logo tidak ditemukan di path:', img.src);

            // Daftar path alternatif untuk dicoba
            const logoPaths = [
                'images/Hijau Kuning Moden KKN Logo.png',
                './images/Hijau Kuning Moden KKN Logo.png',
                '../images/Hijau Kuning Moden KKN Logo.png',
                '../../images/Hijau Kuning Moden KKN Logo.png',
                'assets/images/Hijau Kuning Moden KKN Logo.png',
                'assets-admin/images/Hijau Kuning Moden KKN Logo.png',
                'public/images/Hijau Kuning Moden KKN Logo.png',
                '/public/images/Hijau Kuning Moden KKN Logo.png'
            ];

            // Coba path berikutnya jika ada
            if (window.currentLogoPathIndex === undefined) {
                window.currentLogoPathIndex = 0;
            }

            if (window.currentLogoPathIndex < logoPaths.length) {
                img.src = logoPaths[window.currentLogoPathIndex];
                window.currentLogoPathIndex++;
                console.log('Mencoba path baru:', img.src);
            } else {
                // Jika semua path gagal, gunakan placeholder
                console.log('Semua path gagal, menggunakan placeholder');
                const placeholder = document.createElement('div');
                placeholder.className = 'logo-placeholder';
                placeholder.textContent = 'RK';
                placeholder.style.cssText = 'width:70px;height:70px;background:linear-gradient(135deg,#1A3D7C,#2D5BFF);color:white;display:flex;align-items:center;justify-content:center;font-weight:bold;font-size:24px;border-radius:8px;border:2px solid #FFD700;';
                img.parentNode.replaceChild(placeholder, img);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            console.log('=== RuangKu Admin Login Loaded ===');

            // Password toggle
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');

            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);

                    const icon = this.querySelector('i');
                    if (type === 'text') {
                        icon.className = 'fas fa-eye-slash';
                        this.setAttribute('aria-label', 'Sembunyikan password');
                    } else {
                        icon.className = 'fas fa-eye';
                        this.setAttribute('aria-label', 'Tampilkan password');
                    }
                });
            }

            // Auto-hide logout message after 5 seconds
            const logoutMessage = document.querySelector('.logout-success');
            if (logoutMessage) {
                setTimeout(() => {
                    logoutMessage.style.opacity = '0';
                    logoutMessage.style.transform = 'translateY(-10px)';
                    setTimeout(() => {
                        logoutMessage.style.display = 'none';
                    }, 300);
                }, 5000);
            }

            // Form validation
            const loginForm = document.getElementById('loginForm');
            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    const email = document.getElementById('email').value;
                    const password = document.getElementById('password').value;
                    const submitBtn = document.getElementById('submitBtn');

                    // Simple validation
                    if (!email || !password) {
                        e.preventDefault();
                        alert('Email dan password harus diisi');
                        return false;
                    }

                    if (password.length < 6) {
                        e.preventDefault();
                        alert('Password minimal 6 karakter');
                        return false;
                    }

                    // Show loading state
                    if (submitBtn) {
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
                        submitBtn.disabled = true;
                    }

                    return true;
                });
            }

            // Auto-focus email field if empty
            const emailField = document.getElementById('email');
            if (emailField && !emailField.value) {
                emailField.focus();
            }

            // Debug info untuk logo
            const logoImage = document.getElementById('logoImage');
            if (logoImage) {
                console.log('Logo src awal:', logoImage.src);
                logoImage.onload = function() {
                    console.log('✅ Logo berhasil dimuat dari:', this.src);
                };
            }
        });
    </script>
</body>
</html>
