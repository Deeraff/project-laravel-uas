@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Daftar Transaksi</h1>

    @if($transactions->isEmpty())
        <p class="text-center">Tidak ada transaksi untuk periode ini.</p>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-bordered shadow-sm rounded">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Produk</th>
                        <th>Total Harga</th>
                        <th>Tanggal Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $transaction->customer->nama }}</td> {{-- Pastikan relasi customer ada --}}
                            <td>
                                @foreach($transaction->transactionItems as $item)
                                    <p>{{ $item->product->name }} ({{ $item->quantity }})</p> {{-- Menampilkan produk dan kuantitas --}}
                                @endforeach
                            </td>
                            <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                            <td>{{ $transaction->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@section('styles')
<style>
    /* Gaya untuk header tabel */
    thead {
        background-color: #4CAF50;
        color: white;
    }

    /* Styling tabel */
    table {
        width: 100%;
        border-collapse: collapse;
    }
    
    /* Styling baris tabel */
    th, td {
        padding: 12px;
        text-align: left;
    }

    /* Menambahkan border pada tabel */
    table, th, td {
        border: 1px solid #ddd;
    }

    /* Hover effect untuk baris tabel */
    tr:hover {
        background-color: #f1f1f1;
    }

    /* Styling untuk container */
    .container {
        margin-top: 30px;
    }

    /* Styling header */
    h1 {
        color: #333;
        font-family: 'Arial', sans-serif;
    }

    /* Membuat tabel responsif */
    .table-responsive {
        overflow-x: auto;
    }
</style>
@endsection
@endsection
