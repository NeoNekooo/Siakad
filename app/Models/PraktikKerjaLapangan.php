<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PraktikKerjaLapangan extends Model
{
    use HasFactory;

    /**
     * Tabel yang terasosiasi dengan model.
     * @var string
     */
    protected $table = 'praktik_kerja_lapangan';

    /**
     * Kunci utama untuk model.
     * @var string
     */
    protected $primaryKey = 'pkl_id';

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
        'pkl_id',
        'sekolah_id',
        'guru_id',
        'rombongan_belajar_id',
        'akt_pd_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'semester_id',
        'instruktur',
        'nip',
        'created_at',
        'updated_at',
        'last_sync',
    ];

    /**
     * Atribut yang harus di-cast ke tipe asli.
     * @var array
     */
    protected $casts = [
        'pkl_id' => 'string',
        'sekolah_id' => 'string',
        'guru_id' => 'string',
        'rombongan_belajar_id' => 'string',
        'akt_pd_id' => 'string',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'last_sync' => 'datetime',
    ];

    // --- Relasi (Relationships) ---

    /**
     * Relasi ke tabel Sekolah.
     */
    public function sekolah()
    {
        return $this->belongsTo('App\Models\Sekolah', 'sekolah_id', 'sekolah_id');
    }

    /**
     * Relasi ke tabel Guru (Pembimbing PKL).
     */
    public function guru()
    {
        return $this->belongsTo('App\Models\Guru', 'guru_id', 'guru_id');
    }

    /**
     * Relasi ke tabel Rombongan Belajar (Kelas).
     */
    public function rombonganBelajar()
    {
        return $this->belongsTo('App\Models\RombonganBelajar', 'rombongan_belajar_id', 'rombongan_belajar_id');
    }

    /**
     * Relasi ke tabel Aktivitas Peserta Didik.
     */
    public function aktivitasPesertaDidik()
    {
        return $this->belongsTo('App\Models\AktPd', 'akt_pd_id', 'akt_pd_id');
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