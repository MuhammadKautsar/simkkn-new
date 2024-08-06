<?php

namespace App\Exports;

use App\Models\PanitiaModel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class LokasiExport implements FromCollection, WithHeadings
{
    protected $type;
    protected $id_periode;

    public function __construct($type, $id_periode)
    {
        $this->type = $type;
        $this->id_periode = $id_periode;
    }

    public function collection()
    {
        $data = [];

        switch ($this->type) {
            case 'desa':
                $data = PanitiaModel::getDesaPerPeriode($this->id_periode);
                return collect($data)->map(function($item) {
                    return [
                        'nama_kecamatan' => $item['nama_kecamatan'],
                        'nama_desa' => $item['nama_desa'],
                        'nama_kepala_desa' => $item['nama_kepala_desa'],
                        'no_kepala_desa' => $item['no_kepala_desa'],
                        'nama_korcam' => $item['nama_korcam'],
                        'nama_dpl' => $item['nama_dpl'],
                        'kd_kelompok' => $item['kd_kelompok'],
                    ];
                });
            case 'kecamatan':
                $data = PanitiaModel::getKecamatanPerPeriode($this->id_periode);
                return collect($data)->map(function($item) {
                    return [
                        'provinsi' => $item['provinsi'],
                        'nama_kecamatan' => $item['nama_kecamatan'],
                        'nama_camat' => $item['nama_camat'],
                        'no_hp_camat' => $item['no_hp_camat'],
                        'nama_korcam' => $item['nama_korcam'],
                    ];
                });
            case 'kabupaten':
                $data = PanitiaModel::getKabupatenPerPeriode($this->id_periode);
                return collect($data)->map(function($item) {
                    return [
                        'provinsi' => $item['provinsi'],
                        'kabupaten' => $item['kabupaten'],
                    ];
                });
            default:
                return collect([]);
        }

        return collect($data);
    }

    public function headings(): array
    {
        switch ($this->type) {
            case 'desa':
                return ['Kecamatan', 'Desa', 'Nama Kepala Desa', 'No. Handphone', 'Korcam', 'DPL', 'Kode Kelompok'];
            case 'kecamatan':
                return ['Provinsi - Kabupaten', 'Kecamatan', 'Nama Camat', 'No. Handphone', 'Koordinator Kecamatan'];
            case 'kabupaten':
                return ['Provinsi', 'Kabupaten'];
            default:
                return [];
        }
    }
}
