<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PdPkl extends Model
{
    protected $table = 'pd_pkl';
    protected $primaryKey = 'pd_pkl_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'pd_pkl_id',
        'peserta_didik_id',
        'pkl_id',
        'created_at',
        'updated_at',
        'last_sync',
        'catatan',
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

    // Relasi ke praktik kerja lapangan
    public function praktikKerjaLapangan()
    {
        return $this->belongsTo(PraktikKerjaLapangan::class, 'pkl_id', 'pkl_id');
    }
}
