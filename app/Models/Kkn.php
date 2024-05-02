<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kkn extends Model
{
    // use HasFactory;

    protected $table = 'kkn';

    protected $fillable = [
        'nama_kkn',
        'masa_kegiatan',
        'jenis_kkn',
        'masa_pendaftaran',
        'tahun_ajaran',
        'semester',
        'kode_kkn',
        'minimal_sks',
        'kuota_peserta',
    ];
}
