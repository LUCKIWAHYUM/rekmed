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

use App\Models\User;
use App\Models\Pasien;
use App\Models\Antrian;
use App\Models\Pemeriksaan;
use App\Models\PemeriksaanDetail;

class PemeriksaanController extends Controller
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
                ->addColumn('jam_kunjungan', function($row){
                    return Carbon::parse($row->time_in)->format('H:i');
                })
                ->addColumn('register', function($row){
                    return Carbon::parse($row->created_at);
                })
                ->rawColumns(['nama', 'jumlah_foto', 'is_status_antrian', 'no_rm', 'poli', 'is_status', 'register', 'jam_kunjungan', 'tanggal_kunjungan'])
                ->make(true);
        }

        $data = [
            'subtitle' => 'Pemeriksaan',
        ];

        return view('dokter::pemeriksaan.index', compact('data'));
    }

    public function detail($id)
    {
        $pemeriksaan = Antrian::find($id);
        if($pemeriksaan) {
            $data = [
                'subtitle' => 'Detail Pemeriksaan',
            ];
            return view('dokter::pemeriksaan.detail', compact('data', 'pemeriksaan'));
        } else {
            return redirect()->back()->with('error', 'Pasien tidak ditemukan');
        }
    }

    public function formPeriksa(Request $request)
    {
        if(empty($request->id)) {
            return '<div class="alert alert-danger">ID Periksa tidak ditemukan</div>';
        } else {
            $id = $request->id;
            $antrian = Antrian::find($id);
            $pemeriksaan = Pemeriksaan::where('no_periksa', $antrian->no_periksa)->first();
            return view('dokter::pemeriksaan.form', compact('id', 'antrian', 'pemeriksaan'));
        }
    }

    public function formLampiran(Request $request)
    {
        if(empty($request->id)) {
            return '<div class="alert alert-danger">ID Periksa tidak ditemukan</div>';
        } else {
            $id = $request->id;
            $antrian = Antrian::find($id);
            return view('dokter::pemeriksaan.form-lampiran', compact('id', 'antrian'));
        }
    }

    public function process_lampiran(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'diameter' => 'required',
            'jumlah' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $antrian = Antrian::find($id);
        if($antrian) {
            $foto = null;

            $pemeriksaan = Pemeriksaan::where('no_periksa', $antrian->no_periksa)->first();
            $detailPemeriksaan = PemeriksaanDetail::where('id_pemeriksaan', $pemeriksaan->id)->where('diameter', $request->diameter)->where('jumlah', $request->jumlah)->first();
            if(empty($detailPemeriksaan)) {
                if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                    $foto = $request->file('foto')->store('public/images');
                }

                $detailPemeriksaan = new PemeriksaanDetail();
                $detailPemeriksaan->id = Str::uuid();
                $detailPemeriksaan->id_pemeriksaan = $pemeriksaan->id;
                $detailPemeriksaan->diameter = $request->diameter;
                $detailPemeriksaan->jumlah = $request->jumlah;
                $detailPemeriksaan->foto = $foto;
                $detailPemeriksaan->save();

                if($detailPemeriksaan) {
                    return redirect()->back()->with('success', 'Data pemeriksaan berhasil ditambahkan');
                } else {
                    return redirect()->back()->with('error', 'Data pemeriksaan gagal ditambahkan');
                }
            } else {
                return redirect()->back()->with('error', 'Data pemeriksaan sudah ada');
            }
        } else {
            return redirect()->back()->with('error', 'Data pemeriksaan tidak ditemukan');
        }
    }

    public function process(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'diagnosa' => 'required',
            'tindakan' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $antrian = Antrian::find($id);
        if($antrian) {
            $antrian->status = 2;
            $antrian->id_dokter = auth()->user()->id;

            $checkPemeriksaan = Pemeriksaan::where('no_periksa', $antrian->no_periksa)->first();
            if($checkPemeriksaan) {
                $checkPemeriksaan->diagnosa = $request->diagnosa;
                $checkPemeriksaan->tindakan = $request->tindakan;
                $checkPemeriksaan->keterangan_dokter = $request->keterangan_dokter;

                if($checkPemeriksaan->save()) {
                    $antrian->save();
                    return redirect()->back()->with('success', 'Pasien sedang pemeriksaan');
                } else {
                    return redirect()->back()->with('error', 'Pasien gagal pemeriksaan');
                }
            } else {
                return redirect()->back()->with('error', 'Pasien sedang pemeriksaan, silahkan cek data pemeriksaan');
            }
        } else {
            return redirect()->back()->with('error', 'Pasien tidak ditemukan');
        }
    }
}
