<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name', 255)->unique();
            $table->string('display_name', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        // Buat sequence agar sama seperti PostgreSQL
        DB::statement("CREATE SEQUENCE IF NOT EXISTS permissions_id_seq START WITH 1 INCREMENT BY 1;");
        DB::statement("ALTER TABLE permissions ALTER COLUMN id SET DEFAULT nextval('permissions_id_seq');");
    }

    public function down(): void
    {
        Schema::dropIfExists('permissions');
        DB::statement("DROP SEQUENCE IF EXISTS permissions_id_seq;");
    }
};
