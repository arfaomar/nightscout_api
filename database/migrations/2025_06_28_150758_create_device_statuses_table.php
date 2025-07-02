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
        Schema::create('device_statuses', function (Blueprint $table) {
            $table->string('_id', 24)->primary();
            $table->string('device', 255)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->jsonb('openaps')->nullable();
            $table->jsonb('loop')->nullable();
            $table->integer('uploaderBattery')->nullable();
            $table->boolean('isCharging')->default(false);
            $table->jsonb('configuration')->nullable();
            $table->jsonb('pump')->nullable();
            $table->jsonb('uploader')->nullable();
            $table->jsonb('xdripjs')->nullable();
            $table->jsonb('extra_data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_statuses');
    }
};
