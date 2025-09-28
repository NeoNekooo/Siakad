<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// Asumsi Anda akan menambahkan trait UUIDs secara manual atau melalui package

class GelarPtk extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'gelar_ptk';
    protected $primaryKey = 'gelar_ptk_id';
    
    // Konfigurasi untuk UUID
    public $incrementing = false;
    protected $keyType = 'string';

    // Daftar kolom yang bisa diisi (sesuai skema)
    protected $fillable = [
        'sekolah_id',
        'gelar_akademik_id',
        'guru_id',
        'ptk_id',
        'last_sync',
    ];

    // Casts
    protected $casts = [
        'last_sync' => 'datetime',
    ];
    
    /**
     * RELASI (Jika Model terkait sudah ada)
     */
    
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id', 'guru_id');
    }
}
