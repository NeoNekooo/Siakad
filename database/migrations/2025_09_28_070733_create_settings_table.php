<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            // Kolom ID yang auto-increment (digantikan oleh SEQUENCE di PostgreSQL)
            $table->id(); // Membuat kolom 'id' integer NOT NULL auto-increment

            // Kolom dari skema dump
            $table->string('key', 255); // NOT NULL
            $table->text('value'); // NOT NULL
            $table->uuid('sekolah_id')->nullable();
            $table->string('semester_id', 5)->nullable();
            
            // Catatan: created_at dan updated_at TIDAK ada di skema dump, jadi kita tidak menambahkannya.

            // Foreign Key Constraints (dari skema dump)

            // Relasi ke public.sekolah
            $table->foreign('sekolah_id', 'settings_sekolah_id_foreign')
                  ->references('sekolah_id')->on('public.sekolah')
                  ->onUpdate('cascade')->onDelete('cascade');

            // Relasi ke ref.semester
            $table->foreign('semester_id', 'settings_semester_id_foreign')
                  ->references('semester_id')->on('ref.semester')
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
        Schema::dropIfExists('settings');
    }
}