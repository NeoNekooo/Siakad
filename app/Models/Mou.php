<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mou extends Model
{
    use SoftDeletes;

    protected $table = 'mou';
    protected $primaryKey = 'mou_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'mou_id',
        'mou_id_dapodik',
        'id_jns_ks',
        'dudi_id',
        'dudi_id_dapodik',
        'sekolah_id',
        'nomor_mou',
        'judul_mou',
        'tanggal_mulai',
        'tanggal_selesai',
        'nama_dudi',
        'npwp_dudi',
        'nama_bidang_usaha',
        'telp_kantor',
        'fax',
        'contact_person',
        'telp_cp',
        'jabatan_cp',
        'created_at',
        'updated_at',
        'deleted_at',
        'last_sync',
    ];

    protected $dates = [
        'tanggal_mulai',
        'tanggal_selesai',
        'created_at',
        'updated_at',
        'deleted_at',
        'last_sync',
    ];

    // Relasi ke tabel dudi
    public function dudi()
    {
        return $this->belongsTo(Dudi::class, 'dudi_id', 'dudi_id');
    }

    // Relasi ke tabel sekolah
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }
}
