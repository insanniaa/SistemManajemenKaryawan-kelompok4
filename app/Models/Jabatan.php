<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Jabatan extends Model
{
    protected $primaryKey = 'id_jabatan';

    use HasFactory;

    protected $fillable = [
        'id_jabatan',
        'nama_jabatan',
        'gaji_pokok'
    ];

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('id_jabatan', 'like', '%' . $search . '%')->orWhere('nama_jabatan', 'like', '%' . $search . '%');
        });

        $query->when($filters['id_jabatan'] ?? false, fn ($query, $id_jabatan) => $query->whereHas('id_jabatan', fn ($query) =>
        $query->where('id_jabatan', $id_jabatan)));

    }
   
}
