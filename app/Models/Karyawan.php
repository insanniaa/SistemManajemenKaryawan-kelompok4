<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'jabatan',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'tanggal_bergabung',
        'nomor_handphone',
        'nomor_rekening'
    ];

    // protected $with = ['gaji'];

    // public function gaji()
    // {
    //     return $this->belongsTo(Gaji::class);
    // }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')->orWhere('jabatan', 'like', '%' . $search . '%');
        });

        $query->when($filters['id'] ?? false, fn ($query, $id) => $query->whereHas('id', fn ($query) =>
        $query->where('id', $id)));
    }

    
}
