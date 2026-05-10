-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2026 at 04:54 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bangtansonyeondan`
--

-- --------------------------------------------------------

--
-- Table structure for table `bt21_characters`
--

CREATE TABLE `bt21_characters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `member_name` varchar(255) DEFAULT NULL,
  `emoji` varchar(40) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `accent_color` varchar(30) NOT NULL DEFAULT '#a855f7',
  `mood` varchar(500) DEFAULT NULL,
  `power` varchar(500) DEFAULT NULL,
  `anatomy` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`anatomy`)),
  `moves` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`moves`)),
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bt21_characters`
--

INSERT INTO `bt21_characters` (`id`, `name`, `slug`, `member_name`, `emoji`, `image`, `accent_color`, `mood`, `power`, `anatomy`, `moves`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'KOYA', 'koya', 'RM', '🐨', 'favicons/KOYA.png', '#7c3aed', 'Sleepy genius dream koala', 'Deep thinking + soft leader energy', '[\"Detachable ears for extra cute chaos\",\"Big brain for ideas, lyrics, and tiny naps\",\"Soft sleepy eyes but secretly alert\"]', '[\"Dream cloud float\",\"Leader calm shield\",\"Idea sparkle burst\"]', 1, 1, '2026-05-08 05:21:32', '2026-05-08 05:21:32'),
(2, 'RJ', 'rj', 'Jin', '🦙', 'favicons/RJ.png', '#ec4899', 'Fluffy royal alpaca', 'Comfort food aura + worldwide handsome confidence', '[\"Cloud-fluff body built for warm hugs\",\"Chef-core heart full of snacks\",\"Tiny royal steps with maximum elegance\"]', '[\"WWH wink\",\"Warm hug blanket\",\"Snack shield\"]', 2, 1, '2026-05-08 05:21:32', '2026-05-08 05:21:32'),
(3, 'SHOOKY', 'shooky', 'SUGA', '🍪', 'favicons/SHOOKY.png', '#64748b', 'Tiny savage cookie', 'Studio focus + low-key chaos', '[\"Small body, giant attitude\",\"Crispy edge for savage comments\",\"Producer brain hidden in cookie mode\"]', '[\"Savage crumb shot\",\"Studio silence mode\",\"Sleepy dodge\"]', 3, 1, '2026-05-08 05:21:32', '2026-05-08 05:21:32'),
(4, 'MANG', 'mang', 'j-hope', '🕺', 'favicons/MANG.png', '#f59e0b', 'Masked dance sunshine', 'Rhythm, hope, and stage fireworks', '[\"Mystery mask for performance mode\",\"Dance-core legs with unlimited stamina\",\"Sunshine battery in the chest\"]', '[\"Hope beam\",\"Dance combo spin\",\"Stage spark jump\"]', 4, 1, '2026-05-08 05:21:32', '2026-05-08 05:21:32'),
(5, 'CHIMMY', 'chimmy', 'Jimin', '🐶', 'favicons/CHIMMY.png', '#a855f7', 'Yellow hoodie puppy', 'Sweetness + stage duality', '[\"Soft hoodie armor\",\"Tiny paws for dramatic cuteness\",\"Duality switch hidden under the hood\"]', '[\"Puppy charm\",\"Graceful spin\",\"Duality glow\"]', 5, 1, '2026-05-08 05:21:32', '2026-05-08 05:21:32'),
(6, 'TATA', 'tata', 'V', '💜', 'favicons/TATA.png', '#14b8a6', 'Alien heart prince', 'Cinematic imagination + artsy mystery', '[\"Heart-shaped head from Planet BT\",\"Tiny limbs, huge personality\",\"Mood detector for aesthetic moments\"]', '[\"Alien heart pulse\",\"Vintage jazz aura\",\"Expression freeze frame\"]', 6, 1, '2026-05-08 05:21:32', '2026-05-08 05:21:32'),
(7, 'COOKY', 'cooky', 'Jung Kook', '🐰', 'favicons/COOKY.png', '#22c55e', 'Pink bunny gym beast', 'Golden maknae energy + playful courage', '[\"Bunny ears tuned for challenges\",\"Tiny body with gym-boss power\",\"Heart mark loaded with confidence\"]', '[\"Golden jump\",\"Boxing bunny combo\",\"Challenge accepted dash\"]', 7, 1, '2026-05-08 05:21:32', '2026-05-08 05:21:32'),
(8, 'VAN', 'van', 'ARMY', '🤖', 'favicons/logo.png', '#94a3b8', 'Guardian robot watching over BT21', 'Protection + calm universe balance', '[\"Robot shell with soft guardian energy\",\"Scans chaos and protects the crew\",\"Half light, half shadow, all loyal\"]', '[\"Guardian scan\",\"Shield pulse\",\"Orbit watch\"]', 8, 1, '2026-05-08 05:21:32', '2026-05-08 05:21:32');

-- --------------------------------------------------------

--
-- Table structure for table `bts_copies`
--

CREATE TABLE `bts_copies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bts_name` varchar(120) NOT NULL,
  `copy_extra_name` varchar(120) DEFAULT NULL,
  `copy_title` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `daily_checkins`
--

CREATE TABLE `daily_checkins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `checkin_date` date NOT NULL,
  `points_earned` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `streak_after` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daily_checkins`
--

INSERT INTO `daily_checkins` (`id`, `user_id`, `checkin_date`, `points_earned`, `streak_after`, `created_at`, `updated_at`) VALUES
(1, 6, '2026-05-08', 12, 1, '2026-05-08 04:08:31', '2026-05-08 04:08:31'),
(2, 1, '2026-05-08', 12, 1, '2026-05-08 04:28:43', '2026-05-08 04:28:43'),
(3, 7, '2026-05-09', 12, 1, '2026-05-09 12:45:52', '2026-05-09 12:45:52'),
(4, 1, '2026-05-10', 12, 1, '2026-05-10 05:38:56', '2026-05-10 05:38:56');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_images`
--

CREATE TABLE `gallery_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'Gallery',
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery_images`
--

