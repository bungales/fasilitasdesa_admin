<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Login</title>
  <style>
    body {
      background: linear-gradient(to right, #4facfe, #f37cd3ff);
      font-family: 'Poppins', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .login-box {
      background: #fff;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
      width: 350px;
    }
    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
    }
    input {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 10px;
      border: 1px solid #ccc;
    }
    button {
      width: 100%;
      padding: 10px;
      background: #4facfe;
      color: white;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: 0.3s;
    }
    button:hover {
      background: #00c6ff;
    }
    .error {
      background: #ffe0e0;
      color: #d00000;
      padding: 8px;
      margin-bottom: 10px;
      border-radius: 8px;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h2>Login Page</h2>

    @if ($errors->any())
      <div class="error">
        @foreach ($errors->all() as $error)
          <div>{{ $error }}</div>
        @endforeach
      </div>
    @endif

    <form action="/auth/login" method="POST">
      @csrf
      <input type="text" name="username" placeholder="Masukkan Username" value="{{ old('username') }}">
      <input type="password" name="password" placeholder="Masukkan Password">
      <button type="submit">LOGIN</button>
    </form>
  </div>
</body>
</html>
