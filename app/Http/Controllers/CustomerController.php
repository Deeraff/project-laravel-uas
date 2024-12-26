<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    // Menampilkan daftar produk
    public function index()
    {
        $products = Product::all();
        return view('customer.index', compact('products'));
    }

    // Menambah produk ke keranjang (session)
    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);

        $product = Product::find($request->product_id);

        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan!');
        }

        // Tambahkan ke keranjang
        $cart[$product->id] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => ($cart[$product->id]['quantity'] ?? 0) + 1,
        ];

        session()->put('cart', $cart);

        return redirect()->route('cart.view')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // Melihat keranjang
    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('customer.cart', compact('cart'));
    }

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

        // Simpan customer ke tabel customers
        $customer = Customer::firstOrCreate([
            'nama' => $request->input('nama'),
        ]);

        // Simpan transaksi ke tabel transactions
        $transaction = new Transaction();
        $transaction->customer_id = $customer->id; // Relasi ke tabel customers
        $transaction->total = $total;
        $transaction->payment_method = $request->input('payment_method');
        $transaction->save();

        // Simpan ke tabel transaction_items
        foreach ($cart as $product_id => $item) {
            TransactionItem::create([
                'transaction_id' => $transaction->id, // Foreign key ke tabel transactions
                'product_id' => $product_id,          // Foreign key ke tabel products
                'quantity' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        // Kosongkan keranjang
        session()->forget('cart');

        // Tampilkan struk
        return view('receipt', compact('transaction', 'cart', 'customer'))->with('success', 'Pesanan berhasil diproses!');
    }
}


