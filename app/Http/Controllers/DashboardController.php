<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DataTables;

use App\Enums\GlobalEnum as Status;
use App\Models\User;
use App\Models\LogActivites;

use App\Models\Apoteker;
use App\Models\Dokter;
use App\Models\Perawat;
use App\Models\Pasien;
use App\Models\Antrian;
use App\Models\Pemeriksaan;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'subtitle' => 'Halaman Utama',
        ];

        $apoteker = Apoteker::count();
        $dokter = Dokter::count();
        $perawat = Perawat::count();
        $getPasienBulanIni = Pasien::whereMonth('created_at', date('m'))->count();
        $getAntrianBulanIni = Antrian::whereMonth('created_at', date('m'))->count();
        $getPembayaranLunasBulanIni = Pemeriksaan::whereMonth('created_at', date('m'))->where('status_pembayaran', 1)->count();
        $getPembayaranBelumBulanIni = Pemeriksaan::whereMonth('created_at', date('m'))->where('status_pembayaran', 2)->count();

        return view('admin.app.dashboard.index', compact('data', 'apoteker', 'dokter', 'perawat', 'getPasienBulanIni', 'getAntrianBulanIni', 'getPembayaranLunasBulanIni', 'getPembayaranBelumBulanIni'));
    }

    public function profile()
    {
        $data = [
            'subtitle' => 'Akun anda',
        ];

        return view('admin.app.users.setting', compact('data'));
    }

    public function update(Request $request)
    {
        $id = user()->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        $findUser = User::find($id);

        if($findUser) {
            // update data
            $findUser->name = $input['name'];
            $findUser->email = $input['email'];
            $findUser->phone = $input['phone'];
            if(!empty($input['password'])) {
                $findUser->password = bcrypt($input['password']);
            }

            // save data
            $findUser->save();
            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->back()->with('success', 'Tidak ditemukan data!');
        }
    }
}
