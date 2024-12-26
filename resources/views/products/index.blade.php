@extends('layouts.app')

@section('content')
<!-- Add Font Awesome CDN for social media icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<style>
    /* Custom styles for product cards */
    .product-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 20px;
        background-color: #fff;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .product-card.sold-out {
        opacity: 0.8;
        background-color: #f8f9fa;
    }

    /* Styling image */
    .product-image {
        width: 100%;
        height: 250px; /* Taller image for better visibility */
        object-fit: cover;
        border-bottom: 1px solid #ddd;
    }

    /* Styling for card body */
    .card-body {
        padding: 15px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: bold;
    }

    .card-text {
        font-size: 1rem;
        color: #555;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }

    .price {
        font-weight: bold;
        color: #28a745;
    }

    .add-to-cart-btn {
        background-color: pink;
        border: none;
        color: black;
        width: 100%;
        padding: 10px;
        font-size: 1rem;
        text-transform: uppercase;
    }

    .add-to-cart-btn:hover {
        background-color: rgb(244, 134, 152);
    }

    .add-to-cart-btn:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }

    /* Product grid layout */
    .row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: space-between;
    }

    .col-md-3 {
        flex: 0 0 23%; /* 4 items per row (each takes 23% with spacing) */
        max-width: 23%;
    }

    /* Responsive Design for Mobile */
    @media (max-width: 768px) {
        .col-md-3 {
            flex: 0 0 48%; /* 2 items per row on tablet/mobile */
            max-width: 48%;
        }
    }

    @media (max-width: 576px) {
        .col-md-3 {
            flex: 0 0 100%; /* 1 item per row on small mobile screens */
            max-width: 100%;
        }
    }

    /* Footer styles */
    .footer {
        background-color: #000;
        color: #fff;
        padding: 20px;
        text-align: center;
        font-size: 0.9rem;
        position: relative;
        width: 100%;
        left: 0;
        margin-top: 20px; /* Ensures there's space between the footer and the products */
    }

    .footer a {
        color: #fff;
        margin: 0 10px;
        text-decoration: none;
        font-size: 1.5rem; /* Larger icon size */
    }

    .footer a:hover {
        text-decoration: underline;
    }

    .footer .address {
        margin-top: 10px;
    }

    .featured-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: gold;
        padding: 5px 10px;
        color: white;
        font-weight: bold;
        border-radius: 5px;
        font-size: 0.9rem;
    }

    .sold-out {
        opacity: 0.5;
    }
</style>
<!-- Landing Page (Hero Section) -->
<div class="landing-page" style="background: url('{{ asset('foto/gyj.jpg') }}') no-repeat center center/cover; height: 100vh; display: flex; align-items: center; justify-content: center; color: white; text-align: center; position: relative;">
    <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.6);"></div>
    <div class="content" style="position: relative; z-index: 1;">
        <h1 style="font-size: 3rem; font-weight: bold;">Selamat Datang di Kedai Expo</h1>
        <p style="font-size: 1.2rem; margin: 20px 0;">Nikmati makanan dan minuman terbaik kami dengan mudah</p>
        <!-- Updated button with href to the products section -->
        <a href="#products" class="btn btn-warning btn-lg">Jelajahi Sekarang</a>
    </div>
</div>

<!-- Updated container with id 'products' -->
<div class="container mt-5" id="products">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach($products as $product)
            <div class="col-md-3">
                <div class="card product-card {{ $product->status === 'available' ? '' : 'sold-out' }}" style="position: relative;">
                    <!-- Indikator Produk Unggulan -->
                    @if($product->is_featured)
                        <div class="featured-badge" style="position: absolute; top: 10px; right: 10px; background-color: gold; padding: 5px 10px; color: white; font-weight: bold; border-radius: 5px; z-index: 10;">
                            <i class="fas fa-star"></i> Unggulan
                        </div>
                    @endif

                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top product-image" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                        @if($product->status === 'available')
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-primary add-to-cart-btn">Tambah ke Keranjang</button>
                            </form>
                        @else
                            <button class="btn btn-secondary add-to-cart-btn" disabled>Habis</button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Footer Section -->
<footer class="footer">
    <p class="address">Jl. Penanggungan No.33, Bandar Lor, Kec. Mojoroto, Kediri, Jawa Timur 64114</p>
    <p>Telp: 087753465015</p>
    <div>
        <!-- Facebook and Instagram Logos using Font Awesome -->
        <a href="https://www.facebook.com/kedai.expo/" target="_blank" class="fab fa-facebook-square"></a>
        <a href="https://www.instagram.com/kedai.expo/" target="_blank" class="fab fa-instagram"></a>
    </div>
    <p>Copyright @2022 Kedai Expo</p>
</footer>
@endsection
