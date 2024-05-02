<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pasien extends Authenticatable
{
    use HasFactory;

    protected $table = 'tbl_pasien';
    protected $fillable = [
        'id',
        'no_rm',
        'no_ktp',
        'no_dana_sehat',
        'no_register',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'pekerjaan',
        'telepon',
        'usia',
        'is_anggota',
        'status',
    ];
}
