@extends('layouts.app')

@section('content')
<style>
    /* Responsive design */
    @media (max-width: 768px) {
        h1 {
            font-size: 32px; /* Ukuran font lebih kecil untuk layar kecil */
        }

        h2 {
            font-size: 24px;
        }

        .profile-info {
            text-align: center; /* Pusatkan profil pada perangkat kecil */
        }

        .profile-info img {
            width: 100px; /* Gambar profil lebih kecil */
            height: 100px;
        }

        .card {
            margin-bottom: 15px;
        }

        .card-body {
            padding: 15px;
        }

        .card-title {
            font-size: 1.2rem; /* Ukuran font judul lebih kecil */
        }

        .card-text {
            font-size: 1rem; /* Ukuran teks deskripsi lebih kecil */
        }

        .table-responsive {
            overflow-x: auto; /* Tabel dapat digeser jika tidak muat */
        }

        .form-update-profile {
            align-items: center; /* Pusatkan form pada perangkat kecil */
        }

        .btn {
            width: 100%; /* Tombol memenuhi lebar layar */
            margin-bottom: 10px; /* Jarak antar tombol */
        }
    }

    @media (max-width: 576px) {
        .row > .col-md-4 {
            flex: 0 0 100%; /* Setiap card menjadi 1 baris */
            max-width: 100%;
        }

        .profile-info h2,
        .profile-info p {
            font-size: 16px;
        }

        td img {
            max-width: 80px; /* Gambar produk lebih kecil */
        }
    }
    /* Styling for the overall dashboard */
    h1 {
        font-weight: bold;
        font-size: 64px;
        color: #333;
        text-align: center;
    }

    h2 {
        font-weight: bold;
        color: #333;
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 20px;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .rounded-circle {
        object-fit: cover;
    }

    .card-body {
        padding: 20px;
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .card-text {
        font-size: 1.2rem;
        color: #555;
    }

    /* Button Styling */
    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    .btn-info {
        background-color: pink;
        border: none;
    }

    .btn-info:hover {
        background-color: rgb(244, 134, 152);
    }

    /* Table Styling */
    table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
    }

    th, td {
        padding: 10px;
        text-align: center;
        border: 1px solid white; /* Set border color to white */
    }

    th {
        background-color: #ff66b2; /* Pink background for table header */
        color: white; /* White text for header */
    }

    td {
        background-color: #ffe6f0; /* Light pink background for table cells */
    }

    td img {
        max-width: 100px;
        object-fit: cover;
    }

    .alert {
        margin-top: 20px;
        font-size: 1rem;
    }

    .status-available {
        color: #28a745;
        font-weight: bold;
    }

    .status-unavailable {
        color: #dc3545;
        font-weight: bold;
    }

    /* New styles for header */
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .profile-info {
        text-align: right;
    }

    .profile-info h2, .profile-info p {
        margin: 0;
        margin-top: 10px;
    }

    /* Styling for the form container */
    .form-update-profile {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        width: 100%;
    }

    .form-update-profile .form-group {
        margin-bottom: 10px;
    }

    /* Hide the actual file input */
    #profile_picture {
        display: none;
    }

    /* Styling for clickable profile image */
    .clickable-profile-pic {
        cursor: pointer;
        transition: transform 0.2s ease;
    }

    .clickable-profile-pic:hover {
        transform: scale(1.05);
    }
    .d-flex.flex-column {
    gap: 10px; /* Jarak antar elemen */
    }

    .btn-sm {
        width: 100px; /* Atur lebar tombol */
        text-align: center; /* Pastikan teks berada di tengah */
    }

    .btn-info {
        width: 100%; /* Atur lebar tombol */
        text-align: center; /* Pastikan teks berada di tengah */
    }


    .card-header {
        background-color: pink;
    }

</style>

