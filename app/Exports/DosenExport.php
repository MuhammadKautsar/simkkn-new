<?php

namespace App\Exports;

use App\Models\Dosen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DosenExport implements FromCollection, WithHeadings
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    // Mengambil data dosen berdasarkan parameter yang diberikan
    public function collection()
    {
        $data = Dosen::getDosen($this->id);

        // Menghapus kolom id dan id_periode
        $filteredData = $data->map(function ($item) {
            return [
                'nip' => "\t".$item->nip,
                'nama' => $item->nama,
                'nama_unit' => $item->nama_unit,
                'fakultas' => $item->fakultas,
                'status' => $item->status,
                'no_hp' => $item->no_hp
            ];
        });

        return $filteredData;
    }

    // Menambahkan header pada file Excel
    public function headings(): array
    {
        return ['NIK/NIP', 'Nama', 'Nama Unit', 'Fakultas', 'DPL/Korcam', 'No HP'];
    }
}