INSERT INTO `gallery_images` (`id`, `name`, `img_path`, `caption`, `category`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Purple Energy', 'extra_gallery/BTS.jfif', 'Group energy for the hero mood.', 'Group', 1, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(2, 'Meme Museum', 'extra_gallery/HAHAHA.jfif', 'Because BTS funny moments deserve a museum wing.', 'Meme', 2, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(3, 'Run Era Mood', 'extra_gallery/run.jfif', 'High-energy era card.', 'Era', 3, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(4, 'Life Goes On Comfort', 'extra_gallery/lifeGoesOn.jfif', 'Soft comfort energy.', 'Era', 4, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(5, 'Taekook Moment', 'extra_gallery/taekook.jfif', 'Friendship member moment.', 'Members', 5, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(6, 'Jimin Smile', 'extra_gallery/jiminSmile.jfif', 'Soft gallery highlight.', 'Members', 6, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(7, 'Jin Smile', 'extra_gallery/jinSmile.jfif', 'Worldwide handsome gallery highlight.', 'Members', 7, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(8, 'SUGA Mood', 'extra_gallery/suga.jfif', 'Calm but powerful.', 'Members', 8, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `learning_lessons`
--

CREATE TABLE `learning_lessons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'BTS 101',
  `excerpt` varchar(500) DEFAULT NULL,
  `body` longtext DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `reward_points` bigint(20) UNSIGNED NOT NULL DEFAULT 30,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `learning_lessons`
--

INSERT INTO `learning_lessons` (`id`, `slug`, `title`, `category`, `excerpt`, `body`, `image_path`, `reward_points`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'bts-origin-story', 'BTS Origin Story', 'BTS 101', 'Learn how BTS started, what their early identity was, and why their message felt different.', 'BTS debuted in 2013 with a hip-hop-heavy identity and a message focused on young people, pressure, dreams, and self-expression.\n\nTheir early school trilogy was not just about looking cool. It questioned expectations and gave fans lyrics that felt direct. This is why the website teaches the story first: BTS is easier to understand when you see the message behind the eras.\n\nKey idea: BTS grew because music, performance, personality, and ARMY connection all worked together.', NULL, 30, 1, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(2, 'members-and-roles', 'Members and Roles', 'Member Vaults', 'A simple guide to the seven members, their broad roles, and the energy each one brings.', 'BTS has seven members: RM, Jin, SUGA, j-hope, Jimin, V, and Jung Kook.\n\nRM is the leader and rapper. Jin brings vocals, humor, and comfort. SUGA is a rapper and producer. j-hope is a dancer, rapper, and performance leader. Jimin brings vocals and dance with graceful detail. V brings deep vocals and cinematic mood. Jung Kook is the main vocalist and all-rounder.\n\nThe member vault pages are built so each profile feels personal instead of being just a boring card.', NULL, 30, 2, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(3, 'bt21-anatomy', 'BT21 Character Anatomy', 'BT21', 'Learn what BT21 means on this site and why each character has its own animated profile zone.', 'BT21 is treated as its own colorful side quest in this final project. Instead of linking back to member vaults, the BT21 page has character anatomy notes, fun powers, and animated cards.\n\nKOYA, RJ, SHOOKY, MANG, CHIMMY, TATA, and COOKY each get a playful identity. This keeps the BTS member profiles serious and detailed while letting BT21 stay cute, bright, and chaotic.', NULL, 30, 3, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `learning_materials`
--

CREATE TABLE `learning_materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'BTS 101',
  `topic_type` varchar(255) NOT NULL DEFAULT 'Article',
  `difficulty` varchar(255) DEFAULT NULL,
  `excerpt` varchar(600) DEFAULT NULL,
  `body` longtext DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `gallery_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gallery_images`)),
  `video_poster` varchar(1000) DEFAULT NULL,
  `official_url` varchar(1000) DEFAULT NULL,
  `youtube_url` varchar(1000) DEFAULT NULL,
  `source_label` varchar(255) DEFAULT NULL,
  `links` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`links`)),
  `fun_facts` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`fun_facts`)),
  `history_notes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`history_notes`)),
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `learning_materials`
--

INSERT INTO `learning_materials` (`id`, `slug`, `title`, `category`, `topic_type`, `difficulty`, `excerpt`, `body`, `image_path`, `gallery_images`, `video_poster`, `official_url`, `youtube_url`, `source_label`, `links`, `fun_facts`, `history_notes`, `sort_order`, `is_featured`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'bts-101-official-start-here', 'BTS 101: Start Here', 'BTS 101', 'Guide', 'Beginner', 'A clean starter guide for new ARMY: who BTS are, why they matter, and where to watch official content.', 'BTS, also known as Bangtan Sonyeondan, are a seven-member group from South Korea.\n\nUse this page as a starter map: learn the members, check official channels, watch the MVs, then try the quizzes separately in the Quiz Arena.\n\nFor a real fan site, always guide users back to official sources so streams, views, and support go to BTS directly.', 'imgs/learn/bts-101-official-start-here/cover.jpg', NULL, NULL, 'https://ibighit.com/bts/eng/', 'https://www.youtube.com/@BTS', 'Official BTS site + BANGTANTV', '[{\"label\":\"Official BTS Website\",\"url\":\"https:\\/\\/ibighit.com\\/bts\\/eng\\/\",\"type\":\"Official\"},{\"label\":\"BANGTANTV YouTube\",\"url\":\"https:\\/\\/www.youtube.com\\/@BTS\",\"type\":\"Official YouTube\"},{\"label\":\"HYBE LABELS YouTube\",\"url\":\"https:\\/\\/www.youtube.com\\/@HYBELABELS\",\"type\":\"Official YouTube\"}]', NULL, NULL, 1, 1, 1, '2026-05-10 08:45:23', '2026-05-10 08:45:23'),
(2, 'members-and-bt21-map', 'Members + BT21 Map', 'Members', 'Guide', 'Beginner', 'A quick guide connecting the seven members with their roles, charms, and BT21 characters.', 'This topic helps users understand the difference between BTS member profiles and BT21 character pages.\n\nMember pages should feel emotional and story-based. BT21 pages should feel colorful, playful, animated, and character-anatomy focused.', 'imgs/learn/members-and-bt21-map/cover.jpg', NULL, NULL, 'https://www.bt21.com/', 'https://www.youtube.com/@BT21_official', 'BT21 Official', '[{\"label\":\"BT21 Official Website\",\"url\":\"https:\\/\\/www.bt21.com\\/\",\"type\":\"Official\"},{\"label\":\"BT21 Official YouTube\",\"url\":\"https:\\/\\/www.youtube.com\\/@BT21_official\",\"type\":\"Official YouTube\"}]', NULL, NULL, 2, 1, 1, '2026-05-10 08:45:23', '2026-05-10 08:45:23'),
(3, 'spring-day-mv-study', 'MV Study: Spring Day', 'Music Videos', 'MV Study', 'Intermediate', 'Watch the official MV, then learn the themes, visuals, and emotional meaning fans connect with Spring Day.', 'Spring Day is one of BTS’s most emotional songs. A learning material like this can include: release context, lyrics themes, visual motifs, fan interpretations, and official links.\n\nKeep the quiz separate. This page is for learning, watching, reading, and saving useful links.', 'imgs/learn/spring-day-mv-study/cover.jpg', NULL, NULL, 'https://ibighit.com/bts/eng/discography/detail/you_never_walk_alone.html', 'https://www.youtube.com/watch?v=xEeFrLSkMm8', 'Official MV', '[{\"label\":\"Spring Day Official MV\",\"url\":\"https:\\/\\/www.youtube.com\\/watch?v=xEeFrLSkMm8\",\"type\":\"Official MV\"},{\"label\":\"You Never Walk Alone Discography\",\"url\":\"https:\\/\\/ibighit.com\\/bts\\/eng\\/discography\\/detail\\/you_never_walk_alone.html\",\"type\":\"Official\"}]', NULL, NULL, 3, 1, 1, '2026-05-10 08:45:23', '2026-05-10 08:45:23'),
(4, 'dynamite-mv-study', 'MV Study: Dynamite', 'Music Videos', 'MV Study', 'Beginner', 'A bright MV guide for Dynamite with official MV link, comeback energy, styling notes, and quiz prep hints.', 'Dynamite is perfect for a beginner MV study because it is colorful, easy to recognize, and popular with casual listeners too.\n\nUse this page to explain styling, setting, choreography moments, and the feel-good disco-pop concept.', 'imgs/learn/dynamite-mv-study/cover.jpg', NULL, NULL, 'https://ibighit.com/bts/eng/discography/detail/dynamite.html', 'https://www.youtube.com/watch?v=gdZLi9oWNZg', 'Official MV', '[{\"label\":\"Dynamite Official MV\",\"url\":\"https:\\/\\/www.youtube.com\\/watch?v=gdZLi9oWNZg\",\"type\":\"Official MV\"},{\"label\":\"Dynamite Discography\",\"url\":\"https:\\/\\/ibighit.com\\/bts\\/eng\\/discography\\/detail\\/dynamite.html\",\"type\":\"Official\"}]', NULL, NULL, 4, 0, 1, '2026-05-10 08:45:23', '2026-05-10 08:45:23'),
(5, 'army-terms-and-fandom-culture', 'ARMY Terms + Fandom Culture', 'ARMY Culture', 'Glossary', 'Beginner', 'A friendly glossary for new users: bias, comeback, era, streaming, purple, borahae, and more.', 'This page can become a full glossary. Keep it helpful, warm, and beginner-friendly so new ARMY do not feel lost.\n\nAdmin can keep adding terms and links as the website grows.', 'imgs/learn/army-terms-and-fandom-culture/cover.jpg', NULL, NULL, 'https://weverse.io/bts/feed', 'https://www.youtube.com/@BTS', 'Official community + videos', '[{\"label\":\"BTS on Weverse\",\"url\":\"https:\\/\\/weverse.io\\/bts\\/feed\",\"type\":\"Official Community\"},{\"label\":\"BANGTANTV\",\"url\":\"https:\\/\\/www.youtube.com\\/@BTS\",\"type\":\"Official YouTube\"}]', NULL, NULL, 5, 0, 1, '2026-05-10 08:45:23', '2026-05-10 08:45:23');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `stage_name` varchar(255) DEFAULT NULL,
  `korean_name` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `birthplace` varchar(255) DEFAULT NULL,
  `emoji` varchar(20) DEFAULT NULL,
  `accent_color` varchar(30) DEFAULT NULL,
  `bt21_character` varchar(255) DEFAULT NULL,
  `intro_title` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `quote` varchar(255) DEFAULT NULL,
  `profile_story` longtext DEFAULT NULL,
  `fun_facts` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`fun_facts`)),
  `skill_tags` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`skill_tags`)),
  `spotify_url` varchar(1000) DEFAULT NULL,
  `instagram_url` varchar(1000) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `slug`, `name`, `stage_name`, `korean_name`, `birth_date`, `birthplace`, `emoji`, `accent_color`, `bt21_character`, `intro_title`, `role`, `image`, `quote`, `profile_story`, `fun_facts`, `skill_tags`, `spotify_url`, `instagram_url`, `nickname`, `favicon`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'rm', 'Kim Namjoon', 'RM', 'Kim Namjoon', '1994-09-12', 'Ilsan/Goyang, South Korea', NULL, '#7c3aed', 'KOYA', 'The thoughtful leader who turns chaos into poetry.', 'Leader · Rapper · Lyricist', 'rm.jfif', 'A calm brain, a giant heart, and words that feel like a deep purple sky.', 'RM is the leader and one of the strongest creative voices behind BTS. His vault focuses on leadership, lyrics, art energy, and reflective comfort.', '[\"Known for thoughtful speeches and interviews.\", \"Loves museums, books, nature, and art spaces.\", \"Represents the soft-intellectual side of BTS energy.\"]', '[\"Leadership\", \"Rap\", \"Lyrics\", \"Art lover\", \"English speaker\"]', NULL, NULL, 'RM', 'KOYA.png', 1, 1, '2026-05-08 12:00:00', '2026-05-08 04:23:36'),
(2, 'jin', 'Kim Seokjin', 'Jin', 'Kim Seokjin', '1992-12-04', 'Gwacheon, South Korea', NULL, '#ec4899', 'RJ', 'The worldwide handsome mood-maker with silver vocals.', 'Vocalist · Visual · Worldwide Handsome', 'jin.jfif', 'A vocal prince with dad jokes, elegance, and full chaos mode unlocked.', 'Jin brings warmth, humor, confidence, and emotional vocals. His vault feels wholesome, royal, funny, and secretly powerful.', '[\"Known for Worldwide Handsome energy.\", \"Often brings comfort through emotional solo songs.\", \"Can turn any serious moment into a legendary meme.\"]', '[\"Vocal\", \"Visual\", \"Variety\", \"Confidence\", \"Humor\"]', NULL, NULL, 'Jin', 'RJ.png', 2, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(3, 'suga', 'Min Yoongi', 'SUGA', 'Min Yoongi', '1993-03-09', 'Daegu, South Korea', NULL, '#64748b', 'SHOOKY', 'The quiet producer with savage lyrics and soft-core honesty.', 'Rapper · Producer · Songwriter', 'suga.jfif', 'Calm outside, thunder in the studio, comfort in the lyrics.', 'SUGA is the production brain, sharp rapper, and emotional storyteller. His page is moody, cinematic, and honest.', '[\"Known for direct, honest writing.\", \"Has a strong producer identity beyond performance.\", \"His calm vibe is half sleepy cat, half studio monster.\"]', '[\"Rap\", \"Production\", \"Piano\", \"Songwriting\", \"Agust D\"]', NULL, NULL, 'Suga', 'SHOOKY.png', 3, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(4, 'jhope', 'Jung Hoseok', 'j-hope', 'Jung Hoseok', '1994-02-18', 'Gwangju, South Korea', NULL, '#f59e0b', 'MANG', 'The sunshine engine who turns practice into fireworks.', 'Rapper · Main Dancer · Performance Leader', 'jhope.jfif', 'Bright smile, beast-mode dance lines, and stage energy that wakes the planet.', 'j-hope is movement, precision, and joy. His vault feels like stage lights switching on: dance practice, sunshine, rap flow, and motivation.', '[\"Known for powerful dance leadership.\", \"Brings bright energy with serious discipline.\", \"His stage presence can flip a whole room instantly.\"]', '[\"Dance\", \"Rap\", \"Performance\", \"Choreography\", \"Energy\"]', NULL, NULL, 'Hobi', 'MANG.png', 4, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(5, 'jimin', 'Park Jimin', 'Jimin', 'Park Jimin', '1995-10-13', 'Busan, South Korea', NULL, '#a855f7', 'CHIMMY', 'The graceful performer with angel vocals and lethal duality.', 'Vocalist · Dancer', 'jimin.jfif', 'Soft voice, sharp movement, and stage duality that should honestly be illegal.', 'Jimin brings elegance, emotion, and powerful dance detail. His vault feels delicate and dramatic at the same time.', '[\"Known for expressive dance lines.\", \"Balances softness and intensity on stage.\", \"Has one of the most recognizable performance auras in BTS.\"]', '[\"Dance\", \"Vocal\", \"Performance\", \"Duality\", \"Contemporary\"]', NULL, NULL, 'Jimin', 'CHIMMY.png', 5, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(6, 'v', 'Kim Taehyung', 'V', 'Kim Taehyung', '1995-12-30', 'Daegu, South Korea', NULL, '#14b8a6', 'TATA', 'The velvet-voiced art prince with cinematic energy.', 'Vocalist · Visual · Actor', 'v.jfif', 'Jazz soul, deep voice, model aura, and facial expressions that tell whole stories.', 'V brings color, mood, and a film-like presence. His vault feels like vintage jazz, fashion editorials, soft photography, and mysterious charisma.', '[\"Known for a deep, warm vocal color.\", \"Loves art, photography, jazz, and classic aesthetics.\", \"His expressions can change a whole stage mood.\"]', '[\"Vocal\", \"Jazz tone\", \"Visual\", \"Acting\", \"Fashion\"]', NULL, NULL, 'V', 'TATA.png', 6, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(7, 'jungkook', 'Jeon Jungkook', 'Jung Kook', 'Jeon Jungkook', '1997-09-01', 'Busan, South Korea', NULL, '#22c55e', 'COOKY', 'The golden maknae built like a final boss character.', 'Main Vocalist · Performer · Golden Maknae', 'jk.jfif', 'Vocals, dance, sports, art, chaos — bro downloaded the all-rounder expansion pack.', 'Jung Kook is the powerhouse all-rounder: vocals, dance, performance, athletic energy, and playful maknae chaos.', '[\"Known as the Golden Maknae.\", \"Has strong vocals and sharp stage focus.\", \"Somehow manages to be both chaotic and perfectionist.\"]', '[\"Vocal\", \"Dance\", \"Performance\", \"Sports\", \"Golden Maknae\"]', NULL, NULL, 'JK', 'COOKY.png', 7, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

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
(12, '2026_05_08_130000_create_bt21_characters_table', 2),
(13, '2026_05_09_203738_update_profile_assets_table', 3),
(14, '2026_05_09_204648_add_bundle_fields_to_profile_assets', 3),
(15, '2026_05_09_192315_add_image_path_to_assets_table', 4),
(16, '2026_05_10_090000_expand_user_points_columns', 5),
(17, '2026_05_10_100000_split_learning_and_quizzes', 5);

-- --------------------------------------------------------

--
-- Table structure for table `nav_items`
--

CREATE TABLE `nav_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nav_items`
--

INSERT INTO `nav_items` (`id`, `label`, `url`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Home', '/', 1, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(2, 'Members', '/#members', 2, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(3, 'Learn', '/learn', 3, 1, '2026-05-10 08:44:31', '2026-05-10 08:44:31'),
(4, 'Timeline', '/bts-achievements', 5, 1, '2026-05-08 12:00:00', '2026-05-10 09:49:33'),
(5, 'Songs', '/songs', 6, 1, '2026-05-08 12:00:00', '2026-05-10 09:49:22'),
(6, 'Gallery', '/gallery', 7, 1, '2026-05-08 12:00:00', '2026-05-10 09:49:18'),
(7, 'Quotes', '/quotes', 8, 1, '2026-05-08 12:00:00', '2026-05-10 09:49:15'),
(8, 'BT21', '/bt21', 9, 1, '2026-05-08 12:00:00', '2026-05-10 09:49:11'),
(9, 'Leaderboard', '/leaderboard', 10, 1, '2026-05-08 12:00:00', '2026-05-10 09:49:07'),
(10, 'Vote', '/vote', 11, 1, '2026-05-08 12:00:00', '2026-05-10 09:48:59'),
(11, 'Quizzes', '/quizzes', 4, 1, '2026-05-10 08:44:31', '2026-05-10 08:44:31');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `point_transactions`
--

CREATE TABLE `point_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'earn',
  `points` bigint(20) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `point_transactions`