<div class="container mt-5" style="background-color: #fdd2e3; padding: 20px; border-radius: 10px;">
    <div class="card shadow-sm">
        <div class="card-header bg-light text-center" style="background-color: #ff85a2; color: white;">
            <h1>Dashboard Admin</h1>
        </div>
        <div class="card-body text-center">
            {{-- Foto Profil --}}
            @if(Auth::user()->profile_picture)
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) . '?' . time() }}" 
                    alt="Profile Picture" 
                    class="rounded-circle mb-3" 
                    id="profile-pic" 
                    style="width: 200px; height: 200px; object-fit: cover;">
            @else
                <div class="placeholder-profile mb-3" 
                    style="width: 150px; height: 150px; border-radius: 50%; background: #ddd; display: inline-block;">
                    <span class="d-flex justify-content-center align-items-center h-100 text-muted">No Image</span>
                </div>
            @endif

            {{-- Informasi Admin --}}
            <h2 class="mb-1">Selamat Datang, {{ Auth::user()->name }}</h2>
            <p class="text-muted">Role: {{ Auth::user()->role }}</p>

            {{-- Form Upload Foto --}}
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                @csrf
                <div class="form-group">
                    <label for="profile_picture" class="form-label">Unggah Foto Profil</label>
                    <input type="file" name="profile_picture" class="form-control-file" id="profile_picture">
                </div>
                <button type="submit" class="btn btn-success btn-sm mt-2">Simpan Foto</button>
            </form>
        </div>
    </div>

    {{-- Statistik Penjualan --}}
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Penjualan Hari Ini</h5>
                    <p class="card-text">Rp {{ number_format($daily, 0, ',', '.') }}</p>
                    <a href="{{ route('transactions.show', 'daily') }}" class="btn btn-info">Lihat Detail</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Penjualan Minggu Ini</h5>
                    <p class="card-text">Rp {{ number_format($weekly, 0, ',', '.') }}</p>
                    <a href="{{ route('transactions.show', 'weekly') }}" class="btn btn-info">Lihat Detail</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Penjualan Bulan Ini</h5>
                    <p class="card-text">Rp {{ number_format($monthly, 0, ',', '.') }}</p>
                    <a href="{{ route('transactions.show', 'monthly') }}" class="btn btn-info">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5">
        <h2>Statistik Penjualan</h2>
        <canvas id="salesChart" width="400" height="200"></canvas>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('salesChart').getContext('2d');
            const salesChart = new Chart(ctx, {
                type: 'bar', // Tipe chart (bar, line, pie, dll.)
                data: {
                    labels: ['Harian', 'Mingguan', 'Bulanan'], // Label data
                    datasets: [{
                        label: 'Penjualan (Rp)',
                        data: [{{ $daily }}, {{ $weekly }}, {{ $monthly }}], // Data penjualan
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.4)', // Warna batang Harian
                            'rgba(54, 162, 235, 0.4)', // Warna batang Mingguan
                            'rgba(255, 206, 86, 0.4)'  // Warna batang Bulanan
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)', // Warna border Harian
                            'rgba(54, 162, 235, 1)', // Warna border Mingguan
                            'rgba(255, 206, 86, 1)'  // Warna border Bulanan
                        ],
                        borderWidth: 1 // Ketebalan border
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true // Awali sumbu Y dari nol
                        }
                    }
                }
            });
        });
    </script>    

    {{-- Daftar Produk --}}
    <div class="mt-5">
        <h2>Kelola Produk</h2>
        <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Tambah Produk</a>

        {{-- Notifikasi --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Grid Horizontal Produk --}}
        <div class="list-group">
            @forelse($products as $product)
                <div class="list-group-item list-group-item-action mb-3 shadow-sm d-flex align-items-center">
                    {{-- Gambar Produk --}}
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="rounded me-3" style="width: 120px; height: 120px; object-fit: cover;">
                    @else
                        <div class="bg-secondary text-white d-flex justify-content-center align-items-center rounded me-3" style="width: 120px; height: 120px;">
                            Tidak ada gambar
                        </div>
                    @endif

                    {{-- Detail Produk --}}
                    <div class="flex-grow-1">
                        <h5 class="mb-1">{{ $product->name }}</h5>
                        <p class="mb-1 text-muted">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="mb-1">{{ Str::limit($product->description, 100) }}</p>
                        <span class="badge {{ $product->status === 'available' ? 'bg-success' : 'bg-danger' }}">
                            {{ $product->status === 'available' ? 'Tersedia' : 'Habis' }}
                        </span>
                        @if($product->is_featured)
                            <span class="badge bg-warning text-dark">Unggulan</span>
                        @endif
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="d-flex flex-column align-items-start gap-2">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted">Tidak ada produk</div>
            @endforelse
        </div>
    </div>
</div>

<script>
    // Handle the click event on the profile picture
    document.getElementById('profile-pic').addEventListener('click', function() {
        document.getElementById('profile_picture').click();
    });

    // Update the profile picture preview when a file is selected
    document.getElementById('profile_picture').addEventListener('change', function(e) {
        const reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('profile-pic').src = event.target.result;
        };
        reader.readAsDataURL(e.target.files[0]);
    });
</script>
@endsection