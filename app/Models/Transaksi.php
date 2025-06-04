<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi'; // nama tabel di database
    public $timestamps = true;

     protected $fillable = [
        'kode_transaksi',
        'metode',
        'total',
        'jenis',
        'deskripsi',
        'jenis',
        'status_bayar',
        'no_hp',
        'nama',
        'supplier_id',
    ];
}
