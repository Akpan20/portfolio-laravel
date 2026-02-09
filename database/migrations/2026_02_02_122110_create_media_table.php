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
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->morphs('mediable'); // This already creates an index on mediable_type and mediable_id
            $table->string('collection_name')->default('default')->index();
            $table->string('file_name');
            $table->string('mime_type');
            $table->string('disk')->default('public');
            $table->unsignedBigInteger('size');
            $table->json('custom_properties')->nullable();
            $table->timestamps();
            
            // Composite index for better query performance on collection queries
            $table->index(['mediable_type', 'mediable_id', 'collection_name'], 'media_mediable_collection_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};