<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// Asumsi Anda akan menambahkan trait UUIDs secara manual atau melalui package

class Ekstrakurikuler extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ekstrakurikuler';
    protected $primaryKey = 'ekstrakurikuler_id';
    
    // Konfigurasi untuk UUID
    public $incrementing = false;
    protected $keyType = 'string';

    // Daftar kolom yang bisa diisi (sesuai skema)
    protected $fillable = [
        'sekolah_id',
        'semester_id',
        'guru_id',
        'rombongan_belajar_id',
        'nama_ekskul',
        'nama_ketua',
        'nomor_kontak',
        'alamat_ekskul',
        'is_dapodik',
        'id_kelas_ekskul',
        'ekstrakurikuler_id_migrasi',
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
    
    public function rombonganBelajar()
    {
        return $this->belongsTo(RombonganBelajar::class, 'rombongan_belajar_id', 'rombongan_belajar_id');
    }
}
