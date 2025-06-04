<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Utangpiutang_detail;

class utangpiutang extends Model
{
    protected $table = 'utangpiutang'; // nama tabel di database

    protected $fillable = [
        'kode_transaksi',
        'total',
        'nama', 
        'no_hp' ,
        'jenis',
        'deskripsi',
        'jenis',
        'jatuh_tempo',
        'status',
        'update_at',
        'tanggal'
    ];
    public function details()
    {
        return $this->hasMany(utangpiutang_Detail::class, 'transaksi_id');
    }
}
