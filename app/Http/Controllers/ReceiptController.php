<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf; // Pastikan ini diimpor
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    public function downloadReceipt($transactionId)
    {
        // Ambil data transaksi, pelanggan, dan item
        $transaction = Transaction::with(['transactionItems.product', 'customer'])->findOrFail($transactionId);
        $customer = $transaction->customer;
        $cart = $transaction->transactionItems;

        // Generate PDF dari view
        $pdf = Pdf::loadView('pdf.receipt', [
            'transaction' => $transaction,
            'customer' => $customer,
            'cart' => $cart,
        ]);

        // Download PDF dengan nama file 'struk_transaksi.pdf'
        return $pdf->download('struk_transaksi.pdf');
    }
}

