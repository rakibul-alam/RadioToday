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
        Schema::create('podcast_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('content_details_id')->unique();
            $table->uuid('podcast_id')->nullable();
            $table->foreign('podcast_id')->references('id')->on('podcasts')->nullOnDelete();
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->string('file_path')->nullable();
            $table->string('duration_time')->nullable();
            $table->string('release_date')->nullable();
            $table->string('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('podcast_details');
    }
};
