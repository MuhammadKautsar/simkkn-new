<?php

namespace App\Http\Controllers;

use App\Models\Kkn;
use App\Models\Periode;
use App\Models\DaftarModel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class MahasiswaController extends Controller
{
    public function index()
    {
        $nim = session()->get('nim');

        // $jumlah_sks = DaftarModel::getJumlahSKS($nim);
        // $fields = ['npm', 'nama', 'tempat_lahir', 'tanggal_lahir', 'email', 'alamat', 'no_tlp_mhs', 'jenis_kelamin'];
        // $mahasiswa = DaftarModel::get_mhs($nim, $fields);

        $fields = ['npm', 'nama'];
        $mahasiswa = DaftarModel::get_mhs($nim, $fields);
        $data = Kkn::where('nim13', $nim)->where('status_reg', '1')->first();
        // return view('mahasiswa.kegiatan-kkn', compact('kkns', 'jumlah_sks', 'mahasiswa'));
        return view('mahasiswa.kegiatan-kkn', compact('mahasiswa', 'data'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_kkn' => 'required|string|max:255',
        ]);

        // Simpan data KKN baru
        $kkn = new Kkn();
        $kkn->nama_kkn = $request->nama_kkn;
        $kkn->masa_kegiatan = $request->masa_kegiatan;
        $kkn->jenis_kkn = $request->jenis_kkn;
        $kkn->masa_pendaftaran = $request->masa_pendaftaran;
        $kkn->tahun_ajaran = $request->tahun_ajaran;
        $kkn->semester = $request->semester;
        $kkn->kode_kkn = $request->kode_kkn;
        $kkn->minimal_sks = $request->minimal_sks;
        $kkn->kuota_peserta = $request->kuota_peserta;
        $kkn->save();

        // Redirect dengan pesan sukses
        return redirect()->route('beranda')->with('success', 'Berhasil daftar KKN.');
    }

    public function cetakPdf($nim13, $periode)
    {
        // Ambil data dari model
        $data = Kkn::getDataMhsCetak($nim13, $periode);
        $date = now()->format('d M Y');

        // Generate PDF
        $pdf = Pdf::loadView('mahasiswa.print', compact('data', 'date'));

        // Download PDF
        // return $pdf->download($nim13 . '.pdf');
        return $pdf->stream($data->nim13 . '.pdf');
    }

    // public function generatePdf($nim)
    // {
    //     $data = Kkn::where('nim13', $nim)->first();

    //     $date = now()->format('d M Y');

    //     $pdf = Pdf::loadView('mahasiswa.print', compact('data', 'date'));

    //     return $pdf->stream($data->nim13 . '.pdf');

    //     // Start output buffering
    //     // ob_start();

    //     // // Create new FPDF instance
    //     // $fpdf = new \Codedge\Fpdf\Fpdf\Fpdf();
    //     // $fpdf->AddPage();

    //     // // Kop Surat
    //     // $fpdf->SetFont('Arial', 'B', 12);
    //     // $fpdf->Image(public_path('assets/media/logos/logo-usk.png'), 10, 10, 30);
    //     // $fpdf->Image(public_path('assets/media/logos/logo-kkn-2023.png'), 170, 10, 30);
    //     // $fpdf->Ln(20);

    //     // // Garis Horizontal
    //     // $fpdf->SetLineWidth(1);
    //     // $fpdf->Line(10, 40, 200, 40);
    //     // $fpdf->Ln(2);
    //     // $fpdf->SetLineWidth(0.5);
    //     // $fpdf->Line(10, 43, 200, 43);
    //     // $fpdf->Ln(10);

    //     // // Biodata Mahasiswa
    //     // $fpdf->SetFont('Arial', 'B', 12);
    //     // $fpdf->Cell(0, 10, 'BIODATA CALON MAHASISWA KKN', 0, 1, 'C');
    //     // $fpdf->SetFont('Arial', '', 11);
    //     // $fpdf->Cell(0, 10, 'Periode ' . $data->nim13, 0, 1, 'C');
    //     // $fpdf->Ln(10);

    //     // // Foto Mahasiswa
    //     // $fpdf->Image(public_path('assets/media/logos/logo-usk.png'), 150, 70, 30, 40);

    //     // // Data Mahasiswa
    //     // $fpdf->SetFont('Arial', '', 11);
    //     // $fpdf->Cell(30, 10, 'Nama', 0, 0);
    //     // $fpdf->Cell(5, 10, ':', 0, 0);
    //     // $fpdf->Cell(50, 10, $data->nama_mhs, 0, 1);
    //     // // Tambahkan field lainnya seperti contoh di atas

    //     // // Tambahkan halaman baru untuk Surat Pernyataan
    //     // $fpdf->AddPage();
    //     // $fpdf->SetFont('Arial', 'B', 12);
    //     // $fpdf->Cell(0, 10, 'SURAT PERNYATAAN KESEDIAAN MAHASISWA KKN', 0, 1, 'C');
    //     // $fpdf->Ln(10);

    //     // $fpdf->SetFont('Arial', '', 11);
    //     // $fpdf->MultiCell(0, 10, 'Saya yang bertanda tangan di bawah ini :', 0);
    //     // $fpdf->Cell(30, 10, 'Nama', 0, 0);
    //     // $fpdf->Cell(5, 10, ':', 0, 0);
    //     // $fpdf->Cell(50, 10, $data->nama_mhs, 0, 1);
    //     // // Tambahkan field lainnya seperti contoh di atas

    //     // // Footer dinamis
    //     // $date = now()->format('d M Y');
    //     // $fpdf->SetY(-15);
    //     // $fpdf->SetFont('Arial', 'I', 8);
    //     // $fpdf->Cell(0, 10, 'Dicetak pada tanggal: ' . $date, 0, 0, 'C');

    //     // // Output PDF
    //     // $fpdf->Output('I', $data->nim13 . '.pdf');

    //     // // Get the content of the buffer and clean the buffer
    //     // $pdfContent = ob_get_clean();

    //     // // Return PDF content as response
    //     // return response($pdfContent)
    //     //     ->header('Content-Type', 'application/pdf')
    //     //     ->header('Content-Disposition', 'inline; filename="' . $data->nim13 . '.pdf"');
    // }

    private function fotoKRS($nim13)
    {
        // Implementasi fungsi fotoKRS
    }
}
