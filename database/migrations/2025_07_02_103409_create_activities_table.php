<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->string('_id', 24)->primary();
            $table->string('eventType', 255)->nullable();
            $table->integer('duration')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->text('notes')->nullable();
            $table->string('enteredBy', 255)->nullable();
            $table->jsonb('extra_data')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
