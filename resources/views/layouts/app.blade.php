<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Ordering App</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            padding-top: 50px; /* Sesuaikan konten agar tidak tertutup navbar */
        }
        /* Table Styling */
        body .container table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        body .container th, body .container td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        body .container th {
            background-color: #ff66b2; /* Pink background for table header */
            color: white; /* White text for header */
        }

        body .container td {
            background-color: #ffe6f0; /* Light pink background for table cells */
            border-color: white;
        }

        .custom-navbar {
            background: pink;
            color: white;
            margin-bottom: 20px;
        }

        .custom-navbar .navbar-nav .nav-link {
            color: black;
        }

        .custom-navbar .navbar-nav .nav-link:hover {
            color: rgb(239, 90, 114);
        }

        .btn-outline-success, .btn-logout {
            border-color: black;
            color: black;
        }

        .btn-outline-success:hover, .btn-logout:hover {
            background-color: green;
            color: white;
        }

        .btn-warning {
            background-color: rgb(242, 134, 152);
            color: white;
            border: none;
        }

        .btn-warning:hover {
            background-color: rgb(245, 49, 81);
            border-color: white;
            color: black;
        }

        .btn-logout:hover {
            background-color: red !important;
            border-color: red !important;
            color: white !important;
        }

        .btn-home-2 {
            border-color: black;
            color: black;
            margin-right: 7px;
        }
        
        .btn-home-2:hover {
            background-color: red !important;
            border-color: red !important;
            color: white !important;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light custom-navbar fixed-top shadow-sm">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="{{ asset('foto/expo.png') }}" alt="Kedai Expo Logo" width="150" style="object-fit: contain;">
            </a>

            <!-- Admin-Only Buttons -->
            @if(Auth::check() && Auth::user()->role === 'admin')
                <div class="ms-auto">
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-logout">Logout</button>
                    </form>
                </div>
            @else
                <!-- Customer Navigation -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ url('index') }}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products.makanan') }}">Makanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products.minuman') }}">Minuman</a>
                        </li>
                    </ul>
                    <div class="d-flex align-items-center">
                        <form class="d-flex me-2" action="{{ route('products.search') }}" method="GET">
                            <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                        <a href="{{ url('/') }}" class="btn btn-home-2">Home</a>
                        <a href="{{ route('cart.view') }}" class="btn btn-warning text-white me-2">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="content-section">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
