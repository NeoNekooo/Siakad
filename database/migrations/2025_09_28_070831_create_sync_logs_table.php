<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSyncLogTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sync_log', function (Blueprint $table) {
            // Kolom dari skema dump
            $table->uuid('id')->primary();
            $table->uuid('user_id')->nullable(); // Boleh NULL
            
            // Timestamps
            // Karena di dump adalah timestamp(0) without time zone, kita gunakan timestamp biasa
            $table->timestamp('created_at', 0)->nullable();
            $table->timestamp('updated_at', 0)->nullable();
            
            // Indexes (dari skema dump)
            $table->index('user_id', 'sync_log_user_id_index');

            // Foreign Key Constraints (dari skema dump)

            // Relasi ke public.users
            $table->foreign('user_id', 'sync_log_user_id_foreign')
                  ->references('user_id')->on('public.users')
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
        Schema::dropIfExists('sync_log');
    }
}