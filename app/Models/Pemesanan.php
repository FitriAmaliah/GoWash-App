<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan
    protected $table = 'pemesanan';

    // Kolom-kolom yang dapat diisi melalui mass assignment
    protected $fillable = [
        'layanan_id',
        'user_id',
        'tanggal',
        'waktu',
        'metode_pembayaran',
        'status_pembayaran',
        'biaya',
    ];

    /**
     * Relasi ke model Layanan (many-to-one)
     */
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id');
    }

    /**
     * Relasi ke model User (many-to-one, opsional)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}