<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembelajaran', function (Blueprint $table) {
            $table->uuid('pembelajaran_id')->primary();
            $table->uuid('pembelajaran_id_dapodik')->nullable();
            $table->uuid('sekolah_id');
            $table->string('semester_id', 5);
            $table->uuid('rombongan_belajar_id');
            $table->uuid('guru_id')->nullable();
            $table->uuid('guru_pengajar_id')->nullable();
            $table->integer('mata_pelajaran_id');
            $table->string('nama_mata_pelajaran', 255);
            $table->integer('kelompok_id')->nullable();
            $table->integer('no_urut')->nullable();
            $table->integer('kkm')->nullable();
            $table->integer('is_dapodik')->nullable();
            $table->integer('rasio_p')->nullable();
            $table->integer('rasio_k')->nullable();
            $table->uuid('pembelajaran_id_migrasi')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('last_sync');
            $table->uuid('induk_pembelajaran_id')->nullable();
            $table->smallInteger('bobot_sumatif_materi')->default(1);
            $table->smallInteger('bobot_sumatif_akhir')->default(1);

            // Indexes
            $table->index('guru_id', 'pembelajaran_guru_id_index');
            $table->index('guru_pengajar_id', 'pembelajaran_guru_pengajar_id_index');
            $table->index('kelompok_id', 'pembelajaran_kelompok_id_index');
            $table->index('mata_pelajaran_id', 'pembelajaran_mata_pelajaran_id_index');
            $table->index('rombongan_belajar_id', 'pembelajaran_rombongan_belajar_id_index');
            $table->index('sekolah_id', 'pembelajaran_sekolah_id_index');
            $table->index('semester_id', 'pembelajaran_semester_id_index');

            // Foreign keys
            $table->foreign('guru_id')
                ->references('guru_id')
                ->on('guru')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('guru_pengajar_id')
                ->references('guru_id')
                ->on('guru')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->foreign('induk_pembelajaran_id')
                ->references('pembelajaran_id')
                ->on('pembelajaran')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('kelompok_id')
                ->references('kelompok_id')
                ->on('ref.kelompok')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('mata_pelajaran_id')
                ->references('mata_pelajaran_id')
                ->on('ref.mata_pelajaran')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('rombongan_belajar_id')
                ->references('rombongan_belajar_id')
                ->on('rombongan_belajar')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('sekolah_id')
                ->references('sekolah_id')
                ->on('sekolah')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('semester_id')
                ->references('semester_id')
                ->on('ref.semester')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembelajaran');
    }
};
