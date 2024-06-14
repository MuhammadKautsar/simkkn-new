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

    public function masterDesas()
    {
        return $this->hasMany(MasterDesa::class, 'periode', 'id');
    }

    public function getBatasanWaktu()
    {
        $batasanWaktu = BatasanWaktu::find($this->batasan_waktu);

        if ($batasanWaktu) {
            return [
                'id_periode' => $this->id,
                'mulai_laporan_survey' => $batasanWaktu->mulai_laporan_survey,
                'akhir_laporan_survey' => $batasanWaktu->akhir_laporan_survey,
                'mulai_monev' => $batasanWaktu->mulai_monev,
                'akhir_monev' => $batasanWaktu->akhir_monev,
                'mulai_upload_nilai' => $batasanWaktu->mulai_upload_nilai,
                'akhir_upload_nilai' => $batasanWaktu->akhir_upload_nilai,
                'mulai_upload_proposal' => $batasanWaktu->mulai_upload_proposal,
                'akhir_upload_proposal' => $batasanWaktu->akhir_upload_proposal,
                'mulai_logbook_1' => $batasanWaktu->mulai_logbook_1,
                'akhir_logbook_1' => $batasanWaktu->akhir_logbook_1,
                'mulai_logbook_2' => $batasanWaktu->mulai_logbook_2,
                'akhir_logbook_2' => $batasanWaktu->akhir_logbook_2,
                'mulai_logbook_3' => $batasanWaktu->mulai_logbook_3,
                'akhir_logbook_3' => $batasanWaktu->akhir_logbook_3,
                'mulai_logbook_4' => $batasanWaktu->mulai_logbook_4,
                'akhir_logbook_4' => $batasanWaktu->akhir_logbook_4,
                'mulai_laporan' => $batasanWaktu->mulai_laporan,
                'akhir_laporan' => $batasanWaktu->akhir_laporan,
            ];
        }

        return [
            'id_periode' => $this->id,
            'mulai_laporan_survey' => '',
            'akhir_laporan_survey' => '',
            'mulai_monev' => '',
            'akhir_monev' => '',
            'mulai_upload_nilai' => '',
            'akhir_upload_nilai' => '',
            'mulai_upload_proposal' => '',
            'akhir_upload_proposal' => '',
            'mulai_logbook_1' => '',
            'akhir_logbook_1' => '',
            'mulai_logbook_2' => '',
            'akhir_logbook_2' => '',
            'mulai_logbook_3' => '',
            'akhir_logbook_3' => '',
            'mulai_logbook_4' => '',
            'akhir_logbook_4' => '',
            'mulai_laporan' => '',
            'akhir_laporan' => '',
        ];
    }

    public function batasanWaktu()
    {
        return $this->belongsTo(BatasanWaktu::class, 'batasan_waktu');
    }
}
