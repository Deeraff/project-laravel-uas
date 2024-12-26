<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon; // Tambahkan ini untuk mengimpor Carbon

class DashboardController extends Controller
{
    public function index()
    {
        // Penjualan Hari Ini
        $daily = Transaction::whereDate('created_at', Carbon::today())
                            ->sum('total');

        // Penjualan Minggu Ini
        $weekly = Transaction::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                             ->sum('total');

        // Penjualan Bulan Ini
        $monthly = Transaction::whereMonth('created_at', Carbon::now()->month)
                              ->whereYear('created_at', Carbon::now()->year)
                              ->sum('total');

        // Ambil daftar produk untuk keperluan tampilan
        $products = Product::all();

        // Mengirim data ke view
        return view('dashboard', compact('daily', 'weekly', 'monthly', 'products'));
    }

    public function showTransactions($period)
    {
        $transactions = collect();

        // Menampilkan transaksi berdasarkan periode
        if ($period == 'daily') {
            $transactions = Transaction::with('customer')  // Mengambil relasi customer
                ->whereDate('created_at', Carbon::today())
                ->get();
        } elseif ($period == 'weekly') {
            $transactions = Transaction::with('customer')  // Mengambil relasi customer
                ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->get();
        } elseif ($period == 'monthly') {
            $transactions = Transaction::with('customer')  // Mengambil relasi customer
                ->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->get();
        }

        return view('transactions.index', compact('transactions'));
    }
}


