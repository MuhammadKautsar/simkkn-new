<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users_kkn';

    // Jika tabel tidak memiliki kolom id, tentukan primary key yang benar
    protected $primaryKey = 'nip';
    public $incrementing = false; // Jika nip bukan auto increment
    protected $keyType = 'string'; // Jika nip adalah string (CHAR atau VARCHAR)

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public $timestamps = false;
}
