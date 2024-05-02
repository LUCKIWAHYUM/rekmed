<?php

namespace Modules\Perawat\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Models\User;
use App\Models\Pasien;
use App\Models\Antrian;

class PerawatController extends Controller
{
    public function index()
    {
        $data = [
            'subtitle' => 'Halaman Utama',
        ];

        return view('perawat::index', compact('data'));
    }

    public function profile()
    {
        $data = [
            'subtitle' => 'Akun anda',
        ];

        return view('perawat::setting', compact('data'));
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
