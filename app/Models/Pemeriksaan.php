<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Roles;

class Pemeriksaan extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tbl_pemeriksaan';
    protected $fillable = [
        'id',
        'id_antrian',
        'no_periksa',
        'keluhan',
        'tinggi',
        'berat',
        'tekanan',
        'nadi',
        'alergi',
        'keterangan',
        'biaya',
        'status_pembayaran',
    ];

    public $keyType = 'string';

    public function antrian()
    {
        return $this->hasOne(Antrian::class, 'id', 'id_antrian');
    }

    public function detail()
    {
        return $this->hasMany(PemeriksaanDetail::class, 'id_pemeriksaan', 'id');
    }
}
