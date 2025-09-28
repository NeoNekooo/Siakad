<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Asumsi model terkait sudah ada
use App\Models\Sekolah;
use App\Models\MstWilayah; 
use App\Models\GelarPtk; 

class Guru extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'guru';
    protected $primaryKey = 'guru_id';

    // Konfigurasi untuk UUID
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'guru_id_dapodik',
        'sekolah_id',
        'nama',
        'nuptk',
        'nip',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'nik',
        'jenis_ptk_id',
        'agama_id',
        'status_kepegawaian_id',
        'alamat',
        'rt',
        'rw',
        'desa_kelurahan',
        'kecamatan',
        'kode_wilayah',
        'kode_pos',
        'no_hp',
        'email',
        'photo',
        'guru_id_erapor',
        'is_dapodik',
        'guru_id_migrasi',
        'last_sync',
        'jabatan_ptk_id',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'is_dapodik' => 'integer',
        'jabatan_ptk_id' => 'float',
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

    // Relasi ke tabel Wilayah (ref.mst_wilayah)
    public function wilayah()
    {
        return $this->belongsTo(MstWilayah::class, 'kode_wilayah', 'kode_wilayah');
    }
    
    // Relasi balik ke Gelar PTK
    public function gelarPtk()
    {
        return $this->hasMany(GelarPtk::class, 'guru_id', 'guru_id');
    }
}
