<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasi'; 
    protected $fillable = [
        'pesan',
        'is_read',
    ];
}
