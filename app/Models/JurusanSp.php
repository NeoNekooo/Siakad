<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Asumsi model terkait sudah ada
use App\Models\Sekolah;
use App\Models\Jurusan; // Untuk ref.jurusan

class JurusanSp extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jurusan_sp';
    protected $primaryKey = 'jurusan_sp_id';
    
    // Konfigurasi untuk UUID
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'jurusan_sp_id_dapodik',
        'sekolah_id',
        'jurusan_id',
        'nama_jurusan_sp',
        'last_sync',
    ];

    protected $casts = [
        'last_sync' => 'datetime',
    ];

    /**
     * RELASI
     */
    
    // Relasi ke tabel Sekolah (public.sekolah)
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }

    // Relasi ke tabel Jurusan (ref.jurusan)
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id', 'jurusan_id');
    }
}
