<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Roles;

class PemeriksaanDetail extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tbl_foto_pemeriksaan';
    protected $fillable = [
        'id',
        'id_pemeriksaan',
        'foto',
        'diameter',
        'jumlah'
    ];

    public $keyType = 'string';
    public $timestamps = false;

    public function pemeriksaan()
    {
        return $this->hasOne(Pemeriksaan::class, 'id', 'id_pemeriksaan');
    }
}
