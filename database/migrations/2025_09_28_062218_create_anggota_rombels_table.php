<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota_rombel', function (Blueprint $table) {
            // Primary Key
            $table->uuid('anggota_rombel_id')->primary();

            // Foreign Keys dan Index
            $table->uuid('sekolah_id')->index();
            $table->string('semester_id', 5)->index();
            $table->uuid('rombongan_belajar_id')->index();
            $table->uuid('peserta_didik_id')->index();

            // Kolom Data Tambahan
            $table->uuid('anggota_rombel_id_dapodik');
            $table->uuid('anggota_rombel_id_migrasi')->nullable();
            $table->timestamp('last_sync'); // Tanpa default(now()) agar sesuai dump
            
            // Timestamps dan Soft Deletes
            $table->timestamps();
            $table->softDeletes();
            
            // Definisi Foreign Key Constraints
            $table->foreign('sekolah_id')->references('sekolah_id')->on('sekolah')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('semester_id')->references('semester_id')->on('ref.semester')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('rombongan_belajar_id')->references('rombongan_belajar_id')->on('rombongan_belajar')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('peserta_didik_id')->references('peserta_didik_id')->on('peserta_didik')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anggota_rombel');
    }
};
