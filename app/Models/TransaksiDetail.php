<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Barang; // Pastikan ini ditambahkan jika belum

class TransaksiDetail extends Model
{
    use HasFactory;

    protected $table = 'transaksi_detail';
    public $timestamps = true;

    protected $fillable = ['transaksi_id', 'barang_id', 'quantity', 'harga_satuan', 'subtotal'];

    // ✅ Tambahkan relasi ke tabel Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
     public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

}
