<?php

namespace App\Exports;

use App\Models\PanitiaModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NilaiExport implements FromCollection, WithHeadings
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    // Mengambil data nilai peserta berdasarkan parameter yang diberikan
    public function collection()
    {
        $data = [];

        $data = PanitiaModel::getNilaiAll($this->id);
        return collect($data)->map(function($item) {
            return [
                'nim13' => "\t".$item->nim13,
                'nama_mhs' => $item->nama_mhs,
                'nama_fakultas' => $item->nama_fakultas,
                'nama_prodi' => $item->nama_prodi,
                'kd_kelompok' => $item->kd_kelompok,
                'nama_dpl' => $item->nama_dpl,
                'nilai_geuchik' => $item->nilai_geuchik,
                'nilai_des' => $item->nilai_des,
                'nilai' => $item->nilai,
            ];
        });

        return collect($data);
    }

    // Menambahkan header pada file Excel
    public function headings(): array
    {
        return ['NIM', 'Nama', 'Fakultas', 'Jurusan', 'Kelompok', 'Nama DPL', 'Nilai Geuchik', 'Nilai Akhir Angka', 'Nilai Akhir Huruf'];
    }
}
