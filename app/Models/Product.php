<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'description', 'image', 'jenis_produk', 'is_featured', 'status'];

    // Relasi ke TransactionItem
    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }
}
