<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasus extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'name',
        'nama_pelapor',
        'no_hp',
        'tanggal_kejadian',
        'tempat_kejadian',
        'deskripsi_kejadian',
        'bukti',
        'nama_korban',
        'nama_pelaku',
        'nama_saksi',
        'jenis_kasus',
        'tindak_lanjut',
        'status_kasus',
    ];

    public function user()
    {
        return  $this->belongsTo(User::class, 'id_user');
    }
}
