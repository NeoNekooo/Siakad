<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSekolahTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sekolah', function (Blueprint $table) {
            // Kolom dari skema dump
            $table->uuid('sekolah_id')->primary();
            $table->string('npsn', 255); // NOT NULL
            $table->string('nama', 255); // NOT NULL
            $table->string('nss', 255)->nullable();
            $table->string('alamat', 255)->nullable();
            $table->string('desa_kelurahan', 255)->nullable();
            $table->string('kecamatan', 255)->nullable();
            $table->string('kode_wilayah', 255)->nullable();
            $table->string('kabupaten', 255)->nullable();
            $table->string('provinsi', 255)->nullable();
            $table->string('kode_pos', 255)->nullable();
            $table->string('lintang', 255)->nullable();
            $table->string('bujur', 255)->nullable();
            $table->string('no_telp', 255)->nullable();
            $table->string('no_fax', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('website', 255)->nullable();
            $table->uuid('guru_id')->nullable();
            $table->integer('status_sekolah'); // NOT NULL
            $table->integer('sinkron')->default(0); // NOT NULL with default 0
            $table->string('logo_sekolah', 255)->nullable();
            $table->smallInteger('bentuk_pendidikan_id')->nullable();

            // Timestamps
            $table->timestamp('created_at', 0)->nullable();
            $table->timestamp('updated_at', 0)->nullable();
            $table->timestamp('deleted_at', 0)->nullable();
            $table->timestamp('last_sync', 0); // NOT NULL

            // Indexes (dari skema dump)
            $table->index('guru_id', 'sekolah_guru_id_index');
            $table->index('kode_wilayah', 'sekolah_kode_wilayah_index');

            // Foreign Key Constraints (dari skema dump)

            // Relasi ke public.guru (Kepala Sekolah/Operator?)
            $table->foreign('guru_id', 'sekolah_guru_id_foreign')
                  ->references('guru_id')->on('public.guru')
                  ->onUpdate('cascade')->onDelete('cascade');

            // Relasi ke ref.mst_wilayah
            $table->foreign('kode_wilayah', 'sekolah_kode_wilayah_foreign')
                  ->references('kode_wilayah')->on('ref.mst_wilayah')
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
        Schema::dropIfExists('sekolah');
    }
}