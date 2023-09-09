<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $table = 'anggota';

    protected $fillable = ['nik', 'alamat', 'pekerjaan', 'tgl_lahir', 'jenis_kelamin', 'no_hp', 'simpanan_pokok', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function simpanan()
    {
        return $this->hasMany(Simpanan::class);
    }
    public function pengajuanPinjaman()
    {
        return $this->hasMany(PengajuanPinjaman::class, 'anggota_id');
    }
}
