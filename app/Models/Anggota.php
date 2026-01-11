<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $fillable = [
        'nim',
        'nama',
        'email',
        'no_hp',
        'jenis_kelamin',
        'alamat',
        'fakultas',
        'prodi',
        'angkatan',
        'status',
        'tanggal_masuk',
        'foto',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
    ];
}
