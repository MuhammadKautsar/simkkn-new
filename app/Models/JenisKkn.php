<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKkn extends Model
{
    use HasFactory;

    protected $table = 'jenis_kkn';

    protected $fillable = [
        'kategori',
    ];
}
