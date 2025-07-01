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
            $table->json('openaps')->nullable();
            $table->json('loop')->nullable();
            $table->integer('uploaderBattery')->nullable();
            $table->boolean('isCharging')->default(false);
            $table->json('configuration')->nullable();

            $table->unsignedBigInteger('pump_id')->nullable();
            $table->foreign('pump_id')->references('id')->on('pumps')->onDelete('set null');
            $table->json('pump')->nullable();

            $table->unsignedBigInteger('uploader_id')->nullable();
            $table->foreign('uploader_id')->references('id')->on('uploaders')->onDelete('set null');
            $table->json('uploader')->nullable();

            $table->unsignedBigInteger('xdripjs_id')->nullable();
            $table->foreign('xdripjs_id')->references('id')->on('xdripjs')->onDelete('set null');
            $table->json('xdripjs')->nullable();

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
