<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionItem;
use App\Models\Transaction;
use App\Models\Customer;
use Barryvdh\DomPDF\Facade\Pdf;


class CartController extends Controller
{
    // Update cart item (increase or decrease quantity)
    public function update(Request $request, $product_id)
    {
        $cart = session()->get('cart', []);

        // Check if the product exists in the cart
        if (isset($cart[$product_id])) {
            if ($request->action === 'increase') {
                // Increase the quantity
                $cart[$product_id]['quantity']++;
            } elseif ($request->action === 'decrease' && $cart[$product_id]['quantity'] > 1) {
                // Decrease the quantity, ensuring it doesn't go below 1
                $cart[$product_id]['quantity']--;
            }

            // Save the updated cart in the session
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.view')->with('success', 'Keranjang berhasil diperbarui!');
    }

    // Remove item from the cart
    public function remove($product_id)
    {
        $cart = session()->get('cart', []);

        // Remove the product from the cart
        if (isset($cart[$product_id])) {
            unset($cart[$product_id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.view')->with('success', 'Produk berhasil dihapus dari keranjang!');
    }

    // Checkout logic (already shown in your code)
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        $total = 0;
    
        if (empty($cart)) {
            return redirect()->route('customer.index')->with('error', 'Keranjang kosong!');
        }
    
        // Hitung total harga
        foreach ($cart as $product_id => $item) {
            $total += $item['price'] * $item['quantity'];
        }
    
        // Cek apakah customer sudah ada atau membuat baru
        $customer = Customer::firstOrCreate(
            ['nama' => $request->nama] // Pastikan nama dikirimkan melalui form checkout
        );
    
        // Simpan transaksi dengan foreign key dari customer_id
        $transaction = new Transaction();
        $transaction->customer_id = $customer->id;
        $transaction->total = $total;
        $transaction->payment_method = $request->payment_method;
        $transaction->payment_status = 'pending'; // Default status pembayaran
        $transaction->save();
    
        // Debugging untuk memeriksa apakah transaksi berhasil disimpan
        Log::info('Transaksi berhasil disimpan: ', ['transaction' => $transaction]);
    
        // Simpan detail item ke tabel transaction_items
        foreach ($cart as $product_id => $item) {
            $product = Product::find($product_id);
    
            // Simpan item ke tabel transaction_items
            $transactionItem = new TransactionItem();
            $transactionItem->transaction_id = $transaction->id;
            $transactionItem->product_id = $product_id;
            $transactionItem->quantity = $item['quantity'];
            $transactionItem->subtotal = $item['price'] * $item['quantity'];
            $transactionItem->save();
    
            // Debugging untuk memeriksa apakah item transaksi berhasil disimpan
            Log::info('Item transaksi berhasil disimpan: ', ['transactionItem' => $transactionItem]);
        }
    
        // Kosongkan keranjang setelah checkout
        session()->forget('cart');
    
        // Redirect ke struk pembelian dengan ID transaksi
        return redirect()->route('receipt.show', ['transactionId' => $transaction->id])->with('success', 'Pesanan berhasil diproses! Silakan lakukan pembayaran.');
    }    

    public function showReceipt($transactionId)
    {
        // Ambil transaksi beserta relasi ke transactionItems dan produk
        $transaction = Transaction::with('transactionItems.product')->find($transactionId);

        // Debugging untuk memastikan data yang diambil
        dd($transaction); // Ini akan menampilkan data transaksi dan relasi yang diambil

        if (!$transaction) {
            abort(404, 'Transaksi tidak ditemukan');
        }

        // Kirim data transaksi ke view
        return view('receipt', compact('transaction'));
    }
}