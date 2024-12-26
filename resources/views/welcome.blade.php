<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kedai Expo</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Mengatur posisi tombol Login as Admin di kanan atas */
        .login-admin {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        /* Menambahkan beberapa desain untuk halaman */
        body {
            font-family: Arial, sans-serif;
            background-image: url('/foto/pink.jpg'); /* Ganti dengan path wallpaper Anda */
            background-size: cover; /* Mengatur agar gambar menutupi seluruh latar belakang */
            background-position: center; /* Memusatkan gambar */
            background-attachment: fixed; /* Gambar latar belakang tetap saat scroll */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh; /* Mengatur tinggi body agar memenuhi viewport */
        }

        .container {
            text-align: center;
            margin-top: 100px;
            background-color: rgba(0, 0, 0, 0.7); /* Mengubah transparansi menjadi warna hitam */
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 8px 20px rgba(254, 119, 191, 4); /* Shadow pink */
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        h1 {
            color: white;
            font-size: 3rem;
        }

        h2 {
            color: white;
        }

        .btn {
            padding: 10px 20px;
            font-size: 1rem;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #343a40;
        }

        /* Gaya untuk latar belakang logo */
        .logo-container {
            background-color: white; /* Latar belakang putih */
            border-radius: 10px; /* Sudut membulat */
            padding: 10px; /* Ruang di sekitar logo */
            display: inline-block; /* Agar ukuran sesuai dengan konten */
            margin-bottom: 20px; /* Jarak di bawah logo */
        }

        .logo-container img {
            max-width: 100%; /* Memastikan logo tidak melebihi lebar kontainer */
            height: auto; /* Mempertahankan rasio aspek */
        }

        /* Bagian Detail Toko/Outlet */
        .store-details {
            text-align: center;
            background-color: rgba(0, 0, 0, 0.7); /* Latar belakang lebih gelap */
            color: white;
            padding: 40px;
            margin-top: 140px;
            border-radius: 10px;
            max-width: 1000px;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .store-details h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .store-details p {
            font-size: 1.1rem;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .store-details .btn-contact {
            background-color: #28a745;
            color: white;
        }

        .store-details .btn-contact:hover {
            background-color: #218838;
        }

        /* Responsive Styling */
        @media (max-width: 768px) {
            .container {
                margin-top: 60px;
                padding: 20px;
            }

            .store-details {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Tombol Login as Admin di kanan atas -->
    <a href="{{ route('login') }}" class="btn btn-secondary login-admin">Login as Admin</a>

    <!-- Konten utama -->
    <div class="container">
        <div class="logo-container">
            <img src="/foto/expo.png" alt="Kedai Expo Logo">
        </div>
        <h1>Selamat Datang di Kedai Expo</h1>
        <h2>Silahkan pilih Makanan/Minuman Favorit Anda</h2>
        <div class="mt-4">
            <a href="{{ route('customer.index') }}" class="btn btn-primary">Masuk</a>
        </div>
    </div>
    <!-- Landing Page - Detail Toko/Outlet -->
    <div class="store-details">
        <h2>Tentang Kedai Expo</h2>
        <p>Kedai Expo Kediri adalah restoran yang menawarkan produk makanan dan minuman dengan kualitas bintang 5. Dengan luas area sekitar 5.000 m2, kedai ini menampilkan berbagai produk makanan dan minuman yang bervariasi.</p>
        
        <h3>Alamat Toko</h3>
        <p>Jl. Penanggungan No.33, Bandar Lor, Kec. Mojoroto, Kediri, Jawa Timur 64114</p>

        <h3>Jam Operasional</h3>
        <p>Senin - Jumat: 09:00 AM - 09:00 PM</p>
        <p>Sabtu - Minggu: 10:00 AM - 10:00 PM</p>

        <h3>Hubungi Kami</h3>
        <p>Telepon: +62 812-3456-7890</p>
        <p>Email: qwertyzeed12@gmail.com</p>

        <a href="mailto:qwertyzeed12@gmail.com" class="btn btn-contact">Hubungi Kami</a>
    </div>

</body>
</html>
