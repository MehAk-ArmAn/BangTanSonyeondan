<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('profile_assets') && ! Schema::hasColumn('profile_assets', 'image_path')) {
            Schema::table('profile_assets', function (Blueprint $table) {
                $table->string('image_path')->nullable()->after('cost');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('profile_assets') && Schema::hasColumn('profile_assets', 'image_path')) {
            Schema::table('profile_assets', function (Blueprint $table) {
                $table->dropColumn('image_path');
            });
        }
    }
};
