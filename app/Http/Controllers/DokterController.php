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

use App\Models\Dokter;
use App\Models\Poli;
use App\Models\User;

class DokterController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Dokter::select('*');
            // Convert the Eloquent Collection to a regular PHP array
            $data->each(function ($item, $key) {
                $item->rowIndex = $key + 1;
            });

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('nama_dokter', function($row){
                    return $row->user->name;
                })
                ->addColumn('poli', function($row){
                    return $row->poli->name;
                })
                ->addColumn('is_status', function($row){
                    if($row->status == 1) {
                        return '<span class="mb-1 badge font-medium badge-success py-2 px-3 fs-7">Aktif</span>';
                    } else {
                        return '<span class="mb-1 badge font-medium badge-danger py-2 px-3 fs-7">Tidak aktif</span>';
                    }
                })
                ->addColumn('register', function($row){
                    return Carbon::parse($row->created_at);
                })
                ->rawColumns(['nama_dokter', 'poli', 'is_status', 'register'])
                ->make(true);
        }

        $data = [
            'subtitle' => 'Dokter',
            'button' => true,
            'module' => [
                'url' => route('dokter.create'),
                'name' => 'Tambah Dokter'
            ]
        ];

        return view('admin.app.content.dokter.index', compact('data'));
    }

    public function create()
    {
        $data = [
            'subtitle' => 'Tambah Dokter',
        ];

        $poli = Poli::all();
        return view('admin.app.content.dokter.add', compact('data', 'poli'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_dokter' => 'required',
            'email' => 'required',
            'password' => 'required',
            'id_poli' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'jadwal_praktek' => 'required',
            'nomer_induk' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }

        $checkAccount = User::where('email', $request->email)->orWhere('name', $request->nama_dokter)->count();
        if($checkAccount < 1) {
            $postAccount = new User([
               'name' => $request->nama_dokter,
               'email' => $request->email,
               'password' => bcrypt($request->password),
               'username' => Str::before($request->email, '@') . rand(100, 999),
               'level' => 2,
               'status' => 1
            ]);

            if($postAccount->save()) {
                $postDokter = new Dokter([
                    'id_user' => $postAccount->id,
                    'id_poli' => $request->id_poli,
                    'alamat' => $request->alamat,
                    'telepon' => $request->telepon,
                    'jadwal_praktek' => $request->jadwal_praktek,
                    'nomer_induk' => $request->nomer_induk,
                    'status' => 1
                ]);

                if($postDokter->save()) {
                    return redirect()->route('dokter')->with('success', 'Dokter baru berhasil ditambahkan');
                }
            } else {
                return redirect()->back()->with('error', 'Dokter baru gagal ditambahkan');
            }
        } else {
            return redirect()->back()->with('error', 'Akun sudah ada');
        }
    }

    public function edit($id)
    {
        $data = [
            'subtitle' => 'Edit Dokter',
        ];

        $dokter = Dokter::find($id);
        $poli = Poli::all();
        return view('admin.app.content.dokter.edit', compact('data', 'dokter', 'poli'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_dokter' => 'required',
            'email' => 'required',
            'id_poli' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'jadwal_praktek' => 'required',
            'nomer_induk' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }

        $checkAccount = User::find($id);
        if($checkAccount) {
            $account = User::find($id);
            $account->name = $request->nama_dokter;
            $account->email = $request->email;
            !empty($request->password) ? $account->password = bcrypt($request->password) : $account->password;
            $account->username = Str::before($request->email, '@') . rand(100, 999);

            if($account->save()) {
                $dokter = Dokter::where('id_user', $id)->first();
                $dokter->id_poli = $request->id_poli;
                $dokter->alamat = $request->alamat;
                $dokter->telepon = $request->telepon;
                $dokter->jadwal_praktek = $request->jadwal_praktek;
                $dokter->nomer_induk = $request->nomer_induk;
                $dokter->status = $request->status;

                if($dokter->save()) {
                    return redirect()->route('dokter')->with('success', 'Dokter baru berhasil diperbarui');
                } else {
                    return redirect()->back()->with('error', 'Dokter baru gagal diperbarui');
                }
            } else {
                return redirect()->back()->with('error', 'Dokter baru gagal diperbarui');
            }
        } else {
            return redirect()->back()->with('error', 'Akun tidak ditemukan');
        }
    }

    public function destroy($id)
    {
        $dokter = Dokter::find($id);
        $dokter->user->delete();
        $dokter->delete();
        return redirect()->route('dokter')->with('success', 'Dokter berhasil di hapus');
    }
}
