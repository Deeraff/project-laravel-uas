<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi</title>
    <style>
        /* Gaya Umum */
        body {
            font-family: 'Courier New', Courier, monospace; /* Gaya seperti mesin cetak */
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        .receipt-container {
            background-color: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 450px;
            margin: 20px auto;
            border: 1px dashed #000; /* Garis tepi untuk nuansa struk */
        }

        /* Header Toko */
        .store-name {
            text-align: center;
            font-size: 24px; /* Ukuran lebih besar */
            font-weight: bold;
            margin-bottom: 10px;
        }

        .store-address {
            text-align: center;
            font-size: 14px; /* Ukuran lebih besar */
            margin-bottom: 15px;
        }

        .separator {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }

        /* Informasi Transaksi */
        .transaction-info p {
            font-size: 16px; /* Ukuran lebih besar */
            margin: 8px 0;
        }

        /* Tabel Detail Pesanan */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            font-size: 14px; /* Ukuran lebih besar */
            text-align: left;
            padding: 8px;
        }

        th {
            border-bottom: 1px solid #000;
        }

        td:last-child {
            text-align: right;
        }

        /* Footer */
        .footer {
            text-align: center;
            font-size: 14px; /* Ukuran lebih besar */
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <!-- Header Toko -->
        <div class="store-name">Kedai Expo</div>
        <div class="store-address">Jl. Penanggungan No.33, Bandar Lor, Kec. Mojoroto, Kediri, Jawa Timur 64114<br>Telp:  0822-4466-5557</div>
        
        <div class="separator"></div>

        <!-- Informasi Transaksi -->
        <div class="transaction-info">
            <p><strong>Nomor Transaksi:</strong> {{ $transaction->id }}</p>
            <p><strong>Tanggal:</strong> {{ date('d-m-Y H:i:s') }}</p>
            <p><strong>Nama Pelanggan:</strong> {{ $customer->nama }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ $transaction->payment_method }}</p>
        </div>

        <div class="separator"></div>

        <!-- Tabel Detail Pesanan -->
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="separator"></div>

        <!-- Total -->
        <div class="transaction-info">
            <p><strong>Total Belanja:</strong> Rp {{ number_format($transaction->total, 0, ',', '.') }}</p>
        </div>

        <div class="separator"></div>

        <!-- Footer -->
        <div class="footer">
            Terima kasih telah datang di<br><strong>Kedai Expo</strong><br>
            *** Sampai Jumpa Lagi ***
        </div>
    </div>
</body>
</html>
