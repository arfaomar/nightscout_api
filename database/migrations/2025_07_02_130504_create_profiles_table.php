<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->string('_id', 24)->primary();
            $table->string('defaultProfile')->nullable();
            $table->bigInteger('date')->nullable(); 
            $table->timestamp('created_at')->nullable();
            $table->timestamp('startDate')->nullable();
            $table->jsonb('store')->nullable();
            $table->jsonb('extra_data')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
