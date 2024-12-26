<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use hasFactory;

    protected $fillable = [
        'customer_id', 'total', 'payment_method'
    ];

    // relasi dengan customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    
    // Relasi ke TransactionItem
    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }
}

