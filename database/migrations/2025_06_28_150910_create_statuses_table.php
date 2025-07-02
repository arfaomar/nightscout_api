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
            $table->string('name', 64)->nullable()->default('nightscout');
            $table->string('version', 255)->nullable();
            $table->jsonb('settings')->nullable();
            $table->jsonb('extended_settings')->nullable();
            $table->jsonb('extra_data')->nullable(); 
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
