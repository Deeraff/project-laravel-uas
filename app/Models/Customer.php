<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use hasFactory;

    protected $fillable = [
        'nama'
    ];

    // relasi dengan transaksi
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}


