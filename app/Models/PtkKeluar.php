<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PtkKeluar extends Model
{
    use HasFactory;

    /**
     * Tabel yang terasosiasi dengan model.
     * @var string
     */
    protected $table = 'ptk_keluar';

    /**
     * Kunci utama untuk model.
     * @var string
     */
    protected $primaryKey = 'ptk_keluar_id';

    /**
     * Menunjukkan apakah ID bersifat auto-incrementing.
     * @var bool
     */
    public $incrementing = false;

    /**
     * Tipe data dari kunci utama.
     * @var string
     */
    protected $keyType = 'string'; // Untuk UUID

    /**
     * Menunjukkan apakah model harus distempel waktu (timestamped).
     * @var bool
     */
    public $timestamps = false; // Karena created_at/updated_at didefinisikan secara eksplisit

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     * @var array
     */
    protected $fillable = [
        'ptk_keluar_id',
        'guru_id',
        'sekolah_id',
        'semester_id',
        'created_at',
        'updated_at',
        'last_sync',
    ];

    /**
     * Atribut yang harus di-cast ke tipe asli.
     * @var array
     */
    protected $casts = [
        'ptk_keluar_id' => 'string',
        'guru_id' => 'string',
        'sekolah_id' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'last_sync' => 'datetime',
    ];

    // --- Relasi (Relationships) ---

    /**
     * Relasi ke tabel Guru.
     */
    public function guru()
    {
        return $this->belongsTo('App\Models\Guru', 'guru_id', 'guru_id');
    }

    /**
     * Relasi ke tabel Sekolah.
     */
    public function sekolah()
    {
        return $this->belongsTo('App\Models\Sekolah', 'sekolah_id', 'sekolah_id');
    }

    /**
     * Relasi ke tabel referensi Semester.
     * Diasumsikan model Semester berada di namespace App\Models\Ref\.
     */
    public function semester()
    {
        return $this->belongsTo('App\Models\Ref\Semester', 'semester_id', 'semester_id');
    }
}