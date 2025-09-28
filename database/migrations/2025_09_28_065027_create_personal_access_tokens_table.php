<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('tokenable_type', 255);
            $table->uuid('tokenable_id')->nullable();
            $table->string('name', 255);
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        // Buat sequence seperti PostgreSQL
        DB::statement("CREATE SEQUENCE IF NOT EXISTS personal_access_tokens_id_seq START WITH 1 INCREMENT BY 1;");
        DB::statement("ALTER TABLE personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('personal_access_tokens_id_seq');");
    }

    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
        DB::statement("DROP SEQUENCE IF EXISTS personal_access_tokens_id_seq;");
    }
};
