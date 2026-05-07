<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('site_settings')) {
            Schema::create('site_settings', function (Blueprint $table) {
                $table->id();
                $table->string('key')->unique();
                $table->text('value')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('nav_items')) {
            Schema::create('nav_items', function (Blueprint $table) {
                $table->id();
                $table->string('label');
                $table->string('url');
                $table->unsignedInteger('sort_order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('gallery_images')) {
            Schema::create('gallery_images', function (Blueprint $table) {
                $table->id();
                $table->string('name')->nullable();
                $table->string('img_path')->nullable();
                $table->unsignedInteger('sort_order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (Schema::hasTable('songs_images')) {
            Schema::table('songs_images', function (Blueprint $table) {
                if (!Schema::hasColumn('songs_images', 'release_date')) {
                    $table->date('release_date')->nullable()->after('img_path');
                }

                if (!Schema::hasColumn('songs_images', 'description')) {
                    $table->text('description')->nullable()->after('release_date');
                }

                if (!Schema::hasColumn('songs_images', 'sort_order')) {
                    $table->unsignedInteger('sort_order')->default(0);
                }

                if (!Schema::hasColumn('songs_images', 'is_active')) {
                    $table->boolean('is_active')->default(true);
                }
            });
        }

        if (Schema::hasTable('members')) {
            Schema::table('members', function (Blueprint $table) {
                if (!Schema::hasColumn('members', 'sort_order')) {
                    $table->unsignedInteger('sort_order')->default(0);
                }

                if (!Schema::hasColumn('members', 'is_active')) {
                    $table->boolean('is_active')->default(true);
                }
            });
        }

        if (Schema::hasTable('quotes')) {
            Schema::table('quotes', function (Blueprint $table) {
                if (!Schema::hasColumn('quotes', 'is_active')) {
                    $table->boolean('is_active')->default(true);
                }
            });
        }

        if (!Schema::hasTable('votes')) {
            Schema::create('votes', function (Blueprint $table) {
                $table->id();
                $table->foreignId('member_id')->nullable()->constrained('members')->nullOnDelete();
                $table->string('member_name')->nullable();
                $table->string('ip_address')->nullable();
                $table->text('user_agent')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('timeline_events')) {
            Schema::create('timeline_events', function (Blueprint $table) {
                $table->id();
                $table->string('year', 20);
                $table->string('title');
                $table->longText('body')->nullable();
                $table->json('bullet_points')->nullable();
                $table->json('image_paths')->nullable();
                $table->unsignedInteger('sort_order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('timeline_events');
        Schema::dropIfExists('votes');
        Schema::dropIfExists('nav_items');
        Schema::dropIfExists('site_settings');
    }
};
