@extends('layouts.app')

@section('content')
<style>
    /* Kerangka utama */
    .container {
        font-family: 'Arial', sans-serif;
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Header */
    h1 {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #333;
    }

    /* Alert */
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        color: #155724;
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
    }

    /* Tabel */
    .table {
        width: 100%;
        margin-bottom: 20px;
        background-color: #fff;
        border-collapse: collapse;
        border: 1px solid #ddd;
    }

    .table thead th {
        background-color: #007bff;
        color: #fff;
        text-align: center;
        padding: 10px;
        font-size: 16px;
    }

    .table tbody td {
        padding: 10px;
        border: 1px solid #ddd;
        color: #333;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
        color: #fff;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
        color: #fff;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    /* Form */
    .form-label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    select.form-control {
        appearance: none;
        background: #fff url('data:image/svg+xml;charset=US-ASCII,%3Csvg xmlns%3D%22http%3A//www.w3.org/2000/svg%22 viewBox%3D%220 0 4 5%22%3E%3Cpath fill%3D%22%23ccc%22 d%3D%22M2 0L0 2h4zM2 5L0 3h4z%22/%3E%3C/svg%3E') no-repeat right 10px center;
        background-size: 10px 10px;
    }
</style>
<div class="container mt-5">
    <h1>Keranjang Belanja</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(empty($cart))
        <p>Keranjang Anda kosong.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $product_id => $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.update', $product_id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('PUT')
                                <button type="submit" name="action" value="decrease" class="btn btn-sm btn-danger">-</button>
                                <span>{{ $item['quantity'] }}</span>
                                <button type="submit" name="action" value="increase" class="btn btn-sm btn-success">+</button>
                            </form>
                        </td>
                        <td>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $product_id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <form action="{{ route('cart.checkout') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Pemesan</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="payment_method" class="form-label">Metode Pembayaran</label>
                <select class="form-control" id="payment_method" name="payment_method" required>
                    <option value="cash">Cash</option>
                    <option value="transfer_bank">Transfer Bank</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Checkout</button>
        </form>
    @endif
</div>
@endsection
