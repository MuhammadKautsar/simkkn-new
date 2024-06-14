<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\DB;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';

    // public function getDosen($id)
    // {
    //     $result = DB::select("
    //         SELECT d.*, f.nama_fakultas as fakultas
    //         FROM dosen d
    //         LEFT JOIN fakultas_dosen f on d.fakultas = f.kd_fakultas
    //         WHERE id_periode = ? AND status <> 'verifikator'
    //     ", [$id]);

    //     return $result;
    // }

    public static function getDosen($id, $perPage = 10)
    {
        return self::select('dosen.*', 'fakultas_dosen.nama_fakultas as fakultas')
            ->leftJoin('fakultas_dosen', 'dosen.fakultas', '=', 'fakultas_dosen.kd_fakultas')
            ->where('dosen.id_periode', $id)
            ->where('dosen.status', '<>', 'verifikator')
            ->paginate($perPage);
    }
}
