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

use App\Models\Apoteker;
use App\Models\Poli;
use App\Models\User;

class ApotekerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Apoteker::select('*');
            // Convert the Eloquent Collection to a regular PHP array
            $data->each(function ($item, $key) {
                $item->rowIndex = $key + 1;
            });

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('nama_apoteker', function($row){
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
                ->rawColumns(['is_status', 'register', 'nama_apoteker'])
                ->make(true);
        }

        $data = [
            'subtitle' => 'Apoteker',
            'button' => true,
            'module' => [
                'url' => route('apoteker.create'),
                'name' => 'Tambah Apoteker'
            ]
        ];

        return view('admin.app.content.apoteker.index', compact('data'));
    }

    public function create()
    {
        $data = [
            'subtitle' => 'Tambah Apoteker',
        ];

        return view('admin.app.content.apoteker.add', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_apoteker' => 'required',
            'email' => 'required',
            'password' => 'required',
            'nomer_induk' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }

        $checkAccount = User::where('email', $request->email)->orWhere('name', $request->nama_dokter)->count();
        if($checkAccount < 1) {
            $postAccount = new User([
               'name' => $request->nama_apoteker,
               'email' => $request->email,
               'password' => bcrypt($request->password),
               'username' => Str::before($request->email, '@') . rand(100, 999),
               'level' => 2,
               'status' => 1
            ]);

            if($postAccount->save()) {
                $postApoteker = new Apoteker([
                    'id_user' => $postAccount->id,
                    'nomer_induk' => $request->nomer_induk,
                    'status' => 1
                ]);

                if($postApoteker->save()) {
                    return redirect()->route('apoteker')->with('success', 'Apoteker baru berhasil ditambahkan');
                }
            } else {
                return redirect()->back()->with('error', 'Apoteker baru gagal ditambahkan');
            }
        } else {
            return redirect()->back()->with('error', 'Akun sudah ada');
        }
    }

    public function edit($id)
    {
        $data = [
            'subtitle' => 'Edit Apoteker',
        ];

        $apoteker = Apoteker::find($id);
        return view('admin.app.content.apoteker.edit', compact('data', 'apoteker'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_apoteker' => 'required',
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
            $account->name = $request->nama_apoteker;
            $account->email = $request->email;
            !empty($request->password) ? $account->password = bcrypt($request->password) : $account->password;
            $account->username = Str::before($request->email, '@') . rand(100, 999);

            if($account->save()) {
                $apoteker = Apoteker::where('id_user', $id)->first();
                $apoteker->nomer_induk = $request->nomer_induk;
                $apoteker->status = $request->status;

                if($apoteker->save()) {
                    return redirect()->route('apoteker')->with('success', 'Apoteker baru berhasil diperbarui');
                } else {
                    return redirect()->back()->with('error', 'Apoteker baru gagal diperbarui');
                }
            } else {
                return redirect()->back()->with('error', 'Apoteker baru gagal diperbarui');
            }
        } else {
            return redirect()->back()->with('error', 'Akun tidak ditemukan');
        }
    }

    public function destroy($id)
    {
        $apoteker = Apoteker::find($id);
        $apoteker->user->delete();
        $apoteker->delete();
        return redirect()->route('apoteker')->with('success', 'Apoteker berhasil di hapus');
    }
}
