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
        Schema::create('kasek', function (Blueprint $table) {
            // Primary Key
            $table->uuid('kasek_id')->primary();

            // Kolom Data
            $table->uuid('sekolah_id');
            $table->uuid('guru_id');
            $table->string('semester_id', 5);
            
            // Timestamps
            $table->timestamps();
            
            // Kolom Last Sync dengan default value
            $table->timestamp('last_sync')->default('1901-01-01 00:00:00');

            // Definisi Foreign Key Constraints
            $table->foreign('sekolah_id')->references('sekolah_id')->on('sekolah')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('guru_id')->references('guru_id')->on('guru')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('semester_id')->references('semester_id')->on('ref.semester')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kasek');
    }
};
