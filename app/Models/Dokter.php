<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Roles;

class Dokter extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tbl_dokter';
    protected $fillable = [
        'id',
        'id_user',
        'id_poli',
        'nomer_induk',
        'alamat',
        'telepon',
        'jadwal_praktek',
        'status',
    ];

    public function poli()
    {
        return $this->hasOne(Poli::class, 'id', 'id_poli');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }
}
