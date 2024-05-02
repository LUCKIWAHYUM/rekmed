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
use App\Models\Tindakan;
use App\Models\Resep;
use App\Models\Pemeriksaan;
use App\Models\Antrian;

class ResepController extends Controller
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
                    return Pemeriksaan::where('no_periksa', $row->no_periksa)->first()->diagnosa ?? '-';
                })
                ->addColumn('tindakan', function($row){
                    return Tindakan::where('id', Pemeriksaan::where('no_periksa', $row->no_periksa)->first()->tindakan)->first()->name ?? '-';
                })
                ->addColumn('is_resep_exist', function($row){
                    return Resep::where('no_periksa', $row->no_periksa)->count();
                })
                ->addColumn('register', function($row){
                    return Carbon::parse($row->created_at);
                })
                ->rawColumns(['nama', 'is_resep_exist', 'is_status_antrian', 'no_rm', 'poli', 'is_status', 'register', 'diagnosa', 'tindakan', 'tanggal_kunjungan'])
                ->make(true);
        }

        $data = [
            'subtitle' => 'Resep Obat'
        ];

        return view('dokter::resep-obat.index', compact('data'));
    }

    public function create(Request $request)
    {
        $data = [
            'subtitle' => 'Buat Resep Obat'
        ];

        $pemeriksaan = Pemeriksaan::where('no_periksa', $request->id)->first();
        if(!$pemeriksaan) {
            return '<div class="alert alert-danger">Pemeriksaan pasien tidak ditemukan</div>';
        }
        return view('dokter::resep-obat.add', compact('data', 'pemeriksaan'));
    }

    public function detail($id)
    {
        $detail = Antrian::find($id);
        if($detail) {
            $data = [
                'subtitle' => 'Detail Resep Obat',
            ];

            $resep = Resep::where('no_periksa', $detail->no_periksa)->first();
            $pemeriksaan = Pemeriksaan::where('no_periksa', $detail->no_periksa)->first();
            return view('dokter::resep-obat.detail', compact('data', 'detail', 'resep', 'pemeriksaan'));
        } else {
            return redirect()->back()->with('error', 'Detail resep tidak ditemukan');
        }
    }

    public function print($id)
    {
        $detail = Pemeriksaan::find($id);
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
            $pdf->Cell(0, 4, 'Resep Obat: ' . $detail->no_periksa, 0, 2, 'C');
            $pdf->Ln();

            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(0, 10, 'Pasien: ' . Antrian::where('no_periksa', $detail->no_periksa)->first()->user->nama, 0, 2, 'C');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(90, 10, "No. Periksa", 1, 0, 'C');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(100, 10, $resep->no_periksa, 1, 0, 'C');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(90, 10, "Diagnosa", 1, 0, 'C');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(100, 10, $pemeriksaan->diagnosa, 1, 0, 'C');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(90, 10, "Tindakan", 1, 0, 'C');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(100, 10, Tindakan::where('id', $pemeriksaan->tindakan)->first()->name ?? '-', 1, 0, 'C');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(90, 10, "Resep Obat", 1, 0, 'C');
            $pdf->SetFont('Arial', '', 12);
            $obat_daftar = [];
            foreach(explode(',', $resep->id_obat) as $obat) {
                $obat_daftar[] = \App\Models\Obat::where('id', $obat)->first()->name;
            }
            $pdf->Cell(100, 10, implode(', ', $obat_daftar), 1, 0, 'C');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(90, 10, "Aturan Pakai", 1, 0, 'C');
            $pdf->SetFont('Arial', '', 12);
            $aturan = [];
            foreach(explode(',', $resep->description) as $info) {
                $aturan[] = $info;
            }
            $pdf->Cell(100, 10, implode(', ', $aturan), 1, 0, 'C');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(90, 10, "Tanggal Kunjungan", 1, 0, 'C');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(100, 10, Carbon::parse(Antrian::where('no_periksa', $detail->no_periksa)->first()->time_in)->format('d M Y, H:i:s'), 1, 0, 'C');
            $pdf->Ln();

            $pdf->SetY(247);
            $pdf->SetX(155);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(0,4,"Dicetak oleh : " . user()->name, 0, 0, 'C');
            $pdf->Ln();

            $pdf->SetY(254);
            $pdf->SetX(155);
            $pdf->SetFont('Arial','I',8);
            $pdf->Cell(0,10, 'pada ' . date("d-m-Y H:i:s") . '', 0, 0, 'C');

            return $pdf->Output('D', "Resep Obat Pasien " . $detail->no_periksa . ".pdf");
        } else {
            return redirect()->back()->with('error', 'Detail resep tidak ditemukan');
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_periksa' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $no_resep = strtoupper(Str::random(6));

        $checkResep = Resep::where('no_periksa', $request->no_periksa)->first();
        if($checkResep) {
            return redirect()->route('resep-obat')->with('error', 'Resep obat pasien sudah ada');
        } else {
            $resep = new Resep();
            $resep->id = Str::uuid();
            $resep->id_obat = implode(',', $request->id_obat);
            $resep->no_resep = $no_resep;
            $resep->no_periksa = $request->no_periksa;
            $resep->description = $request->description;
            $resep->is_pribadi = empty($request->is_pribadi) ? 2 : 1;
            $resep->status = empty($request->is_pribadi) ? 1 : 2;

            if($resep->save()) {
                return redirect()->route('resep-obat')->with('success', 'Resep obat pasien berhasil ditambahkan');
            } else {
                return redirect()->back()->with('error', 'Resep obat pasien gagal ditambahkan');
            }
        }
    }

    public function edit(Request $request)
    {
        if(empty($request->id)) {
            return '<div class="alert alert-danger">Resep Obat pasien tidak ditemukan</div>';
        }

        $resep = Resep::where('no_periksa', $request->id)->first();
        if($resep) {
            $data = [
                'subtitle' => 'Perbarui Resep',
            ];
            $pemeriksaan = Pemeriksaan::where('no_periksa', $request->id)->first();
            return view('dokter::resep-obat.edit', compact('data', 'resep', 'pemeriksaan'));
        } else {
            return '<div class="alert alert-danger">Resep Obat pasien tidak ditemukan</div>';
        }
    }

    public function update(Request $request, $no_periksa)
    {
        $validator = Validator::make($request->all(), [
            'no_periksa' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $resep = Resep::where('no_periksa', $no_periksa)->first();
        if($resep) {
            $resep->id_obat = implode(',', $request->id_obat);
            $resep->description = $request->description;
            $resep->is_pribadi = empty($request->is_pribadi) ? 2 : 1;
            $resep->status = 2;
            if($resep->save()) {
                return redirect()->route('resep-obat')->with('success', 'Resep obat pasien berhasil diperbarui');
            } else {
                return redirect()->back()->with('error', 'Resep obat pasien gagal diperbarui');
            }
        } else {
            return redirect()->back()->with('error', 'Resep obat pasien tidak ditemukan');
        }
    }

    public function destroy($id)
    {
        $resep = Resep::find($id);
        if($resep) {
            if($resep->delete()) {
                return redirect()->back()->with('success', 'Resep obat pasien berhasil dihapus');
            } else {
                return redirect()->back()->with('error', 'Resep obat pasien gagal dihapus');
            }
        } else {
            return redirect()->back()->with('error', 'Resep obat pasien tidak ditemukan');
        }
    }

    public function done($id)
    {
        $resep = Resep::where('no_periksa', $id)->first();
        if($resep) {
            $periksa = Antrian::where('no_periksa', $id)->first();
            $periksa->status = 3;
            if($periksa->save()) {
                return redirect()->back()->with('success', 'Resep obat pasien dinyatakan selesai, dan pasien dapat mengambil obat diapotik jika pasien memilih untuk mengambil obat');
            } else {
                return redirect()->back()->with('error', 'Resep obat pasien gagal diperbarui');
            }
        } else {
            return redirect()->back()->with('error', 'Resep obat pasien tidak ditemukan');
        }
    }
}
