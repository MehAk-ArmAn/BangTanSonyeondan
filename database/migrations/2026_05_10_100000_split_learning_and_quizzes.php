<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('learning_materials')) {
            Schema::create('learning_materials', function (Blueprint $table) {
                $table->id();
                $table->string('slug')->unique();
                $table->string('title');
                $table->string('category')->default('BTS 101');
                $table->string('topic_type')->default('Article');
                $table->string('difficulty')->nullable();
                $table->string('excerpt', 600)->nullable();
                $table->longText('body')->nullable();
                $table->string('image_path')->nullable();
                $table->string('official_url', 1000)->nullable();
                $table->string('youtube_url', 1000)->nullable();
                $table->string('source_label')->nullable();
                $table->json('links')->nullable();
                $table->unsignedInteger('sort_order')->default(0);
                $table->boolean('is_featured')->default(false);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('quiz_games')) {
            Schema::create('quiz_games', function (Blueprint $table) {
                $table->id();
                $table->string('slug')->unique();
                $table->string('title');
                $table->string('category')->default('BTS 101');
                $table->string('difficulty')->default('easy');
                $table->string('description', 1000)->nullable();
                $table->string('cover_image')->nullable();
                $table->unsignedInteger('time_limit_seconds')->default(0);
                $table->unsignedBigInteger('points_per_question')->default(10);
                $table->unsignedBigInteger('bonus_points')->default(0);
                $table->unsignedInteger('sort_order')->default(0);
                $table->boolean('is_featured')->default(false);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('quiz_game_questions')) {
            Schema::create('quiz_game_questions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('quiz_game_id')->constrained('quiz_games')->cascadeOnDelete();
                $table->string('question', 1000);
                $table->json('options');
                $table->unsignedTinyInteger('correct_option')->default(0);
                $table->text('explanation')->nullable();
                $table->unsignedBigInteger('points')->default(10);
                $table->unsignedInteger('sort_order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('quiz_game_attempts')) {
            Schema::create('quiz_game_attempts', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->foreignId('quiz_game_id')->constrained('quiz_games')->cascadeOnDelete();
                $table->unsignedInteger('score')->default(0);
                $table->unsignedInteger('total')->default(0);
                $table->unsignedBigInteger('points_earned')->default(0);
                $table->decimal('accuracy', 5, 2)->default(0);
                $table->json('answers')->nullable();
                $table->timestamps();
            });
        }

        $driver = DB::connection()->getDriverName();

        if ($driver === 'mysql') {
            foreach ([
                "ALTER TABLE users MODIFY points BIGINT UNSIGNED NOT NULL DEFAULT 0",
                "ALTER TABLE point_transactions MODIFY points BIGINT NOT NULL",
                "ALTER TABLE profile_assets MODIFY cost BIGINT UNSIGNED NOT NULL DEFAULT 0",
                "ALTER TABLE learning_lessons MODIFY reward_points BIGINT UNSIGNED NOT NULL DEFAULT 30",
                "ALTER TABLE quiz_questions MODIFY points BIGINT UNSIGNED NOT NULL DEFAULT 10",
                "ALTER TABLE quiz_attempts MODIFY points_earned BIGINT UNSIGNED NOT NULL DEFAULT 0",
                "ALTER TABLE daily_checkins MODIFY points_earned BIGINT UNSIGNED NOT NULL DEFAULT 0",
            ] as $statement) {
                try {
                    DB::statement($statement);
                } catch (Throwable $exception) {
                    // Skip safely when an older install does not have one of these tables yet.
                }
            }
        }

        if (Schema::hasTable('nav_items')) {
            DB::table('nav_items')->updateOrInsert(
                ['url' => '/learn'],
                ['label' => 'Learn', 'sort_order' => 3, 'is_active' => true, 'updated_at' => now(), 'created_at' => now()]
            );

            DB::table('nav_items')->updateOrInsert(
                ['url' => '/quizzes'],
                ['label' => 'Quizzes', 'sort_order' => 4, 'is_active' => true, 'updated_at' => now(), 'created_at' => now()]
            );
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_game_attempts');
        Schema::dropIfExists('quiz_game_questions');
        Schema::dropIfExists('quiz_games');
        Schema::dropIfExists('learning_materials');
    }
};
