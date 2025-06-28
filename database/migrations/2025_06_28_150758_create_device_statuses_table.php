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
            $table->string('openaps', 255)->nullable();
            $table->string('loop', 255)->nullable();

            $table->unsignedBigInteger('pump')->nullable();
            $table->unsignedBigInteger('uploader')->nullable();
            $table->unsignedBigInteger('xdripjs')->nullable();
            // Foreign keys
            $table->foreign('pump')->references('id')->on('pumps')->onDelete("set null");
            $table->foreign('uploader')->references('id')->on('uploaders')->onDelete("set null");
            $table->foreign('xdripjs')->references('id')->on('xdripjs')->onDelete("set null");

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
