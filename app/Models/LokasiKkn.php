<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiKkn extends Model
{
    use HasFactory;

    protected $table = 'lokasi_kkn';

    public function lokasi()
    {
        return $this->belongsTo(Periode::class);
    }
}
