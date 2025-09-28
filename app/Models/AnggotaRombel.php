<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// Asumsi Anda akan menambahkan trait UUIDs secara manual atau melalui package

class AnggotaRombel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'anggota_rombel';
    protected $primaryKey = 'anggota_rombel_id';
    
    // Konfigurasi untuk UUID
    public $incrementing = false;
    protected $keyType = 'string';

    // Daftar kolom yang bisa diisi (sesuai skema)
    protected $fillable = [
        'sekolah_id',
        'semester_id',
        'rombongan_belajar_id',
        'peserta_didik_id',
        'anggota_rombel_id_dapodik',
        'anggota_rombel_id_migrasi',
        'last_sync',
    ];

    // Casts
    protected $casts = [
        'last_sync' => 'datetime',
        // Tambahkan casting untuk kolom UUID jika perlu, meskipun umumnya tidak wajib
        // 'anggota_rombel_id' => 'string',
        // 'sekolah_id' => 'string',
        // ...
    ];
}
