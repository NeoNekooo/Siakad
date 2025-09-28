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
        Schema::create('gelar_ptk', function (Blueprint $table) {
            // Primary Key
            $table->uuid('gelar_ptk_id')->primary();

            // Foreign Keys dan Index
            $table->uuid('sekolah_id')->index();
            $table->integer('gelar_akademik_id')->index();
            $table->uuid('guru_id')->index();
            $table->uuid('ptk_id'); // Kolom ptk_id tanpa index di skema dump, jadi dipertahankan tanpa index
            
            // Timestamps dan Soft Deletes
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('last_sync');
            
            // Definisi Foreign Key Constraints
            $table->foreign('gelar_akademik_id')->references('gelar_akademik_id')->on('ref.gelar_akademik')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('guru_id')->references('guru_id')->on('guru')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('gelar_ptk');
    }
};
