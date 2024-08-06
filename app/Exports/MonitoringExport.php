<?php

namespace App\Exports;

use App\Models\PanitiaModel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class MonitoringExport implements FromCollection, WithHeadings
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
            case 'dosen':
                $data = PanitiaModel::getKelompok($this->id_periode);
                return collect($data)->map(function($item) {
                    return [
                        'nama_dpl' => $item->nama_dpl,
                        'kd_kelompok' => $item->kd_kelompok,
                        'profil_desa' => $item->profil_desa == "" ? "Belum diunggah" : "Sudah diunggah",
                        'laporan_survey' => $item->laporan_survey == "" ? "Belum diunggah" : "Sudah diunggah",
                        'monev' => $item->monev == "" ? "Belum diunggah" : "Sudah diunggah",
                        'tgl_pdf_nilai' => $item->tgl_pdf_nilai == "" ? "Belum diunggah" : "Sudah diunggah",
                        'tgl_pdf_nilai_geuchik' => $item->tgl_pdf_nilai_geuchik == "" ? "Belum diunggah" : "Sudah diunggah",
                    ];
                });
            case 'peserta':
                $data = PanitiaModel::getMhs($this->id_periode);
                return collect($data)->map(function($item) {
                    return [
                        'nim13' => "\t".$item->nim13,
                        'nama_mhs' => $item->nama_mhs,
                        'nama_dpl' => $item->nama_dpl,
                        'kd_kelompok' => $item->kd_kelompok,
                        'proposal_kkn' => $item->proposal_kkn == "" ? "Belum diunggah" : "Sudah diunggah",
                        'logbook_1' => $item->logbook_1 == "" ? "Belum diunggah" : "Sudah diunggah Link Video",
                        'logbook_2' => $item->logbook_2 == "" ? "Belum diunggah" : "Sudah diunggah Link Video",
                        'logbook_3' => $item->logbook_3 == "" ? "Belum diunggah" : "Sudah diunggah Link Video",
                        'logbook_4' => $item->logbook_4 == "" ? "Belum diunggah" : "Sudah diunggah Link Video",
                        'laporan_kkn' => $item->laporan_kkn == "" ? "Belum diunggah" : "Sudah diunggah",
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
            case 'dosen':
                return ['DPL', 'Kelompok', 'Profil Desa', 'Laporan Survey Dosen', 'Laporan Monev', 'Nilai Akhir DPL', 'Nilai Akhir Geuchik'];
            case 'peserta':
                return ['NIM', 'Nama', 'Nama DPL', 'Kelompok', 'Proposal', 'Minggu Ke-1', 'Minggu Ke-2', 'Minggu Ke-3', 'Minggu Ke-4', 'Laporan Akhir'];
            default:
                return [];
        }
    }
}
