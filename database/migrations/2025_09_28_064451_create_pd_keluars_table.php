<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pd_keluar', function (Blueprint $table) {
            $table->uuid('pd_keluar_id')->primary();
            $table->uuid('peserta_didik_id');
            $table->uuid('sekolah_id');
            $table->string('semester_id', 5);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('last_sync');

            $table->foreign('peserta_didik_id')
                ->references('peserta_didik_id')
                ->on('peserta_didik')
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
        Schema::dropIfExists('pd_keluar');
    }
};
