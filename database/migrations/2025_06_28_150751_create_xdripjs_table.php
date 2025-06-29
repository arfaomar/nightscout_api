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
        Schema::create('xdripjs', function (Blueprint $table) {
            $table->id();
            $table->float('state')->nullable();
            $table->string('stateString', 255)->nullable();
            $table->string('stateStringShort', 255)->nullable();
            $table->string('txId', 255)->nullable();
            $table->float('txStatus')->nullable();
            $table->string('txStatusString', 255)->nullable();
            $table->string('txStatusStringShort', 255)->nullable();
            $table->bigInteger('txActivation')->nullable();
            $table->string('mode', 255)->nullable();
            $table->bigInteger('timestamp')->nullable();
            $table->float('rssi')->nullable();
            $table->float('unfiltered')->nullable();
            $table->float('filtered')->nullable();
            $table->float('noise')->nullable();
            $table->string('noiseString', 255)->nullable();
            $table->float('slope')->nullable();
            $table->float('intercept')->nullable();
            $table->string('calType', 255)->nullable();
            $table->bigInteger('lastCalibrationDate')->nullable();
            $table->bigInteger('sessionStart')->nullable();
            $table->bigInteger('batteryTimestamp')->nullable();
            $table->float('voltagea')->nullable();
            $table->float('voltageb')->nullable();
            $table->float('temperature')->nullable(); 
            $table->float('resistance')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('xdripjs');
    }
};
