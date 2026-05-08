<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username')->nullable()->unique()->after('name');
            }
            if (!Schema::hasColumn('users', 'is_admin')) {
                $table->boolean('is_admin')->default(false)->after('password');
            }
            if (!Schema::hasColumn('users', 'avatar_key')) {
                $table->string('avatar_key')->default('purple-heart')->after('is_admin');
            }
            if (!Schema::hasColumn('users', 'profile_theme')) {
                $table->string('profile_theme')->default('galaxy-purple')->after('avatar_key');
            }
            if (!Schema::hasColumn('users', 'bio')) {
                $table->string('bio', 500)->nullable()->after('profile_theme');
            }
            if (!Schema::hasColumn('users', 'points')) {
                $table->unsignedInteger('points')->default(0)->after('bio');
            }
            if (!Schema::hasColumn('users', 'streak_days')) {
                $table->unsignedInteger('streak_days')->default(0)->after('points');
            }
            if (!Schema::hasColumn('users', 'last_streak_date')) {
                $table->date('last_streak_date')->nullable()->after('streak_days');
            }
            if (!Schema::hasColumn('users', 'google_id')) {
                $table->string('google_id')->nullable()->index()->after('last_streak_date');
            }
            if (!Schema::hasColumn('users', 'auth_provider')) {
                $table->string('auth_provider')->default('email')->after('google_id');
            }
        });

        if (!Schema::hasTable('learning_lessons')) {
            Schema::create('learning_lessons', function (Blueprint $table) {
                $table->id();
                $table->string('slug')->unique();
                $table->string('title');
                $table->string('category')->default('BTS 101');
                $table->string('excerpt', 500)->nullable();
                $table->longText('body')->nullable();
                $table->string('image_path')->nullable();
                $table->unsignedInteger('reward_points')->default(30);
                $table->unsignedInteger('sort_order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('quiz_questions')) {
            Schema::create('quiz_questions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('learning_lesson_id')->constrained('learning_lessons')->cascadeOnDelete();
                $table->string('question');
                $table->json('options');
                $table->unsignedTinyInteger('correct_option')->default(0);
                $table->text('explanation')->nullable();
                $table->unsignedInteger('points')->default(10);
                $table->unsignedInteger('sort_order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('quiz_attempts')) {
            Schema::create('quiz_attempts', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->foreignId('learning_lesson_id')->constrained('learning_lessons')->cascadeOnDelete();
                $table->unsignedInteger('score')->default(0);
                $table->unsignedInteger('total')->default(0);
                $table->unsignedInteger('points_earned')->default(0);
                $table->json('answers')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('point_transactions')) {
            Schema::create('point_transactions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->string('type')->default('earn');
                $table->integer('points');
                $table->string('reason')->nullable();
                $table->json('meta')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('profile_assets')) {
            Schema::create('profile_assets', function (Blueprint $table) {
                $table->id();
                $table->string('key')->unique();
                $table->string('label');
                $table->string('type')->default('avatar');
                $table->string('description', 500)->nullable();
                $table->unsignedInteger('cost')->default(0);
                $table->string('image_path')->nullable();
                $table->string('gradient')->nullable();
                $table->unsignedInteger('sort_order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('user_profile_assets')) {
            Schema::create('user_profile_assets', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->foreignId('profile_asset_id')->constrained('profile_assets')->cascadeOnDelete();
                $table->timestamp('unlocked_at')->useCurrent();
                $table->unique(['user_id', 'profile_asset_id']);
            });
        }

        if (!Schema::hasTable('daily_checkins')) {
            Schema::create('daily_checkins', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->date('checkin_date');
                $table->unsignedInteger('points_earned')->default(0);
                $table->unsignedInteger('streak_after')->default(0);
                $table->timestamps();
                $table->unique(['user_id', 'checkin_date']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_checkins');
        Schema::dropIfExists('user_profile_assets');
        Schema::dropIfExists('profile_assets');
        Schema::dropIfExists('point_transactions');
        Schema::dropIfExists('quiz_attempts');
        Schema::dropIfExists('quiz_questions');
        Schema::dropIfExists('learning_lessons');
    }
};
