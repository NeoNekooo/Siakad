<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRombonganBelajarTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rombongan_belajar', function (Blueprint $table) {
            // Kolom dari skema dump
            $table->uuid('rombongan_belajar_id')->primary();
            $table->uuid('sekolah_id'); // NOT NULL
            $table->string('semester_id', 5); // NOT NULL
            $table->string('jurusan_id', 25)->nullable();
            $table->uuid('jurusan_sp_id')->nullable();
            $table->integer('kurikulum_id'); // NOT NULL
            $table->string('nama', 255); // NOT NULL
            $table->uuid('guru_id'); // NOT NULL (Wali Kelas)
            $table->uuid('ptk_id')->nullable();
            $table->integer('tingkat'); // NOT NULL
            $table->unsignedTinyInteger('jenis_rombel'); // numeric(2,0) NOT NULL
            $table->uuid('rombel_id_dapodik'); // NOT NULL
            $table->integer('kunci_nilai')->default(0); // NOT NULL with default 0
            $table->uuid('rombongan_belajar_id_migrasi')->nullable();

            // Timestamps
            $table->timestamp('created_at', 0)->nullable();
            $table->timestamp('updated_at', 0)->nullable();
            $table->timestamp('deleted_at', 0)->nullable();
            $table->timestamp('last_sync', 0); // NOT NULL

            // Indexes (dari skema dump)
            $table->index('guru_id', 'rombongan_belajar_guru_id_index');
            $table->index('jurusan_id', 'rombongan_belajar_jurusan_id_index');
            $table->index('jurusan_sp_id', 'rombongan_belajar_jurusan_sp_id_index');
            $table->index('sekolah_id', 'rombongan_belajar_sekolah_id_index');

            // Foreign Key Constraints (dari skema dump)

            // Relasi ke public.guru
            $table->foreign('guru_id', 'rombongan_belajar_guru_id_foreign')
                  ->references('guru_id')->on('public.guru')
                  ->onUpdate('cascade')->onDelete('cascade');

            // Relasi ke ref.jurusan
            $table->foreign('jurusan_id', 'rombongan_belajar_jurusan_id_foreign')
                  ->references('jurusan_id')->on('ref.jurusan')
                  ->onUpdate('cascade')->onDelete('cascade');

            // Relasi ke public.jurusan_sp
            $table->foreign('jurusan_sp_id', 'rombongan_belajar_jurusan_sp_id_foreign')
                  ->references('jurusan_sp_id')->on('public.jurusan_sp')
                  ->onUpdate('cascade')->onDelete('cascade');

            // Relasi ke public.sekolah
            $table->foreign('sekolah_id', 'rombongan_belajar_sekolah_id_foreign')
                  ->references('sekolah_id')->on('public.sekolah')
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
        Schema::dropIfExists('rombongan_belajar');
    }
}