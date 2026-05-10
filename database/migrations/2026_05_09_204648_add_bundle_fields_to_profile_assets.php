<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('profile_assets')) {
            return;
        }

        Schema::table('profile_assets', function (Blueprint $table) {
            if (! Schema::hasColumn('profile_assets', 'avatar_image')) {
                $table->string('avatar_image')->nullable()->after('image_path');
            }

            if (! Schema::hasColumn('profile_assets', 'theme_class')) {
                $table->string('theme_class')->nullable()->after('avatar_image');
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('profile_assets')) {
            return;
        }

        Schema::table('profile_assets', function (Blueprint $table) {
            if (Schema::hasColumn('profile_assets', 'theme_class')) {
                $table->dropColumn('theme_class');
            }

            if (Schema::hasColumn('profile_assets', 'avatar_image')) {
                $table->dropColumn('avatar_image');
            }
        });
    }
};