--

INSERT INTO `point_transactions` (`id`, `user_id`, `type`, `points`, `reason`, `meta`, `created_at`, `updated_at`) VALUES
(5, 6, 'earn', 50, 'Welcome bonus', '{\"source\":\"registration\"}', '2026-05-08 04:02:54', '2026-05-08 04:02:54'),
(6, 6, 'earn', 12, 'Daily streak check-in', '{\"streak_days\":1}', '2026-05-08 04:08:31', '2026-05-08 04:08:31'),
(7, 1, 'earn', 12, 'Daily streak check-in', '{\"streak_days\":1}', '2026-05-08 04:28:43', '2026-05-08 04:28:43'),
(8, 1, 'earn', 30, 'Quiz reward: BTS Origin Story', '{\"lesson_slug\":\"bts-origin-story\",\"attempt_id\":1}', '2026-05-08 04:30:04', '2026-05-08 04:30:04'),
(9, 7, 'earn', 50, 'Welcome bonus', '{\"source\":\"registration\"}', '2026-05-09 12:45:33', '2026-05-09 12:45:33'),
(10, 7, 'earn', 12, 'Daily streak check-in', '{\"streak_days\":1}', '2026-05-09 12:45:53', '2026-05-09 12:45:53'),
(11, 7, 'earn', 30, 'Quiz reward: BTS Origin Story', '{\"lesson_slug\":\"bts-origin-story\",\"attempt_id\":2}', '2026-05-09 12:48:08', '2026-05-09 12:48:08'),
(12, 7, 'spend', -80, 'Unlocked profile upgrade: Night Black Theme', '{\"asset_key\":\"night-black\"}', '2026-05-09 12:48:32', '2026-05-09 12:48:32'),
(13, 7, 'earn', 20, 'Quiz reward: Members and Roles', '{\"lesson_slug\":\"members-and-roles\",\"attempt_id\":3}', '2026-05-09 13:28:13', '2026-05-09 13:28:13'),
(14, 7, 'earn', 20, 'Quiz reward: Members and Roles', '{\"lesson_slug\":\"members-and-roles\",\"attempt_id\":4}', '2026-05-09 13:28:45', '2026-05-09 13:28:45'),
(15, 7, 'earn', 30, 'Quiz reward: Members and Roles', '{\"lesson_slug\":\"members-and-roles\",\"attempt_id\":5}', '2026-05-09 13:29:04', '2026-05-09 13:29:04'),
(16, 7, 'earn', 30, 'Quiz reward: Members and Roles', '{\"lesson_slug\":\"members-and-roles\",\"attempt_id\":6}', '2026-05-09 13:29:20', '2026-05-09 13:29:20'),
(17, 7, 'earn', 30, 'Quiz reward: Members and Roles', '{\"lesson_slug\":\"members-and-roles\",\"attempt_id\":7}', '2026-05-09 13:29:49', '2026-05-09 13:29:49'),
(18, 7, 'spend', -90, 'Unlocked profile upgrade: BT21 Spark Badge', '{\"asset_key\":\"bt21-spark\"}', '2026-05-09 13:30:12', '2026-05-09 13:30:12'),
(19, 7, 'earn', 30, 'Quiz reward: Members and Roles', '{\"lesson_slug\":\"members-and-roles\",\"attempt_id\":8}', '2026-05-09 13:31:39', '2026-05-09 13:31:39'),
(20, 7, 'earn', 30, 'Quiz reward: Members and Roles', '{\"lesson_slug\":\"members-and-roles\",\"attempt_id\":9}', '2026-05-09 13:31:52', '2026-05-09 13:31:52'),
(21, 7, 'earn', 30, 'Quiz reward: Members and Roles', '{\"lesson_slug\":\"members-and-roles\",\"attempt_id\":10}', '2026-05-09 13:32:05', '2026-05-09 13:32:05'),
(22, 7, 'earn', 20, 'Quiz reward: Members and Roles', '{\"lesson_slug\":\"members-and-roles\",\"attempt_id\":11}', '2026-05-09 13:32:18', '2026-05-09 13:32:18'),
(23, 7, 'earn', 20, 'Quiz reward: Members and Roles', '{\"lesson_slug\":\"members-and-roles\",\"attempt_id\":12}', '2026-05-09 13:32:30', '2026-05-09 13:32:30'),
(24, 7, 'earn', 20, 'Quiz reward: Members and Roles', '{\"lesson_slug\":\"members-and-roles\",\"attempt_id\":13}', '2026-05-09 13:32:41', '2026-05-09 13:32:41'),
(25, 7, 'earn', 20, 'Quiz reward: Members and Roles', '{\"lesson_slug\":\"members-and-roles\",\"attempt_id\":14}', '2026-05-09 13:32:55', '2026-05-09 13:32:55'),
(26, 7, 'spend', -120, 'Unlocked profile upgrade: Galaxy Stage Theme', '{\"asset_key\":\"galaxy-stage\"}', '2026-05-09 16:29:40', '2026-05-09 16:29:40'),
(27, 7, 'spend', -100, 'Unlocked profile upgrade: BT21 CHIMMY Avatar', '{\"asset_key\":\"chimmy-avatar\"}', '2026-05-09 17:09:44', '2026-05-09 17:09:44'),
(28, 1, 'earn', 12, 'Daily streak check-in', '{\"streak_days\":1}', '2026-05-10 05:39:01', '2026-05-10 05:39:01'),
(29, 7, 'spend', -100, 'Unlocked profile upgrade: BT21 KOYA Avatar', '{\"asset_key\":\"koya-avatar\"}', '2026-05-10 10:19:59', '2026-05-10 10:19:59'),
(30, 7, 'spend', -180, 'Unlocked profile upgrade: BT21 CHIMMY Bundle', '{\"asset_key\":\"chimmy-bundle\"}', '2026-05-10 10:20:04', '2026-05-10 10:20:04'),
(31, 7, 'spend', -120, 'Unlocked profile upgrade: BT21 TATA Theme', '{\"asset_key\":\"tata-theme\"}', '2026-05-10 10:20:07', '2026-05-10 10:20:07'),
(32, 7, 'spend', -100, 'Unlocked profile upgrade: BT21 SHOOKY Avatar', '{\"asset_key\":\"shooky-avatar\"}', '2026-05-10 10:20:10', '2026-05-10 10:20:10'),
(33, 7, 'spend', -100, 'Unlocked profile upgrade: BT21 MANG Avatar', '{\"asset_key\":\"mang-avatar\"}', '2026-05-10 10:20:13', '2026-05-10 10:20:13'),
(34, 7, 'spend', -100, 'Unlocked profile upgrade: BT21 RJ Avatar', '{\"asset_key\":\"rj-avatar\"}', '2026-05-10 10:20:17', '2026-05-10 10:20:17'),
(35, 7, 'spend', -100, 'Unlocked profile upgrade: BT21 TATA Avatar', '{\"asset_key\":\"tata-avatar\"}', '2026-05-10 10:20:36', '2026-05-10 10:20:36'),
(36, 7, 'spend', -180, 'Unlocked profile upgrade: BT21 MANG Bundle', '{\"asset_key\":\"mang-bundle\"}', '2026-05-10 10:20:40', '2026-05-10 10:20:40'),
(37, 7, 'spend', -180, 'Unlocked profile upgrade: BT21 RJ Bundle', '{\"asset_key\":\"rj-bundle\"}', '2026-05-10 10:20:44', '2026-05-10 10:20:44'),
(38, 7, 'spend', -120, 'Unlocked profile upgrade: BT21 KOYA Theme', '{\"asset_key\":\"koya-theme\"}', '2026-05-10 10:21:13', '2026-05-10 10:21:13'),
(39, 7, 'spend', -180, 'Unlocked profile upgrade: BT21 COOKY Bundle', '{\"asset_key\":\"cooky-bundle\"}', '2026-05-10 10:21:21', '2026-05-10 10:21:21'),
(40, 7, 'spend', -180, 'Unlocked profile upgrade: BT21 TATA Bundle', '{\"asset_key\":\"tata-bundle\"}', '2026-05-10 10:26:01', '2026-05-10 10:26:01'),
(41, 7, 'earn', 100, 'Quiz reward: MV Detective: Round One', '{\"quiz_slug\":\"mv-detective-round-one\",\"attempt_id\":1}', '2026-05-10 10:27:01', '2026-05-10 10:27:01'),
(42, 8, 'earn', 50, 'Welcome bonus', '{\"source\":\"registration\"}', '2026-05-10 10:48:30', '2026-05-10 10:48:30');

