<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanan';

    protected $fillable = [
        'nama_layanan',
        'deskripsi',
        'harga',
        'foto',
    ];

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'layanan_id');
    }
}
