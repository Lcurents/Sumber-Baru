<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Piutang extends Model
{
    protected $table = 'utangpiutang_detail'; // nama tabel di database
    public $timestamps = true;

     protected $fillable = ['transaksi_id', 'barang_id', 'quantity', 'harga_satuan', 'subtotal' ];
}
