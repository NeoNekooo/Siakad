<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Asumsi model terkait sudah ada
use App\Models\Sekolah;
use App\Models\Guru;
use App\Models\Semester; // Untuk ref.semester

class Kasek extends Model
{
    use HasFactory;

    protected $table = 'kasek';
    protected $primaryKey = 'kasek_id';
    
    // Konfigurasi untuk UUID
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'sekolah_id',
        'guru_id',
        'semester_id',
        'last_sync',
    ];

    protected $casts = [
        'last_sync' => 'datetime',
    ];

    /**
     * RELASI
     */
    
    // Relasi ke tabel Sekolah
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }

    // Relasi ke tabel Guru
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id', 'guru_id');
    }
    
    // Relasi ke tabel Semester (ref.semester)
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'semester_id');
    }
}
