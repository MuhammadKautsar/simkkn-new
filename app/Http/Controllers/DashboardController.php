<?php

namespace App\Http\Controllers;

use App\Models\PanitiaModel;
use App\Models\Periode;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard_panitia(Request $request)
    {
        $nip = session()->get('nip');

        // $kkns = Periode::orderBy('id', 'desc')->paginate(10);
        $kkns = Periode::with(['lokasi_mappings.regency'])->orderBy('id', 'desc')->where('status', '<>', 2)->get();

        return view('panitia.dashboard', compact('kkns', 'nip'));
    }
}
