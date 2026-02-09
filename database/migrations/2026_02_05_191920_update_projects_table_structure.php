<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            // Rename columns
            if (Schema::hasColumn('projects', 'short_description')) {
                $table->renameColumn('short_description', 'title');
            }
            
            if (Schema::hasColumn('projects', 'full_description')) {
                $table->renameColumn('full_description', 'description');
            }
            
            if (Schema::hasColumn('projects', 'sort_order')) {
                $table->renameColumn('sort_order', 'order');
            }
            
            // Add missing columns
            if (!Schema::hasColumn('projects', 'image')) {
                $table->string('image')->nullable()->after('title');
            }
            
            if (!Schema::hasColumn('projects', 'url')) {
                $table->string('url')->nullable()->after('technologies');
            }
        });
    }

    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            // Reverse the changes
            $table->renameColumn('title', 'short_description');
            $table->renameColumn('description', 'full_description');
            $table->renameColumn('order', 'sort_order');
            
            $table->dropColumn(['image', 'url']);
        });
    }
};