<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertaDidikTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta_didik', function (Blueprint $table) {
            // Kolom dari skema dump
            $table->uuid('peserta_didik_id')->primary();
            $table->uuid('peserta_didik_id_dapodik')->nullable();
            $table->uuid('sekolah_id'); // NOT NULL
            $table->string('nama', 255); // NOT NULL
            $table->string('no_induk', 255); // NOT NULL
            $table->string('nisn', 255)->nullable();
            $table->string('nik', 16)->nullable();
            $table->string('jenis_kelamin', 255); // NOT NULL
            $table->string('tempat_lahir', 255); // NOT NULL
            $table->date('tanggal_lahir'); // NOT NULL
            $table->integer('agama_id'); // NOT NULL
            $table->string('status', 255); // NOT NULL
            $table->integer('anak_ke'); // NOT NULL
            $table->string('alamat', 255)->nullable();
            $table->string('rt', 255)->nullable();
            $table->string('rw', 255)->nullable();
            $table->string('desa_kelurahan', 255)->nullable();
            $table->string('kecamatan', 255)->nullable();
            $table->string('kode_pos', 255)->nullable();
            $table->string('no_telp', 255)->nullable();
            $table->string('sekolah_asal', 255)->nullable();
            $table->string('diterima_kelas', 255)->nullable();
            $table->date('diterima')->nullable();
            $table->string('kode_wilayah', 8); // NOT NULL
            $table->string('email', 255)->nullable();
            $table->string('nama_ayah', 255)->nullable();
            $table->string('nama_ibu', 255)->nullable();
            $table->integer('kerja_ayah')->nullable();
            $table->integer('kerja_ibu')->nullable();
            $table->string('nama_wali', 255)->nullable();
            $table->string('alamat_wali', 255)->nullable();
            $table->string('telp_wali', 255)->nullable();
            $table->integer('kerja_wali')->nullable();
            $table->string('photo', 255)->nullable();
            // numeric(1,0) dijadikan unsignedTinyInteger dengan default 1
            $table->unsignedTinyInteger('active')->default(1);
            $table->uuid('peserta_didik_id_migrasi')->nullable();

            // Timestamps (created_at, updated_at, deleted_at nullable, last_sync not nullable)
            $table->timestamp('created_at', 0)->nullable();
            $table->timestamp('updated_at', 0)->nullable();
            $table->timestamp('deleted_at', 0)->nullable();
            $table->timestamp('last_sync', 0); // NOT NULL

            // Indexes (dari skema dump)
            $table->index('kerja_ayah', 'peserta_didik_kerja_ayah_index');
            $table->index('kerja_ibu', 'peserta_didik_kerja_ibu_index');
            $table->index('kerja_wali', 'peserta_didik_kerja_wali_index');
            $table->index('kode_wilayah', 'peserta_didik_kode_wilayah_index');
            $table->index('sekolah_id', 'peserta_didik_sekolah_id_index');

            // Foreign Key Constraints (dari skema dump)
            // Relasi ke ref.pekerjaan (Pekerjaan Ayah)
            $table->foreign('kerja_ayah', 'peserta_didik_kerja_ayah_foreign')
                  ->references('pekerjaan_id')->on('ref.pekerjaan')
                  ->onUpdate('cascade')->onDelete('cascade');

            // Relasi ke ref.pekerjaan (Pekerjaan Ibu)
            $table->foreign('kerja_ibu', 'peserta_didik_kerja_ibu_foreign')
                  ->references('pekerjaan_id')->on('ref.pekerjaan')
                  ->onUpdate('cascade')->onDelete('cascade');

            // Relasi ke ref.pekerjaan (Pekerjaan Wali)
            $table->foreign('kerja_wali', 'peserta_didik_kerja_wali_foreign')
                  ->references('pekerjaan_id')->on('ref.pekerjaan')
                  ->onUpdate('cascade')->onDelete('cascade');

            // Relasi ke ref.mst_wilayah
            $table->foreign('kode_wilayah', 'peserta_didik_kode_wilayah_foreign')
                  ->references('kode_wilayah')->on('ref.mst_wilayah')
                  ->onUpdate('cascade')->onDelete('cascade');

            // Relasi ke public.sekolah
            $table->foreign('sekolah_id', 'peserta_didik_sekolah_id_foreign')
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
        Schema::dropIfExists('peserta_didik');
    }
}