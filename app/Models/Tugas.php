<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_tugas',
        'tanggal_mulai',
        'nama_pembuat',
        'status',
        'tanggal_tenggat',
        'nama_penggarap',
        'deskripsi',
    ];
}
