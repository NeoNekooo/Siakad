<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePtkKeluarTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ptk_keluar', function (Blueprint $table) {
            // Kolom dari skema dump
            $table->uuid('ptk_keluar_id')->primary();
            $table->uuid('guru_id'); // NOT NULL
            $table->uuid('sekolah_id'); // NOT NULL
            $table->string('semester_id', 5); // NOT NULL
            
            // Timestamps
            $table->timestamp('created_at', 0)->nullable();
            $table->timestamp('updated_at', 0)->nullable();
            $table->timestamp('last_sync', 0); // NOT NULL
            
            // Foreign Key Constraints (dari skema dump)

            // Relasi ke public.guru
            $table->foreign('guru_id', 'ptk_keluar_guru_id_foreign')
                  ->references('guru_id')->on('public.guru')
                  ->onUpdate('cascade')->onDelete('cascade');

            // Relasi ke public.sekolah
            $table->foreign('sekolah_id', 'ptk_keluar_sekolah_id_foreign')
                  ->references('sekolah_id')->on('public.sekolah')
                  ->onUpdate('cascade')->onDelete('cascade');

            // Relasi ke ref.semester
            $table->foreign('semester_id', 'ptk_keluar_semester_id_foreign')
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
        Schema::dropIfExists('ptk_keluar');
    }
}