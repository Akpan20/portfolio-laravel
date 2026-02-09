<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Add new fields if they don't exist
            if (!Schema::hasColumn('projects', 'short_description')) {
                $table->text('short_description')->nullable()->after('description');
            }
            if (!Schema::hasColumn('projects', 'full_description')) {
                $table->text('full_description')->nullable()->after('short_description');
            }
            if (!Schema::hasColumn('projects', 'technologies')) {
                $table->json('technologies')->nullable()->after('full_description');
            }
            if (!Schema::hasColumn('projects', 'github_url')) {
                $table->string('github_url')->nullable()->after('url');
            }
            if (!Schema::hasColumn('projects', 'sort_order')) {
                $table->integer('sort_order')->default(0);
            }
            if (!Schema::hasColumn('projects', 'is_featured')) {
                $table->boolean('is_featured')->default(false);
            }
            if (!Schema::hasColumn('projects', 'is_active')) {
                $table->boolean('is_active')->default(true);
            }
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Remove the columns if they exist
            $columns = ['short_description', 'full_description', 'technologies', 
                       'github_url', 'sort_order', 'is_featured', 'is_active'];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('projects', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};