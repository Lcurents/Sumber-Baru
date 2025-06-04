<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class keranjang extends Model
{
    protected $table = 'keranjang'; // nama tabel di database

    protected $fillable = [
        'id',
        'barang_id',
        'harga',
        'jumlah_barang',
    ];
}
