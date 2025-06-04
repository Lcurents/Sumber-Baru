<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utangpiutang_detail extends Model
{
    protected $table = 'utangpiutang_detail'; // nama tabel di database
    public $timestamps = true;

     protected $fillable = ['transaksi_id', 'barang_id', 'quantity', 'harga_satuan', 'subtotal' ];

     public function barang()
     {
         return $this->belongsTo(Barang::class, 'barang_id');
     }
 
     public function transaksi()
     {
         return $this->belongsTo(utangpiutang::class, 'transaksi_id');
     }
}
