<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Fasilitas Desa</title>


    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">


    <!-- Font Awesome 7 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    <style>
        body {
            background: url('{{ asset('assets-admin/images/bg-login.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: "Poppins", sans-serif;
        }




        .login-card {
            width: 420px;
            background: rgba(130, 192, 233, 0.72);
            backdrop-filter: blur(6px);
            border-radius: 14px;
            padding: 35px;
            box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.25);
            animation: fadeIn .5s ease-in-out;
        }


        .logo-app {
            text-align: center;
            margin-bottom: 10px;
        }


        .logo-app img {
            width: 60px;
            margin-bottom: 5px;
        }


        .input-group-text {
            background: #2F5DFE;
            color: white;
            border: none;
        }


        .btn-primary {
            background: #2F5DFE !important;
            border: none !important;
        }


        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }


            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>


<body>


    <div class="login-card">


        <div class="logo-app">
            <img src="https://cdn-icons-png.flaticon.com/512/684/684908.png">
            <h4 class="text-primary font-weight-bold">
                <i class="fa-solid fa-building-columns"></i> LOGIN ADMIN
            </h4>
            <p class="text-muted" style="font-size: 14px;">Fasilitas Desa Sistem ini dibuat untuk mempermudah pengelolaan data warga dan fasilitas umum di desa sehingga proses administrasi menjadi lebih efektif, tertata, dan mudah diakses.</p>
        </div>


        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif


        <form action="{{ route('login.store') }}" method="POST">
            @csrf


            <label>Email</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                </div>
                <input type="email" class="form-control" name="email" placeholder="Masukkan Email" required
                    autofocus>
            </div>


            <label>Password</label>
            <div class="input-group mb-4">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                </div>
                <input type="password" class="form-control" name="password" placeholder="Masukkan Password" required>
            </div>


            <button type="submit" class="btn btn-primary btn-block">
                <i class="fa-solid fa-right-to-bracket"></i> Login
            </button>
        </form>
    </div>


</body>


</html>
