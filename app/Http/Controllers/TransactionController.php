<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;    

class TransactionController extends Controller
{
    public function show($id)
    {
        $transaction = Transaction::with('customer', 'details')->findOrFail($id); // Pastikan relasi sudah dimuat
        return view('transactions.show', compact('transaction'));
    }
    
}
