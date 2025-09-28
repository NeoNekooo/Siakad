<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Digunakan karena adanya kolom deleted_at

class RombonganBelajar extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Tabel yang terasosiasi dengan model.
     * @var string
     */
    protected $table = 'rombongan_belajar';

    /**
     * Kunci utama untuk model.
     * @var string
     */
    protected $primaryKey = 'rombongan_belajar_id';

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
        'rombongan_belajar_id',
        'sekolah_id',
        'semester_id',
        'jurusan_id',
        'jurusan_sp_id',
        'kurikulum_id',
        'nama',
        'guru_id',
        'ptk_id',
        'tingkat',
        'jenis_rombel',
        'rombel_id_dapodik',
        'kunci_nilai',
        'rombongan_belajar_id_migrasi',
        'created_at',
        'updated_at',
        'deleted_at',
        'last_sync',
    ];

    /**
     * Atribut yang harus di-cast ke tipe asli.
     * @var array
     */
    protected $casts = [
        'rombongan_belajar_id' => 'string',
        'sekolah_id' => 'string',
        'jurusan_sp_id' => 'string',
        'guru_id' => 'string',
        'ptk_id' => 'string',
        'rombel_id_dapodik' => 'string',
        'rombongan_belajar_id_migrasi' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
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
     * Relasi ke tabel Guru (Wali Kelas).
     */
    public function guru()
    {
        return $this->belongsTo('App\Models\Guru', 'guru_id', 'guru_id');
    }
    
    /**
     * Relasi ke tabel referensi Jurusan.
     * Diasumsikan model Jurusan berada di namespace App\Models\Ref\.
     */
    public function jurusan()
    {
        return $this->belongsTo('App\Models\Ref\Jurusan', 'jurusan_id', 'jurusan_id');
    }
    
    /**
     * Relasi ke tabel Jurusan SP.
     */
    public function jurusanSp()
    {
        return $this->belongsTo('App\Models\JurusanSp', 'jurusan_sp_id', 'jurusan_sp_id');
    }

    // Catatan: Relasi ke tabel 'ref.semester' (melalui 'semester_id') dan relasi ke tabel yang memiliki 'ptk_id'
    // tidak memiliki FK constraint di skema dump, namun Anda mungkin ingin menambahkannya di sini:
    // public function semester() { return $this->belongsTo('App\Models\Ref\Semester', 'semester_id', 'semester_id'); }
    // public function ptk() { return $this->belongsTo('App\Models\Ptk', 'ptk_id', 'ptk_id'); }
}