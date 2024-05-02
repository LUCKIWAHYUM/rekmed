<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Roles;

use Modules\Seller\Entities\AccountModel;
use App\Enums\GlobalEnum;
use App\Models\LogActivites;
use App\Models\Seller;
use App\Helpers\MailerHelper as Mailers;

use DataTables;
use Carbon\Carbon;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*')->where('level', 1)->orderBy('created_at', 'desc');
            // Convert the Eloquent Collection to a regular PHP array
            $data->each(function ($item, $key) {
                $item->rowIndex = $key + 1;
            });

            return Datatables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('title-post', function($row) {
                    return '
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-25px symbol-circle">
                            <div class="symbol-label" style="background-image:url(' . gravatar_team($row->email) . ')"></div>
                        </div>
                        <div class="ms-3"><span>' . $row->name . '</span></div>
                    </div>
                    ';
                })
                ->addColumn('action', function($row){
                    $view = route('users.show', ['id' => $row->id]);
                    $edit = route('users.edit', ['id' => $row->id]);
                    $delete = route('users.delete', ['id' => $row->id]);
                    $btn = '
                    <a href="' . $view . '" class="btn btn-light btn-sm px-4"><i class="ki-outline ki-eye"></i></a>
                    <a href="' . $edit . '" class="btn btn-light btn-sm px-4"><i class="ki-outline ki-pencil"></i></a>
                    <a data-url="' . $delete . '" href="#" class="btn btn-light btn-sm deleteContent px-4"><i class="ki-outline ki-trash"></i></a>
                    ';
                    return $btn;
                })
                ->addColumn('status', function($row){
                    if ($row->status == GlobalEnum::isActive) {
                        return '<span class="mb-1 badge font-medium badge-success py-2 px-3 fs-7">Active</span>';
                    } elseif($row->status == GlobalEnum::isInactive) {
                        return '<span class="mb-1 badge font-medium badge-primary py-2 px-3 fs-7">Non Active</span>';
                    } elseif($row->status == GlobalEnum::isDeactive) {
                        return '<span class="mb-1 badge font-medium badge-danger py-2 px-3 fs-7">Deactivated</span>';
                    } else {
                        return '<span class="mb-1 badge font-medium badge-warning py-2 px-3 fs-7">Not Verified</span>';
                    }
                })
                ->rawColumns(['title-post','action','status'])
                ->filter(function ($query) use ($request) {
                    if ($request->has('search')) {
                        $search = $request->get('search')['value'];
                        if(!empty($search)) {
                            $query->where('name', 'LIKE', "%$search%");
                            $query->orWhere('email', 'LIKE', "%$search%");
                            $query->where('level', 1);
                        } else {
                            $query->where('level', 1);
                        }
                    }
                })
                ->make(true);
        }

        $data = [
            'subtitle' => 'Users',
            'button' => true,
            'module' => [
                'url' => route('users.create'),
                'name' => 'Create New'
            ]
        ];

        return view('admin.app.users.index', compact('data'));
    }

    public function create()
    {
        $data = [
            'subtitle' => 'Create New'
        ];

        $roles = Roles::whereIn('id', [1,2])->get();
        return view('admin.app.users.add', compact('data', 'roles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'status' => 'required',
            'level' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        $foto_namaBaru = null;
        $userEmailToken = md5(Str::random(25));

        $post = new User([
            'name' => $input['name'],
            'username' => Str::before($input['email'], '@') . rand(100, 999),
            'email' => $input['email'],
            'password' => empty($input['password']) ? bcrypt('default123') : bcrypt($input['password']),
            'status' => $input['status'],
            'level' => $input['level'],
            'thumbnail' => empty($foto_namaBaru) ? '' : $foto_namaBaru,
        ]);

        $check = User::where('email', $input['email'])->count();
        // $insertLog = LogActivites::default([
        //     'causedBy' => user()->id,
        //     'logType' => GlobalEnum::LogOfGeneral,
        //     'withContent' => [
        //         'status' => 'add',
        //         'text' => 'Insert a new user with email ' . $input['email'],
        //     ]
        // ]);
        if ($check == 0) {
            $sendEmail = Mailers::to($input['email'], false, 'email.auth.register', [
                'message' => 'Anda telah berhasil didaftarkan, silahkan catat akun anda',
                'subject' => 'Pendaftaran Pengguna',
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => empty($input['password']) ? 'default123' : $input['password'],
                'token' => $userEmailToken
            ]);

            if ($post->save()) {
                if($sendEmail) {
                    return redirect()->route('users')->with('success', 'You have successfully added data');
                } else {
                    return redirect()->route('users')->with('error', 'An error occurred in the query email');
                }
            } else {
                return redirect()->route('users')->with('error', 'An error occurred in the query');
            }
        } else {
            return redirect()->route('users')->with('error', 'Email already exists');
        }
    }

    public function show($id)
    {
        $data = [
            'subtitle' => User::where('id', $id)->first()->email,
            'records' => User::where('id', $id)->first(),
            'logs' => User::where('id', $id)->first()
        ];
        return view('admin.app.users.detail', compact('data'));
    }

    public function edit($id)
    {
        $data = [
            'subtitle' => User::where('id', $id)->first()->email,
            'records' => User::where('id', $id)->first()
        ];

        $roles = Roles::whereIn('id', [1,2])->get();
        return view('admin.app.users.edit', compact('data', 'id', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'level' => 'required',
            'status' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,svg|max:7048',
        ], [
            'image.mimes' => 'Tipe file yang diunggah harus jpg, jpeg, png, atau svg.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Cari data berdasarkan ID
        $user = User::find($id);

        // Jika data ditemukan
        if ($user) {
            // Jika ada file baru yang diunggah, hapus file thumbnail yang lama
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                if ($user->thumbnail) {
                    Storage::delete($user->thumbnail);
                }
            }

            // Update data dengan data baru dari form yang telah dibersihkan
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            !empty($request->input('password')) ? $user->password = bcrypt($request->input('password')) : $user->password;
            $user->level = $request->input('level');
            $user->status = $request->input('status');
            $user->username = Str::before($user->email, '@') . rand(100, 999);

            // Jika ada file baru yang diunggah, simpan file baru di storage
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $foto_namaBaru = $request->file('image')->store('public/images');
                $user->thumbnail = $foto_namaBaru;
            }

            // Simpan perubahan pada database
            $user->save();
            return redirect()->route('users')->with('swal', swal_alert('success', 'You are successfully modify data'));
        } else {
            return redirect()->route('users')->with('swal', swal_alert('error', 'Unexpected error'));
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        // Jika data ditemukan
        if ($user) {
            // Cek apakah ada file di kolom "is_thumbnail"
            if ($user->thumbnail) {
                // Hapus file thumbnail dari storage
                Storage::delete($user->is_thumbnail);
            }
            // Hapus data dari database
            $user->delete();
            return redirect()->route('users')->with('swal', swal_alert('success', 'You are successfully deleted records'));
        } else {
            return redirect()->route('users')->with('swal', swal_alert('error', 'Data not found'));
        }
    }
}
