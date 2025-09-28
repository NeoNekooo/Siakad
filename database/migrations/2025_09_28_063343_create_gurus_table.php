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
        Schema::create('guru', function (Blueprint $table) {
            // Primary Key
            $table->uuid('guru_id')->primary();

            // Kolom Data
            $table->uuid('guru_id_dapodik')->nullable();
            $table->uuid('sekolah_id')->index();
            $table->string('nama', 255);
            $table->string('nuptk', 255)->nullable();
            $table->string('nip', 255)->nullable();
            $table->string('jenis_kelamin', 255);
            $table->string('tempat_lahir', 255);
            $table->date('tanggal_lahir');
            $table->string('nik', 16)->nullable();
            $table->integer('jenis_ptk_id');
            $table->integer('agama_id');
            $table->integer('status_kepegawaian_id');
            $table->string('alamat', 255)->nullable();
            $table->string('rt', 255)->nullable();
            $table->string('rw', 255)->nullable();
            $table->string('desa_kelurahan', 255)->nullable();
            $table->string('kecamatan', 255)->nullable();
            $table->string('kode_wilayah', 255)->index();
            $table->string('kode_pos', 255)->nullable();
            $table->string('no_hp', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('photo', 255)->nullable();
            $table->integer('guru_id_erapor')->nullable();
            $table->integer('is_dapodik')->default(0);
            $table->uuid('guru_id_migrasi')->nullable();
            $table->numeric('jabatan_ptk_id', 5, 0)->nullable();
            
            // Timestamps dan Soft Deletes
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('last_sync');

            // Definisi Foreign Key Constraints
            $table->foreign('sekolah_id')->references('sekolah_id')->on('sekolah')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kode_wilayah')->references('kode_wilayah')->on('ref.mst_wilayah')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guru');
    }
};
