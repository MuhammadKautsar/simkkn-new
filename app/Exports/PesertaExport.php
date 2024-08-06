<?php

namespace App\Exports;

use App\Models\PanitiaModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PesertaExport implements FromCollection, WithHeadings
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    // Mengambil data peserta berdasarkan parameter yang diberikan
    public function collection()
    {
        $data = [];

        $data = PanitiaModel::getMhs($this->id);
        return collect($data)->map(function($item) {
            return [
                'nim13' => "\t".$item->nim13,
                'nama_mhs' => $item->nama_mhs,
                'jenis_kelamin' => $item->jenis_kelamin,
                'prodi' => $item->prodi,
                'fakultas' => $item->fakultas,
                'status_keanggotaan' => $item->status_keanggotaan,
                'nama_kecamatan' => $item->nama_kecamatan,
                'nama_desa' => $item->nama_desa,
                'status_reg' => $item->status_reg == 0 ? "Nonaktif" : "Aktif",
                'kd_kelompok' => $item->kd_kelompok
            ];
        });

        return collect($data);
    }

    // Menambahkan header pada file Excel
    public function headings(): array
    {
        return ['NIM', 'Nama', 'Jenis Kelamin', 'Prodi', 'Fakultas', 'Keanggotaan', 'Lokasi Penempatan Kecamatan', 'Lokasi Penempatan Desa', 'Status', 'Kelompok'];
    }
}
