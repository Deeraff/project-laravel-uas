<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-image: url('/foto/pink.jpg'); /* Ganti dengan path gambar latar belakang */
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Overlay transparansi untuk wallpaper */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7); /* Transparansi gelap untuk wallpaper */
            z-index: -1; /* Tetap di belakang konten */
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.5); /* Warna form tetap terang */
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(254, 119, 191, 4); /* Shadow pink */
            width: 100%;
            max-width: 500px;
            position: relative;
        }

        h1 {
            text-align: center;
            color: black;
            margin-bottom: 20px;
            font-size: 2rem;
        }

        label {
            font-size: 1rem;
            color: black;
            margin-bottom: 5px;
            display: block;
        }

        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease; /* Menambahkan transisi untuk efek perubahan */
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3); /* Bayangan standar */
        }

        /* Efek saat tombol dihover */
        button:hover {
            background-color: #0056b3; /* Mengubah warna latar belakang saat hover */
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.5); /* Menambahkan bayangan */
        }

        /* Efek saat tombol ditekan (active) */
        button:active {
            transform: scale(0.98); /* Memberikan efek tombol sedikit mengecil saat ditekan */
            box-shadow: 0 2px 5px rgba(0, 123, 255, 0.5); /* Mengubah bayangan saat tombol ditekan */
        }

        .links {
            text-align: center;
            margin-top: 15px;
        }

        .links a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        @if ($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
</body>
</html>
