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
        Schema::create('ekstrakurikuler', function (Blueprint $table) {
            // Primary Key
            $table->uuid('ekstrakurikuler_id')->primary();

            // Foreign Keys dan Index
            $table->uuid('sekolah_id')->index();
            $table->string('semester_id', 5)->index();
            $table->uuid('guru_id')->index();
            $table->uuid('rombongan_belajar_id')->index(); // FK untuk Kelas Rombel Ekskul

            // Data Utama
            $table->string('nama_ekskul', 255);
            $table->string('nama_ketua', 255)->nullable();
            $table->string('nomor_kontak', 255)->nullable();
            $table->string('alamat_ekskul', 255)->nullable();
            
            // Status dan Migrasi
            $table->string('is_dapodik', 255)->default('0');
            $table->uuid('id_kelas_ekskul')->nullable();
            $table->uuid('ekstrakurikuler_id_migrasi')->nullable();
            
            // Timestamps dan Soft Deletes
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('last_sync');
            
            // Definisi Foreign Key Constraints
            $table->foreign('sekolah_id')->references('sekolah_id')->on('sekolah')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('semester_id')->references('semester_id')->on('ref.semester')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('guru_id')->references('guru_id')->on('guru')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('rombongan_belajar_id')->references('rombongan_belajar_id')->on('rombongan_belajar')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ekstrakurikuler');
    }
};
