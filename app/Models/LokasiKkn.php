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

    // Define relationship with Regency
    public function regency()
    {
        return $this->belongsTo(Regency::class, 'id_kabupaten', 'id');
    }

    // Define custom accessor for province
    public function getProvinceAttribute()
    {
        // Extract first 2 digits of id_kabupaten
        $provinceId = substr($this->id_kabupaten, 0, 2);

        // Fetch province using the extracted ID
        return Provinsi::where('id', $provinceId)->first();
    }
}
