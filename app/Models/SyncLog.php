<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyncLog extends Model
{
    use HasFactory;

    /**
     * Tabel yang terasosiasi dengan model.
     * @var string
     */
    protected $table = 'sync_log';

    /**
     * Kunci utama untuk model.
     * @var string
     */
    protected $primaryKey = 'id';

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
    // Kita set true, tetapi biarkan created_at dan updated_at di fillable/casts karena
    // skema dump mendefinisikan kolomnya, dan Laravel akan mengelolanya.
    public $timestamps = true;

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'created_at',
        'updated_at',
    ];

    /**
     * Atribut yang harus di-cast ke tipe asli.
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'user_id' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // --- Relasi (Relationships) ---

    /**
     * Relasi ke tabel Users.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'user_id');
    }
}