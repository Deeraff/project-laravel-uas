@extends('layouts.app')

@section('content')
<style>
    /* Container Utama */
    .container {
        font-family: 'Arial', sans-serif;
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Header Utama */
    h1 {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #333;
    }

    /* Card untuk Informasi Pemesan */
    .card {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .card-body {
        padding: 15px;
    }

    .card-body h4 {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #007bff;
    }

    .card-body p {
        font-size: 16px;
        margin-bottom: 5px;
        color: #555;
    }

    /* Header Detail Pesanan */
    h5 {
        font-size: 20px;
        margin-bottom: 15px;
        color: #333;
        font-weight: bold;
        border-bottom: 2px solid #ddd;
        padding-bottom: 5px;
    }

    /* Tabel Detail Pesanan */
    .table {
        width: 100%;
        margin-bottom: 20px;
        background-color: #fff;
        border-collapse: collapse;
    }

    .table thead th {
        background-color: #007bff;
        color: #fff;
        text-align: left;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ddd;
    }

    .table tbody td {
        padding: 10px;
        border: 1px solid #ddd;
        font-size: 14px;
        color: #333;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
    }

    .btn-danger:hover {
        background-color: #bd2130;
    }

    /* Flexbox untuk Tombol */
    .d-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .d-flex a {
        margin-right: 10px;
    }
</style>
<div class="container mt-5">
    <h1>Struk Transaksi</h1>

    <div class="card">
        <div class="card-body">
            <h4>Nama Pemesan: {{ $customer->nama }}</h4>
            <p>Metode Pembayaran: {{ $transaction->payment_method }}</p>
            <p>Total: Rp {{ number_format($transaction->total, 0, ',', '.') }}</p>
        </div>
    </div>

    <h5 class="mt-4">Detail Pesanan:</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $product_id => $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-between mt-3">
        <a href="{{ route('customer.index') }}" class="btn btn-primary">Kembali ke Beranda</a>
        <a href="{{ route('receipt.download', $transaction->id) }}" class="btn btn-danger mt-3">Cetak PDF</a>
    </div>
</div>
@endsection
