<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            // Kolom ID yang auto-increment (digantikan oleh SEQUENCE di PostgreSQL)
            $table->id(); // Membuat kolom 'id' bigint NOT NULL auto-increment

            // Kolom dari skema dump
            $table->string('name', 255)->unique(); // NOT NULL dengan unique constraint
            $table->string('display_name', 255)->nullable();
            $table->string('description', 255)->nullable();

            // Timestamps
            // created_at dan updated_at nullable seperti di skema dump
            $table->timestamp('created_at', 0)->nullable();
            $table->timestamp('updated_at', 0)->nullable();
        });
    }

    /**
     * Balikkan migrasi.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}