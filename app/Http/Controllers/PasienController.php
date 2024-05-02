<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use DataTables;
use GuzzleHttp\Client;
use Carbon\Carbon;

use App\Models\Pasien;
use App\Models\Antrian;

class PasienController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pasien::select('*');
            // Convert the Eloquent Collection to a regular PHP array
            $data->each(function ($item, $key) {
                $item->rowIndex = $key + 1;
            });

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('anggota', function($row){
                    if($row->is_anggota == 1) {
                        return '<span class="mb-1 badge font-medium badge-danger py-2 px-3 fs-7">Tidak</span>';
                    } else {
                        return '<span class="mb-1 badge font-medium badge-dark py-2 px-3 fs-7">Iya</span>';
                    }
                })
                ->addColumn('is_status', function($row){
                    if($row->status == 1) {
                        return '<span class="mb-1 badge font-medium badge-success py-2 px-3 fs-7">Baru</span>';
                    } else {
                        return '<span class="mb-1 badge font-medium badge-danger py-2 px-3 fs-7">Lama</span>';
                    }
                })
                ->addColumn('kelamin', function($row){
                    if($row->jenis_kelamin == 1) {
                        return 'Laki-laki';
                    } else {
                        return 'Perempuan';
                    }
                })
                ->addColumn('register', function($row){
                    return Carbon::parse($row->created_at);
                })
                ->rawColumns(['anggota', 'is_status', 'register', 'kelamin'])
                ->make(true);
        }

        $data = [
            'subtitle' => 'Pasien',
            'button' => true,
            'module' => [
                'url' => route('pasien.create'),
                'name' => 'Tambah Pasien baru'
            ]
        ];

        return view('admin.app.content.pasien.index', compact('data'));
    }

    public function find(Request $request)
    {
        $data = Pasien::where('no_ktp', $request->no_ktp)->first();
        return view('admin.app.content.pasien.find', compact('data'));
    }

    public function kunjungan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_ktp' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }

        $checkPasien = Pasien::where('no_ktp', $request->no_ktp)->first();
        $lastNumber = Antrian::where('time_in', 'LIKE', Carbon::now()->format('Y-m-d'))->where('status', 3)->max('kode');
        $nomor = $lastNumber ? $lastNumber + 1 : 1;

        $postAntrian = new Antrian([
            'id_user' => $checkPasien->id,
            'kode' => $nomor,
            'status' => 1,
            'time_in' => Carbon::now()
        ]);

        if($postAntrian->save()) {
            return redirect()->route('pasien')->with('success', 'Kunjungan Pasien baru berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Kunjungan Pasien baru gagal ditambahkan');
        }
    }

    public function create()
    {
        $data = [
            'subtitle' => 'Tambah Pasien',
        ];

        return view('admin.app.content.pasien.add', compact('data'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_rm' => 'required',
            'no_regis' => 'required',
            'name' => 'required',
            'no_ktp' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'telepon' => 'required',
            'usia' => 'required',
            'status' => 'required',
            'is_anggota' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }

        $checkAccount = Pasien::where('nama', $request->name)->count();
        if($checkAccount < 1) {
            $postAccount = new Pasien([
               'no_dana_sehat' => $request->no_dana_sehat,
               'no_rm' => $request->no_rm,
               'no_register' => $request->no_regis,
               'nama' => $request->name,
               'no_ktp' => $request->no_ktp,
               'jenis_kelamin' => $request->jenis_kelamin,
               'tempat_lahir' => $request->tempat_lahir,
               'tanggal_lahir' => $request->tanggal_lahir,
               'agama' => $request->agama,
               'pekerjaan' => $request->pekerjaan,
               'telepon' => $request->telepon,
               'usia' => $request->usia,
               'status' => $request->status,
               'is_anggota' => $request->is_anggota
            ]);

            if($postAccount->save()) {
                return redirect()->route('pasien')->with('success', 'Pasien baru berhasil ditambahkan');
            } else {
                return redirect()->back()->with('error', 'Pasien baru gagal ditambahkan');
            }
        } else {
            return redirect()->back()->with('error', 'Pasien sudah ada');
        }
    }

    public function edit($id)
    {
        $data = [
            'subtitle' => 'Edit Pasien',
        ];

        $pasien = Pasien::find($id);
        return view('admin.app.content.pasien.edit', compact('data', 'pasien'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'no_rm' => 'required',
            'no_regis' => 'required',
            'name' => 'required',
            'no_ktp' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'telepon' => 'required',
            'usia' => 'required',
            'status' => 'required',
            'is_anggota' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }

        $checkAccount = Pasien::find($id);
        if($checkAccount) {
            $account = Pasien::find($id);
            $account->no_dana_sehat = $request->no_dana_sehat;
            $account->no_rm = $request->no_rm;
            $account->no_register = $request->no_regis;
            $account->nama = $request->name;
            $account->no_ktp = $request->no_ktp;
            $account->jenis_kelamin = $request->jenis_kelamin;
            $account->tempat_lahir = $request->tempat_lahir;
            $account->tanggal_lahir = $request->tanggal_lahir;
            $account->agama = $request->agama;
            $account->pekerjaan = $request->pekerjaan;
            $account->telepon = $request->telepon;
            $account->usia = $request->usia;
            $account->status = $request->status;
            $account->is_anggota = $request->is_anggota;

            if($account->save()) {
                return redirect()->route('pasien')->with('success', 'Pasien baru berhasil diperbarui');
            } else {
                return redirect()->back()->with('error', 'Pasien baru gagal diperbarui');
            }
        } else {
            return redirect()->back()->with('error', 'Pasien tidak ditemukan');
        }
    }

    public function destroy($id)
    {
        $pasien = Pasien::find($id);
        $pasien->delete();
        return redirect()->route('pasien')->with('success', 'Pasien berhasil di hapus');
    }
}
