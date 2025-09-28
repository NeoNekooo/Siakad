<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembelajaran extends Model
{
    use SoftDeletes;

    protected $table = 'pembelajaran';
    protected $primaryKey = 'pembelajaran_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'pembelajaran_id',
        'pembelajaran_id_dapodik',
        'sekolah_id',
        'semester_id',
        'rombongan_belajar_id',
        'guru_id',
        'guru_pengajar_id',
        'mata_pelajaran_id',
        'nama_mata_pelajaran',
        'kelompok_id',
        'no_urut',
        'kkm',
        'is_dapodik',
        'rasio_p',
        'rasio_k',
        'pembelajaran_id_migrasi',
        'created_at',
        'updated_at',
        'deleted_at',
        'last_sync',
        'induk_pembelajaran_id',
        'bobot_sumatif_materi',
        'bobot_sumatif_akhir',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'last_sync',
    ];

    // Relasi guru utama
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id', 'guru_id');
    }

    // Relasi guru pengajar
    public function guruPengajar()
    {
        return $this->belongsTo(Guru::class, 'guru_pengajar_id', 'guru_id');
    }

    // Relasi ke induk pembelajaran (self relation)
    public function indukPembelajaran()
    {
        return $this->belongsTo(Pembelajaran::class, 'induk_pembelajaran_id', 'pembelajaran_id');
    }

    // Relasi ke kelompok (ref)
    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class, 'kelompok_id', 'kelompok_id');
    }

    // Relasi ke mata pelajaran (ref)
    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id', 'mata_pelajaran_id');
    }

    // Relasi ke rombongan belajar
    public function rombonganBelajar()
    {
        return $this->belongsTo(RombonganBelajar::class, 'rombongan_belajar_id', 'rombongan_belajar_id');
    }

    // Relasi ke sekolah
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }

    // Relasi ke semester (ref)
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'semester_id');
    }
}
