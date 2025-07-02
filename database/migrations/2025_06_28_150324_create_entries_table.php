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
        Schema::create('entries', function (Blueprint $table) {
            $table->string('_id', 24)->primary();
            $table->timestamp('created_at')->nullable();
            $table->string('type');
            $table->timestamp('dateString');
            $table->bigInteger('date');
            $table->float('sgv')->nullable();
            $table->string('direction')->nullable();
            $table->float('noise')->nullable();
            $table->float('filtered')->nullable();
            $table->float('unfiltered')->nullable();
            $table->float('rssi')->nullable();
            $table->jsonb('extra_data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entries');
    }
};
