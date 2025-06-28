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
        Schema::create('statuses', function (Blueprint $table) {
            $table->string('_id', 24)->primary();
            $table->boolean('apiEnabled')->nullable();
            $table->boolean('carePortalEnabled')->nullable();
            $table->string('head', 255)->nullable();
            $table->string('name', 10)->default('nightscout');
            $table->string('version', 255)->nullable();
            $table->unsignedBigInteger('settings')->nullable();
            $table->unsignedBigInteger('extendedSettings')->nullable();

            // Foreign keys
            $table->foreign('settings')->references('id')->on('settings')->onDelete("set null");
            $table->foreign('extendedSettings')->references('id')->on('extended_settings')->onDelete("set null");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
};
