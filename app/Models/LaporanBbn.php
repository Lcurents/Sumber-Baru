<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaporanBbn extends Model
{
    use HasFactory;

    protected $table = 'beban';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nama',
        'quantity',
        'created_at',
        'update_at',
       
        
    ];

}
