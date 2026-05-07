<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Professional content/system upgrade.
     *
     * This migration is intentionally defensive:
     * - It creates missing admin/content tables.
     * - It adds missing columns only if they do not already exist.
     * - It does not destroy existing data.
     */
    public function up(): void
    {
        if (!Schema::hasTable('site_settings')) {
            Schema::create('site_settings', function (Blueprint $table) {
                $table->id();
                $table->string('key')->unique();
                $table->longText('value')->nullable();
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
                $table->string('caption')->nullable();
                $table->string('category')->default('Gallery');
                $table->unsignedInteger('sort_order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        } else {
            Schema::table('gallery_images', function (Blueprint $table) {
                if (!Schema::hasColumn('gallery_images', 'caption')) {
                    $table->string('caption')->nullable()->after('img_path');
                }
                if (!Schema::hasColumn('gallery_images', 'category')) {
                    $table->string('category')->default('Gallery')->after('caption');
                }
                if (!Schema::hasColumn('gallery_images', 'sort_order')) {
                    $table->unsignedInteger('sort_order')->default(0);
                }
                if (!Schema::hasColumn('gallery_images', 'is_active')) {
                    $table->boolean('is_active')->default(true);
                }
                if (!Schema::hasColumn('gallery_images', 'created_at')) {
                    $table->timestamps();
                }
            });
        }

        if (Schema::hasTable('members')) {
            Schema::table('members', function (Blueprint $table) {
                $columns = Schema::getColumnListing('members');
                if (!in_array('slug', $columns)) $table->string('slug')->nullable()->after('id');
                if (!in_array('stage_name', $columns)) $table->string('stage_name')->nullable()->after('name');
                if (!in_array('korean_name', $columns)) $table->string('korean_name')->nullable()->after('stage_name');
                if (!in_array('birth_date', $columns)) $table->date('birth_date')->nullable()->after('korean_name');
                if (!in_array('birthplace', $columns)) $table->string('birthplace')->nullable()->after('birth_date');
                if (!in_array('emoji', $columns)) $table->string('emoji', 20)->nullable()->after('birthplace');
                if (!in_array('accent_color', $columns)) $table->string('accent_color', 30)->nullable()->after('emoji');
                if (!in_array('bt21_character', $columns)) $table->string('bt21_character')->nullable()->after('accent_color');
                if (!in_array('intro_title', $columns)) $table->string('intro_title')->nullable()->after('bt21_character');
                if (!in_array('profile_story', $columns)) $table->longText('profile_story')->nullable()->after('quote');
                if (!in_array('fun_facts', $columns)) $table->json('fun_facts')->nullable()->after('profile_story');
                if (!in_array('skill_tags', $columns)) $table->json('skill_tags')->nullable()->after('fun_facts');
                if (!in_array('spotify_url', $columns)) $table->string('spotify_url', 1000)->nullable()->after('skill_tags');
                if (!in_array('instagram_url', $columns)) $table->string('instagram_url', 1000)->nullable()->after('spotify_url');
                if (!in_array('sort_order', $columns)) $table->unsignedInteger('sort_order')->default(0);
                if (!in_array('is_active', $columns)) $table->boolean('is_active')->default(true);
            });
        }

        if (Schema::hasTable('quotes')) {
            Schema::table('quotes', function (Blueprint $table) {
                if (!Schema::hasColumn('quotes', 'context')) {
                    $table->string('context')->nullable()->after('quote');
                }
                if (!Schema::hasColumn('quotes', 'is_active')) {
                    $table->boolean('is_active')->default(true);
                }
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
                if (!Schema::hasColumn('songs_images', 'era')) {
                    $table->string('era')->nullable()->after('description');
                }
                if (!Schema::hasColumn('songs_images', 'spotify_url')) {
                    $table->string('spotify_url', 1000)->nullable()->after('era');
                }
                if (!Schema::hasColumn('songs_images', 'sort_order')) {
                    $table->unsignedInteger('sort_order')->default(0);
                }
                if (!Schema::hasColumn('songs_images', 'is_active')) {
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
                $table->string('category')->default('Milestone');
                $table->string('title');
                $table->longText('body')->nullable();
                $table->json('bullet_points')->nullable();
                $table->json('image_paths')->nullable();
                $table->unsignedInteger('sort_order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        } else {
            Schema::table('timeline_events', function (Blueprint $table) {
                if (!Schema::hasColumn('timeline_events', 'category')) {
                    $table->string('category')->default('Milestone')->after('year');
                }
            });
        }
    }

    public function down(): void
    {
        // Do not drop content tables on rollback; this avoids accidental data loss.
    }
};
