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
        Schema::create('pumps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('battery_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->timestamp('clock')->nullable();
            $table->float('reservoir')->nullable();

            // Foreign keys
            $table->foreign('battery_id')->references('id')->on('pump_batteries')->onDelete("set null");
            $table->foreign('status_id')->references('id')->on('pump_statuses')->onDelete("set null");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pumps');
    }
};
