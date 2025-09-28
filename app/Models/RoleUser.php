<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// Model pivot umumnya tidak memiliki timestamps,
// jadi kita tidak perlu menambahkan trait SoftDeletes atau kolom created_at/updated_at.

class RoleUser extends Model
{
    use HasFactory;

    /**
     * Tabel yang terasosiasi dengan model.
     * @var string
     */
    protected $table = 'role_user';

    /**
     * Tabel pivot biasanya tidak memiliki primary key otomatis.
     * @var bool
     */
    public $incrementing = false;

    /**
     * Tabel pivot biasanya tidak memiliki timestamps.
     * @var bool
     */
    public $timestamps = false;

    /**
     * Kunci gabungan yang dapat diisi secara massal (mass assignable).
     * @var array
     */
    protected $fillable = [
        'role_id',
        'user_id',
        'user_type',
        'team_id',
    ];

    /**
     * Atribut yang harus di-cast ke tipe asli.
     * @var array
     */
    protected $casts = [
        'role_id' => 'integer',
        'user_id' => 'string', // UUID
        'team_id' => 'integer',
    ];


    // --- Relasi (Relationships) ---

    // Relasi model pivot lebih sering didefinisikan pada model utama (User, Role, Team)
    // menggunakan metode belongsToMany(). Namun, jika Anda menggunakan model pivot secara langsung:

    /**
     * Relasi ke model Role.
     */
    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'role_id', 'id');
    }

    /**
     * Relasi ke model Team.
     */
    public function team()
    {
        return $this->belongsTo('App\Models\Team', 'team_id', 'id');
    }

    // Catatan: Relasi ke User/PTK/PesertaDidik bergantung pada nilai 'user_type',
    // sehingga memerlukan logika polimorfik atau method yang dinamis.
}