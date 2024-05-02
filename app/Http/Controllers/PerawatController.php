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

use App\Models\Perawat;
use App\Models\Poli;
use App\Models\User;

class PerawatController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Perawat::select('*');
            // Convert the Eloquent Collection to a regular PHP array
            $data->each(function ($item, $key) {
                $item->rowIndex = $key + 1;
            });

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('nama_perawat', function($row){
                    return $row->user->name;
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
                ->rawColumns(['is_status', 'register', 'nama_perawat'])
                ->make(true);
        }

        $data = [
            'subtitle' => 'Perawat',
            'button' => true,
            'module' => [
                'url' => route('perawat.create'),
                'name' => 'Tambah Perawat'
            ]
        ];

        return view('admin.app.content.perawat.index', compact('data'));
    }

    public function create()
    {
        $data = [
            'subtitle' => 'Tambah Perawat',
        ];

        return view('admin.app.content.perawat.add', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_perawat' => 'required',
            'email' => 'required',
            'password' => 'required',
            'nomer_induk' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }

        $checkAccount = User::where('email', $request->email)->orWhere('name', $request->nama_perawat)->count();
        if($checkAccount < 1) {
            $postAccount = new User([
               'name' => $request->nama_perawat,
               'email' => $request->email,
               'password' => bcrypt($request->password),
               'username' => Str::before($request->email, '@') . rand(100, 999),
               'level' => 2,
               'status' => 1
            ]);

            if($postAccount->save()) {
                $postDokter = new Perawat([
                    'id_user' => $postAccount->id,
                    'nomer_induk' => $request->nomer_induk,
                    'status' => 1
                ]);

                if($postDokter->save()) {
                    return redirect()->route('perawat')->with('success', 'Perawat baru berhasil ditambahkan');
                }
            } else {
                return redirect()->back()->with('error', 'Perawat baru gagal ditambahkan');
            }
        } else {
            return redirect()->back()->with('error', 'Akun sudah ada');
        }
    }

    public function edit($id)
    {
        $data = [
            'subtitle' => 'Edit Perawat',
        ];

        $perawat = Perawat::find($id);
        return view('admin.app.content.perawat.edit', compact('data', 'perawat'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_perawat' => 'required',
            'email' => 'required',
            'nomer_induk' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }

        $checkAccount = User::find($id);
        if($checkAccount) {
            $account = User::find($id);
            $account->name = $request->nama_perawat;
            $account->email = $request->email;
            !empty($request->password) ? $account->password = bcrypt($request->password) : $account->password;
            $account->username = Str::before($request->email, '@') . rand(100, 999);

            if($account->save()) {
                $perawat = Perawat::where('id_user', $id)->first();
                $perawat->nomer_induk = $request->nomer_induk;
                $perawat->status = $request->status;

                if($perawat->save()) {
                    return redirect()->route('perawat')->with('success', 'Perawat baru berhasil diperbarui');
                } else {
                    return redirect()->back()->with('error', 'Perawat baru gagal diperbarui');
                }
            } else {
                return redirect()->back()->with('error', 'Perawat baru gagal diperbarui');
            }
        } else {
            return redirect()->back()->with('error', 'Akun tidak ditemukan');
        }
    }

    public function destroy($id)
    {
        $perawat = Perawat::find($id);
        $perawat->user->delete();
        $perawat->delete();
        return redirect()->route('perawat')->with('success', 'Perawat berhasil di hapus');
    }
}
