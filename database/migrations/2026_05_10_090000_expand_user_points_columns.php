<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $driver = DB::getDriverName();

        // MySQL / MariaDB fix for: Warning #1264 Out of range value for column 'points'.
        if (in_array($driver, ['mysql', 'mariadb'], true)) {
            if (Schema::hasColumn('users', 'points')) {
                DB::statement('ALTER TABLE `users` MODIFY `points` BIGINT UNSIGNED NOT NULL DEFAULT 0');
            }

            if (Schema::hasColumn('point_transactions', 'points')) {
                DB::statement('ALTER TABLE `point_transactions` MODIFY `points` BIGINT NOT NULL');
            }

            if (Schema::hasColumn('profile_assets', 'cost')) {
                DB::statement('ALTER TABLE `profile_assets` MODIFY `cost` BIGINT UNSIGNED NOT NULL DEFAULT 0');
            }

            if (Schema::hasColumn('learning_lessons', 'reward_points')) {
                DB::statement('ALTER TABLE `learning_lessons` MODIFY `reward_points` BIGINT UNSIGNED NOT NULL DEFAULT 30');
            }

            if (Schema::hasColumn('quiz_questions', 'points')) {
                DB::statement('ALTER TABLE `quiz_questions` MODIFY `points` BIGINT UNSIGNED NOT NULL DEFAULT 10');
            }

            if (Schema::hasColumn('quiz_attempts', 'points_earned')) {
                DB::statement('ALTER TABLE `quiz_attempts` MODIFY `points_earned` BIGINT UNSIGNED NOT NULL DEFAULT 0');
            }

            if (Schema::hasColumn('daily_checkins', 'points_earned')) {
                DB::statement('ALTER TABLE `daily_checkins` MODIFY `points_earned` BIGINT UNSIGNED NOT NULL DEFAULT 0');
            }
        }
    }

    public function down(): void
    {
        $driver = DB::getDriverName();

        if (in_array($driver, ['mysql', 'mariadb'], true)) {
            if (Schema::hasColumn('users', 'points')) {
                DB::statement('ALTER TABLE `users` MODIFY `points` INT UNSIGNED NOT NULL DEFAULT 0');
            }

            if (Schema::hasColumn('point_transactions', 'points')) {
                DB::statement('ALTER TABLE `point_transactions` MODIFY `points` INT NOT NULL');
            }
        }
    }
};
