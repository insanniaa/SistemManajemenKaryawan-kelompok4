<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;
    protected $fillable = ['id_gaji', 'nama_karyawan', 'jabatan', 'bulan', 'gaji_pokok', 'potongan', 'total_gaji'];
    protected $table = 'gaji';
    public $timestamps = false;
}