-- --------------------------------------------------------

--
-- Table structure for table `profile_assets`
--

CREATE TABLE `profile_assets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'avatar',
  `description` varchar(500) DEFAULT NULL,
  `cost` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `image_path` varchar(255) DEFAULT NULL,
  `gradient` varchar(255) DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar_image` varchar(255) DEFAULT NULL,
  `theme_class` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profile_assets`
--

INSERT INTO `profile_assets` (`id`, `key`, `label`, `type`, `description`, `cost`, `image_path`, `gradient`, `sort_order`, `is_active`, `created_at`, `updated_at`, `avatar_image`, `theme_class`) VALUES
(25, 'purple-heart', 'Purple Heart Starter', 'bundle', 'Default ARMY starter profile bundle.', 0, 'favicons/logo.png', 'linear-gradient(135deg,#581c87,#a855f7,#111827)', 1, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', 'favicons/logo.png', 'purple-heart-theme'),
(26, 'chimmy-avatar', 'BT21 CHIMMY Avatar', 'avatar', 'CUTE CHIMMY ENERGY 😭💛', 100, 'favicons/CHIMMY.png', NULL, 2, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', NULL, NULL),
(27, 'chimmy-theme', 'BT21 CHIMMY Theme', 'theme', 'Yellow cozy CHIMMY vibes.', 120, NULL, 'linear-gradient(135deg,#facc15,#fde68a,#78350f)', 3, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', NULL, 'chimmy-theme'),
(28, 'chimmy-bundle', 'BT21 CHIMMY Bundle', 'bundle', 'Full CHIMMY profile pack.', 180, 'favicons/CHIMMY.png', 'linear-gradient(135deg,#facc15,#fde68a,#78350f)', 4, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', 'favicons/CHIMMY.png', 'chimmy-theme'),
(29, 'tata-avatar', 'BT21 TATA Avatar', 'avatar', 'TATA chaotic energy.', 100, 'favicons/TATA.png', NULL, 5, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', NULL, NULL),
(30, 'tata-theme', 'BT21 TATA Theme', 'theme', 'Red cosmic TATA vibes.', 120, NULL, 'linear-gradient(135deg,#ef4444,#7f1d1d,#111827)', 6, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', NULL, 'tata-theme'),
(31, 'tata-bundle', 'BT21 TATA Bundle', 'bundle', 'Full TATA profile pack.', 180, 'favicons/TATA.png', 'linear-gradient(135deg,#ef4444,#7f1d1d,#111827)', 7, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', 'favicons/TATA.png', 'tata-theme'),
(32, 'koya-avatar', 'BT21 KOYA Avatar', 'avatar', 'Sleepy KOYA vibes.', 100, 'favicons/KOYA.png', NULL, 8, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', NULL, NULL),
(33, 'koya-theme', 'BT21 KOYA Theme', 'theme', 'Dreamy blue KOYA galaxy.', 120, NULL, 'linear-gradient(135deg,#60a5fa,#1e3a8a,#111827)', 9, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', NULL, 'koya-theme'),
(34, 'koya-bundle', 'BT21 KOYA Bundle', 'bundle', 'Full KOYA profile pack.', 180, 'favicons/KOYA.png', 'linear-gradient(135deg,#60a5fa,#1e3a8a,#111827)', 10, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', 'favicons/KOYA.png', 'koya-theme'),
(35, 'rj-avatar', 'BT21 RJ Avatar', 'avatar', 'Soft fluffy RJ vibes.', 100, 'favicons/RJ.png', NULL, 11, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', NULL, NULL),
(36, 'rj-bundle', 'BT21 RJ Bundle', 'bundle', 'Full RJ profile pack.', 180, 'favicons/RJ.png', 'linear-gradient(135deg,#f8fafc,#d1d5db,#6b7280)', 12, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', 'favicons/RJ.png', 'rj-theme'),
(37, 'shooky-avatar', 'BT21 SHOOKY Avatar', 'avatar', 'Sassy SHOOKY chaos.', 100, 'favicons/SHOOKY.png', NULL, 13, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', NULL, NULL),
(38, 'shooky-bundle', 'BT21 SHOOKY Bundle', 'bundle', 'Full SHOOKY profile pack.', 180, 'favicons/SHOOKY.png', 'linear-gradient(135deg,#92400e,#451a03,#111827)', 14, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', 'favicons/SHOOKY.png', 'shooky-theme'),
(39, 'cooky-avatar', 'BT21 COOKY Avatar', 'avatar', 'Buff pink bunny energy.', 100, 'favicons/COOKY.png', NULL, 15, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', NULL, NULL),
(40, 'cooky-bundle', 'BT21 COOKY Bundle', 'bundle', 'Full COOKY profile pack.', 180, 'favicons/COOKY.png', 'linear-gradient(135deg,#f472b6,#831843,#111827)', 16, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', 'favicons/COOKY.png', 'cooky-theme'),
(41, 'mang-avatar', 'BT21 MANG Avatar', 'avatar', 'Mysterious dance horse vibes.', 100, 'favicons/MANG.png', NULL, 17, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', NULL, NULL),
(42, 'mang-bundle', 'BT21 MANG Bundle', 'bundle', 'Full MANG profile pack.', 180, 'favicons/MANG.png', 'linear-gradient(135deg,#a855f7,#312e81,#111827)', 18, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', 'favicons/MANG.png', 'mang-theme');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_attempts`
--

