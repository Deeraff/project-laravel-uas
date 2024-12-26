@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Arial', sans-serif;
    }

    .container {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }

    h1 {
        color: #333;
        margin-bottom: 20px;
        text-align: center;
        font-weight: bold;
    }

    .form-group label {
        font-weight: bold;
        color: #555;
    }

    .form-control {
        border: 1px solid #ced4da;
        border-radius: 5px;
        padding: 10px;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .btn {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        font-weight: bold;
        margin-top: 10px;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .form-group {
        margin-bottom: 20px;
    }
</style>
<div class="container mt-5">
    <h1>Tambah Produk</h1>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="price" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label>Gambar</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="form-group">
            <label for="jenis_produk">Jenis Produk</label>
            <select name="jenis_produk" id="jenis_produk" class="form-control">
                <option value="makanan">Makanan</option>
                <option value="minuman">Minuman</option>
            </select>
        </div>
        <div class="form-group">
            <label for="is_featured">Produk Unggulan</label>
            <input type="checkbox" name="is_featured" id="is_featured" value="1">
        </div>        
        <div class="form-group">
            <label for="status">Status Produk</label>
            <select name="status" id="status" class="form-control">
                <option value="available" {{ old('status', $product->status ?? '') == 'available' ? 'selected' : '' }}>Tersedia</option>
                <option value="unavailable" {{ old('status', $product->status ?? '') == 'unavailable' ? 'selected' : '' }}>Habis</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
