<?php

namespace App\Models;



// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_member',
        'role', // Pastikan role ditambahkan di sini
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id'); // Pastikan kolom 'user_id' adalah foreign key di tabel 'ulasan'
    // }    

    // Fungsi untuk generate id_member
    
    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'user_id');
    }

    public function orders()
{
    return $this->hasMany(Pemesanan::class, 'user_id', 'id');
}



}
