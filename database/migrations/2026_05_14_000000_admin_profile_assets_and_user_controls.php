<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('profile_assets')) {
            Schema::create('profile_assets', function (Blueprint $table) {
                $table->id();
                $table->string('key')->unique();
                $table->string('label');
                $table->string('type')->default('avatar');
                $table->text('description')->nullable();
                $table->unsignedInteger('cost')->default(0);
                $table->string('image_path', 1000)->nullable();
                $table->string('avatar_image', 1000)->nullable();
                $table->string('theme_class')->nullable();
                $table->string('badge_label')->nullable();
                $table->string('gradient', 1000)->nullable();
                $table->unsignedInteger('sort_order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        Schema::table('profile_assets', function (Blueprint $table) {
            if (! Schema::hasColumn('profile_assets', 'badge_label')) {
                $table->string('badge_label')->nullable()->after('theme_class');
            }

            if (! Schema::hasColumn('profile_assets', 'gradient')) {
                $table->string('gradient', 1000)->nullable()->after('badge_label');
            }

            if (! Schema::hasColumn('profile_assets', 'avatar_image')) {
                $table->string('avatar_image', 1000)->nullable()->after('image_path');
            }
        });

        if (! Schema::hasTable('user_profile_assets')) {
            Schema::create('user_profile_assets', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->foreignId('profile_asset_id')->constrained('profile_assets')->cascadeOnDelete();
                $table->timestamp('unlocked_at')->nullable();
                $table->timestamps();

                $table->unique(['user_id', 'profile_asset_id']);
            });
        }
    }

    public function down(): void
    {
        // Keep data safe. Do not drop user/profile asset tables automatically.
    }
};
