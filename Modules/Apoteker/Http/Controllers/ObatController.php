<?php

namespace Modules\Apoteker\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use DataTables;
use GuzzleHttp\Client;
use Carbon\Carbon;

use App\Models\Obat;

class ObatController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Obat::select('*');
            // Convert the Eloquent Collection to a regular PHP array
            $data->each(function ($item, $key) {
                $item->rowIndex = $key + 1;
            });

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('harga', function($row){
                    if($row->category == 1) {
                        $category = 'Tablet';
                    } elseif($row->category == 2) {
                        $category = 'Kapsul';
                    } elseif($row->category == 3) {
                        $category = 'Kaplet';
                    } elseif($row->category == 4) {
                        $category = 'Pil';
                    } elseif($row->category == 5) {
                        $category = 'Puyer';
                    } elseif($row->category == 6) {
                        $category = 'Sirup';
                    }
                    return 'Rp. ' . number_format($row->price, 0, ',', '.') . ' /' . strtolower($category);
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
                ->rawColumns(['is_status', 'register', 'harga'])
                ->make(true);
        }

        $data = [
            'subtitle' => 'Obat',
            'button' => true,
            'module' => [
                'url' => site_url('apoteker', 'obat/create'),
                'name' => 'Tambah Obat'
            ]
        ];

        return view('apoteker::obat.index', compact('data'));
    }

    public function create()
    {
        $data = [
            'subtitle' => 'Tambah Obat',
        ];

        return view('apoteker::obat.add', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_obat' => 'required',
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }

        $checkObat = Obat::where('name', $request->name)->count();
        if($checkObat < 1) {
            $postObat = new Obat([
               'kode_obat' => $request->kode_obat,
               'name' => $request->name,
               'description' => $request->description,
               'category' => $request->category,
               'price' => $request->price,
               'stock' => $request->stock,
               'status' => 1
            ]);

            if($postObat->save()) {
                return redirect()->url(site_url('apoteker', 'obat'))->with('success', 'Obat baru berhasil ditambahkan');
            } else {
                return redirect()->back()->with('error', 'Obat baru gagal ditambahkan');
            }
        } else {
            return redirect()->back()->with('error', 'Obat sudah ada');
        }
    }

    public function edit($id)
    {
        $data = [
            'subtitle' => 'Edit Obat',
        ];

        $obat = Obat::find($id);
        return view('apoteker::obat.edit', compact('data', 'obat'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kode_obat' => 'required',
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }

        $checkObat = Obat::find($id);
        if($checkObat) {
            $obat = Obat::find($id);
            $obat->kode_obat = $request->kode_obat;
            $obat->name = $request->name;
            $obat->description = $request->description;
            $obat->category = $request->category;
            $obat->price = $request->price;
            $obat->stock = $request->stock;
            $obat->status = $request->status;

            if($obat->save()) {
                return redirect()->url(site_url('apoteker', 'obat'))->with('success', 'Obat baru berhasil diperbarui');
            } else {
                return redirect()->back()->with('error', 'Obat baru gagal diperbarui');
            }
        } else {
            return redirect()->back()->with('error', 'Obat tidak ditemukan');
        }
    }

    public function destroy($id)
    {
        $obat = Obat::find($id);
        $obat->delete();
        return redirect()->url(site_url('apoteker', 'obat'))->with('success', 'Obat berhasil di hapus');
    }
}
