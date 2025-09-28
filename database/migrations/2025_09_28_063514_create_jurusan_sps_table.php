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
        Schema::create('jurusan_sp', function (Blueprint $table) {
            // Primary Key
            $table->uuid('jurusan_sp_id')->primary();

            // Kolom Data
            $table->uuid('jurusan_sp_id_dapodik');
            $table->uuid('sekolah_id')->index();
            $table->string('jurusan_id', 255)->index();
            $table->string('nama_jurusan_sp', 255);
            
            // Timestamps dan Soft Deletes
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('last_sync');

            // Definisi Foreign Key Constraints
            $table->foreign('jurusan_id')->references('jurusan_id')->on('ref.jurusan')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('jurusan_sp');
    }
};
