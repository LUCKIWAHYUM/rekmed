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
use App\Models\Tindakan;

class TindakanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Tindakan::select('*');
            // Convert the Eloquent Collection to a regular PHP array
            $data->each(function ($item, $key) {
                $item->rowIndex = $key + 1;
            });

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('harga', function($row){
                    return 'Rp. ' . number_format($row->price, 0, ',', '.');
                })
                ->addColumn('is_status', function($row){
                    if($row->status == 1) {
                        return '<span class="mb-1 badge font-medium badge-success py-2 px-3 fs-7">Aktif</span>';
                    } else {
                        return '<span class="mb-1 badge font-medium badge-danger py-2 px-3 fs-7">Tidak Aktif</span>';
                    }
                })
                ->addColumn('register', function($row){
                    return Carbon::parse($row->created_at);
                })
                ->rawColumns(['is_status', 'harga', 'register'])
                ->make(true);
        }

        $data = [
            'subtitle' => 'Tindakan',
            'button' => true,
            'module' => [
                'url' => site_url('dokter', 'tindakan/create'),
                'name' => 'Tindakan Baru',
            ]
        ];

        return view('dokter::tindakan.index', compact('data'));
    }

    public function create()
    {
        $data = [
            'subtitle' => 'Tindakan',
        ];

        return view('dokter::tindakan.add', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $checkTindakan = Tindakan::where('name', $request->name)->first();
        if($checkTindakan) {
            return redirect()->back()->with('error', 'Tindakan sudah ada');
        } else {
            $tindakan = new Tindakan();
            $tindakan->id_dokter = user()->id;
            $tindakan->name = $request->name;
            $tindakan->description = $request->description;
            $tindakan->price = $request->price;
            $tindakan->status = 1;

            if($tindakan->save()) {
                return redirect()->route('tindakan')->with('success', 'Tindakan berhasil ditambahkan');
            } else {
                return redirect()->back()->with('error', 'Tindakan gagal ditambahkan');
            }
        }
    }

    public function edit($id)
    {
        $tindakan = Tindakan::find($id);
        if($tindakan) {
            $data = [
                'subtitle' => 'Perbarui Tindakan',
            ];

            return view('dokter::tindakan.edit', compact('data', 'tindakan'));
        } else {
            return redirect()->back()->with('error', 'Tindakan tidak ditemukan');
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $tindakan = Tindakan::find($id);
        if($tindakan) {
            $tindakan->name = $request->name;
            $tindakan->description = $request->description;
            $tindakan->price = $request->price;
            $tindakan->status = $request->status;
            if($tindakan->save()) {
                return redirect()->route('tindakan')->with('success', 'Tindakan berhasil diperbarui');
            } else {
                return redirect()->back()->with('error', 'Tindakan gagal diperbarui');
            }
        } else {
            return redirect()->back()->with('error', 'Tindakan tidak ditemukan');
        }
    }

    public function destroy($id)
    {
        $tindakan = Tindakan::find($id);
        if($tindakan) {
            if($tindakan->delete()) {
                return redirect()->back()->with('success', 'Tindakan berhasil dihapus');
            } else {
                return redirect()->back()->with('error', 'Tindakan gagal dihapus');
            }
        } else {
            return redirect()->back()->with('error', 'Tindakan tidak ditemukan');
        }
    }
}
