<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// Asumsi Anda akan menambahkan trait UUIDs secara manual atau melalui package

class Dudi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'dudi';
    protected $primaryKey = 'dudi_id';
    
    // Konfigurasi untuk UUID
    public $incrementing = false;
    protected $keyType = 'string';

    // Daftar kolom yang bisa diisi (sesuai skema)
    protected $fillable = [
        'dudi_id_dapodik',
        'sekolah_id',
        'nama',
        'bidang_usaha_id',
        'nama_bidang_usaha',
        'alamat_jalan',
        'rt',
        'rw',
        'nama_dusun',
        'desa_kelurahan',
        'kode_wilayah',
        'kode_pos',
        'lintang',
        'bujur',
        'nomor_telepon',
        'nomor_fax',
        'email',
        'website',
        'npwp',
        'last_sync',
    ];

    // Casts
    protected $casts = [
        // Cast kolom koordinat dan numerik ke float atau decimal
        'rt' => 'integer',
        'rw' => 'integer',
        'lintang' => 'decimal:12', // Cast sebagai decimal dengan 12 digit presisi
        'bujur' => 'decimal:12', // Cast sebagai decimal dengan 12 digit presisi
        'last_sync' => 'datetime',
    ];
    
    // Relasi ke Model Sekolah
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }
}
