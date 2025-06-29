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
        Schema::create('thresholds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('settings_id')->nullable();
            $table->integer('bg_high')->nullable();
            $table->integer('bg_target_top')->nullable();
            $table->integer('bg_target_bottom')->nullable();
            $table->integer('bg_low')->nullable();

            $table->foreign('settings_id')->references('id')->on('settings')->onDelete("set null");
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thresholds');
    }
};
