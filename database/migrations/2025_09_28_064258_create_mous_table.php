<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mou', function (Blueprint $table) {
            $table->uuid('mou_id')->primary();
            $table->uuid('mou_id_dapodik');
            $table->decimal('id_jns_ks', 6, 0);
            $table->uuid('dudi_id');
            $table->uuid('dudi_id_dapodik');
            $table->uuid('sekolah_id');
            $table->string('nomor_mou', 80);
            $table->string('judul_mou', 80);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('nama_dudi', 100);
            $table->string('npwp_dudi', 15)->nullable();
            $table->string('nama_bidang_usaha', 40);
            $table->string('telp_kantor', 20)->nullable();
            $table->string('fax', 20)->nullable();
            $table->string('contact_person', 100)->nullable();
            $table->string('telp_cp', 20)->nullable();
            $table->string('jabatan_cp', 40)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('last_sync');

            $table->index('dudi_id', 'mou_dudi_id_index');
            $table->index('sekolah_id', 'mou_sekolah_id_index');

            $table->foreign('dudi_id')
                ->references('dudi_id')
                ->on('dudi')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('sekolah_id')
                ->references('sekolah_id')
                ->on('sekolah')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mou');
    }
};
