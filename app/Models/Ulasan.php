<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika berbeda dengan nama model (optional)
    protected $table = 'ulasan';

    // Menentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama_pengguna',
        'rating',
        'komentar',
        'tanggal_ulasan',
    ];

    // Menentukan kolom yang tidak bisa diisi secara massal (optional)
    // protected $guarded = ['id'];

    // Menentukan format waktu untuk kolom tanggal_ulasan
    protected $dates = ['tanggal_ulasan'];

    public function user()
{
    return $this->belongsTo(User::class, 'user_id'); // pastikan kolom user_id ada pada tabel ulasan
}

}
