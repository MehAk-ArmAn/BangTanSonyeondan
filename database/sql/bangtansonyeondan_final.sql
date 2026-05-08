-- BangTanSonyeondan final database with dynamic footer + BT21 admin editing
-- Import this file in phpMyAdmin into XAMPP / MariaDB.
-- Admin login: admin@bangtansonyeondan.com / Army@2026!

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS=0;
START TRANSACTION;

CREATE DATABASE IF NOT EXISTS `bangtansonyeondan` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `bangtansonyeondan`;

DROP TABLE IF EXISTS `daily_checkins`, `user_profile_assets`, `profile_assets`, `point_transactions`, `quiz_attempts`, `quiz_questions`, `learning_lessons`, `timeline_events`, `votes`, `gallery_images`, `bt21_characters`, `nav_items`, `site_settings`, `songs_images`, `quotes`, `bts_copies`, `members`, `failed_jobs`, `job_batches`, `jobs`, `cache_locks`, `cache`, `sessions`, `password_reset_tokens`, `users`, `migrations`;

CREATE TABLE `migrations` (`id` int unsigned NOT NULL AUTO_INCREMENT, `migration` varchar(255) NOT NULL, `batch` int NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `users` (`id` bigint unsigned NOT NULL AUTO_INCREMENT, `name` varchar(255) NOT NULL, `username` varchar(255) DEFAULT NULL, `email` varchar(255) NOT NULL, `email_verified_at` timestamp NULL DEFAULT NULL, `password` varchar(255) NOT NULL, `is_admin` tinyint(1) NOT NULL DEFAULT 0, `avatar_key` varchar(255) NOT NULL DEFAULT 'purple-heart', `profile_theme` varchar(255) NOT NULL DEFAULT 'galaxy-purple', `bio` varchar(500) DEFAULT NULL, `points` int unsigned NOT NULL DEFAULT 0, `streak_days` int unsigned NOT NULL DEFAULT 0, `last_streak_date` date DEFAULT NULL, `google_id` varchar(255) DEFAULT NULL, `auth_provider` varchar(255) NOT NULL DEFAULT 'email', `remember_token` varchar(100) DEFAULT NULL, `created_at` timestamp NULL DEFAULT NULL, `updated_at` timestamp NULL DEFAULT NULL, PRIMARY KEY (`id`), UNIQUE KEY `users_email_unique` (`email`), UNIQUE KEY `users_username_unique` (`username`), KEY `users_google_id_index` (`google_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `password_reset_tokens` (`email` varchar(255) NOT NULL, `token` varchar(255) NOT NULL, `created_at` timestamp NULL DEFAULT NULL, PRIMARY KEY (`email`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `sessions` (`id` varchar(255) NOT NULL, `user_id` bigint unsigned DEFAULT NULL, `ip_address` varchar(45) DEFAULT NULL, `user_agent` text DEFAULT NULL, `payload` longtext NOT NULL, `last_activity` int NOT NULL, PRIMARY KEY (`id`), KEY `sessions_user_id_index` (`user_id`), KEY `sessions_last_activity_index` (`last_activity`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `cache` (`key` varchar(255) NOT NULL, `value` mediumtext NOT NULL, `expiration` int NOT NULL, PRIMARY KEY (`key`), KEY `cache_expiration_index` (`expiration`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `cache_locks` (`key` varchar(255) NOT NULL, `owner` varchar(255) NOT NULL, `expiration` int NOT NULL, PRIMARY KEY (`key`), KEY `cache_locks_expiration_index` (`expiration`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `jobs` (`id` bigint unsigned NOT NULL AUTO_INCREMENT, `queue` varchar(255) NOT NULL, `payload` longtext NOT NULL, `attempts` tinyint unsigned NOT NULL, `reserved_at` int unsigned DEFAULT NULL, `available_at` int unsigned NOT NULL, `created_at` int unsigned NOT NULL, PRIMARY KEY (`id`), KEY `jobs_queue_index` (`queue`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `job_batches` (`id` varchar(255) NOT NULL, `name` varchar(255) NOT NULL, `total_jobs` int NOT NULL, `pending_jobs` int NOT NULL, `failed_jobs` int NOT NULL, `failed_job_ids` longtext NOT NULL, `options` mediumtext DEFAULT NULL, `cancelled_at` int DEFAULT NULL, `created_at` int NOT NULL, `finished_at` int DEFAULT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `failed_jobs` (`id` bigint unsigned NOT NULL AUTO_INCREMENT, `uuid` varchar(255) NOT NULL, `connection` text NOT NULL, `queue` text NOT NULL, `payload` longtext NOT NULL, `exception` longtext NOT NULL, `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`), UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `members` (`id` bigint unsigned NOT NULL AUTO_INCREMENT, `slug` varchar(255) DEFAULT NULL, `name` varchar(255) NOT NULL, `stage_name` varchar(255) DEFAULT NULL, `korean_name` varchar(255) DEFAULT NULL, `birth_date` date DEFAULT NULL, `birthplace` varchar(255) DEFAULT NULL, `emoji` varchar(20) DEFAULT NULL, `accent_color` varchar(30) DEFAULT NULL, `bt21_character` varchar(255) DEFAULT NULL, `intro_title` varchar(255) DEFAULT NULL, `role` varchar(255) NOT NULL, `image` varchar(255) DEFAULT NULL, `quote` varchar(255) DEFAULT NULL, `profile_story` longtext DEFAULT NULL, `fun_facts` json DEFAULT NULL, `skill_tags` json DEFAULT NULL, `spotify_url` varchar(1000) DEFAULT NULL, `instagram_url` varchar(1000) DEFAULT NULL, `nickname` varchar(255) DEFAULT NULL, `favicon` varchar(255) DEFAULT NULL, `sort_order` int unsigned NOT NULL DEFAULT 0, `is_active` tinyint(1) NOT NULL DEFAULT 1, `created_at` timestamp NULL DEFAULT NULL, `updated_at` timestamp NULL DEFAULT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `bts_copies` (`id` bigint unsigned NOT NULL AUTO_INCREMENT, `bts_name` varchar(120) NOT NULL, `copy_extra_name` varchar(120) DEFAULT NULL, `copy_title` varchar(200) NOT NULL, `description` text DEFAULT NULL, `created_at` timestamp NULL DEFAULT NULL, `updated_at` timestamp NULL DEFAULT NULL, PRIMARY KEY (`id`), UNIQUE KEY `bts_copies_bts_name_copy_title_unique` (`bts_name`,`copy_title`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `quotes` (`id` bigint unsigned NOT NULL AUTO_INCREMENT, `source` varchar(255) NOT NULL, `quote` text NOT NULL, `context` varchar(255) DEFAULT NULL, `is_active` tinyint(1) NOT NULL DEFAULT 1, `created_at` timestamp NULL DEFAULT NULL, `updated_at` timestamp NULL DEFAULT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `songs_images` (`id` bigint unsigned NOT NULL AUTO_INCREMENT, `name` varchar(255) NOT NULL, `img_path` varchar(255) NOT NULL, `release_date` date DEFAULT NULL, `description` text DEFAULT NULL, `era` varchar(255) DEFAULT NULL, `spotify_url` varchar(1000) DEFAULT NULL, `sort_order` int unsigned NOT NULL DEFAULT 0, `is_active` tinyint(1) NOT NULL DEFAULT 1, `created_at` timestamp NULL DEFAULT NULL, `updated_at` timestamp NULL DEFAULT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `site_settings` (`id` bigint unsigned NOT NULL AUTO_INCREMENT, `key` varchar(255) NOT NULL, `value` longtext DEFAULT NULL, `created_at` timestamp NULL DEFAULT NULL, `updated_at` timestamp NULL DEFAULT NULL, PRIMARY KEY (`id`), UNIQUE KEY `site_settings_key_unique` (`key`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `nav_items` (`id` bigint unsigned NOT NULL AUTO_INCREMENT, `label` varchar(255) NOT NULL, `url` varchar(255) NOT NULL, `sort_order` int unsigned NOT NULL DEFAULT 0, `is_active` tinyint(1) NOT NULL DEFAULT 1, `created_at` timestamp NULL DEFAULT NULL, `updated_at` timestamp NULL DEFAULT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `bt21_characters` (`id` bigint unsigned NOT NULL AUTO_INCREMENT, `name` varchar(255) NOT NULL, `slug` varchar(255) NOT NULL, `member_name` varchar(255) DEFAULT NULL, `emoji` varchar(40) DEFAULT NULL, `image` varchar(255) DEFAULT NULL, `accent_color` varchar(30) NOT NULL DEFAULT '#a855f7', `mood` varchar(500) DEFAULT NULL, `power` varchar(500) DEFAULT NULL, `anatomy` json DEFAULT NULL, `moves` json DEFAULT NULL, `sort_order` int unsigned NOT NULL DEFAULT 0, `is_active` tinyint(1) NOT NULL DEFAULT 1, `created_at` timestamp NULL DEFAULT NULL, `updated_at` timestamp NULL DEFAULT NULL, PRIMARY KEY (`id`), UNIQUE KEY `bt21_characters_slug_unique` (`slug`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `gallery_images` (`id` bigint unsigned NOT NULL AUTO_INCREMENT, `name` varchar(255) DEFAULT NULL, `img_path` varchar(255) DEFAULT NULL, `caption` varchar(255) DEFAULT NULL, `category` varchar(255) NOT NULL DEFAULT 'Gallery', `sort_order` int unsigned NOT NULL DEFAULT 0, `is_active` tinyint(1) NOT NULL DEFAULT 1, `created_at` timestamp NULL DEFAULT NULL, `updated_at` timestamp NULL DEFAULT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `votes` (`id` bigint unsigned NOT NULL AUTO_INCREMENT, `member_id` bigint unsigned DEFAULT NULL, `member_name` varchar(255) DEFAULT NULL, `ip_address` varchar(255) DEFAULT NULL, `user_agent` text DEFAULT NULL, `created_at` timestamp NULL DEFAULT NULL, `updated_at` timestamp NULL DEFAULT NULL, PRIMARY KEY (`id`), KEY `votes_member_id_foreign` (`member_id`), CONSTRAINT `votes_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE SET NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `timeline_events` (`id` bigint unsigned NOT NULL AUTO_INCREMENT, `year` varchar(20) NOT NULL, `category` varchar(255) NOT NULL DEFAULT 'Milestone', `title` varchar(255) NOT NULL, `body` longtext DEFAULT NULL, `bullet_points` json DEFAULT NULL, `image_paths` json DEFAULT NULL, `sort_order` int unsigned NOT NULL DEFAULT 0, `is_active` tinyint(1) NOT NULL DEFAULT 1, `created_at` timestamp NULL DEFAULT NULL, `updated_at` timestamp NULL DEFAULT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `learning_lessons` (`id` bigint unsigned NOT NULL AUTO_INCREMENT, `slug` varchar(255) NOT NULL, `title` varchar(255) NOT NULL, `category` varchar(255) NOT NULL DEFAULT 'BTS 101', `excerpt` varchar(500) DEFAULT NULL, `body` longtext DEFAULT NULL, `image_path` varchar(255) DEFAULT NULL, `reward_points` int unsigned NOT NULL DEFAULT 30, `sort_order` int unsigned NOT NULL DEFAULT 0, `is_active` tinyint(1) NOT NULL DEFAULT 1, `created_at` timestamp NULL DEFAULT NULL, `updated_at` timestamp NULL DEFAULT NULL, PRIMARY KEY (`id`), UNIQUE KEY `learning_lessons_slug_unique` (`slug`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `quiz_questions` (`id` bigint unsigned NOT NULL AUTO_INCREMENT, `learning_lesson_id` bigint unsigned NOT NULL, `question` varchar(255) NOT NULL, `options` json NOT NULL, `correct_option` tinyint unsigned NOT NULL DEFAULT 0, `explanation` text DEFAULT NULL, `points` int unsigned NOT NULL DEFAULT 10, `sort_order` int unsigned NOT NULL DEFAULT 0, `is_active` tinyint(1) NOT NULL DEFAULT 1, `created_at` timestamp NULL DEFAULT NULL, `updated_at` timestamp NULL DEFAULT NULL, PRIMARY KEY (`id`), KEY `quiz_questions_learning_lesson_id_foreign` (`learning_lesson_id`), CONSTRAINT `quiz_questions_learning_lesson_id_foreign` FOREIGN KEY (`learning_lesson_id`) REFERENCES `learning_lessons` (`id`) ON DELETE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `quiz_attempts` (`id` bigint unsigned NOT NULL AUTO_INCREMENT, `user_id` bigint unsigned NOT NULL, `learning_lesson_id` bigint unsigned NOT NULL, `score` int unsigned NOT NULL DEFAULT 0, `total` int unsigned NOT NULL DEFAULT 0, `points_earned` int unsigned NOT NULL DEFAULT 0, `answers` json DEFAULT NULL, `created_at` timestamp NULL DEFAULT NULL, `updated_at` timestamp NULL DEFAULT NULL, PRIMARY KEY (`id`), KEY `quiz_attempts_user_id_foreign` (`user_id`), KEY `quiz_attempts_learning_lesson_id_foreign` (`learning_lesson_id`), CONSTRAINT `quiz_attempts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE, CONSTRAINT `quiz_attempts_learning_lesson_id_foreign` FOREIGN KEY (`learning_lesson_id`) REFERENCES `learning_lessons` (`id`) ON DELETE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `point_transactions` (`id` bigint unsigned NOT NULL AUTO_INCREMENT, `user_id` bigint unsigned NOT NULL, `type` varchar(255) NOT NULL DEFAULT 'earn', `points` int NOT NULL, `reason` varchar(255) DEFAULT NULL, `meta` json DEFAULT NULL, `created_at` timestamp NULL DEFAULT NULL, `updated_at` timestamp NULL DEFAULT NULL, PRIMARY KEY (`id`), KEY `point_transactions_user_id_foreign` (`user_id`), CONSTRAINT `point_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `profile_assets` (`id` bigint unsigned NOT NULL AUTO_INCREMENT, `key` varchar(255) NOT NULL, `label` varchar(255) NOT NULL, `type` varchar(255) NOT NULL DEFAULT 'avatar', `description` varchar(500) DEFAULT NULL, `cost` int unsigned NOT NULL DEFAULT 0, `image_path` varchar(255) DEFAULT NULL, `gradient` varchar(255) DEFAULT NULL, `sort_order` int unsigned NOT NULL DEFAULT 0, `is_active` tinyint(1) NOT NULL DEFAULT 1, `created_at` timestamp NULL DEFAULT NULL, `updated_at` timestamp NULL DEFAULT NULL, PRIMARY KEY (`id`), UNIQUE KEY `profile_assets_key_unique` (`key`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `user_profile_assets` (`id` bigint unsigned NOT NULL AUTO_INCREMENT, `user_id` bigint unsigned NOT NULL, `profile_asset_id` bigint unsigned NOT NULL, `unlocked_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`), UNIQUE KEY `user_profile_assets_user_id_profile_asset_id_unique` (`user_id`,`profile_asset_id`), KEY `user_profile_assets_profile_asset_id_foreign` (`profile_asset_id`), CONSTRAINT `user_profile_assets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE, CONSTRAINT `user_profile_assets_profile_asset_id_foreign` FOREIGN KEY (`profile_asset_id`) REFERENCES `profile_assets` (`id`) ON DELETE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `daily_checkins` (`id` bigint unsigned NOT NULL AUTO_INCREMENT, `user_id` bigint unsigned NOT NULL, `checkin_date` date NOT NULL, `points_earned` int unsigned NOT NULL DEFAULT 0, `streak_after` int unsigned NOT NULL DEFAULT 0, `created_at` timestamp NULL DEFAULT NULL, `updated_at` timestamp NULL DEFAULT NULL, PRIMARY KEY (`id`), UNIQUE KEY `daily_checkins_user_id_checkin_date_unique` (`user_id`,`checkin_date`), CONSTRAINT `daily_checkins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_28_104910_create_members_table', 1),
(5, '2026_01_28_110424_add_favicon_to_members_table', 1),
(6, '2026_02_07_131748_create_bts_copies_table', 1),
(7, '2026_02_17_050950_create_quotes_table', 1),
(8, '2026_03_24_163105_create_songs_images_table', 1),
(9, '2026_05_07_181046_upgrade_bts_site_for_admin', 1),
(10, '2026_05_07_200000_glow_up_content_upgrade', 1),
(11, '2026_05_08_000000_create_army_learning_features', 1),
(12, '2026_05_08_130000_create_bt21_characters_table', 1);


INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `is_admin`, `avatar_key`, `profile_theme`, `bio`, `points`, `streak_days`, `last_streak_date`, `google_id`, `auth_provider`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'BTS Admin', 'bts_admin', 'admin@bangtansonyeondan.com', NULL, '$2y$12$xW.hPbMQ2RKzAU/EoK.qReDrcgacv7q4D2w2uXnC8BpKYlpdRWn7O', 1, 'purple-heart', 'galaxy-purple', NULL, 0, 0, NULL, NULL, 'email', NULL, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(2, 'MehakARMY', 'mehak_army', 'mehak@example.com', NULL, '$2y$12$xW.hPbMQ2RKzAU/EoK.qReDrcgacv7q4D2w2uXnC8BpKYlpdRWn7O', 0, 'purple-heart', 'galaxy-purple', 'BTS forever. Purple blood mode on.', 680, 9, '2026-05-08', NULL, 'email', NULL, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(3, 'PurpleMochi', 'purple_mochi', 'mochi@example.com', NULL, '$2y$12$xW.hPbMQ2RKzAU/EoK.qReDrcgacv7q4D2w2uXnC8BpKYlpdRWn7O', 0, 'purple-heart', 'galaxy-purple', 'Learning every era one quiz at a time.', 520, 6, '2026-05-08', NULL, 'email', NULL, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(4, 'MoonChild', 'moon_child', 'moon@example.com', NULL, '$2y$12$xW.hPbMQ2RKzAU/EoK.qReDrcgacv7q4D2w2uXnC8BpKYlpdRWn7O', 0, 'purple-heart', 'galaxy-purple', 'RM lyrics saved my brain.', 430, 4, '2026-05-08', NULL, 'email', NULL, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(5, 'GoldenBunny', 'golden_bunny', 'bunny@example.com', NULL, '$2y$12$xW.hPbMQ2RKzAU/EoK.qReDrcgacv7q4D2w2uXnC8BpKYlpdRWn7O', 0, 'purple-heart', 'galaxy-purple', 'Quiz first, sleep later.', 390, 3, '2026-05-08', NULL, 'email', NULL, '2026-05-08 12:00:00', '2026-05-08 12:00:00');


INSERT INTO `members` (`id`, `slug`, `name`, `stage_name`, `korean_name`, `birth_date`, `birthplace`, `emoji`, `accent_color`, `bt21_character`, `intro_title`, `role`, `image`, `quote`, `profile_story`, `fun_facts`, `skill_tags`, `spotify_url`, `instagram_url`, `nickname`, `favicon`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'rm', 'Kim Namjoon', 'RM', 'Kim Namjoon', '1994-09-12', 'Ilsan/Goyang, South Korea', 'KOYA', '#7c3aed', 'KOYA', 'The thoughtful leader who turns chaos into poetry.', 'Leader · Rapper · Lyricist', 'rm.jfif', 'A calm brain, a giant heart, and words that feel like a deep purple sky.', 'RM is the leader and one of the strongest creative voices behind BTS. His vault focuses on leadership, lyrics, art energy, and reflective comfort.', '["Known for thoughtful speeches and interviews.", "Loves museums, books, nature, and art spaces.", "Represents the soft-intellectual side of BTS energy."]', '["Leadership", "Rap", "Lyrics", "Art lover", "English speaker"]', NULL, NULL, 'RM', 'KOYA.png', 1, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(2, 'jin', 'Kim Seokjin', 'Jin', 'Kim Seokjin', '1992-12-04', 'Gwacheon, South Korea', 'RJ', '#ec4899', 'RJ', 'The worldwide handsome mood-maker with silver vocals.', 'Vocalist · Visual · Worldwide Handsome', 'jin.jfif', 'A vocal prince with dad jokes, elegance, and full chaos mode unlocked.', 'Jin brings warmth, humor, confidence, and emotional vocals. His vault feels wholesome, royal, funny, and secretly powerful.', '["Known for Worldwide Handsome energy.", "Often brings comfort through emotional solo songs.", "Can turn any serious moment into a legendary meme."]', '["Vocal", "Visual", "Variety", "Confidence", "Humor"]', NULL, NULL, 'Jin', 'RJ.png', 2, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(3, 'suga', 'Min Yoongi', 'SUGA', 'Min Yoongi', '1993-03-09', 'Daegu, South Korea', 'SHOOKY', '#64748b', 'SHOOKY', 'The quiet producer with savage lyrics and soft-core honesty.', 'Rapper · Producer · Songwriter', 'suga.jfif', 'Calm outside, thunder in the studio, comfort in the lyrics.', 'SUGA is the production brain, sharp rapper, and emotional storyteller. His page is moody, cinematic, and honest.', '["Known for direct, honest writing.", "Has a strong producer identity beyond performance.", "His calm vibe is half sleepy cat, half studio monster."]', '["Rap", "Production", "Piano", "Songwriting", "Agust D"]', NULL, NULL, 'Suga', 'SHOOKY.png', 3, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(4, 'jhope', 'Jung Hoseok', 'j-hope', 'Jung Hoseok', '1994-02-18', 'Gwangju, South Korea', 'MANG', '#f59e0b', 'MANG', 'The sunshine engine who turns practice into fireworks.', 'Rapper · Main Dancer · Performance Leader', 'jhope.jfif', 'Bright smile, beast-mode dance lines, and stage energy that wakes the planet.', 'j-hope is movement, precision, and joy. His vault feels like stage lights switching on: dance practice, sunshine, rap flow, and motivation.', '["Known for powerful dance leadership.", "Brings bright energy with serious discipline.", "His stage presence can flip a whole room instantly."]', '["Dance", "Rap", "Performance", "Choreography", "Energy"]', NULL, NULL, 'Hobi', 'MANG.png', 4, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(5, 'jimin', 'Park Jimin', 'Jimin', 'Park Jimin', '1995-10-13', 'Busan, South Korea', 'CHIMMY', '#a855f7', 'CHIMMY', 'The graceful performer with angel vocals and lethal duality.', 'Vocalist · Dancer', 'jimin.jfif', 'Soft voice, sharp movement, and stage duality that should honestly be illegal.', 'Jimin brings elegance, emotion, and powerful dance detail. His vault feels delicate and dramatic at the same time.', '["Known for expressive dance lines.", "Balances softness and intensity on stage.", "Has one of the most recognizable performance auras in BTS."]', '["Dance", "Vocal", "Performance", "Duality", "Contemporary"]', NULL, NULL, 'Jimin', 'CHIMMY.png', 5, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(6, 'v', 'Kim Taehyung', 'V', 'Kim Taehyung', '1995-12-30', 'Daegu, South Korea', 'TATA', '#14b8a6', 'TATA', 'The velvet-voiced art prince with cinematic energy.', 'Vocalist · Visual · Actor', 'v.jfif', 'Jazz soul, deep voice, model aura, and facial expressions that tell whole stories.', 'V brings color, mood, and a film-like presence. His vault feels like vintage jazz, fashion editorials, soft photography, and mysterious charisma.', '["Known for a deep, warm vocal color.", "Loves art, photography, jazz, and classic aesthetics.", "His expressions can change a whole stage mood."]', '["Vocal", "Jazz tone", "Visual", "Acting", "Fashion"]', NULL, NULL, 'V', 'TATA.png', 6, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(7, 'jungkook', 'Jeon Jungkook', 'Jung Kook', 'Jeon Jungkook', '1997-09-01', 'Busan, South Korea', 'COOKY', '#22c55e', 'COOKY', 'The golden maknae built like a final boss character.', 'Main Vocalist · Performer · Golden Maknae', 'jk.jfif', 'Vocals, dance, sports, art, chaos — bro downloaded the all-rounder expansion pack.', 'Jung Kook is the powerhouse all-rounder: vocals, dance, performance, athletic energy, and playful maknae chaos.', '["Known as the Golden Maknae.", "Has strong vocals and sharp stage focus.", "Somehow manages to be both chaotic and perfectionist."]', '["Vocal", "Dance", "Performance", "Sports", "Golden Maknae"]', NULL, NULL, 'JK', 'COOKY.png', 7, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00');


INSERT INTO `site_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_title', 'BangTanSonyeondan', '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(2, 'site_subtitle', 'A dark purple BTS learning website with member profiles, songs, gallery, quotes, BT21 anatomy profiles, quizzes, points, streaks, and leaderboard.', '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(3, 'hero_kicker', 'BTS FOREVER · ARMY HOMEBASE', '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(4, 'hero_title', 'BangTanSonyeondan', '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(5, 'hero_body', 'A fan-made BTS hub where ARMY can learn, explore member vaults, take quizzes, earn points, unlock profile upgrades, and climb the leaderboard.', '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(6, 'footer_text', 'BangTanSonyeondan is a fan-made website created with love. Please support official BTS channels whenever possible.', '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(7, 'admin_email', 'hello@bangtansonyeondan.com', '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(8, 'location', 'ARMY Hub', '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(9, 'creator_name', 'Mehak Arman', '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(10, 'phone', '', '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(11, 'instagram', '', '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(12, 'linkedin', '', '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(13, 'twitter', '', '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(14, 'youtube', '', '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(15, 'tiktok', '', '2026-05-08 12:00:00', '2026-05-08 12:00:00');


INSERT INTO `nav_items` (`id`, `label`, `url`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Home', '/', 1, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(2, 'Members', '/#members', 2, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(3, 'Learn', '/learn', 3, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(4, 'Timeline', '/bts-achievements', 4, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(5, 'Songs', '/songs', 5, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(6, 'Gallery', '/gallery', 6, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(7, 'Quotes', '/quotes', 7, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(8, 'BT21', '/bt21', 8, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(9, 'Leaderboard', '/leaderboard', 9, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(10, 'Vote', '/vote', 10, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00');


INSERT INTO `bt21_characters` (`id`, `name`, `slug`, `member_name`, `emoji`, `image`, `accent_color`, `mood`, `power`, `anatomy`, `moves`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'KOYA', 'koya', 'RM', '🐨', 'favicons/KOYA.png', '#7c3aed', 'Sleepy genius dream koala', 'Deep thinking + soft leader energy', '["Detachable ears for extra cute chaos", "Big brain for ideas, lyrics, and tiny naps", "Soft sleepy eyes but secretly alert"]', '["Dream cloud float", "Leader calm shield", "Idea sparkle burst"]', 1, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(2, 'RJ', 'rj', 'Jin', '🦙', 'favicons/RJ.png', '#ec4899', 'Fluffy royal alpaca', 'Comfort food aura + worldwide handsome confidence', '["Cloud-fluff body built for warm hugs", "Chef-core heart full of snacks", "Tiny royal steps with maximum elegance"]', '["WWH wink", "Warm hug blanket", "Snack shield"]', 2, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(3, 'SHOOKY', 'shooky', 'SUGA', '🍪', 'favicons/SHOOKY.png', '#64748b', 'Tiny savage cookie', 'Studio focus + low-key chaos', '["Small body, giant attitude", "Crispy edge for savage comments", "Producer brain hidden in cookie mode"]', '["Savage crumb shot", "Studio silence mode", "Sleepy dodge"]', 3, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(4, 'MANG', 'mang', 'j-hope', '🕺', 'favicons/MANG.png', '#f59e0b', 'Masked dance sunshine', 'Rhythm, hope, and stage fireworks', '["Mystery mask for performance mode", "Dance-core legs with unlimited stamina", "Sunshine battery in the chest"]', '["Hope beam", "Dance combo spin", "Stage spark jump"]', 4, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(5, 'CHIMMY', 'chimmy', 'Jimin', '🐶', 'favicons/CHIMMY.png', '#a855f7', 'Yellow hoodie puppy', 'Sweetness + stage duality', '["Soft hoodie armor", "Tiny paws for dramatic cuteness", "Duality switch hidden under the hood"]', '["Puppy charm", "Graceful spin", "Duality glow"]', 5, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(6, 'TATA', 'tata', 'V', '💜', 'favicons/TATA.png', '#14b8a6', 'Alien heart prince', 'Cinematic imagination + artsy mystery', '["Heart-shaped head from Planet BT", "Tiny limbs, huge personality", "Mood detector for aesthetic moments"]', '["Alien heart pulse", "Vintage jazz aura", "Expression freeze frame"]', 6, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(7, 'COOKY', 'cooky', 'Jung Kook', '🐰', 'favicons/COOKY.png', '#22c55e', 'Pink bunny gym beast', 'Golden maknae energy + playful courage', '["Bunny ears tuned for challenges", "Tiny body with gym-boss power", "Heart mark loaded with confidence"]', '["Golden jump", "Boxing bunny combo", "Challenge accepted dash"]', 7, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(8, 'VAN', 'van', 'ARMY', '🤖', 'favicons/logo.png', '#94a3b8', 'Guardian robot watching over BT21', 'Protection + calm universe balance', '["Robot shell with soft guardian energy", "Scans chaos and protects the crew", "Half light, half shadow, all loyal"]', '["Guardian scan", "Shield pulse", "Orbit watch"]', 8, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00');


INSERT INTO `quotes` (`id`, `source`, `quote`, `context`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'RM', 'Some songs feel like a map back to yourself.', 'Reflection', 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(2, 'Jin', 'Confidence can be funny, soft, and powerful at the same time.', 'Comfort', 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(3, 'SUGA', 'Healing is not always loud. Sometimes it is just honest.', 'Honesty', 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(4, 'j-hope', 'Energy is a choice, and he chooses sunshine with discipline.', 'Motivation', 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(5, 'Jimin', 'Grace hits hardest when it carries emotion.', 'Performance', 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(6, 'V', 'A deep voice can turn one quiet second into cinema.', 'Mood', 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(7, 'Jung Kook', 'Talent becomes legendary when effort refuses to sleep.', 'Growth', 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(8, 'ARMY', 'Seven people. Millions of stories. One purple stage.', 'Fandom', 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00');


INSERT INTO `songs_images` (`id`, `name`, `img_path`, `release_date`, `description`, `era`, `spotify_url`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'No More Dream', 'imgs/songs/1.jfif', '2013-06-12', 'Debut era attitude: bold, raw, and hungry.', 'School Trilogy', NULL, 1, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(2, 'I NEED U', 'imgs/songs/5.jfif', '2015-04-29', 'A turning-point era with youth, pain, and cinematic emotion.', 'HYYH', NULL, 2, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(3, 'Spring Day', 'imgs/songs/10.jfif', '2017-02-13', 'A timeless comfort song with soft winter-to-spring feeling.', 'You Never Walk Alone', NULL, 3, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(4, 'DNA', 'imgs/songs/13.jfif', '2017-09-18', 'Bright, colorful, and made for global discovery.', 'Love Yourself', NULL, 4, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(5, 'FAKE LOVE', 'imgs/songs/16.jfif', '2018-05-18', 'Dark, dramatic, and iconic for the Love Yourself era.', 'Love Yourself', NULL, 5, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(6, 'IDOL', 'imgs/songs/18.jfif', '2018-08-24', 'A loud celebration of identity and performance.', 'Love Yourself', NULL, 6, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(7, 'Boy With Luv', 'imgs/songs/21.jfif', '2019-04-12', 'Sweet pop energy with a worldwide sing-along feeling.', 'Map of the Soul', NULL, 7, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(8, 'Black Swan', 'imgs/songs/24.jfif', '2020-01-17', 'Art-film energy, shadow themes, and elegant darkness.', 'Map of the Soul', NULL, 8, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(9, 'Dynamite', 'imgs/songs/27.jfif', '2020-08-21', 'Disco-bright global pop with instant serotonin.', 'English Singles', NULL, 9, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(10, 'Life Goes On', 'imgs/songs/30.jfif', '2020-11-20', 'Soft pandemic-era comfort wrapped in warmth.', 'BE', NULL, 10, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(11, 'Butter', 'imgs/songs/33.jfif', '2021-05-21', 'Smooth, playful, and built for summer domination.', 'English Singles', NULL, 11, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(12, 'Permission to Dance', 'imgs/songs/36.jfif', '2021-07-09', 'A hopeful, open-air celebration of moving again.', 'English Singles', NULL, 12, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(13, 'Yet To Come', 'imgs/songs/40.jfif', '2022-06-10', 'A reflective promise that the best is still ahead.', 'Proof', NULL, 13, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(14, 'Run BTS', 'imgs/songs/43.jfif', '2022-06-10', 'Hard-hitting proof that BTS never stopped running.', 'Proof', NULL, 14, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(15, 'Take Two', 'imgs/songs/46.jfif', '2023-06-09', 'A fan-letter feeling made for ARMY and anniversary season.', 'Anniversary', NULL, 15, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00');


INSERT INTO `gallery_images` (`id`, `name`, `img_path`, `caption`, `category`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Purple Energy', 'extra_gallery/BTS.jfif', 'Group energy for the hero mood.', 'Group', 1, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(2, 'Meme Museum', 'extra_gallery/HAHAHA.jfif', 'Because BTS funny moments deserve a museum wing.', 'Meme', 2, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(3, 'Run Era Mood', 'extra_gallery/run.jfif', 'High-energy era card.', 'Era', 3, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(4, 'Life Goes On Comfort', 'extra_gallery/lifeGoesOn.jfif', 'Soft comfort energy.', 'Era', 4, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(5, 'Taekook Moment', 'extra_gallery/taekook.jfif', 'Friendship member moment.', 'Members', 5, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(6, 'Jimin Smile', 'extra_gallery/jiminSmile.jfif', 'Soft gallery highlight.', 'Members', 6, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(7, 'Jin Smile', 'extra_gallery/jinSmile.jfif', 'Worldwide handsome gallery highlight.', 'Members', 7, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(8, 'SUGA Mood', 'extra_gallery/suga.jfif', 'Calm but powerful.', 'Members', 8, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00');


INSERT INTO `timeline_events` (`id`, `year`, `category`, `title`, `body`, `bullet_points`, `image_paths`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '2013', 'Debut', 'Debut with 2 Cool 4 Skool', 'BTS began their journey with a sharp hip-hop identity, rookie energy, and a message that questioned pressure placed on young people.', '["Debut era begins", "ARMY origin story starts", "School Trilogy foundation"]', '["imgs/timeline/2013/1.jfif", "imgs/timeline/2013/2.jfif"]', 1, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(2, '2016', 'Recognition', 'First major awards and wider recognition', 'BTS started moving from promising rookies to serious award-season names, building momentum through performance and storytelling.', '["Korean award visibility increases", "Bigger stages", "Fandom grows stronger"]', '[]', 2, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(3, '2017', 'Global', 'Billboard breakthrough and global attention', 'BTS moved from rising stars to global conversation, with international fandom becoming impossible to ignore.', '["Global fanbase grows rapidly", "US award-show visibility increases", "Love Yourself era begins"]', '["imgs/timeline/2017/1.jfif", "imgs/timeline/2017/2.jfif"]', 3, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(4, '2018', 'Message', 'Love Yourself and Speak Yourself impact', 'Their message expanded beyond music into self-love, youth voice, and cultural impact.', '["Love Yourself message becomes central", "Bigger stadium-scale presence", "Global media focus"]', '["imgs/timeline/2018/1.jfif", "imgs/timeline/2018/2.jfif"]', 4, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(5, '2020', 'Record Era', 'Dynamite, BE, and worldwide comfort', 'BTS reached another global peak while releasing music that brought brightness and comfort during a difficult year.', '["Dynamite era explodes worldwide", "BE carries a softer healing tone", "BTS becomes a household global pop name"]', '["imgs/timeline/2020/1.jfif", "imgs/timeline/2020/2.jfif"]', 5, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(6, '2021', 'Stadium Pop', 'Butter and Permission to Dance', 'BTS leaned into polished pop brightness while keeping the fan connection strong.', '["English singles era continues", "Performance scale grows", "ARMY moments everywhere"]', '[]', 6, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(7, '2022', 'Reflection', 'Proof anthology era', 'Proof looked back across the group journey and framed their story as something still moving forward.', '["Anthology project", "Career reflection", "Promise of the future"]', '[]', 7, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(8, '2023-2025', 'Solo Chapter', 'Solo era and individual colors', 'Each member explored solo identity, showing different sounds, styles, and personal artistic colors while the seven-member story stayed connected.', '["Solo albums and singles", "Member identities shine", "Group bond remains central"]', '["imgs/timeline/2023/1.jfif", "imgs/timeline/2023/2.jfif", "imgs/timeline/2023/3.jfif"]', 8, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00');


INSERT INTO `learning_lessons` (`id`, `slug`, `title`, `category`, `excerpt`, `body`, `image_path`, `reward_points`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'bts-origin-story', 'BTS Origin Story', 'BTS 101', 'Learn how BTS started, what their early identity was, and why their message felt different.', 'BTS debuted in 2013 with a hip-hop-heavy identity and a message focused on young people, pressure, dreams, and self-expression.

Their early school trilogy was not just about looking cool. It questioned expectations and gave fans lyrics that felt direct. This is why the website teaches the story first: BTS is easier to understand when you see the message behind the eras.

Key idea: BTS grew because music, performance, personality, and ARMY connection all worked together.', NULL, 30, 1, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(2, 'members-and-roles', 'Members and Roles', 'Member Vaults', 'A simple guide to the seven members, their broad roles, and the energy each one brings.', 'BTS has seven members: RM, Jin, SUGA, j-hope, Jimin, V, and Jung Kook.

RM is the leader and rapper. Jin brings vocals, humor, and comfort. SUGA is a rapper and producer. j-hope is a dancer, rapper, and performance leader. Jimin brings vocals and dance with graceful detail. V brings deep vocals and cinematic mood. Jung Kook is the main vocalist and all-rounder.

The member vault pages are built so each profile feels personal instead of being just a boring card.', NULL, 30, 2, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(3, 'bt21-anatomy', 'BT21 Character Anatomy', 'BT21', 'Learn what BT21 means on this site and why each character has its own animated profile zone.', 'BT21 is treated as its own colorful side quest in this final project. Instead of linking back to member vaults, the BT21 page has character anatomy notes, fun powers, and animated cards.

KOYA, RJ, SHOOKY, MANG, CHIMMY, TATA, and COOKY each get a playful identity. This keeps the BTS member profiles serious and detailed while letting BT21 stay cute, bright, and chaotic.', NULL, 30, 3, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00');


INSERT INTO `quiz_questions` (`id`, `learning_lesson_id`, `question`, `options`, `correct_option`, `explanation`, `points`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Which year did BTS debut?', '["2011", "2013", "2016", "2020"]', 1, 'BTS debuted in 2013.', 10, 1, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(2, 1, 'What was a major theme in early BTS music?', '["Youth pressure and dreams", "Cooking shows only", "Space travel only", "Sports commentary"]', 0, 'Early BTS lyrics often explored youth, pressure, dreams, and identity.', 10, 2, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(3, 1, 'Why is learning the story important?', '["It makes quizzes harder only", "It helps fans understand the message behind the eras", "It replaces the songs", "It hides member profiles"]', 1, 'The story gives meaning to songs, eras, and achievements.', 10, 3, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(4, 2, 'Who is the leader of BTS?', '["Jin", "RM", "Jimin", "V"]', 1, 'RM is the leader.', 10, 1, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(5, 2, 'Which member is often called the Golden Maknae?', '["Jung Kook", "SUGA", "j-hope", "Jin"]', 0, 'Jung Kook is widely known as the Golden Maknae.', 10, 2, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(6, 2, 'Which member is strongly linked with dance leadership and sunshine energy?', '["RM", "j-hope", "V", "SUGA"]', 1, 'j-hope is known for dance, performance, and bright energy.', 10, 3, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(7, 3, 'What is fixed about the new BT21 page?', '["It routes only to admin", "It has its own fun character anatomy profiles", "It deletes all characters", "It becomes a plain text page"]', 1, 'The final BT21 page is its own colorful anatomy profile section.', 10, 1, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(8, 3, 'Which BT21 character is linked with Jin?', '["RJ", "KOYA", "COOKY", "MANG"]', 0, 'RJ is Jin’s BT21 character.', 10, 2, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(9, 3, 'Which BT21 character is linked with V?', '["SHOOKY", "TATA", "CHIMMY", "RJ"]', 1, 'TATA is V’s BT21 character.', 10, 3, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00');


INSERT INTO `profile_assets` (`id`, `key`, `label`, `type`, `description`, `cost`, `image_path`, `gradient`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'purple-heart', 'Purple Heart Starter', 'avatar', 'Default soft purple ARMY avatar asset.', 0, NULL, 'linear-gradient(135deg,#581c87,#a855f7,#111827)', 1, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(2, 'galaxy-purple', 'Galaxy Purple Theme', 'theme', 'Free default black and purple profile theme.', 0, NULL, 'linear-gradient(135deg,#2e1065,#581c87,#111827)', 2, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(3, 'galaxy-stage', 'Galaxy Stage Theme', 'theme', 'Dark galaxy profile card with purple glow.', 120, NULL, 'linear-gradient(135deg,#0f172a,#4c1d95,#7e22ce)', 3, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(4, 'night-black', 'Night Black Theme', 'theme', 'Clean black profile card with soft purple edges.', 80, NULL, 'linear-gradient(135deg,#020617,#111827,#3b0764)', 4, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(5, 'crimson-stage', 'Crimson Stage Theme', 'theme', 'Black, purple, and red concert-energy profile theme.', 160, NULL, 'linear-gradient(135deg,#111827,#7f1d1d,#581c87)', 5, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(6, 'bt21-spark', 'BT21 Spark Badge', 'badge', 'Cute BT21-style sparkle badge for playful profiles.', 90, NULL, 'linear-gradient(135deg,#fde68a,#f0abfc,#93c5fd)', 6, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00');


INSERT INTO `user_profile_assets` (`id`, `user_id`, `profile_asset_id`, `unlocked_at`) VALUES
(1, 2, 1, '2026-05-08 12:00:00'),
(2, 2, 2, '2026-05-08 12:00:00'),
(3, 3, 1, '2026-05-08 12:00:00'),
(4, 3, 2, '2026-05-08 12:00:00'),
(5, 4, 1, '2026-05-08 12:00:00'),
(6, 4, 2, '2026-05-08 12:00:00'),
(7, 5, 1, '2026-05-08 12:00:00'),
(8, 5, 2, '2026-05-08 12:00:00');


INSERT INTO `point_transactions` (`id`, `user_id`, `type`, `points`, `reason`, `meta`, `created_at`, `updated_at`) VALUES
(1, 2, 'earn', 680, 'Demo leaderboard starter points', '{"source": "seed"}', '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(2, 3, 'earn', 520, 'Demo leaderboard starter points', '{"source": "seed"}', '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(3, 4, 'earn', 430, 'Demo leaderboard starter points', '{"source": "seed"}', '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(4, 5, 'earn', 390, 'Demo leaderboard starter points', '{"source": "seed"}', '2026-05-08 12:00:00', '2026-05-08 12:00:00');


SET FOREIGN_KEY_CHECKS=1;

ALTER TABLE `users` AUTO_INCREMENT=6;
ALTER TABLE `members` AUTO_INCREMENT=8;
ALTER TABLE `site_settings` AUTO_INCREMENT=16;
ALTER TABLE `nav_items` AUTO_INCREMENT=11;
ALTER TABLE `bt21_characters` AUTO_INCREMENT=9;
ALTER TABLE `quotes` AUTO_INCREMENT=9;
ALTER TABLE `songs_images` AUTO_INCREMENT=16;
ALTER TABLE `gallery_images` AUTO_INCREMENT=9;
ALTER TABLE `timeline_events` AUTO_INCREMENT=9;
ALTER TABLE `learning_lessons` AUTO_INCREMENT=4;
ALTER TABLE `quiz_questions` AUTO_INCREMENT=10;
ALTER TABLE `profile_assets` AUTO_INCREMENT=5;
ALTER TABLE `user_profile_assets` AUTO_INCREMENT=5;
ALTER TABLE `point_transactions` AUTO_INCREMENT=5;

COMMIT;
