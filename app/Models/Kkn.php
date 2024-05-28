<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kkn extends Model
{
    // use HasFactory;

    protected $table = 'kkn';

    // protected $fillable = ['*'];
    protected $guarded = [];

    public $timestamps = false;

    public static function getDataMhsCetak($nim13, $periode)
    {
        // Implementasi logika untuk mengambil data mahasiswa berdasarkan nim13 dan periode
        return self::where('nim13', $nim13)->where('periode', $periode)->first();
    }
}
