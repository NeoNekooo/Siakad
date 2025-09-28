<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /**
     * Tabel yang terasosiasi dengan model.
     * @var string
     */
    protected $table = 'settings';

    /**
     * Kunci utama untuk model.
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Menunjukkan apakah ID bersifat auto-incrementing.
     * @var bool
     */
    public $incrementing = true;

    /**
     * Tipe data dari kunci utama.
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * Menunjukkan apakah model harus distempel waktu (timestamped).
     * Diset false karena kolom created_at dan updated_at tidak ada dalam skema dump.
     * @var bool
     */
    public $timestamps = false;

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     * @var array
     */
    protected $fillable = [
        'key',
        'value',
        'sekolah_id',
        'semester_id',
    ];

    /**
     * Atribut yang harus di-cast ke tipe asli.
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'sekolah_id' => 'string', // UUID
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
     * Relasi ke tabel referensi Semester.
     * Diasumsikan model Semester berada di namespace App\Models\Ref\.
     */
    public function semester()
    {
        return $this->belongsTo('App\Models\Ref\Semester', 'semester_id', 'semester_id');
    }
}