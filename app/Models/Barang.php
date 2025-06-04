<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'ID';

    protected $fillable = [
        'ID',
        'Nama_Barang',
        'satuan',
        'Harga',
        'minimumbeli',
        'maximumbeli',
        'supplier',
        'gambar',
    ];

    // ✅ Relasi ke tabel satuan
 

}
