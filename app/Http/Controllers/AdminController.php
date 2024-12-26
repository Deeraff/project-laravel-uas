<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Total transaksi harian
        $daily = Transaction::whereDate('created_at', today())->sum('total');
        
        // Total transaksi mingguan
        $weekly = Transaction::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('total');
        
        // Total transaksi bulanan
        $monthly = Transaction::whereMonth('created_at', now()->month)
                              ->whereYear('created_at', now()->year)
                              ->sum('total');


        return view('dashboard', compact('daily', 'weekly', 'monthly'));
    }

    public function viewTransactions()
    {
        $transactions = TransactionItem::with('transaction', 'product')->get();
        return view('admin.transactions', compact('transactions'));
    }
}

