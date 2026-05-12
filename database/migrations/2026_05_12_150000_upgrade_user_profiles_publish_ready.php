<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'badge_key')) {
                $table->string('badge_key')->nullable()->after('profile_theme');
            }

            if (! Schema::hasColumn('users', 'profile_visibility')) {
                $table->string('profile_visibility')->default('public')->after('badge_key');
            }
        });

        Schema::table('profile_assets', function (Blueprint $table) {
            if (! Schema::hasColumn('profile_assets', 'badge_label')) {
                $table->string('badge_label')->nullable()->after('theme_class');
            }
        });
    }

    public function down(): void
    {
        Schema::table('profile_assets', function (Blueprint $table) {
            if (Schema::hasColumn('profile_assets', 'badge_label')) {
                $table->dropColumn('badge_label');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'profile_visibility')) {
                $table->dropColumn('profile_visibility');
            }

            if (Schema::hasColumn('users', 'badge_key')) {
                $table->dropColumn('badge_key');
            }
        });
    }
};