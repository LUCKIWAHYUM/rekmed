<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Roles;

class Antrian extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tbl_antrian';
    protected $fillable = [
        'id',
        'id_poli',
        'id_dokter',
        'id_perawat',
        'id_perawat',
        'id_user',
        'no_periksa',
        'kode',
        'time_in',
        'time_out',
        'status',
    ];

    public function user()
    {
        return $this->hasOne(Pasien::class, 'id', 'id_user');
    }

    public function poli()
    {
        return $this->hasOne(Poli::class, 'id', 'id_poli');
    }

    public function pemeriksaan()
    {
        return $this->hasOne(Pemeriksaan::class, 'id', 'id_antrian');
    }
}
