<?php

namespace Modules\Dokter\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use DataTables;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Crabbly\Fpdf\Fpdf as FPDF;

use App\Models\User;
use App\Models\Pasien;
use App\Models\Antrian;
use App\Models\Pemeriksaan;
use App\Models\PemeriksaanDetail;
use App\Models\Resep;
use App\Models\Tindakan;

class RekamController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Antrian::select('*');
            // Convert the Eloquent Collection to a regular PHP array
            $data->each(function ($item, $key) {
                $item->rowIndex = $key + 1;
            });

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('no_rm', function($row){
                    return $row->user->no_rm;
                })
                ->addColumn('nama', function($row){
                    return $row->user->nama;
                })
                ->addColumn('poli', function($row){
                    return $row->poli->name;
                })
                ->addColumn('jumlah_foto', function($row){
                    return PemeriksaanDetail::where('id_pemeriksaan', $row->id)->count() ?? 0;
                })
                ->addColumn('is_status', function($row){
                    if($row->status == 1) {
                        return '<span class="mb-1 badge font-medium badge-dark py-2 px-3 fs-7">Menunggu</span>';
                    } elseif($row->status == 2) {
                        return '<span class="mb-1 badge font-medium badge-primary py-2 px-3 fs-7">Pemeriksaan</span>';
                    } else {
                        return '<span class="mb-1 badge font-medium badge-success py-2 px-3 fs-7">Selesai</span>';
                    }
                })
                ->addColumn('is_status_antrian', function($row){
                    return $row->status;
                })
                ->addColumn('tanggal_kunjungan', function($row){
                    return Carbon::parse($row->time_in)->format('d M Y');
                })
                ->addColumn('diagnosa', function($row){
                    return Pemeriksaan::where('no_periksa', $row->no_periksa)->first()->diagnosa;
                })
                ->addColumn('kelamin', function($row){
                    return $row->user->jenis_kelamin == 1 ? 'Laki-laki' : 'Perempuan';
                })
                ->addColumn('register', function($row){
                    return Carbon::parse($row->created_at);
                })
                ->rawColumns(['nama', 'jumlah_foto', 'kelamin', 'is_status_antrian', 'no_rm', 'poli', 'is_status', 'register', 'diagnosa', 'tanggal_kunjungan'])
                ->make(true);
        }

        $data = [
            'subtitle' => 'Rekam Medis Pasien',
        ];

        return view('dokter::rekam-medis.index', compact('data'));
    }

    public function detail($id)
    {
        $pemeriksaan = Antrian::where('no_periksa', $id)->first();
        if($pemeriksaan) {
            $data = [
                'subtitle' => 'Detail Rekam Medis',
            ];

            return view('dokter::rekam-medis.detail', compact('data', 'pemeriksaan'));
        } else {
            return redirect()->back()->with('error', 'Rekam Medis tidak ditemukan');
        }
    }

    public function print($id)
    {

        $detail = Pemeriksaan::where('no_periksa', $id)->first();
        if($detail) {
            $data = [
                'subtitle' => 'Detail Resep Obat',
            ];

            $resep = Resep::where('no_periksa', $detail->no_periksa)->first();
            $pemeriksaan = Pemeriksaan::where('no_periksa', $detail->no_periksa)->first();

            $pdf = new FPDF;
            $pdf->AddPage('P', 'A4');

            // Header
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->Cell(0, 10, 'Rekam Medis: #' . Antrian::where('no_periksa', $detail->no_periksa)->first()->user->no_rm, 0, 2, 'C');
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(0, 15, 'Tanggal Kunjungan: ' . Carbon::parse($detail->antrian->time_in)->format('d M Y'), 0, 2, 'C');
            $pdf->Ln();

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, 6, '=============================================================================', 0, 2, 'C');
            $pdf->Ln();

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(100, 10, "Nama Lengkap: " . Antrian::where('no_periksa', $detail->no_periksa)->first()->user->nama, 0, 0, 'L');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(100, 10, 'TTL: ' . Antrian::where('no_periksa', $detail->no_periksa)->first()->user->tempat_lahir . ', ' . Carbon::parse(Antrian::where('no_periksa', $detail->no_periksa)->first()->user->tanggal_lahir)->format('d M Y'), 0, 0, 'L');
            $pdf->Ln();

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(100, 10, "Nama Lengkap KK: " . Antrian::where('no_periksa', $detail->no_periksa)->first()->user->nama, 0, 0, 'L');
            $pdf->SetFont('Arial', '', 12);
            $agama = Antrian::where('no_periksa', $detail->no_periksa)->first()->user->agama == 1 ? 'Islam' : (Antrian::where('no_periksa', $detail->no_periksa)->first()->user->agama == 2 ? 'Kristen' : (Antrian::where('no_periksa', $detail->no_periksa)->first()->user->agama == 3 ? 'Katolik' : (Antrian::where('no_periksa', $detail->no_periksa)->first()->user->agama == 4 ? 'Hindu' : 'Budha')));
            $pdf->Cell(100, 10, 'Agama: ' . $agama, 0, 0, 'L');
            $pdf->Ln();

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(100, 10, "NIK: " . Antrian::where('no_periksa', $detail->no_periksa)->first()->user->no_ktp, 0, 0, 'L');
            $pdf->SetFont('Arial', '', 12);
            $kelamin = Antrian::where('no_periksa', $detail->no_periksa)->first()->user->jenis_kelamin == 1 ? 'Laki-laki' : 'Perempuan';
            $pdf->Cell(100, 10, "Jenis Kelamin: $kelamin", 0, 0, 'L');
            $pdf->Ln();

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, 6, '', 0, 2, 'C');
            $pdf->Ln();

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(100, 10, "Pekerjaan: " . Antrian::where('no_periksa', $detail->no_periksa)->first()->user->pekerjaan, 0, 0, 'L');
            $pdf->SetFont('Arial', '', 12);
            $biaya = Antrian::where('no_periksa', $detail->no_periksa)->first()->user->is_anggota == 1 ? 'Umum' : 'Dana Sehat';
            $pdf->Cell(100, 10, "Biaya: $biaya", 0, 0, 'L');
            $pdf->Ln();

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(100, 10, "No. HP: " . Antrian::where('no_periksa', $detail->no_periksa)->first()->user->telepon, 0, 0, 'L');
            $pdf->SetFont('Arial', '', 12);
            $no_dana_sehat = Antrian::where('no_periksa', $detail->no_periksa)->first()->user->is_anggota == 1 ? '-' : Antrian::where('no_periksa', $detail->no_periksa)->first()->user->no_dana_sehat;
            $pdf->Cell(100, 10, "No. Dana Sehat: $no_dana_sehat", 0, 0, 'L');
            $pdf->Ln();

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, 3, '', 0, 2, 'C');
            $pdf->Ln();

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, 6, '=============================================================================', 0, 2, 'C');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(60, 10, "Diagnosa", 1, 0, 'L');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(129, 10, $pemeriksaan->diagnosa, 1, 0, 'C');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(60, 10, "Tindakan", 1, 0, 'L');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(129, 10, Tindakan::where('id', $pemeriksaan->tindakan)->first()->name ?? '-', 1, 0, 'C');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(60, 10, "Resep Obat", 1, 0, 'L');
            $pdf->SetFont('Arial', '', 12);
            $obat_daftar = [];
            foreach(explode(',', $resep->id_obat) as $obat) {
                $obat_daftar[] = \App\Models\Obat::where('id', $obat)->first()->name ?? '-';
            }
            $pdf->Cell(129, 10, implode(', ', $obat_daftar), 1, 0, 'C');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(60, 10, "Aturan Pakai", 1, 0, 'L');
            $pdf->SetFont('Arial', '', 12);
            $aturan = [];
            foreach(explode(',', $resep->description) as $info) {
                $aturan[] = $info;
            }
            $pdf->Cell(129, 10, implode(', ', $aturan), 1, 0, 'C');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(60, 10, "Keterangan Dokter", 1, 0, 'L');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(129, 10, $pemeriksaan->keterangan_dokter, 1, 0, 'C');
            $pdf->Ln();

            // Footer
            $pdf->SetY(240);
            $pdf->SetX(155);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(0,4,"Ambulu, " . date("d-m-Y"), 0, 0, 'C');
            $pdf->Ln();

            $pdf->SetY(247);
            $pdf->SetX(155);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(0,4,"TTD,", 0, 0, 'C');
            $pdf->Ln();

            $pdf->SetY(264);
            $pdf->SetX(155);
            $pdf->SetFont('Arial','I',10);
            $pdf->Cell(0,10, user()->name, 0, 0, 'C');
            return $pdf->Output('D', "Rekam Medis: " . $detail->no_periksa . ".pdf");
        } else {
            return redirect()->back()->with('error', 'Detail rekam medis tidak ditemukan');
        }
    }
}
