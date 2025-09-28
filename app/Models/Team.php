<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    /**
     * Tabel yang terasosiasi dengan model.
     * @var string
     */
    protected $table = 'teams';

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
    protected $keyType = 'integer'; // bigint

    /**
     * Menunjukkan apakah model harus distempel waktu (timestamped).
     * @var bool
     */
    // Kita set true (default Laravel) dan biarkan created_at/updated_at di fillable/casts
    // untuk mencerminkan kolom yang ada di skema dump (walaupun nullable).
    public $timestamps = true;

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     * @var array
     */
    protected $fillable = [
        'name',
        'display_name',
        'description',
        'created_at',
        'updated_at',
    ];

    /**
     * Atribut yang harus di-cast ke tipe asli.
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // --- Relasi (Relationships) ---

    // Karena tidak ada Foreign Key yang didefinisikan dalam skema dump untuk tabel ini,
    // tidak ada relasi langsung yang dibuat di sini. Relasi biasanya didefinisikan pada
    // tabel pivot seperti 'role_user' (seperti yang terlihat sebelumnya) atau tabel lain.
}