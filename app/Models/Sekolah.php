<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Digunakan karena adanya kolom deleted_at

class Sekolah extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Tabel yang terasosiasi dengan model.
     * @var string
     */
    protected $table = 'sekolah';

    /**
     * Kunci utama untuk model.
     * @var string
     */
    protected $primaryKey = 'sekolah_id';

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
        'sekolah_id',
        'npsn',
        'nama',
        'nss',
        'alamat',
        'desa_kelurahan',
        'kecamatan',
        'kode_wilayah',
        'kabupaten',
        'provinsi',
        'kode_pos',
        'lintang',
        'bujur',
        'no_telp',
        'no_fax',
        'email',
        'website',
        'guru_id',
        'status_sekolah',
        'sinkron',
        'logo_sekolah',
        'bentuk_pendidikan_id',
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
        'sekolah_id' => 'string',
        'guru_id' => 'string',
        'status_sekolah' => 'integer',
        'sinkron' => 'integer',
        'bentuk_pendidikan_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'last_sync' => 'datetime',
    ];

    // --- Relasi (Relationships) ---

    /**
     * Relasi ke tabel Guru (Kepala Sekolah atau PTK yang ditunjuk).
     */
    public function guru()
    {
        return $this->belongsTo('App\Models\Guru', 'guru_id', 'guru_id');
    }

    /**
     * Relasi ke tabel referensi MstWilayah (Wilayah Administrasi).
     * Diasumsikan model MstWilayah berada di namespace App\Models\Ref\.
     */
    public function wilayah()
    {
        return $this->belongsTo('App\Models\Ref\MstWilayah', 'kode_wilayah', 'kode_wilayah');
    }
}