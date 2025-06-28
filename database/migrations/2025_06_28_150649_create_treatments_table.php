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
        Schema::create('treatments', function (Blueprint $table) {
            $table->string('_id', 24)->primary();  
            $table->string('eventType', 255);
            $table->timestamp('created_at')->nullable();
            $table->string('glucose', 255)->nullable();
            $table->string('glucoseType', 255)->nullable();
            $table->float('carbs')->nullable();
            $table->float('protein')->nullable();
            $table->float('fat')->nullable();
            $table->float('insulin')->nullable();
            $table->string('units', 255)->nullable();
            $table->string('transmitterId', 255)->nullable();
            $table->string('sensorCode', 255)->nullable();
            $table->text('notes')->nullable();
            $table->string('enteredBy', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatments');
    }
};
