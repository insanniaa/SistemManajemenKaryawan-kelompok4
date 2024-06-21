<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'name',
        // 'jabatan',
        'karyawan_id',
        'hari',
        'jam_masuk',
        'jam_keluar'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
            ->orWhere('start_time', 'like', '%' . $search . '%')
            ->orWhere('end_time', 'like', '%' . $search . '%');
    
        });

        $query->when($filters['id'] ?? false, function ($query, $id) {
            return $query->where('id', $id);
        });
    }

    public function karyawan(): BelongsTo
    {
        return $this->belongsTo(Karyawan::class);
    }
}
