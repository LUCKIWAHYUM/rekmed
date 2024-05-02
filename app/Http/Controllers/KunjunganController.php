<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use DataTables;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Crabbly\Fpdf\Fpdf as FPDF;
use Barryvdh\DomPDF\Facade as PDF;

use App\Models\Pasien;
use App\Models\Antrian;
use App\Models\Pemeriksaan;
use App\Models\Tindakan;
use App\Models\Resep;

class KunjunganController extends Controller
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
                ->addColumn('is_pemeriksaan_exists', function($row){
                    return Pemeriksaan::where('no_periksa', $row->no_periksa)->count();
                })
                ->addColumn('tanggal_kunjungan', function($row){
                    return Carbon::parse($row->time_in)->format('d M Y');
                })
                ->addColumn('jam_kunjungan', function($row){
                    return Carbon::parse($row->time_in)->format('H:i');
                })
                ->addColumn('register', function($row){
                    return Carbon::parse($row->created_at);
                })
                ->rawColumns(['nama','no_rm', 'is_pemeriksaan_exists', 'poli', 'is_status', 'register', 'jam_kunjungan', 'tanggal_kunjungan'])
                ->make(true);
        }

        $data = [
            'subtitle' => 'Kunjungan Pasien'
        ];

        return view('admin.app.content.kunjungan.index', compact('data'));
    }

    public function find(Request $request)
    {
        $data = Pasien::where('no_ktp', $request->no_ktp)->first();
        return view('admin.app.content.kunjungan.find', compact('data'));
    }

    public function process(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'time_in' => 'required',
            'no_ktp' => 'required',
            'id_dokter' => 'required',
            'id_perawat' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }


        $checkPasien = Pasien::where('no_ktp', $request->no_ktp)->first();
        $lastNumber = Antrian::where('time_in', 'LIKE', Carbon::parse($request->time_in))->where('status', 3)->max('kode');
        $nomor = $lastNumber ? $lastNumber + 1 : 1;

        $postAntrian = new Antrian([
            'id_user' => $checkPasien->id,
            'id_dokter' => $request->id_dokter,
            'id_perawat' => $request->id_perawat,
            'id_poli' => 2,
            'no_periksa' => strtoupper(Str::random(6)),
            'kode' => $nomor,
            'status' => 1,
            'time_in' => $request->time_in
        ]);

        if($postAntrian->save()) {
            return redirect()->route('kunjungan')->with('success', 'Kunjungan Pasien baru berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Kunjungan Pasien baru gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        $data = [
            'subtitle' => 'Edit Kunjungan',
        ];

        $kunjungan = Antrian::find($id);
        $pasien = Pasien::find($kunjungan->id_user);
        return view('admin.app.content.kunjungan.edit', compact('data', 'kunjungan', 'pasien'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_poli' => 'required',
            'time_in' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }

        $checkAccount = Antrian::find($id);
        if($checkAccount) {
            $account = Pasien::find($id);

            if($checkAccount->status == 3) {
                return redirect()->route('kunjungan')->with('error', 'Kunjungan ini sudah dinyatakan selesai pada periode sebelumnya');
            }

            $checkAccount->id_poli = 2;
            $checkAccount->time_in = $request->time_in;

            if($account->save()) {
                return redirect()->route('kunjungan')->with('success', 'Kunjungan baru berhasil diperbarui');
            } else {
                return redirect()->back()->with('error', 'Kunjungan baru gagal diperbarui');
            }
        } else {
            return redirect()->back()->with('error', 'Kunjungan tidak ditemukan');
        }
    }

    public function destroy($id)
    {
        $antrian = Antrian::find($id);

        if($antrian->status == 3) return redirect()->route('kunjungan')->with('error', 'Kunjungan ini sudah dinyatakan selesai pada periode sebelumnya');
        if($antrian->status == 2) {
            $pemeriksaan = Pemeriksaan::where('no_periksa', $antrian->no_periksa)->first();
            $antrian->delete();
            $pemeriksaan->delete();
            return redirect()->route('kunjungan')->with('success', 'Kunjungan dan Pemeriksaan berhasil di hapus');
        }
    }

    public function pembayaran(Request $request)
    {
        if ($request->ajax()) {
            $data = Antrian::where('status', 3)->select('*');
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
                ->addColumn('is_pemeriksaan_exists', function($row){
                    return Pemeriksaan::where('no_periksa', $row->no_periksa)->count();
                })
                ->addColumn('tanggal_kunjungan', function($row){
                    return Carbon::parse($row->time_in)->format('d M Y');
                })
                ->addColumn('harga', function($row){
                    $checkPemeriksaan = Pemeriksaan::where('no_periksa', $row->no_periksa)->first();
                    $checkTindakan = Tindakan::where('id', $checkPemeriksaan->tindakan)->first();
                    $harga = 0;
                    if($row->user->is_anggota == 1) {
                        $harga += $checkTindakan->price;
                        $resep = Resep::where('no_periksa', $row->no_periksa)->first();
                        foreach(explode(',', $resep->id_obat) as $obat) {
                            $checkObat = \App\Models\Obat::where('id', $obat)->first();
                            $harga += $checkObat->price;
                        }
                    } else {
                        $resep = Resep::where('no_periksa', $row->no_periksa)->first();
                        foreach(explode(',', $resep->id_obat) as $obat) {
                            $checkObat = \App\Models\Obat::where('id', $obat)->first();
                            $harga += $checkObat->price;
                        }
                    }

                    return 'Rp. ' . number_format($harga, 0, ',', '.');
                })
                ->addColumn('status_pembayaran', function($row){
                    if(Pemeriksaan::where('no_periksa', $row->no_periksa)->first()->status_pembayaran == 1) {
                        return '<span class="mb-1 badge font-medium badge-success py-2 px-3 fs-7">Lunas</span>';
                    } else {
                        return '<span class="mb-1 badge font-medium badge-danger py-2 px-3 fs-7">Belum Lunas</span>';
                    }
                })
                ->addColumn('status_pasien', function($row){
                    if($row->user->is_anggota == 1) {
                        return '<span class="mb-1 badge font-medium badge-dark py-2 px-3 fs-7">Bukan ASKES</span>';
                    } else {
                        return '<span class="mb-1 badge font-medium badge-dark py-2 px-3 fs-7">ASKES</span>';
                    }
                })
                ->addColumn('jam_kunjungan', function($row){
                    return Carbon::parse($row->time_in)->format('H:i');
                })
                ->addColumn('register', function($row){
                    return Carbon::parse($row->created_at);
                })
                ->rawColumns(['nama','no_rm', 'harga', 'status_pasien', 'status_pembayaran', 'is_pemeriksaan_exists', 'poli', 'is_status', 'register', 'jam_kunjungan', 'tanggal_kunjungan'])
                ->make(true);
        }

        $data = [
            'subtitle' => 'Pembayaran'
        ];

        return view('admin.app.content.pembayaran.index', compact('data'));
    }

    public function printStruk($id)
    {
        $detail = Pemeriksaan::where('no_periksa', $id)->where('status', 3)->first();
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
            $pdf->Cell(0, 7, 'Nomor Periksa: #' . Antrian::where('no_periksa', $detail->no_periksa)->first()->user->no_rm, 0, 2, 'C');
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(0, 15, 'Tanggal Periksa: ' . Carbon::parse($detail->antrian->time_in)->format('d M Y'), 0, 2, 'C');
            $pdf->Ln();

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, 3, '=============================================================================', 0, 2, 'C');
            $pdf->Ln();

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(100, 10, "Nama Lengkap: " . Antrian::where('no_periksa', $detail->no_periksa)->first()->user->nama, 0, 0, 'L');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(100, 10, 'TTL: ' . Antrian::where('no_periksa', $detail->no_periksa)->first()->user->tempat_lahir . ', ' . Carbon::parse(Antrian::where('no_periksa', $detail->no_periksa)->first()->user->tanggal_lahir)->format('d M Y'), 0, 0, 'L');
            $pdf->Ln();

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(100, 10, "Nomor Registrasi: " . Antrian::where('no_periksa', $detail->no_periksa)->first()->user->no_register, 0, 0, 'L');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(100, 10, 'Nomor RM: ' . Antrian::where('no_periksa', $detail->no_periksa)->first()->user->no_rm, 0, 0, 'L');
            $pdf->Ln();

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, 6, '=============================================================================', 0, 2, 'C');
            $pdf->Ln();

            $subTotal = 0;
            foreach(explode(',', $resep->id_obat) as $obat) {
                $subTotal += \App\Models\Obat::where('id', $obat)->first()->price;
                $checkObat = \App\Models\Obat::where('id', $obat)->first();
                $pdf->SetFont('Arial', '', 12);
                $pdf->Cell(100, 10, $checkObat->name, 0, 0, 'L');
                $pdf->SetFont('Arial', '', 12);
                $pdf->Cell(100, 10, 'Rp. ' . number_format($checkObat->price, 0, ',', '.'), 0, 0, 'L');
                $pdf->Ln();
            }

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, 6, '', 0, 2, 'C');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(100, 10, "Aturan Pakai:", 0, 0, 'L');
            $pdf->SetFont('Arial', '', 12);
            $aturan = [];
            foreach(explode(',', $resep->description) as $info) {
                $aturan[] = $info;
            }
            $pdf->Cell(100, 10, implode(', ', $aturan), 0, 0, 'L');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'b', 12);
            $pdf->Cell(100, 10, "Diagnosa:", 0, 0, 'L');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(100, 10, $pemeriksaan->diagnosa, 0, 0, 'L');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 12);
            $tindakan = Tindakan::where('id', $pemeriksaan->tindakan)->first()->name;
            $pdf->Cell(100, 10, "Tindakan:", 0, 0, 'L');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(100, 10, $tindakan, 0, 0, 'L');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(100, 10, "Total: ",  0, 0, 'L');
            $pdf->SetFont('Arial', '', 12);

            if(Antrian::where('no_periksa', $detail->no_periksa)->first()->user->is_anggota == 1) {
                $bayar = $subTotal + Tindakan::where('id', $pemeriksaan->tindakan)->first()->price;
            } else {
                $bayar = $subTotal;
            }

            $pdf->Cell(100, 10, 'Rp. ' . number_format($bayar, 0, ',', '.'), 0, 0, 'L');
            $pdf->Ln();

            // Footer
            $pdf->SetY(260);
            $pdf->SetX(140);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(0,4,"Dicetak oleh: " . user()->name, 0, 0, 'C');
            $pdf->Ln();
            return $pdf->Output('D', "Pembayaran #" . $detail->no_periksa . ".pdf");
        } else {
            return redirect()->route('pembayaran')->with('error', 'Pembayaran tidak ditemukan');
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
            return $pdf->Output('D', "Kunjungan: " . $detail->no_periksa . ".pdf");
        } else {
            return redirect()->back()->with('error', 'Detail Kunjungan tidak ditemukan');
        }
    }

    public function detailPembayaran($id)
    {
        $pembayaran = Antrian::find($id);
        if($pembayaran) {
            $data = [
                'subtitle' => 'Detail Pembayaran',
            ];

            $pemeriksaan = Pemeriksaan::where('no_periksa', $pembayaran->no_periksa)->first();
            $resep = Resep::where('no_periksa', $pembayaran->no_periksa)->first();
            $tindakan = Tindakan::where('id', $pemeriksaan->tindakan)->first();

            return view('admin.app.content.pembayaran.detail', compact('data', 'pemeriksaan', 'tindakan', 'pembayaran', 'pemeriksaan', 'resep'));
        } else {
            return redirect()->route('pembayaran')->with('error', 'Pembayaran tidak ditemukan');
        }
    }

    public function processPembayaran(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'biaya' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $pembayaran = Antrian::find($id);
        if($pembayaran) {
            $pemeriksaan = Pemeriksaan::where('no_periksa', $pembayaran->no_periksa)->first();
            $tindakan = Tindakan::where('id', $pemeriksaan->tindakan)->first();
            $resep = Resep::where('no_periksa', $pembayaran->no_periksa)->first();
            $totalHarga = 0;

            if($pembayaran->user->is_anggota == 1) {
                foreach(explode(',', $resep->id_obat) as $obat)
                {
                    $checkObat = \App\Models\Obat::where('id', $obat)->first();
                    $totalHarga += $checkObat->price;
                }

                $totalHarga += $tindakan->price;
            } else {
                foreach(explode(',', $resep->id_obat) as $obat)
                {
                    $checkObat = \App\Models\Obat::where('id', $obat)->first();
                    $totalHarga += $checkObat->price;
                }
            }

            if($request->biaya >= $totalHarga) {
                $pemeriksaan->status_pembayaran = 1;
                $pemeriksaan->biaya = $request->biaya;
                $kembalian = $request->biaya - $totalHarga;

                if($pemeriksaan->save()) {
                    return redirect()->route('pembayaran')->with('success', 'Pembayaran Berhasil dan pasien menerima kembalian sebesar Rp. ' . number_format($kembalian, 0, ',', '.'));
                } else {
                    return redirect()->route('pembayaran')->with('error', 'Pembayaran gagal');
                }
            } else {
                return redirect()->route('pembayaran')->with('error', 'Pembayaran yang diberikan pasien kurang dari biaya pemeriksaan');
            }
        } else {
            return redirect()->route('pembayaran')->with('error', 'Pembayaran tidak ditemukan');
        }
    }

    public function cetak()
    {
        $data = [
            'subtitle' => 'Cetak Data Kunjungan',
        ];

        $kunjungan = Antrian::get()->groupBy(function($d) {
            return Carbon::parse($d->created_at)->format('m');
        });

        return view('admin.app.content.kunjungan.cetak', compact('data', 'kunjungan'));
    }

    public function cetakExcel($id)
    {
        $detail = Antrian::whereMonth('created_at', $id)->get();
        if($detail) {
            // dd($detail);
            return view('admin.app.content.kunjungan.cetakKunjungan', compact('detail', 'id'));
        } else {
            return redirect()->back()->with('error', 'Detail Kunjungan tidak ditemukan');
        }
    }
}
