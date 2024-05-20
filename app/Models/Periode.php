<?php

namespace App\Models;

use App\Models\JenisKkn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Periode extends Model
{
    use HasFactory;

    protected $table = 'periode';

    protected $guarded = [];

    public function jenisKkn()
    {
        return $this->belongsTo(JenisKkn::class, 'jenis_kkn', 'id');
    }

    public function lokasi_mappings()
    {
        return $this->hasMany(LokasiKkn::class, 'id_periode', 'id');
    }

    public $timestamps = false;

}
