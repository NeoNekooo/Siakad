<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePraktikKerjaLapanganTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('praktik_kerja_lapangan', function (Blueprint $table) {
            // Kolom dari skema dump
            $table->uuid('pkl_id')->primary();
            $table->uuid('sekolah_id'); // NOT NULL
            $table->uuid('guru_id'); // NOT NULL
            $table->uuid('rombongan_belajar_id'); // NOT NULL
            $table->uuid('akt_pd_id'); // NOT NULL
            $table->date('tanggal_mulai'); // NOT NULL
            $table->date('tanggal_selesai'); // NOT NULL
            $table->string('semester_id', 5); // NOT NULL
            
            // Timestamps
            $table->timestamp('created_at', 0)->nullable();
            $table->timestamp('updated_at', 0)->nullable();
            // last_sync dengan default '1901-01-01 00:00:00'
            $table->timestamp('last_sync', 0)->default('1901-01-01 00:00:00'); 
            
            $table->string('instruktur', 255)->nullable();
            $table->string('nip', 100)->nullable();

            // Foreign Key Constraints (dari skema dump)

            // Relasi ke public.akt_pd
            $table->foreign('akt_pd_id', 'praktik_kerja_lapangan_akt_pd_id_foreign')
                  ->references('akt_pd_id')->on('public.akt_pd')
                  ->onUpdate('cascade')->onDelete('cascade');

            // Relasi ke public.guru
            $table->foreign('guru_id', 'praktik_kerja_lapangan_guru_id_foreign')
                  ->references('guru_id')->on('public.guru')
                  ->onUpdate('cascade')->onDelete('cascade');

            // Relasi ke public.rombongan_belajar
            $table->foreign('rombongan_belajar_id', 'praktik_kerja_lapangan_rombongan_belajar_id_foreign')
                  ->references('rombongan_belajar_id')->on('public.rombongan_belajar')
                  ->onUpdate('cascade')->onDelete('cascade');

            // Relasi ke public.sekolah
            $table->foreign('sekolah_id', 'praktik_kerja_lapangan_sekolah_id_foreign')
                  ->references('sekolah_id')->on('public.sekolah')
                  ->onUpdate('cascade')->onDelete('cascade');

            // Relasi ke ref.semester
            $table->foreign('semester_id', 'praktik_kerja_lapangan_semester_id_foreign')
                  ->references('semester_id')->on('ref.semester')
                  ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Balikkan migrasi.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('praktik_kerja_lapangan');
    }
}