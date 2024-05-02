<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\Pages;
use Carbon\Carbon;
use DataTables;

class PageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pages::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('title-post', function($row){
                    $text = '
                    <p class="mb-0">' . $row->title . '</p>
                    <p class="mb-0 small text-muted">Terakhir diperbarui pada ' . date_formatting(Carbon::parse($row->updated_at, 'Y-m-d'), 'timeago') . '</p>
                    ';
                    return $text;
                })
                ->rawColumns(['title-post'])
                ->make(true);
        }

        $data = [
            'subtitle' => 'Laman',
            'button' => true,
            'module' => [
                'url' => route('page.create'),
                'name' => 'Create New'
            ]
        ];

        return view('admin.app.pages.index', compact('data'));
    }

    public function create()
    {
        $data = [
            'subtitle' => 'Tambah baru',
        ];

        return view('admin.app.pages.add', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Unexpected error, please try again')->withInput();
        }

        $input = $request->all();
        $titleSlug = Str::slug($input['title']);

        $post = new Pages([
            'slug' => $titleSlug,
            'title' => $input['title'], // Membersihkan input judul menggunakan Purifier
            'description' => $input['description'], // Membersihkan input deskripsi menggunakan Purifier
        ]);

        $check = Pages::where('title', $input['title'])->count();
        if ($check == 0) {
            if ($post->save()) {
                return redirect()->route('page')->with('success', 'You have successfully added data');
            } else {
                return redirect()->route('page')->with('error', 'Unexpected error, please try again');
            }
        } else {
            return redirect()->route('page')->with('error', 'Data already exists');
        }
    }

    public function show($id)
    {
        $data = [
            'subtitle' => Pages::where('slug', $id)->first()->title,
            'records' => Pages::where('slug', $id)->first()
        ];
        return view('admin.app.pages.detail', compact('data'));
    }

    public function edit($id)
    {
        $data = [
            'subtitle' => 'Edit: ' . Pages::where('id', $id)->first()->title,
            'records' => Pages::where('id', $id)->first(),
        ];
        $posts = Pages::FindOrFail($id);

        return view('admin.app.pages.edit', compact('data','posts', 'id'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input sebelum memperbarui data
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', 'Unexpected error, please try again');
        }

        // Cari data berdasarkan ID
        $post = Pages::find($id);

        // Jika data ditemukan
        if ($post) {

            // Update data dengan data baru dari form yang telah dibersihkan
            $post->title = $request->input('title');
            $post->slug = Str::slug($request->input('title'));;
            $post->description = $request->input('description');

            // Simpan perubahan pada database
            $post->save();
            return redirect()->route('page')->with('success', 'You are successfully modify data');
        } else {
            return redirect()->route('page')->with('error', 'Data not found');
        }
    }

    public function delete($id)
    {
        // Cari data berdasarkan ID
        $post = Pages::find($id);
        // Jika data ditemukan
        if ($post) {
            // Hapus data dari database
            $post->delete();
            return redirect()->route('page')->with('success', 'You are successfully deleted records');
        } else {
            return redirect()->route('page')->with('error', 'Data not found');
        }
    }
}
