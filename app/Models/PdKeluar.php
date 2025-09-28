<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PdKeluar extends Model
{
    protected $table = 'pd_keluar';
    protected $primaryKey = 'pd_keluar_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'pd_keluar_id',
        'peserta_didik_id',
        'sekolah_id',
        'semester_id',
        'created_at',
        'updated_at',
        'last_sync',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'last_sync',
    ];

    // Relasi ke peserta_didik
    public function pesertaDidik()
    {
        return $this->belongsTo(PesertaDidik::class, 'peserta_didik_id', 'peserta_didik_id');
    }

    // Relasi ke sekolah
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }

    // Relasi ke semester (ref.semester)
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'semester_id');
    }
}
