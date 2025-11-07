<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Selamat Datang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #00c6ff, #0072ff);
            color: white;
            text-align: center;
            padding-top: 150px;
        }
        h1 {
            font-size: 2.5em;
        }
        p {
            font-size: 1.2em;
        }
        a {
            display: inline-block;
            margin-top: 30px;
            background: white;
            color: #0072ff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s;
        }
        a:hover {
            background: #eb72d1ff;
        }
    </style>
</head>
<body>
    <h1>Selamat Datang, {{ $username }}!</h1>
    <p>Selamat anda berhasil login dengan username dan password sama 🎉</p>

    <a href="/auth">Kembali ke Login</a>
</body>
</html>