CREATE TABLE `quiz_attempts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `learning_lesson_id` bigint(20) UNSIGNED NOT NULL,
  `score` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `total` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `points_earned` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `answers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`answers`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quiz_attempts`
--

INSERT INTO `quiz_attempts` (`id`, `user_id`, `learning_lesson_id`, `score`, `total`, `points_earned`, `answers`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, 3, 30, '{\"1\":{\"picked\":1,\"correct_option\":1,\"correct\":true},\"2\":{\"picked\":0,\"correct_option\":0,\"correct\":true},\"3\":{\"picked\":1,\"correct_option\":1,\"correct\":true}}', '2026-05-08 04:30:04', '2026-05-08 04:30:04'),
(2, 7, 1, 3, 3, 30, '{\"1\":{\"picked\":1,\"correct_option\":1,\"correct\":true},\"2\":{\"picked\":0,\"correct_option\":0,\"correct\":true},\"3\":{\"picked\":1,\"correct_option\":1,\"correct\":true}}', '2026-05-09 12:48:08', '2026-05-09 12:48:08'),
(3, 7, 2, 2, 3, 20, '{\"4\":{\"picked\":1,\"correct_option\":1,\"correct\":true},\"5\":{\"picked\":3,\"correct_option\":0,\"correct\":false},\"6\":{\"picked\":1,\"correct_option\":1,\"correct\":true}}', '2026-05-09 13:28:12', '2026-05-09 13:28:12'),
(4, 7, 2, 2, 3, 20, '{\"4\":{\"picked\":1,\"correct_option\":1,\"correct\":true},\"5\":{\"picked\":2,\"correct_option\":0,\"correct\":false},\"6\":{\"picked\":1,\"correct_option\":1,\"correct\":true}}', '2026-05-09 13:28:45', '2026-05-09 13:28:45'),
(5, 7, 2, 3, 3, 30, '{\"4\":{\"picked\":1,\"correct_option\":1,\"correct\":true},\"5\":{\"picked\":0,\"correct_option\":0,\"correct\":true},\"6\":{\"picked\":1,\"correct_option\":1,\"correct\":true}}', '2026-05-09 13:29:04', '2026-05-09 13:29:04'),
(6, 7, 2, 3, 3, 30, '{\"4\":{\"picked\":1,\"correct_option\":1,\"correct\":true},\"5\":{\"picked\":0,\"correct_option\":0,\"correct\":true},\"6\":{\"picked\":1,\"correct_option\":1,\"correct\":true}}', '2026-05-09 13:29:20', '2026-05-09 13:29:20'),
(7, 7, 2, 3, 3, 30, '{\"4\":{\"picked\":1,\"correct_option\":1,\"correct\":true},\"5\":{\"picked\":0,\"correct_option\":0,\"correct\":true},\"6\":{\"picked\":1,\"correct_option\":1,\"correct\":true}}', '2026-05-09 13:29:49', '2026-05-09 13:29:49'),
(8, 7, 2, 3, 3, 30, '{\"4\":{\"picked\":1,\"correct_option\":1,\"correct\":true},\"5\":{\"picked\":0,\"correct_option\":0,\"correct\":true},\"6\":{\"picked\":1,\"correct_option\":1,\"correct\":true}}', '2026-05-09 13:31:39', '2026-05-09 13:31:39'),
(9, 7, 2, 3, 3, 30, '{\"4\":{\"picked\":1,\"correct_option\":1,\"correct\":true},\"5\":{\"picked\":0,\"correct_option\":0,\"correct\":true},\"6\":{\"picked\":1,\"correct_option\":1,\"correct\":true}}', '2026-05-09 13:31:51', '2026-05-09 13:31:51'),
(10, 7, 2, 3, 3, 30, '{\"4\":{\"picked\":1,\"correct_option\":1,\"correct\":true},\"5\":{\"picked\":0,\"correct_option\":0,\"correct\":true},\"6\":{\"picked\":1,\"correct_option\":1,\"correct\":true}}', '2026-05-09 13:32:05', '2026-05-09 13:32:05'),
(11, 7, 2, 2, 3, 20, '{\"4\":{\"picked\":1,\"correct_option\":1,\"correct\":true},\"5\":{\"picked\":0,\"correct_option\":0,\"correct\":true},\"6\":{\"picked\":2,\"correct_option\":1,\"correct\":false}}', '2026-05-09 13:32:18', '2026-05-09 13:32:18'),
(12, 7, 2, 2, 3, 20, '{\"4\":{\"picked\":1,\"correct_option\":1,\"correct\":true},\"5\":{\"picked\":0,\"correct_option\":0,\"correct\":true},\"6\":{\"picked\":2,\"correct_option\":1,\"correct\":false}}', '2026-05-09 13:32:29', '2026-05-09 13:32:29'),
(13, 7, 2, 2, 3, 20, '{\"4\":{\"picked\":1,\"correct_option\":1,\"correct\":true},\"5\":{\"picked\":0,\"correct_option\":0,\"correct\":true},\"6\":{\"picked\":2,\"correct_option\":1,\"correct\":false}}', '2026-05-09 13:32:41', '2026-05-09 13:32:41'),
(14, 7, 2, 2, 3, 20, '{\"4\":{\"picked\":1,\"correct_option\":1,\"correct\":true},\"5\":{\"picked\":0,\"correct_option\":0,\"correct\":true},\"6\":{\"picked\":2,\"correct_option\":1,\"correct\":false}}', '2026-05-09 13:32:55', '2026-05-09 13:32:55');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_games`
--

CREATE TABLE `quiz_games` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'BTS 101',
  `difficulty` varchar(255) NOT NULL DEFAULT 'easy',
  `description` varchar(1000) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `time_limit_seconds` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `points_per_question` bigint(20) UNSIGNED NOT NULL DEFAULT 10,
  `bonus_points` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quiz_games`
--

INSERT INTO `quiz_games` (`id`, `slug`, `title`, `category`, `difficulty`, `description`, `cover_image`, `time_limit_seconds`, `points_per_question`, `bonus_points`, `sort_order`, `is_featured`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'bts-101-rookie-army', 'BTS 101: Rookie ARMY', 'BTS 101', 'easy', 'Quick starter quiz for new ARMY. Simple, cute, and point-friendly.', 'imgs/btsssss.jfif', 0, 10, 20, 1, 1, 1, '2026-05-10 08:45:23', '2026-05-10 08:45:23'),
(2, 'mv-detective-round-one', 'MV Detective: Round One', 'Music Videos', 'medium', 'Spot the MV, era, and concept clues. More points, more drama.', 'imgs/songs/dna.jfif', 0, 20, 40, 2, 1, 1, '2026-05-10 08:45:23', '2026-05-10 08:45:23'),
(3, 'borahae-legend-mode', 'Borahae Legend Mode', 'ARMY Culture', 'hard', 'Harder ARMY culture questions for users who want serious leaderboard energy.', 'imgs/bts-crowd.jfif', 0, 35, 80, 3, 0, 1, '2026-05-10 08:45:23', '2026-05-10 08:45:23');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_game_attempts`
--

CREATE TABLE `quiz_game_attempts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `quiz_game_id` bigint(20) UNSIGNED NOT NULL,
  `score` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `total` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `points_earned` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `accuracy` decimal(5,2) NOT NULL DEFAULT 0.00,
  `answers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`answers`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quiz_game_attempts`
--

INSERT INTO `quiz_game_attempts` (`id`, `user_id`, `quiz_game_id`, `score`, `total`, `points_earned`, `accuracy`, `answers`, `created_at`, `updated_at`) VALUES
(1, 7, 2, 3, 3, 100, 100.00, '{\"4\":{\"picked\":1,\"correct_option\":1,\"correct\":true},\"5\":{\"picked\":0,\"correct_option\":0,\"correct\":true},\"6\":{\"picked\":1,\"correct_option\":1,\"correct\":true}}', '2026-05-10 10:27:01', '2026-05-10 10:27:01');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_game_questions`
--

CREATE TABLE `quiz_game_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quiz_game_id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(1000) NOT NULL,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`options`)),
  `correct_option` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `explanation` text DEFAULT NULL,
  `points` bigint(20) UNSIGNED NOT NULL DEFAULT 10,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quiz_game_questions`
--

