<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleUserTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            // Kolom dari skema dump
            $table->bigInteger('role_id'); // NOT NULL
            $table->uuid('user_id'); // NOT NULL
            $table->string('user_type', 255); // NOT NULL
            $table->bigInteger('team_id')->nullable();

            // Constraint UNIQUE gabungan (dari skema dump)
            $table->unique(
                ['user_id', 'role_id', 'user_type', 'team_id'],
                'role_user_user_id_role_id_user_type_team_id_unique'
            );

            // Foreign Key Constraints (dari skema dump)

            // Relasi ke public.roles
            $table->foreign('role_id', 'role_user_role_id_foreign')
                  ->references('id')->on('public.roles')
                  ->onUpdate('cascade')->onDelete('cascade');

            // Relasi ke public.teams
            $table->foreign('team_id', 'role_user_team_id_foreign')
                  ->references('id')->on('public.teams')
                  ->onUpdate('cascade')->onDelete('cascade');

            // Catatan: Relasi ke 'user_id' tidak bisa dibuat tanpa mengetahui tabel 'users' yang dituju.
            // Dalam kasus Laravel, 'user_id' biasanya terhubung ke tabel users, ptk, atau peserta_didik.
            // Karena tidak ada FK di skema Anda, kami hanya mengikuti skema yang ada.
        });
    }

    /**
     * Balikkan migrasi.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_user');
    }
}