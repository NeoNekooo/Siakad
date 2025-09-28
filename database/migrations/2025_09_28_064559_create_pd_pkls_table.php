<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pd_pkl', function (Blueprint $table) {
            $table->uuid('pd_pkl_id')->primary();
            $table->uuid('peserta_didik_id');
            $table->uuid('pkl_id');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('last_sync')->default('1901-01-01 00:00:00');
            $table->text('catatan')->nullable();

            $table->foreign('peserta_didik_id')
                ->references('peserta_didik_id')
                ->on('peserta_didik')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('pkl_id')
                ->references('pkl_id')
                ->on('praktik_kerja_lapangan')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pd_pkl');
    }
};