INSERT INTO `quiz_game_questions` (`id`, `quiz_game_id`, `question`, `options`, `correct_option`, `explanation`, `points`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'What does BTS also stand for?', '[\"Bangtan Sonyeondan\",\"Big Time Stars\",\"Born To Sing\",\"Bright Team Seoul\"]', 0, 'BTS is also known as Bangtan Sonyeondan.', 10, 1, 1, '2026-05-10 08:45:23', '2026-05-10 08:45:23'),
(2, 1, 'How many members are in BTS?', '[\"5\",\"6\",\"7\",\"8\"]', 2, 'BTS has seven members.', 10, 2, 1, '2026-05-10 08:45:23', '2026-05-10 08:45:23'),
(3, 1, 'What color is strongly connected with ARMY love?', '[\"Blue\",\"Purple\",\"Orange\",\"Green\"]', 1, 'Purple is deeply connected with BTS and ARMY through borahae.', 10, 3, 1, '2026-05-10 08:45:23', '2026-05-10 08:45:23'),
(4, 2, 'Which BTS song is famous for the line “Cause I-I-I’m in the stars tonight”?', '[\"DNA\",\"Dynamite\",\"Black Swan\",\"Fire\"]', 1, 'That line is from Dynamite.', 20, 1, 1, '2026-05-10 08:45:23', '2026-05-10 08:45:23'),
(5, 2, 'Which MV is often connected with emotional longing and winter/spring imagery?', '[\"Spring Day\",\"Idol\",\"Dope\",\"Butter\"]', 0, 'Spring Day is known for emotional imagery and longing.', 20, 2, 1, '2026-05-10 08:45:23', '2026-05-10 08:45:23'),
(6, 2, 'Which song title is also a type of genetic molecule?', '[\"Fire\",\"DNA\",\"Save Me\",\"Mic Drop\"]', 1, 'DNA is the correct answer.', 20, 3, 1, '2026-05-10 08:45:23', '2026-05-10 08:45:23'),
(7, 3, 'What does “bias” usually mean in K-pop fandom language?', '[\"Favorite member\",\"Least favorite song\",\"Stage outfit\",\"Album version\"]', 0, 'A bias is usually your favorite member.', 35, 1, 1, '2026-05-10 08:45:23', '2026-05-10 08:45:23'),
(8, 3, 'What does “comeback” usually refer to?', '[\"A new release\\/promotion period\",\"An old concert only\",\"A fan account\",\"A hairstyle\"]', 0, 'A comeback is a new release and promotional era.', 35, 2, 1, '2026-05-10 08:45:23', '2026-05-10 08:45:23'),
(9, 3, 'Which platform is commonly used for official artist-fan community updates?', '[\"Weverse\",\"Only maps\",\"A calculator app\",\"A weather site\"]', 0, 'Weverse is used for official community updates.', 35, 3, 1, '2026-05-10 08:45:23', '2026-05-10 08:45:23');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `learning_lesson_id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`options`)),
  `correct_option` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `explanation` text DEFAULT NULL,
  `points` bigint(20) UNSIGNED NOT NULL DEFAULT 10,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`id`, `learning_lesson_id`, `question`, `options`, `correct_option`, `explanation`, `points`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Which year did BTS debut?', '[\"2011\", \"2013\", \"2016\", \"2020\"]', 1, 'BTS debuted in 2013.', 10, 1, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(2, 1, 'What was a major theme in early BTS music?', '[\"Youth pressure and dreams\", \"Cooking shows only\", \"Space travel only\", \"Sports commentary\"]', 0, 'Early BTS lyrics often explored youth, pressure, dreams, and identity.', 10, 2, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(3, 1, 'Why is learning the story important?', '[\"It makes quizzes harder only\", \"It helps fans understand the message behind the eras\", \"It replaces the songs\", \"It hides member profiles\"]', 1, 'The story gives meaning to songs, eras, and achievements.', 10, 3, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(4, 2, 'Who is the leader of BTS?', '[\"Jin\", \"RM\", \"Jimin\", \"V\"]', 1, 'RM is the leader.', 10, 1, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(5, 2, 'Which member is often called the Golden Maknae?', '[\"Jung Kook\", \"SUGA\", \"j-hope\", \"Jin\"]', 0, 'Jung Kook is widely known as the Golden Maknae.', 10, 2, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(6, 2, 'Which member is strongly linked with dance leadership and sunshine energy?', '[\"RM\", \"j-hope\", \"V\", \"SUGA\"]', 1, 'j-hope is known for dance, performance, and bright energy.', 10, 3, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(7, 3, 'What is fixed about the new BT21 page?', '[\"It routes only to admin\", \"It has its own fun character anatomy profiles\", \"It deletes all characters\", \"It becomes a plain text page\"]', 1, 'The final BT21 page is its own colorful anatomy profile section.', 10, 1, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(8, 3, 'Which BT21 character is linked with Jin?', '[\"RJ\", \"KOYA\", \"COOKY\", \"MANG\"]', 0, 'RJ is Jin’s BT21 character.', 10, 2, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(9, 3, 'Which BT21 character is linked with V?', '[\"SHOOKY\", \"TATA\", \"CHIMMY\", \"RJ\"]', 1, 'TATA is V’s BT21 character.', 10, 3, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `source` varchar(255) NOT NULL,
  `quote` text NOT NULL,
  `context` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `source`, `quote`, `context`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'RM', 'Some songs feel like a map back to yourself.', 'Reflection', 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(2, 'Jin', 'Confidence can be funny, soft, and powerful at the same time.', 'Comfort', 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(3, 'SUGA', 'Healing is not always loud. Sometimes it is just honest.', 'Honesty', 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(4, 'j-hope', 'Energy is a choice, and he chooses sunshine with discipline.', 'Motivation', 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(5, 'Jimin', 'Grace hits hardest when it carries emotion.', 'Performance', 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(6, 'V', 'A deep voice can turn one quiet second into cinema.', 'Mood', 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(7, 'Jung Kook', 'Talent becomes legendary when effort refuses to sleep.', 'Growth', 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(8, 'ARMY', 'Seven people. Millions of stories. One purple stage.', 'Fandom', 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1eTDC2xvdSWWl65RotXGGuJZmhiwGBEZjou5IVVU', 8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQzFFekN1RkNyWFpYNk53cXh0MnZtTjNRRGhrRWk1M2U5VjJQWE0wSiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sZWFkZXJib2FyZCI7czo1OiJyb3V0ZSI7czoxMToibGVhZGVyYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo4O30=', 1778424833);

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_title', 'BangTanSonyeondan', '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(2, 'site_subtitle', 'A dark purple BTS learning website with member profiles, songs, gallery, quotes, BT21 anatomy profiles, quizzes, points, streaks, and leaderboard.', '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(3, 'hero_kicker', 'BTS FOREVER · ARMY HOMEBASE', '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(4, 'hero_title', 'BangTanSonyeondan', '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(5, 'hero_body', 'A fan-made BTS hub where ARMY can learn, explore member vaults, take quizzes, earn points, unlock profile upgrades, and climb the leaderboard.', '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(6, 'footer_text', 'BangTanSonyeondan is a fan-made website created with love. Please support official BTS channels whenever possible.', '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(7, 'admin_email', 'support@bangtansonyeondan.com', '2026-05-08 12:00:00', '2026-05-09 13:06:37'),
(8, 'location', 'ARMY Hub', '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(9, 'creator_name', 'Mehak Arman', '2026-05-08 12:00:00', '2026-05-10 04:44:45'),
(10, 'phone', NULL, '2026-05-08 12:00:00', '2026-05-09 13:06:37'),
(11, 'instagram', NULL, '2026-05-08 12:00:00', '2026-05-09 13:06:37'),
(12, 'linkedin', '', '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(13, 'twitter', NULL, '2026-05-08 12:00:00', '2026-05-09 13:06:38'),
(14, 'youtube', NULL, '2026-05-08 12:00:00', '2026-05-09 13:06:38'),
(15, 'tiktok', NULL, '2026-05-08 12:00:00', '2026-05-09 13:06:38');

-- --------------------------------------------------------

--
-- Table structure for table `songs_images`
--

CREATE TABLE `songs_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `img_path` varchar(255) NOT NULL,
  `release_date` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `era` varchar(255) DEFAULT NULL,
  `spotify_url` varchar(1000) DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `songs_images`
--

