<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Digunakan karena adanya kolom deleted_at

class PesertaDidik extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Tabel yang terasosiasi dengan model.
     * @var string
     */
    protected $table = 'peserta_didik';

    /**
     * Kunci utama untuk model.
     * @var string
     */
    protected $primaryKey = 'peserta_didik_id';

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
     * Diset false karena created_at/updated_at didefinisikan secara eksplisit di fillable.
     * @var bool
     */
    public $timestamps = false;

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     * @var array
     */
    protected $fillable = [
        'peserta_didik_id',
        'peserta_didik_id_dapodik',
        'sekolah_id',
        'nama',
        'no_induk',
        'nisn',
        'nik',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama_id',
        'status',
        'anak_ke',
        'alamat',
        'rt',
        'rw',
        'desa_kelurahan',
        'kecamatan',
        'kode_pos',
        'no_telp',
        'sekolah_asal',
        'diterima_kelas',
        'diterima',
        'kode_wilayah',
        'email',
        'nama_ayah',
        'nama_ibu',
        'kerja_ayah',
        'kerja_ibu',
        'nama_wali',
        'alamat_wali',
        'telp_wali',
        'kerja_wali',
        'photo',
        'active',
        'peserta_didik_id_migrasi',
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
        'peserta_didik_id' => 'string',
        'sekolah_id' => 'string',
        'tanggal_lahir' => 'date',
        'diterima' => 'date',
        'active' => 'boolean', // Untuk numeric(1,0)
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'last_sync' => 'datetime',
    ];

    // --- Relasi (Relationships) ---

    /**
     * Relasi ke tabel pekerjaan untuk Ayah.
     * Diasumsikan model Pekerjaan berada di namespace App\Models\Ref\.
     */
    public function pekerjaanAyah()
    {
        return $this->belongsTo('App\Models\Ref\Pekerjaan', 'kerja_ayah', 'pekerjaan_id');
    }

    /**
     * Relasi ke tabel pekerjaan untuk Ibu.
     */
    public function pekerjaanIbu()
    {
        return $this->belongsTo('App\Models\Ref\Pekerjaan', 'kerja_ibu', 'pekerjaan_id');
    }

    /**
     * Relasi ke tabel pekerjaan untuk Wali.
     */
    public function pekerjaanWali()
    {
        return $this->belongsTo('App\Models\Ref\Pekerjaan', 'kerja_wali', 'pekerjaan_id');
    }

    /**
     * Relasi ke tabel wilayah.
     * Diasumsikan model MstWilayah berada di namespace App\Models\Ref\.
     */
    public function wilayah()
    {
        return $this->belongsTo('App\Models\Ref\MstWilayah', 'kode_wilayah', 'kode_wilayah');
    }

    /**
     * Relasi ke tabel sekolah.
     * Diasumsikan model Sekolah berada di namespace App\Models\.
     */
    public function sekolah()
    {
        return $this->belongsTo('App\Models\Sekolah', 'sekolah_id', 'sekolah_id');
    }
}