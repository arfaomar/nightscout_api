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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('units', 255)->nullable();
            $table->string('timeFormat', 2)->nullable();
            $table->string('customTitle', 255)->nullable();
            $table->boolean('nightMode')->nullable();
            $table->string('theme', 255)->nullable();
            $table->string('language', 255)->nullable();
            $table->text('showPlugins')->nullable();
            $table->string('showRawbg', 255)->nullable();
            $table->string('alarmTypes', 255)->nullable(); 
            $table->boolean('alarmUrgentHigh')->nullable();
            $table->boolean('alarmHigh')->nullable();
            $table->boolean('alarmLow')->nullable();
            $table->boolean('alarmUrgentLow')->nullable();
            $table->boolean('alarmTimeagoWarn')->nullable();
            $table->integer('alarmTimeagoWarnMins')->nullable();
            $table->boolean('alarmTimeagoUrgent')->nullable();
            $table->integer('alarmTimeagoUrgentMins')->nullable();
            $table->text('enable')->nullable(); 
            $table->integer('thresholds')->nullable();
        });
    }  


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