INSERT INTO `songs_images` (`id`, `name`, `img_path`, `release_date`, `description`, `era`, `spotify_url`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(16, 'No More Dream', 'imgs/songs/no-more-dream.jfif', '2013-06-12', 'BTS debut title track energy: dreams, pressure, school-age rebellion, and the start of the BangTan story.', '2 Cool 4 Skool', NULL, 1, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(17, '2 Cool 4 Skool', 'imgs/songs/2-cool-4-skool.jfif', '2013-06-12', 'BTS debut single album cover/artwork for the first era of BangTanSonyeondan.', '2 Cool 4 Skool', NULL, 2, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(18, 'War of Hormone', 'imgs/songs/war-of-hormone.jfif', '2014-10-21', 'A bold, playful 2014 BTS track from the Dark & Wild era.', 'Dark & Wild', NULL, 3, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(19, 'Dark & Wild', 'imgs/songs/dark-and-wild.jfif', '2014-08-20', 'First studio album era with darker hip-hop styling and stronger concept storytelling.', 'Dark & Wild', NULL, 4, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(20, 'Wake Up', 'imgs/songs/wake-up.jfif', '2014-12-24', 'Japanese album era artwork for BTS early discography expansion.', 'Wake Up', NULL, 5, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(21, 'Skool Luv Affair', 'imgs/songs/skool-luv-affair.jfif', '2014-02-12', 'School trilogy era artwork with youthful love, student styling, and early BTS identity.', 'Skool Luv Affair', NULL, 6, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(22, 'I Need U', 'imgs/songs/i-need-u.jfif', '2015-04-29', 'The emotional turning point of BTS storytelling, connected to youth, pain, and growth.', 'The Most Beautiful Moment in Life Pt.1', NULL, 7, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(23, 'RUN', 'imgs/songs/run.jfif', '2015-11-30', 'A dramatic youth-era song about running forward even through confusion and pain.', 'The Most Beautiful Moment in Life Pt.2', NULL, 8, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(24, 'Butterfly', 'imgs/songs/butterfly.jfif', '2015-11-30', 'A soft emotional BTS track with fragile, poetic imagery.', 'The Most Beautiful Moment in Life Pt.2', NULL, 9, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(25, 'Save Me', 'imgs/songs/save-me.jfif', '2016-05-02', 'A fan-favorite emotional track with clean choreography and longing energy.', 'The Most Beautiful Moment in Life: Young Forever', NULL, 10, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(26, 'The Most Beautiful Moment in Life: Young Forever', 'imgs/songs/young-forever.jfif', '2016-05-02', 'Compilation era artwork for one of BTS most iconic youth story periods.', 'Young Forever', NULL, 11, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(27, 'Fire', 'imgs/songs/fire.jfif', '2016-05-02', 'High-energy BTS anthem with explosive performance energy.', 'The Most Beautiful Moment in Life: Young Forever', NULL, 12, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(28, 'Lie', 'imgs/songs/lie.jfif', '2016-10-10', 'Jimin solo from WINGS, known for dramatic performance and emotional intensity.', 'WINGS', NULL, 13, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(29, 'WINGS', 'imgs/songs/wings.jfif', '2016-10-10', 'BTS WINGS era artwork, tied to solo tracks, growth, temptation, and mature storytelling.', 'WINGS', NULL, 14, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(30, 'Blood Sweat & Tears', 'imgs/songs/blood-sweat-and-tears.jfif', '2016-10-10', 'An iconic BTS title track with elegant visuals, temptation themes, and dramatic performance.', 'WINGS', NULL, 15, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(31, 'You Never Walk Alone', 'imgs/songs/you-never-walk-alone.jfif', '2017-02-13', 'Repackage era artwork connected to comfort, friendship, and continuation of the WINGS story.', 'You Never Walk Alone', NULL, 16, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(32, 'Intro: Serendipity', 'imgs/songs/intro-serendipity.jfif', '2017-09-18', 'Jimin solo intro with soft vocals and dreamy Love Yourself energy.', 'Love Yourself: Her', NULL, 17, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(33, 'DNA', 'imgs/songs/dna.jfif', '2017-09-18', 'Bright, colorful title track that brought BTS to a huge new global audience.', 'Love Yourself: Her', NULL, 18, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(34, 'Fake Love', 'imgs/songs/fake-love.jfif', '2018-05-18', 'Dark emotional title track about losing yourself in fake love.', 'Love Yourself: Tear', NULL, 19, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(35, 'Love Yourself: Tear', 'imgs/songs/love-yourself-tear.jfif', '2018-05-18', 'Album artwork for one of BTS most critically loved eras.', 'Love Yourself: Tear', NULL, 20, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(36, 'The Truth Untold', 'imgs/songs/the-truth-untold.jfif', '2018-05-18', 'Emotional vocal-line ballad from the Love Yourself era.', 'Love Yourself: Tear', NULL, 21, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(37, 'Trivia: Seesaw', 'imgs/songs/trivia-seesaw.jfif', '2018-08-24', 'SUGA solo track with sleek emotional pop-rap production.', 'Love Yourself: Answer', NULL, 22, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(38, 'Love Yourself: Answer', 'imgs/songs/love-yourself-answer.jfif', '2018-08-24', 'Repackage album artwork for the closing chapter of the Love Yourself series.', 'Love Yourself: Answer', NULL, 23, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(39, 'IDOL', 'imgs/songs/idol.jfif', '2018-08-24', 'Powerful celebration track mixing Korean cultural energy with global pop scale.', 'Love Yourself: Answer', NULL, 24, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(40, 'Euphoria', 'imgs/songs/euphoria.jfif', '2018-08-24', 'Jung Kook solo song known for bright vocals and emotional uplift.', 'Love Yourself: Answer', NULL, 25, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(41, 'Magic Shop', 'imgs/songs/magic-shop.jfif', '2018-05-18', 'ARMY comfort song about finding a safe place through BTS music.', 'Love Yourself: Tear', NULL, 26, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(42, 'MIC Drop', 'imgs/songs/mic-drop.jfif', '2017-09-18', 'Hard-hitting performance track with confident rap-line energy.', 'Love Yourself: Her', NULL, 27, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(43, 'Make It Right', 'imgs/songs/make-it-right.jfif', '2019-04-12', 'Soft pop track from Persona era with comforting message energy.', 'Map of the Soul: Persona', NULL, 28, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(44, 'Mikrokosmos', 'imgs/songs/mikrokosmos.jfif', '2019-04-12', 'A glowing ARMY-favorite song comparing people to tiny shining stars.', 'Map of the Soul: Persona', NULL, 29, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(45, 'Map of the Soul: Persona', 'imgs/songs/map-of-the-soul-persona.jfif', '2019-04-12', 'Persona era artwork from the Map of the Soul series.', 'Map of the Soul: Persona', NULL, 30, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(46, 'Black Swan', 'imgs/songs/black-swan.jfif', '2020-01-17', 'Artistic, introspective BTS track about fear of losing passion for music.', 'Map of the Soul: 7', NULL, 31, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(47, '00:00 (Zero O’Clock)', 'imgs/songs/zero-oclock.jfif', '2020-02-21', 'Comfort track about starting again when the day resets at midnight.', 'Map of the Soul: 7', NULL, 32, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(48, 'Dope', 'imgs/songs/dope.jfif', '2015-04-29', 'Classic BTS performance track with sharp choreography and work-hard energy.', 'The Most Beautiful Moment in Life Pt.1', NULL, 33, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(49, 'BTS World OST', 'imgs/songs/bts-world-ost.jfif', '2019-06-28', 'Official game soundtrack era connected to the BTS World project.', 'BTS World', NULL, 34, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(50, 'Permission to Dance', 'imgs/songs/permission-to-dance.jfif', '2021-07-09', 'Bright English-language single focused on joy, hope, and dancing freely.', 'Butter / Permission to Dance', NULL, 35, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(51, 'Butter', 'imgs/songs/butter.jfif', '2021-05-21', 'Smooth global hit with confident summer pop energy.', 'Butter', NULL, 36, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(52, 'Run BTS', 'imgs/songs/run-bts.jfif', '2022-06-10', 'High-energy Proof-era track celebrating BTS hustle and legacy.', 'Proof', NULL, 37, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(53, 'Face Yourself', 'imgs/songs/face-yourself.jfif', '2018-04-04', 'Japanese album artwork from the Love Yourself period.', 'Face Yourself', NULL, 38, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(54, 'Blue Side', 'imgs/songs/blue-side.jfif', '2021-03-01', 'j-hope solo track with calm blue emotional atmosphere.', 'Hope World / j-hope Solo', NULL, 39, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(55, 'Daechwita', 'imgs/songs/daechwita.jfif', '2020-05-22', 'Agust D solo title track with royal traditional Korean concept and fierce rap energy.', 'Agust D / D-2', NULL, 40, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(56, 'Haegeum', 'imgs/songs/haegeum.jfif', '2023-04-21', 'Agust D title track from D-DAY with sharp social commentary and cinematic visuals.', 'Agust D / D-DAY', NULL, 41, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(57, 'AMYGDALA', 'imgs/songs/amygdala.jfif', '2023-04-21', 'Deeply personal Agust D track focused on memory, pain, and healing.', 'Agust D / D-DAY', NULL, 42, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(58, 'Dreamers', 'imgs/songs/dreamers.jfif', '2022-11-20', 'Jung Kook FIFA World Cup song with uplifting global anthem energy.', 'Jung Kook Solo', NULL, 43, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(59, 'Seven', 'imgs/songs/seven.jfif', '2023-07-14', 'Jung Kook solo single with polished pop energy.', 'Jung Kook Solo', NULL, 44, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(60, 'Standing Next to You', 'imgs/songs/standing-next-to-you.jfif', '2023-11-03', 'Jung Kook GOLDEN-era performance single with retro pop star energy.', 'Jung Kook GOLDEN', NULL, 45, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35'),
(61, '3D', 'imgs/songs/3d.jfif', '2023-09-29', 'Jung Kook solo single with playful pop/R&B styling.', 'Jung Kook GOLDEN', NULL, 46, 1, '2026-05-08 09:52:35', '2026-05-08 09:52:35');

-- --------------------------------------------------------

--
-- Table structure for table `timeline_events`
--

CREATE TABLE `timeline_events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year` varchar(20) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'Milestone',
  `title` varchar(255) NOT NULL,
  `body` longtext DEFAULT NULL,
  `bullet_points` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`bullet_points`)),
  `image_paths` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`image_paths`)),
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `timeline_events`
--

INSERT INTO `timeline_events` (`id`, `year`, `category`, `title`, `body`, `bullet_points`, `image_paths`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '2013', 'Debut', 'Debut with 2 Cool 4 Skool', 'BTS began their journey with a sharp hip-hop identity, rookie energy, and a message that questioned pressure placed on young people.', '[\"Debut era begins\", \"ARMY origin story starts\", \"School Trilogy foundation\"]', '[\"imgs/timeline/2013/1.jfif\", \"imgs/timeline/2013/2.jfif\"]', 1, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(2, '2016', 'Recognition', 'First major awards and wider recognition', 'BTS started moving from promising rookies to serious award-season names, building momentum through performance and storytelling.', '[\"Korean award visibility increases\", \"Bigger stages\", \"Fandom grows stronger\"]', '[]', 2, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(3, '2017', 'Global', 'Billboard breakthrough and global attention', 'BTS moved from rising stars to global conversation, with international fandom becoming impossible to ignore.', '[\"Global fanbase grows rapidly\", \"US award-show visibility increases\", \"Love Yourself era begins\"]', '[\"imgs/timeline/2017/1.jfif\", \"imgs/timeline/2017/2.jfif\"]', 3, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(4, '2018', 'Message', 'Love Yourself and Speak Yourself impact', 'Their message expanded beyond music into self-love, youth voice, and cultural impact.', '[\"Love Yourself message becomes central\", \"Bigger stadium-scale presence\", \"Global media focus\"]', '[\"imgs/timeline/2018/1.jfif\", \"imgs/timeline/2018/2.jfif\"]', 4, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(5, '2020', 'Record Era', 'Dynamite, BE, and worldwide comfort', 'BTS reached another global peak while releasing music that brought brightness and comfort during a difficult year.', '[\"Dynamite era explodes worldwide\", \"BE carries a softer healing tone\", \"BTS becomes a household global pop name\"]', '[\"imgs/timeline/2020/1.jfif\", \"imgs/timeline/2020/2.jfif\"]', 5, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(6, '2021', 'Stadium Pop', 'Butter and Permission to Dance', 'BTS leaned into polished pop brightness while keeping the fan connection strong.', '[\"English singles era continues\", \"Performance scale grows\", \"ARMY moments everywhere\"]', '[]', 6, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(7, '2022', 'Reflection', 'Proof anthology era', 'Proof looked back across the group journey and framed their story as something still moving forward.', '[\"Anthology project\", \"Career reflection\", \"Promise of the future\"]', '[]', 7, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(8, '2023-2025', 'Solo Chapter', 'Solo era and individual colors', 'Each member explored solo identity, showing different sounds, styles, and personal artistic colors while the seven-member story stayed connected.', '[\"Solo albums and singles\", \"Member identities shine\", \"Group bond remains central\"]', '[\"imgs/timeline/2023/1.jfif\", \"imgs/timeline/2023/2.jfif\", \"imgs/timeline/2023/3.jfif\"]', 8, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `avatar_key` varchar(255) NOT NULL DEFAULT 'purple-heart',
  `profile_theme` varchar(255) NOT NULL DEFAULT 'galaxy-purple',
  `bio` varchar(500) DEFAULT NULL,
  `points` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `streak_days` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `last_streak_date` date DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `auth_provider` varchar(255) NOT NULL DEFAULT 'email',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `is_admin`, `avatar_key`, `profile_theme`, `bio`, `points`, `streak_days`, `last_streak_date`, `google_id`, `auth_provider`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'BTS Admin', 'bts_admin', 'admin@bangtansonyeondan.com', NULL, '$2y$12$QFxj5sWagBmuc.m4lGttCecWEDBpvokXkXbb7rebm9RUCuzzSwp6.', 1, 'purple-heart', 'galaxy-purple', NULL, 12, 1, '2026-05-10', NULL, 'email', 'WbKUAbgFx7Uh4nTjr5193ot9eljm6KqEHpPeKEibRk6zJwCK3G3dumW0pj7G', '2026-05-08 12:00:00', '2026-05-10 05:38:56'),
(6, 'Mehak Arman', 'mehak_frostnap', 'mehakarmaan1@gmail.com', NULL, '$2y$12$NSL1PCrWzlEJrBAYPNZuLuCPUVptKOnRY4a/tM58ChAJsZSRdaS42', 0, 'purple-heart', 'galaxy-purple', NULL, 18446744073709551615, 1, '2026-05-08', NULL, 'email', NULL, '2026-05-08 04:02:54', '2026-05-08 04:08:31'),
(7, 'Hamdan Arman', '6_7', 'hamdanarmaan@gmail.com', NULL, '$2y$12$XlDYktFO5OCirbPfsr0lk.Za5MnDJTKA1M.wLnX4XpPw8a7y.pyV2', 0, 'favicons/TATA.png', 'tata-theme', '67', 0, 1, '2026-05-09', NULL, 'email', 'q72pd1t26Z2AfLP0rTAPGpgyhKryCXpHVuOQTpmML3O9q5M6BDr74QdfiDqm', '2026-05-09 12:45:32', '2026-05-10 10:30:14'),
(8, 'Mahreen Arman', 'ARMY_BTS_0t7I_-6-7', 'mahreenarmaan10@gmail.com', NULL, '$2y$12$8GBbL5u6jEM/cuM36lpWgukiBg2q8fqjxwKQUzwJq9DT.oLACoR5.', 0, 'favicons/logo.png', 'purple-heart-theme', '6-7', 18446744073709551615, 0, NULL, NULL, 'email', NULL, '2026-05-10 10:48:30', '2026-05-10 10:49:48');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile_assets`
--

CREATE TABLE `user_profile_assets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `profile_asset_id` bigint(20) UNSIGNED NOT NULL,
  `unlocked_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_profile_assets`
--

INSERT INTO `user_profile_assets` (`id`, `user_id`, `profile_asset_id`, `unlocked_at`) VALUES
(16, 7, 26, '2026-05-09 21:09:43'),
(17, 7, 32, '2026-05-10 14:19:59'),
(18, 7, 28, '2026-05-10 14:20:04'),
(19, 7, 30, '2026-05-10 14:20:07'),
(20, 7, 37, '2026-05-10 14:20:10'),
(21, 7, 41, '2026-05-10 14:20:13'),
(22, 7, 35, '2026-05-10 14:20:17'),
(23, 7, 29, '2026-05-10 14:20:36'),
(24, 7, 42, '2026-05-10 14:20:40'),
(25, 7, 36, '2026-05-10 14:20:44'),
(26, 7, 33, '2026-05-10 14:21:13'),
(27, 7, 40, '2026-05-10 14:21:21'),
(28, 7, 31, '2026-05-10 14:26:01'),
(29, 8, 25, '2026-05-10 14:48:30');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `member_id` bigint(20) UNSIGNED DEFAULT NULL,
  `member_name` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `user_id`, `member_id`, `member_name`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, 1, 3, NULL, NULL, NULL, '2026-05-10 10:11:04', '2026-05-10 10:11:04'),
(2, 7, 7, NULL, NULL, NULL, '2026-05-10 10:31:16', '2026-05-10 10:31:16'),
(3, 8, 5, NULL, NULL, NULL, '2026-05-10 10:50:44', '2026-05-10 10:50:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bt21_characters`
--
ALTER TABLE `bt21_characters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bt21_characters_slug_unique` (`slug`);

--
-- Indexes for table `bts_copies`
--
ALTER TABLE `bts_copies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bts_copies_bts_name_copy_title_unique` (`bts_name`,`copy_title`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `daily_checkins`
--
ALTER TABLE `daily_checkins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `daily_checkins_user_id_checkin_date_unique` (`user_id`,`checkin_date`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `learning_lessons`
--
ALTER TABLE `learning_lessons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `learning_lessons_slug_unique` (`slug`);

--
-- Indexes for table `learning_materials`
--
ALTER TABLE `learning_materials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `learning_materials_slug_unique` (`slug`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nav_items`
--
ALTER TABLE `nav_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `point_transactions`
--
ALTER TABLE `point_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `point_transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `profile_assets`
--
ALTER TABLE `profile_assets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `profile_assets_key_unique` (`key`);

--
-- Indexes for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_attempts_user_id_foreign` (`user_id`),
  ADD KEY `quiz_attempts_learning_lesson_id_foreign` (`learning_lesson_id`);

--
-- Indexes for table `quiz_games`
--
ALTER TABLE `quiz_games`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `quiz_games_slug_unique` (`slug`);

--
-- Indexes for table `quiz_game_attempts`
--
ALTER TABLE `quiz_game_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_game_attempts_user_id_foreign` (`user_id`),
  ADD KEY `quiz_game_attempts_quiz_game_id_foreign` (`quiz_game_id`);

--
-- Indexes for table `quiz_game_questions`
--
ALTER TABLE `quiz_game_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_game_questions_quiz_game_id_foreign` (`quiz_game_id`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_questions_learning_lesson_id_foreign` (`learning_lesson_id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `site_settings_key_unique` (`key`);

--
-- Indexes for table `songs_images`
--
ALTER TABLE `songs_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timeline_events`
--
ALTER TABLE `timeline_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_google_id_index` (`google_id`);

--
-- Indexes for table `user_profile_assets`
--
ALTER TABLE `user_profile_assets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_profile_assets_user_id_profile_asset_id_unique` (`user_id`,`profile_asset_id`),
  ADD KEY `user_profile_assets_profile_asset_id_foreign` (`profile_asset_id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `votes_user_id_unique` (`user_id`),
  ADD KEY `votes_member_id_foreign` (`member_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bt21_characters`
--
ALTER TABLE `bt21_characters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bts_copies`
--
ALTER TABLE `bts_copies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `daily_checkins`
--
ALTER TABLE `daily_checkins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery_images`
--
ALTER TABLE `gallery_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `learning_lessons`
--
ALTER TABLE `learning_lessons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `learning_materials`
--
ALTER TABLE `learning_materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `nav_items`
--
ALTER TABLE `nav_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `point_transactions`
--
ALTER TABLE `point_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `profile_assets`
--
ALTER TABLE `profile_assets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `quiz_games`
--
ALTER TABLE `quiz_games`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quiz_game_attempts`
--
ALTER TABLE `quiz_game_attempts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quiz_game_questions`
--
ALTER TABLE `quiz_game_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `songs_images`
--
ALTER TABLE `songs_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `timeline_events`
--
ALTER TABLE `timeline_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_profile_assets`
--
ALTER TABLE `user_profile_assets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daily_checkins`
--
ALTER TABLE `daily_checkins`
  ADD CONSTRAINT `daily_checkins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `point_transactions`
--
ALTER TABLE `point_transactions`
  ADD CONSTRAINT `point_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  ADD CONSTRAINT `quiz_attempts_learning_lesson_id_foreign` FOREIGN KEY (`learning_lesson_id`) REFERENCES `learning_lessons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quiz_attempts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quiz_game_attempts`
--
ALTER TABLE `quiz_game_attempts`
  ADD CONSTRAINT `quiz_game_attempts_quiz_game_id_foreign` FOREIGN KEY (`quiz_game_id`) REFERENCES `quiz_games` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quiz_game_attempts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quiz_game_questions`
--
ALTER TABLE `quiz_game_questions`
  ADD CONSTRAINT `quiz_game_questions_quiz_game_id_foreign` FOREIGN KEY (`quiz_game_id`) REFERENCES `quiz_games` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD CONSTRAINT `quiz_questions_learning_lesson_id_foreign` FOREIGN KEY (`learning_lesson_id`) REFERENCES `learning_lessons` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_profile_assets`
--
ALTER TABLE `user_profile_assets`
  ADD CONSTRAINT `user_profile_assets_profile_asset_id_foreign` FOREIGN KEY (`profile_asset_id`) REFERENCES `profile_assets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_profile_assets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
