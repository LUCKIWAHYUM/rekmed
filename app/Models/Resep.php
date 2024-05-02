<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Roles;

class Resep extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tbl_resep_pasien';
    protected $fillable = [
        'id',
        'id_obat',
        'no_periksa',
        'no_resep',
        'aturan_pakai',
        'is_pribadi',
        'status',
    ];

    public $keyType = 'string';
}
