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
        Schema::create('dudi', function (Blueprint $table) {
            // Primary Key
            $table->uuid('dudi_id')->primary();

            // Data Utama
            $table->uuid('dudi_id_dapodik');
            $table->uuid('sekolah_id')->index();
            $table->string('nama', 100);
            $table->string('bidang_usaha_id', 10);
            $table->string('nama_bidang_usaha', 40);
            $table->string('alamat_jalan', 80);
            
            // Kolom Numerik dengan Presisi
            $table->decimal('rt', 2, 0)->nullable();
            $table->decimal('rw', 2, 0)->nullable();
            
            // Alamat Lanjut
            $table->string('nama_dusun', 60)->nullable();
            $table->string('desa_kelurahan', 60);
            $table->string('kode_wilayah', 8);
            $table->string('kode_pos', 5)->nullable();
            
            // Koordinat
            $table->decimal('lintang', 18, 12)->nullable();
            $table->decimal('bujur', 18, 12)->nullable();
            
            // Kontak
            $table->string('nomor_telepon', 20)->nullable();
            $table->string('nomor_fax', 20)->nullable();
            $table->string('email', 60)->nullable();
            $table->string('website', 100)->nullable();
            $table->string('npwp', 15)->nullable();
            
            // Timestamps dan Soft Deletes
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('last_sync');
            
            // Foreign Key Constraint
            $table->foreign('sekolah_id')->references('sekolah_id')->on('sekolah')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dudi');
    }
};
