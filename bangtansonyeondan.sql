-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 15, 2026 at 06:45 AM
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
(4, 'MANG', 'mang', 'j-hope', '🐿️', 'favicons/MANG.png', '#f59e0b', 'Masked dance sunshine', 'Rhythm, hope, and stage fireworks', '[\"Mystery mask for performance mode\",\"Dance-core legs with unlimited stamina\",\"Sunshine battery in the chest\"]', '[\"Hope beam\",\"Dance combo spin\",\"Stage spark jump\"]', 4, 1, '2026-05-08 05:21:32', '2026-05-08 05:21:32'),
(5, 'CHIMMY', 'chimmy', 'Jimin', '🐥', 'favicons/CHIMMY.png', '#a855f7', 'Yellow hoodie puppy', 'Sweetness + stage duality', '[\"Soft hoodie armor\",\"Tiny paws for dramatic cuteness\",\"Duality switch hidden under the hood\"]', '[\"Puppy charm\",\"Graceful spin\",\"Duality glow\"]', 5, 1, '2026-05-08 05:21:32', '2026-05-08 05:21:32'),
(6, 'TATA', 'tata', 'V', '🐻', 'favicons/TATA.png', '#14b8a6', 'Alien heart prince', 'Cinematic imagination + artsy mystery', '[\"Heart-shaped head from Planet BT\",\"Tiny limbs, huge personality\",\"Mood detector for aesthetic moments\"]', '[\"Alien heart pulse\",\"Vintage jazz aura\",\"Expression freeze frame\"]', 6, 1, '2026-05-08 05:21:32', '2026-05-08 05:21:32'),
(7, 'COOKY', 'cooky', 'Jung Kook', '🐰', 'favicons/COOKY.png', '#22c55e', 'Pink bunny gym beast', 'Golden maknae energy + playful courage', '[\"Bunny ears tuned for challenges\",\"Tiny body with gym-boss power\",\"Heart mark loaded with confidence\"]', '[\"Golden jump\",\"Boxing bunny combo\",\"Challenge accepted dash\"]', 7, 1, '2026-05-08 05:21:32', '2026-05-08 05:21:32'),
(8, 'VAN', 'van', 'ARMY', '🛡️', 'favicons/VAN.png', '#94a3b8', 'Guardian robot watching over BT21', 'Protection + calm universe balance', '[\"Robot shell with soft guardian energy\",\"Scans chaos and protects the crew\",\"Half light, half shadow, all loyal\"]', '[\"Guardian scan\",\"Shield pulse\",\"Orbit watch\"]', 8, 1, '2026-05-08 05:21:32', '2026-05-08 05:21:32');

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
-- Table structure for table `bts_updates`
--

CREATE TABLE `bts_updates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `source_label` varchar(255) DEFAULT NULL,
  `excerpt` text DEFAULT NULL,
  `body` longtext DEFAULT NULL,
  `image_path` varchar(1000) DEFAULT NULL,
  `video_url` varchar(1000) DEFAULT NULL,
  `video_path` varchar(1000) DEFAULT NULL,
  `links` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`links`)),
  `is_pinned` tinyint(1) NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `published_at` timestamp NULL DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
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
(2, 1, '2026-05-08', 12, 1, '2026-05-08 04:28:43', '2026-05-08 04:28:43'),
(3, 7, '2026-05-09', 12, 1, '2026-05-09 12:45:52', '2026-05-09 12:45:52'),
(4, 1, '2026-05-10', 12, 1, '2026-05-10 05:38:56', '2026-05-10 05:38:56'),
(5, 7, '2026-05-12', 12, 1, '2026-05-12 11:32:30', '2026-05-12 11:32:30'),
(6, 9, '2026-05-13', 12, 1, '2026-05-13 01:12:42', '2026-05-13 01:12:42'),
(7, 9, '2026-05-14', 14, 2, '2026-05-14 01:02:43', '2026-05-14 01:02:43');

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
(1, 'bts-101-official-start-here', 'BTS 101: Start Here', 'BTS 101', 'Guide', 'Beginner', 'A clean starter guide for new ARMY: who BTS are, why they matter, and where to watch official content.', 'BTS, also known as Bangtan Sonyeondan, are a seven-member group from South Korea.\r\n\r\nUse this page as a starter map: learn the members, check official channels, watch the MVs, then try the quizzes separately in the Quiz Arena.\r\n\r\nFor a real fan site, always guide users back to official sources so streams, views, and support go to BTS directly.', 'learning/baby-army-cover-1778695016-5ZvZtZ.jfif', NULL, NULL, 'https://ibighit.com/bts/eng/', 'https://www.youtube.com/@BTS', 'Official BTS site + BANGTANTV', '[{\"label\":\"Official BTS Website\",\"url\":\"https:\\/\\/ibighit.com\\/bts\\/eng\\/\",\"type\":\"Official\"},{\"label\":\"BANGTANTV YouTube\",\"url\":\"https:\\/\\/www.youtube.com\\/@BTS\",\"type\":\"Official YouTube\"},{\"label\":\"HYBE LABELS YouTube\",\"url\":\"https:\\/\\/www.youtube.com\\/@HYBELABELS\",\"type\":\"Official YouTube\"}]', NULL, NULL, 1, 1, 1, '2026-05-10 08:45:23', '2026-05-13 13:56:56'),
(2, 'members-and-bt21-map', 'Members + BT21 Map', 'Members', 'Guide', 'Beginner', 'BT21 are cute cartoon characters created by BTS themselves! Each member drew a character that matches their real-life personality: RM is KOYA the sleepy koala, Jin is RJ the foodie alpaca, Suga is SHOOKY the wild cookie, J-Hope is MANG the dance-king pony, Jimin is CHIMMY the cute puppy, V is TATA the heart-headed alien, and Jungkook is COOKY the tough pink bunny. There is also VAN, a space robot who represents you—the ARMY fanbase—protecting them all!', '## 🌟 THE ULTIMATE ARMY GUIDE: BTS × BT21 UNIVERSE 🌟\r\nWelcome to the fandom! One of the most fun milestones of becoming an ARMY is learning the BT21 Universe. These are not just random corporate mascots. In 2017, the members of BTS sat down with LINE FRIENDS and personally sketched, designed, and built the personalities of these eight characters from scratch.\r\nTo help you memorize who is who, here is the complete, detailed breakdown mapping every BTS member to their adorable animated alter-ego!\r\n\r\n------------------------------\r\n\r\n## 🐨 RM as KOYA: The Sleepy Intellectual\r\n\r\n* The BTS Link: Just like BTS’s brilliant leader RM (Kim Namjoon), KOYA is incredibly smart and a deep thinker. RM loves nature, books, and quiet contemplation, which perfectly matches KOYA\'s vibe.\r\n* Character Traits: KOYA is a brilliant blue koala who looks like he is sleeping 24/7, but he is actually thinking deeply.\r\n* The Quirks: His ears are removable! They literally fall off whenever he gets shocked or startled.\r\n\r\n## 🦙 JIN as RJ: The Fluffy Foodie\r\n\r\n* The BTS Link: Jin (Kim Seokjin) loves eating and cooking (famous for his \"Eat Jin\" vlogs). He is also known for his cozy, comforting, and worldwide handsome energy.\r\n* Character Traits: RJ is a remarkably fluffy, kind-hearted white alpaca from Machu Picchu. He loves to eat everything in sight and wears a red scarf.\r\n* The Quirks: He gets cold very easily, so he wears a red parka jacket when the weather drops. If he gets dirty, he gets stressed!\r\n\r\n## 🍪 SUGA as SHOOKY: The Tiny Prankster\r\n\r\n* The BTS Link: Suga (Min Yoongi) might seem quiet on the outside, but he has a savage wit, a playful side, and loves a good nap—traits heavily infused into this tiny character.\r\n* Character Traits: SHOOKY is a tiny, mischievous magic cookie filled with endless energy. He is the ultimate prankster of the group and loves joking around with his friends.\r\n* The Quirks: He has one massive, ultimate weakness: MILK. If he steps in milk, he softens up and shakes with absolute terror!\r\n\r\n## 🐴 J-HOPE as MANG: The Expressionist Dance King\r\n\r\n* The BTS Link: J-Hope (Jung Hoseok) is the main dancer and the literal \"hope\" and sunshine of BTS. He brought his unparalleled dance skills and cool factor to this design.\r\n* Character Traits: MANG is a purple, heart-nosed dancing machine. For years, MANG wore a mysterious pony mask while tearing up the dance floor, keeping their true face hidden.\r\n* The Quirks: In the official BT21 storyline, MANG eventually took off the mask to reveal an incredibly cute, tiny pink acorn-like face underneath, symbolizing self-love and confidence!\r\n\r\n## 🐶 JIMIN as CHIMMY: The Passionate Puppy\r\n\r\n* The BTS Link: Jimin (Park Jimin) is legendary for his intense work ethic, boundary-pushing stage presence, and his incredibly cute, chubby-cheeked \"mochi\" visuals.\r\n* Character Traits: CHIMMY is a bright yellow, hoodie-wearing puppy who represents pure passion. He puts 100% of his effort, heart, and soul into everything he tries.\r\n* The Quirks: He can\'t resist showing off his massive, goofy tongue when he works hard, and his cheeks automatically puff up when he plays his favorite instrument: the harmonica.\r\n\r\n## 👽 V as TATA: The Curious Shape-Shifter\r\n\r\n* The BTS Link: V (Kim Taehyung) is famous for his unique, out-of-the-box thinking, his love for art, and his massive heart for the fans.\r\n* Character Traits: TATA is an alien prince from Planet BT with a giant, bright red, heart-shaped head. He possesses a body that can stretch, bend, and transform into weird shapes.\r\n* The Quirks: TATA left his royal life and came to Earth on a spaceship because he wanted to understand what true \"love\" is and spread it across the universe.\r\n\r\n## 🐰 JUNGKOOK as COOKY: The Tough Bunny\r\n\r\n* The BTS Link: Jungkook (Jeon Jung Kook) is the \"Golden Maknae\" of BTS. He is famous for his bunny-like smile, but he is also incredibly muscular, athletic, and fiercely competitive.\r\n* Character Traits: COOKY is a pastel pink bunny who subverts expectations. Instead of being fragile, COOKY works out constantly, lifts weights, and dreams of being incredibly strong.\r\n* The Quirks: He has one perked-up, crooked eyebrow that gives him a mischievous, tough look whenever he is ready to take on a challenge.\r\n\r\n------------------------------\r\n## 🤖 THE GUARDIAN OF THE UNIVERSE: VAN\r\n\r\n* The Representation: ARMY (The Fanbase)\r\n* Character Traits: VAN is a giant, half-white, half-grey space robot. He is the protector of BT21. He flew TATA to Earth and now uses his futuristic shields and knowledge to keep all seven characters safe from harm.\r\n* The Meaning: BTS designed VAN to explicitly represent their fans. It means that no matter where the characters go, ARMY is always there to guide, support, and protect them!\r\n\r\n\r\n------------------------------\r\n## 💡 PRO-TIP FOR NEW ARMYs\r\n\r\nThe overall plot of the BT21 universe is called \"UNIVERSTARS.\" TATA gathered KOYA, RJ, SHOOKY, MANG, CHIMMY, and COOKY together to form a pop idol group to rival the best in the universe, proving that love and music can save the world.', 'learning/download-4-1778739383-HbPd6e.jpg', NULL, NULL, 'https://www.bt21.com/', 'https://www.youtube.com/@BT21_official', 'BT21 Official', '[{\"label\":\"BT21 Official Website\",\"url\":\"https:\\/\\/www.bt21.com\\/\",\"type\":\"Official\"},{\"label\":\"BT21 Official YouTube\",\"url\":\"https:\\/\\/www.youtube.com\\/@BT21_official\",\"type\":\"Official YouTube\"}]', NULL, NULL, 2, 1, 1, '2026-05-10 08:45:23', '2026-05-14 02:16:28'),
(3, 'spring-day-mv-study', 'MV Study: Spring Day', 'Music Videos', 'MV Study', 'Intermediate', 'Watch the official MV, then learn the themes, visuals, and emotional meaning fans connect with Spring Day.', 'Spring Day is one of BTS’s most emotional songs. A learning material like this can include: release context, lyrics themes, visual motifs, fan interpretations, and official links.\r\n\r\nKeep the quiz separate. This page is for learning, watching, reading, and saving useful links.', 'imgs/learn/spring-day-mv-study/cover.jpg', NULL, NULL, 'https://ibighit.com/bts/eng/discography/detail/you_never_walk_alone.html', 'https://www.youtube.com/watch?v=xEeFrLSkMm8', 'Official MV', '[{\"label\":\"Spring Day Official MV\",\"url\":\"https:\\/\\/www.youtube.com\\/watch?v=xEeFrLSkMm8\",\"type\":\"Official MV\"},{\"label\":\"You Never Walk Alone Discography\",\"url\":\"https:\\/\\/ibighit.com\\/bts\\/eng\\/discography\\/detail\\/you_never_walk_alone.html\",\"type\":\"Official\"}]', NULL, NULL, 3, 0, 0, '2026-05-10 08:45:23', '2026-05-14 02:32:03'),
(4, 'dynamite-mv-study', 'MV Study: Dynamite', 'Music Videos', 'MV Study', 'Beginner', 'A bright MV guide for Dynamite with official MV link, comeback energy, styling notes, and quiz prep hints.', 'Dynamite is perfect for a beginner MV study because it is colorful, easy to recognize, and popular with casual listeners too.\r\n\r\nUse this page to explain styling, setting, choreography moments, and the feel-good disco-pop concept.', 'imgs/learn/dynamite-mv-study/cover.jpg', NULL, NULL, 'https://ibighit.com/bts/eng/discography/detail/dynamite.html', 'https://www.youtube.com/watch?v=gdZLi9oWNZg', 'Official MV', '[{\"label\":\"Dynamite Official MV\",\"url\":\"https:\\/\\/www.youtube.com\\/watch?v=gdZLi9oWNZg\",\"type\":\"Official MV\"},{\"label\":\"Dynamite Discography\",\"url\":\"https:\\/\\/ibighit.com\\/bts\\/eng\\/discography\\/detail\\/dynamite.html\",\"type\":\"Official\"}]', NULL, NULL, 4, 0, 0, '2026-05-10 08:45:23', '2026-05-14 02:31:40'),
(5, 'army-terms-and-fandom-culture', 'ARMY Terms + Fandom Culture', 'ARMY Culture', 'Glossary', 'Beginner', 'A friendly glossary for new users: bias, comeback, era, streaming, purple, borahae, and more.', 'This page can become a full glossary. Keep it helpful, warm, and beginner-friendly so new ARMY do not feel lost.\r\n\r\nAdmin can keep adding terms and links as the website grows.', 'imgs/learn/army-terms-and-fandom-culture/cover.jpg', NULL, NULL, 'https://weverse.io/bts/feed', 'https://www.youtube.com/@BTS', 'Official community + videos', '[{\"label\":\"BTS on Weverse\",\"url\":\"https:\\/\\/weverse.io\\/bts\\/feed\",\"type\":\"Official Community\"},{\"label\":\"BANGTANTV\",\"url\":\"https:\\/\\/www.youtube.com\\/@BTS\",\"type\":\"Official YouTube\"}]', NULL, NULL, 5, 0, 0, '2026-05-10 08:45:23', '2026-05-14 02:31:33'),
(6, 'baby-army-start-here', 'Baby ARMY Start Here', 'BTS 101', 'Starter Guide', 'Beginner', 'A calm, friendly first guide for new ARMYs who want to understand who BTS are without getting overwhelmed.', 'BTS, also known as Bangtan Sonyeondan / Bulletproof Boys Scout / or even Beyond The Scene, are a seven-member group under BIGHIT MUSIC company. The members are:\r\n- RM\r\n- Jin\r\n- SUGA\r\n- j-hope\r\n- Jimin\r\n- V\r\n- Jung Kook\r\nFor a new fan, the best way to begin is simple; learn the members, listen to a few key songs, use official sources, and TAKE YOUR TIME(which u should spend HERE learning with USSS:). \r\nBTS are known for music that connects personal stories, youth, pressure, dreams, self-love, friendship, and growth. \r\nYou do not need to know EVERYTHING in just one day. Being an ARMY starts with curiosity, respect, and enjoying the musiccccccc.', 'learning/yoongi-20130604-1778694994-2kZwlG.jpg', '[\"baby-army-1.jfif\", \"baby-army-2.jfif\", \"baby-army-3.jfif\"]', 'baby-army-video-poster.jfif', 'https://ibighit.com/en/bts/profile/', 'https://www.youtube.com/watch?v=UPJX6QK6etg', 'BIGHIT profile + BANGTANTV', '[{\"label\": \"Official BTS Profile\", \"url\": \"https://ibighit.com/en/bts/profile/\", \"type\": \"Official\"}, {\"label\": \"BANGTANTV Official YouTube\", \"url\": \"https://www.youtube.com/channel/UCLkAepWjdylmXSltofFvsYQ\", \"type\": \"Official Video\"}, {\"label\": \"BTS Official Discography\", \"url\": \"https://ibighit.com/en/bts/discography/\", \"type\": \"Official\"}]', '[\"BTS has seven members.\", \"ARMY is the name used by BTS fans.\", \"Official sources are the safest place to check facts.\"]', '[\"Start with the official profile to learn member names.\", \"Use the official discography to explore albums in order.\", \"Use BANGTANTV and HYBE/BIGHIT channels for official video content.\"]', 1, 1, 1, '2026-05-13 07:26:31', '2026-05-13 13:56:34'),
(7, 'bts-members-official-guide', 'The 7 BTS Members', 'Members', 'Official Guide', 'Beginner', 'The number 7 is the ultimate symbol of BTS, representing the unbreakable bond of the seven members—RM, Jin, Suga, J-Hope, Jimin, V, and Jungkook—who have stayed together since 2013, a milestone they permanently celebrated by getting matching \"7\" friendship tattoos.', '## 💜 THE UNBREAKABLE BOND: THE HISTORY OF THE BTS 7 💜\r\nIn the K-pop industry, groups frequently change lineups, lose members, or disband entirely. BTS stands as a historic anomaly. Since June 13, 2013, the exact same seven men have stood side-by-side. To understand why the number 7 is a sacred symbol to the ARMY fandom, you must look at how they found each other, the grueling poverty they survived, and why they promised never to leave a single man behind.\r\n\r\n------------------------------\r\n\r\n## PART 1: THE ACCIDENTAL FAMILY (HOW THEY JOINED)\r\nIn 2010, Big Hit Entertainment was a tiny, nearly bankrupt agency. The CEO, Bang Si-hyuk, wanted to build a raw hip-hop crew. Piece by piece, the universe assembled seven wildly different boys from across South Korea:\r\n\r\n* RM (The Foundation): Kim Namjoon was an underground middle-school rapper named Runch Randa. CEO Bang was so blown away by his genius lyrics that he decided to build an entire music group centered entirely around him.\r\n* Suga (The Producer): Min Yoongi entered a Big Hit rap competition. He strictly wanted to be a background music producer and beatmaker, but CEO Bang tricked him, promising him he wouldn\'t have to dance if he joined the group.\r\n* J-Hope (The Lifeline): Jung Hoseok was a famous street dancer in Gwangju. He initially auditioned for JYP Entertainment but was rejected. Big Hit snatched him up for his elite dance skills.\r\n* Jin (The Visual Accord): Kim Seokjin was just a college student studying acting. A casting director spotted him stepping off a bus and scouted him strictly because his face was so staggeringly handsome. He had zero singing or dancing experience.\r\n* Jungkook (The Spark): Jeon Jung Kook auditioned for a TV talent show at age 13. He was eliminated, but seven different entertainment agencies tried to sign him. He chose the tiny, poor Big Hit purely because he saw RM rapping and thought he was the coolest person alive.\r\n* V (The Hidden Ace): Kim Taehyung only went to a Big Hit audition to support his friend. A rookie executive saw him sitting in the hallway, begged him to try out, and he ended up being the only person from that entire region to pass.\r\n* Jimin (The Final Piece): Park Jimin was a top modern dancer at an arts high school. His teacher urged him to audition. He joined the company last, training like a madman to adapt his graceful contemporary lines into aggressive hip-hop choreography.\r\n\r\n------------------------------\r\n\r\n## PART 2: THE BLOOD, SWEAT, AND TEARS (THE HARDSHIPS)\r\nBefore the stadiums and the Grammys, BTS lived a life of severe, exhausting adversity.\r\n\r\n* The Single Room Dorm: All seven teenage boys slept bunk-to-bunk in one single, tiny, cramped bedroom. They shared one bathroom, washed their clothes in cramped sinks, and dealt with unhygienic conditions like severe fruit fly infestations.\r\n* Severe Financial Starvation: The agency had no money. Suga frequently had to choose between using his pocket money to buy a bowl of noodles or paying for a bus ride home; he couldn\'t afford both. To survive, Jin used to take food from his own family\'s kitchen to feed the growing younger members.\r\n* The Pre-Debut Crises: Six months before debut, the immense pressure almost shattered them. RM actually ran away from the agency out of sheer anxiety. Later, J-Hope actually quit the lineup and packed his bags to return home. RM went to management and stated they could not make it without Hoseok, while Jungkook cried and begged J-Hope to stay, pulling the family back together.\r\n* Industry Mistreatment: Because they were from a \"no-name\" company, the mainstream K-pop industry treated them like outcasts. TV stations regularly cut their performances short, took away their broadcast screen time, or removed them from award show clips entirely. They were openly mocked on variety shows and falsely accused of plagiarism by rival fanbases when they finally started winning.\r\n* The 2014 & 2018 Disbandment Shadows: In 2014, they almost broke up because Big Hit was completely out of funds. Years later, even at the peak of their initial global fame in early 2018, the intense pressure, sleepless nights, and mental toll caused them to break down behind closed doors, seriously considering splitting up before ultimately deciding to press on.\r\n\r\n\r\n------------------------------\r\n\r\n## PART 3: WHY THE NUMBER \"7\" IS SACRED\r\nFor BTS, 7 is not a lucky digit—it is their identity.\r\n\r\n* The Friendship Tattoos: In 2022, to solidify their permanent brotherhood before entering their mandatory South Korean military service, all seven members went together to get a matching tattoo. Each member tattooed the number \"7\" on a different hidden part of their body (RM on his ankle, Jin on his ribs, Suga on his wrist, J-Hope on his calf, Jimin on his finger, V on his thigh, and Jungkook behind his ear).\r\n* The Philosophy of Oneness: When Suga reassures fans during hard times or solo eras, he repeats a core mantra: \"We are 7.\" To BTS, no individual success is valid if a single member is missing. They refuse to rotate members, add new people, or ever let the group fade.\r\n* The Map of the Soul: Their landmark album Map of the Soul: 7 was a direct tribute to their seven years together as seven guys. As Jimin once explained, each member has a totally different strength, but those strengths only become an explosive, world-changing force when all seven are locked together.\r\n\r\nThey started from nothing, fought the entire music industry as underdogs, and built an empire purely on loyalty.', 'learning/bts-members-official-cover-1778742714-TV6Rcu.jpg', '[\"bts-members-official-guide-1\", \"bts-members-official-guide-2\", \"bts-members-official-guide-3\", \"bts-members-official-guide-4\", \"bts-members-official-guide-5\", \"bts-members-official-guide-6\"]', 'bts-members-official-guide-video-poster', 'https://ibighit.com/en/bts/profile/', 'https://youtu.be/7UWBYJjuIL0?list=RD7UWBYJjuIL0', 'BIGHIT official profile', '[{\"label\": \"Official BTS Profile\", \"url\": \"https://ibighit.com/en/bts/profile/\", \"type\": \"Official\"}, {\"label\": \"BANGTANTV\", \"url\": \"https://www.youtube.com/channel/UCLkAepWjdylmXSltofFvsYQ\", \"type\": \"Official Video\"}]', '[\"The seven-member structure is one of the first facts every Baby ARMY should learn.\", \"Stage names are commonly used in official and fan spaces.\", \"Learning members through performances is easier than memorizing everything at once.\"]', '[\"Use official profile information first.\", \"Then watch group performances and interviews to recognize each member naturally.\"]', 2, 1, 1, '2026-05-13 07:26:31', '2026-05-14 03:11:54'),
(8, 'bts-debut-and-early-message', 'BTS Debut and Early Message', 'History', 'Era Guide', 'Beginner', 'Learn how BTS began with 2 COOL 4 SKOOL and the message behind No More Dream.', 'BTS debuted in 2013 with the 2 COOL 4 SKOOL era. The official BIGHIT discography page introduces No More Dream as the debut track and presents the early message around the question: What is your dream? This is important because BTS did not begin only with bright pop songs. Their early identity was strongly connected to youth, pressure, school, dreams, and speaking honestly. For Baby ARMYs, this era helps explain why fans often say BTS music feels personal.', 'media-gallery/bts-debut-cover.jpg', '[\"media-gallery/bts-debut-1.jpg\", \"media-gallery/bts-debut-2.jpg\"]', 'media-gallery/bts-debut-video.jpg', 'https://ibighit.com/en/bts/discography/detail/2_cool_4_school', 'https://www.youtube.com/channel/UCLkAepWjdylmXSltofFvsYQ', 'BIGHIT official discography', '[{\"label\": \"2 COOL 4 SKOOL Official Page\", \"url\": \"https://ibighit.com/en/bts/discography/detail/2_cool_4_school\", \"type\": \"Official\"}, {\"label\": \"BTS Discography\", \"url\": \"https://ibighit.com/en/bts/discography/\", \"type\": \"Official\"}]', '[\"No More Dream is connected to BTS early debut message.\", \"The early concept focused on youth and dreams.\", \"This era helps explain the group name and early hip-hop identity.\"]', '[\"2013 marks the beginning of BTS as a released group.\", \"2 COOL 4 SKOOL is the starting point for official discography study.\", \"The early message asked young people to think about their own dreams.\"]', 3, 0, 0, '2026-05-13 07:26:31', '2026-05-14 02:31:08'),
(9, 'bts-discography-map', 'How to Explore BTS Discography', 'Music', 'Listening Guide', 'Beginner', 'A beginner map for exploring BTS music through official album pages, eras, and themes.', 'BTS discography can feel huge, so Baby ARMYs should explore it like a map. Start with the official discography page, then choose one era at a time. Early releases show youth and pressure. Later albums explore growth, love, identity, self-acceptance, and reflection. Do not rush. Listen to title tracks first, then B-sides, then live performances. A good fan site should guide people to official music pages and official videos so learners do not depend on random claims.', 'media-gallery/bts-discography-cover.jpg', '[\"media-gallery/bts-discography-1.jpg\", \"media-gallery/bts-discography-2.jpg\"]', 'media-gallery/bts-discography-video.jpg', 'https://ibighit.com/en/bts/discography/', 'https://www.youtube.com/channel/UCLkAepWjdylmXSltofFvsYQ', 'BIGHIT official discography', '[{\"label\": \"BTS Official Discography\", \"url\": \"https://ibighit.com/en/bts/discography/\", \"type\": \"Official\"}, {\"label\": \"BANGTANTV\", \"url\": \"https://www.youtube.com/channel/UCLkAepWjdylmXSltofFvsYQ\", \"type\": \"Official Video\"}]', '[\"Discography means the official list of releases.\", \"An era usually includes music, visuals, performances, styling, and messages.\", \"Baby ARMYs can learn better by studying one era at a time.\"]', '[\"Start with official album pages.\", \"Move from title tracks to B-sides.\", \"Use official videos to understand performances and concepts.\"]', 4, 0, 0, '2026-05-13 07:26:31', '2026-05-14 02:31:50'),
(10, 'love-yourself-era-guide', 'LOVE YOURSELF Era Guide', 'Music', 'Era Guide', 'Beginner', 'A gentle introduction to the Love Yourself message and why Answer matters in the series.', 'The LOVE YOURSELF era is one of the most important BTS learning paths for Baby ARMYs. BIGHIT describes LOVE YOURSELF 結 ANSWER as the final piece of the puzzle. The series is often connected with self-reflection, love, identity, and learning to accept yourself. For beginners, this era is a good place to understand how BTS connects music, story, visuals, and emotional message. When explaining this era, stay grounded in official album pages and avoid overclaiming hidden theories as facts.', 'media-gallery/love-yourself-cover.jpg', '[\"media-gallery/love-yourself-1.jpg\", \"media-gallery/love-yourself-2.jpg\"]', 'media-gallery/love-yourself-video.jpg', 'https://ibighit.com/en/bts/discography/detail/love_yourself-answer', 'https://www.youtube.com/channel/UCLkAepWjdylmXSltofFvsYQ', 'BIGHIT official album page', '[{\"label\": \"LOVE YOURSELF Answer Official Page\", \"url\": \"https://ibighit.com/en/bts/discography/detail/love_yourself-answer\", \"type\": \"Official\"}, {\"label\": \"BTS Discography\", \"url\": \"https://ibighit.com/en/bts/discography/\", \"type\": \"Official\"}]', '[\"ANSWER is described by BIGHIT as the final piece of the puzzle.\", \"This era is useful for learning about self-love themes.\", \"It is better to separate official album facts from fan theories.\"]', '[\"Study the Love Yourself releases in order.\", \"Use official album pages for facts.\", \"Use lyrics and performances carefully, without inventing meanings.\"]', 5, 0, 0, '2026-05-13 07:26:31', '2026-05-14 02:31:27'),
(11, 'proof-anthology-guide', 'Proof: BTS History in One Album', 'Music', 'Album Guide', 'Beginner', 'A beginner guide to Proof, the anthology album that looks back at BTS history.', 'Proof is an anthology album released by BTS on June 10, 2022. BIGHIT describes Proof as the core of BTS history. For Baby ARMYs, this album can work like a doorway into older eras because it collects key parts of the group journey. It is not just a random playlist. It is a reflection of where BTS came from, what their music represented, and how their story built over time. Use Proof as a listening map, then go backward into the original albums.', 'media-gallery/proof-cover.jpg', '[\"media-gallery/proof-1.jpg\", \"media-gallery/proof-2.jpg\"]', 'media-gallery/proof-video.jpg', 'https://ibighit.com/en/bts/discography/detail/proof', 'https://www.youtube.com/channel/UCLkAepWjdylmXSltofFvsYQ', 'BIGHIT official album page', '[{\"label\": \"Proof Official Page\", \"url\": \"https://ibighit.com/en/bts/discography/detail/proof\", \"type\": \"Official\"}, {\"label\": \"BTS Discography\", \"url\": \"https://ibighit.com/en/bts/discography/\", \"type\": \"Official\"}]', '[\"Proof is an anthology album.\", \"BIGHIT describes Proof as the core of BTS history.\", \"It is useful for new fans who want a guided entry into older eras.\"]', '[\"Use Proof as a summary of BTS history.\", \"Then explore the original releases behind the songs.\", \"Connect songs to their original eras for deeper understanding.\"]', 6, 0, 0, '2026-05-13 07:26:31', '2026-05-14 02:31:19'),
(12, 'official-bts-sources-guide', 'How to Check BTS Facts Safely', 'ARMY Culture', 'Source Guide', 'Beginner', 'A safety guide for Baby ARMYs: how to avoid fake BTS facts and use official sources.', 'Not every viral post is true. Baby ARMYs should learn how to check BTS facts before sharing them. Use the official BIGHIT profile for member information, official discography pages for albums, BANGTANTV and official music channels for video content, and official community announcements when available. Fan explanations can be helpful, but they should not replace official sources. A good ARMY learns, checks, and shares responsibly.', 'media-gallery/official-sources-cover.jpg', '[\"media-gallery/official-sources-1.jpg\", \"media-gallery/official-sources-2.jpg\"]', 'media-gallery/official-sources-video.jpg', 'https://ibighit.com/en/bts/profile/', 'https://www.youtube.com/channel/UCLkAepWjdylmXSltofFvsYQ', 'Official source guide', '[{\"label\": \"BTS Official Profile\", \"url\": \"https://ibighit.com/en/bts/profile/\", \"type\": \"Official\"}, {\"label\": \"BTS Official Discography\", \"url\": \"https://ibighit.com/en/bts/discography/\", \"type\": \"Official\"}, {\"label\": \"BANGTANTV\", \"url\": \"https://www.youtube.com/channel/UCLkAepWjdylmXSltofFvsYQ\", \"type\": \"Official Video\"}]', '[\"Official sources protect your site from spreading false information.\", \"Fan theories should be labeled as theories, not facts.\", \"A clean source habit makes your website more trusted.\"]', '[\"Check the official profile for member information.\", \"Check the official discography for albums.\", \"Check official video channels for performances and clips.\"]', 7, 0, 0, '2026-05-13 07:26:31', '2026-05-14 02:31:14'),
(13, 'bts-the-comeback-2026', 'BTS THE COMEBACK 2026', 'BTS 101', 'Guide', 'Intermidiate', 'After four years of eager anticipation, BTS made their grand return on March 20, 2026, releasing their new album ARIRANG. The comeback officially began with a sold-out, star-studded free concert in Seoul\'s Gwanghwamun Square on March 21, 2026, which was broadcast live to millions globally.', 'BTS launched their official 2026 comeback after completing their mandatory military service, culminating in a historic full-group return. The entire timeline spans from their internal reunions in mid-2025 to the conclusion of their massive 2026 stadium world tour.\r\n## 🌟 Phase 1: Reunion and Preparation (June 2025 – Early 2026)\r\nThe groundwork for the comeback was laid immediately following the discharge of the final group members from the military.\r\n\r\n* June 2025: All seven members officially complete their South Korean military service and hold a private internal reunion.\r\n* Late 2025: The group begins secret production on new music and choreography in Seoul, shifting away from their solo chapters.\r\n* January 16, 2026: Big Hit Music officially announces the comeback, opening global pre-orders for the new studio album.\r\n\r\n## 💿 Phase 2: The Album Release (March 2026)\r\nThe core of the comeback focused on the rollout of their fifth full-length studio project.\r\n\r\n* Album Title: ARIRANG, a 14-track studio album blending traditional Korean folk instruments with contemporary pop and hip-hop.\r\n* Lead Single: \"SWIM,\" a radio-friendly track designed for global streaming dominance.\r\n* March 17, 2026: Netflix debuts the official trailer for BTS: THE RETURN, a documentary chronicling their emotional reunion journey.\r\n* March 20, 2026: The ARIRANG album drops globally at 1:00 PM KST, instantly breaking multiple real-time streaming records.\r\n\r\n## 🎤 Phase 3: Live Relaunch and Promotional Events (March 2026)\r\nFollowing the digital drop, the group immediately transitioned to live public performances to re-engage their fanbase.\r\n\r\n* March 21, 2026: BTS hosts a massive live comeback concert at Gwanghwamun Square in Seoul.\r\n* Visual Direction: The members perform in modernized Korean cultural attire designed in collaboration with fashion house SONGZIO.\r\n* Global Broadcast: The live event is streamed globally on Netflix, directed by Emmy award-winner Hamish Hamilton.\r\n\r\n## 🗺️ Phase 4: The ARIRANG World Tour (April 2026 Onward)\r\nThe final phase of the comeback scales the project into a massive, multi-continental live stadium tour.\r\n\r\n* Tour Launch: The official 79-date world tour kicks off on April 9, 2026.\r\n* Geographic Scope: Spans 34 major cities across North America, Europe, Latin America, and Asia.\r\n* Stage Innovation: Performances leverage a unique 360-degree \"in-the-round\" center-stage layout built for maximum stadium capacity and fan immersion.', 'learning/bts-the-comeback-live-arirang-1778694632-OtQKMw.jfif', NULL, NULL, 'https://www.netflix.com/title/82157128', 'https://www.youtube.com/watch?v=2K7R68DmAfE', NULL, '[]', NULL, NULL, 0, 1, 1, '2026-05-13 13:50:32', '2026-05-13 13:50:32');

-- --------------------------------------------------------

--
-- Table structure for table `media_albums`
--

CREATE TABLE `media_albums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `cover_path` varchar(1000) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media_albums`
--

INSERT INTO `media_albums` (`id`, `slug`, `title`, `description`, `cover_path`, `sort_order`, `is_featured`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'bts-eras', 'BTS Eras', 'Photos and videos organized by BTS eras.', NULL, 1, 1, 1, '2026-05-13 05:23:56', '2026-05-13 05:23:56'),
(2, 'members', 'Members', 'Member-focused photos, edits, and clips.', NULL, 2, 1, 1, '2026-05-13 05:23:56', '2026-05-13 05:23:56'),
(3, 'bt21', 'BT21', 'BT21 characters, cute media, and animations.', NULL, 3, 0, 1, '2026-05-13 05:23:56', '2026-05-13 05:23:56'),
(4, 'concerts', 'Concerts', 'Stage, tours, fan moments, and performance clips.', NULL, 4, 0, 1, '2026-05-13 05:23:56', '2026-05-13 05:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `media_items`
--

CREATE TABLE `media_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `media_album_id` bigint(20) UNSIGNED DEFAULT NULL,
  `media_type` varchar(255) NOT NULL DEFAULT 'image',
  `title` varchar(255) NOT NULL,
  `caption` text DEFAULT NULL,
  `file_path` varchar(1000) DEFAULT NULL,
  `thumbnail_path` varchar(1000) DEFAULT NULL,
  `video_url` varchar(1000) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `taken_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media_items`
--

INSERT INTO `media_items` (`id`, `media_album_id`, `media_type`, `title`, `caption`, `file_path`, `thumbnail_path`, `video_url`, `tags`, `sort_order`, `is_featured`, `is_active`, `taken_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'image', 'BTS', '0t7 FOREVERRR', 'media-gallery/btssss-1778655308-k7Awl9.jfif', NULL, NULL, NULL, 0, 1, 1, NULL, '2026-05-13 02:45:26', '2026-05-13 14:03:27'),
(2, 2, 'image', 'Hobi', 'I am your hope, You are my hope, I am J-hope :)', 'media-gallery/u2605l01d4d0l01d4fel01d4fbl01d4eal01d4fc-l01d4f2l01d4ecl01d4f8l01d4f7l01d4fc-1778695293-7Tyoac.jfif', NULL, NULL, 'J-jope, Hobi, Sunshine, Hope', 0, 1, 1, NULL, '2026-05-13 14:01:33', '2026-05-13 14:02:45');

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
(1, 'rm', 'Kim Namjoon', 'RM', 'Kim Namjoon', '1994-09-12', 'Ilsan/Goyang, South Korea', NULL, '#7c3aed', 'KOYA', 'The thoughtful leader who turns chaos into poetry.', 'Leader · Rapper · Lyricist', 'rm.jfif', 'A calm brain, a giant heart, and words that feel like a deep purple sky.', 'RM is the leader and one of the strongest creative voices behind BTS. His vault focuses on leadership, lyrics, art energy, and reflective comfort.', '[\"Known for thoughtful speeches and interviews.\", \"Loves museums, books, nature, and art spaces.\", \"Represents the soft-intellectual side of BTS energy.\"]', '[\"Leadership\", \"Rap\", \"Lyrics\", \"Art lover\", \"English speaker\"]', NULL, NULL, 'RM', 'KOYA.png', 1, 1, '2026-05-08 12:00:00', '2026-05-13 14:04:23'),
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
(17, '2026_05_10_100000_split_learning_and_quizzes', 5),
(18, '2026_05_12_150000_upgrade_user_profiles_publish_ready', 6),
(19, '2026_05_12_170000_create_bts_updates_table', 7),
(20, '2026_05_12_180000_create_media_gallery_system', 8),
(21, '2026_05_14_000000_admin_profile_assets_and_user_controls', 9);

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
(2, 'Members', '/#members', 2, 1, '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(3, 'Learn', '/learn', 3, 1, '2026-05-10 08:44:31', '2026-05-10 08:44:31'),
(4, 'Timeline', '/bts-achievements', 5, 1, '2026-05-08 12:00:00', '2026-05-10 09:49:33'),
(5, 'Songs', '/songs', 6, 1, '2026-05-08 12:00:00', '2026-05-10 09:49:22'),
(6, 'Media Gallery', '/gallery', 7, 1, '2026-05-08 12:00:00', '2026-05-13 02:42:27'),
(7, 'Quotes', '/quotes', 8, 1, '2026-05-08 12:00:00', '2026-05-10 09:49:15'),
(8, 'BT21', '/bt21', 9, 1, '2026-05-08 12:00:00', '2026-05-10 09:49:11'),
(9, 'Leaderboard', '/leaderboard', 10, 1, '2026-05-08 12:00:00', '2026-05-10 09:49:07'),
(10, 'Vote', '/vote', 11, 1, '2026-05-08 12:00:00', '2026-05-10 09:48:59'),
(11, 'Quizzes', '/quizzes', 4, 1, '2026-05-10 08:44:31', '2026-05-10 08:44:31'),
(12, 'ARMY Profiles', '/army', 1, 1, '2026-05-12 11:12:23', '2026-05-12 11:12:23'),
(13, 'Profile', '/profile', 12, 1, '2026-05-12 11:13:04', '2026-05-12 11:13:04'),
(14, 'BangTan Updates', '/updates', 13, 1, '2026-05-12 13:59:36', '2026-05-12 13:59:36');

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
(42, 8, 'earn', 50, 'Welcome bonus', '{\"source\":\"registration\"}', '2026-05-10 10:48:30', '2026-05-10 10:48:30'),
(43, 7, 'earn', 12, 'Daily streak check-in', '{\"streak_days\":1}', '2026-05-12 11:32:30', '2026-05-12 11:32:30'),
(44, 9, 'earn', 50, 'Welcome bonus', '{\"source\":\"registration\"}', '2026-05-12 13:37:19', '2026-05-12 13:37:19'),
(45, 9, 'spend', -180, 'Unlocked profile upgrade: BT21 TATA Bundle', '{\"asset_key\":\"tata-bundle\"}', '2026-05-12 13:39:16', '2026-05-12 13:39:16'),
(46, 9, 'spend', -100, 'Unlocked profile upgrade: BT21 TATA Avatar', '{\"asset_key\":\"tata-avatar\"}', '2026-05-12 13:39:35', '2026-05-12 13:39:35'),
(47, 9, 'spend', -120, 'Unlocked profile upgrade: BT21 TATA Theme', '{\"asset_key\":\"tata-theme\"}', '2026-05-12 13:42:32', '2026-05-12 13:42:32'),
(48, 9, 'earn', 12, 'Daily streak check-in', '{\"streak_days\":1}', '2026-05-13 01:12:42', '2026-05-13 01:12:42'),
(49, 9, 'earn', 14, 'Daily streak check-in', '{\"streak_days\":2}', '2026-05-14 01:02:43', '2026-05-14 01:02:43'),
(50, 9, 'spend', -100, 'Unlocked profile upgrade: BT21 VAN Avatar', '{\"asset_key\":\"bt21-van-avatar\"}', '2026-05-14 01:57:51', '2026-05-14 01:57:51'),
(51, 9, 'spend', -120, 'Unlocked profile upgrade: BT21 CHIMMY Theme', '{\"asset_key\":\"chimmy-theme\"}', '2026-05-14 01:57:55', '2026-05-14 01:57:55'),
(52, 9, 'spend', -100, 'Unlocked profile upgrade: BT21 CHIMMY Avatar', '{\"asset_key\":\"chimmy-avatar\"}', '2026-05-14 01:57:58', '2026-05-14 01:57:58'),
(53, 9, 'spend', -120, 'Unlocked profile upgrade: BT21 KOYA Theme', '{\"asset_key\":\"koya-theme\"}', '2026-05-14 01:58:03', '2026-05-14 01:58:03'),
(54, 9, 'spend', -180, 'Unlocked profile upgrade: BT21 KOYA Bundle', '{\"asset_key\":\"koya-bundle\"}', '2026-05-14 01:58:09', '2026-05-14 01:58:09'),
(55, 9, 'spend', -180, 'Unlocked profile upgrade: BT21 SHOOKY Bundle', '{\"asset_key\":\"shooky-bundle\"}', '2026-05-14 01:58:13', '2026-05-14 01:58:13'),
(56, 9, 'spend', -180, 'Unlocked profile upgrade: BT21 COOKY Bundle', '{\"asset_key\":\"cooky-bundle\"}', '2026-05-14 01:58:18', '2026-05-14 01:58:18'),
(57, 9, 'spend', -180, 'Unlocked profile upgrade: BT21 RJ Bundle', '{\"asset_key\":\"rj-bundle\"}', '2026-05-14 01:58:22', '2026-05-14 01:58:22'),
(58, 9, 'spend', -100, 'Unlocked profile upgrade: BT21 KOYA Avatar', '{\"asset_key\":\"koya-avatar\"}', '2026-05-14 01:58:27', '2026-05-14 01:58:27'),
(59, 9, 'spend', -100, 'Unlocked profile upgrade: BT21 MANG Avatar', '{\"asset_key\":\"mang-avatar\"}', '2026-05-14 01:58:31', '2026-05-14 01:58:31'),
(60, 9, 'spend', -180, 'Unlocked profile upgrade: BT21 MANG Bundle', '{\"asset_key\":\"mang-bundle\"}', '2026-05-14 01:58:36', '2026-05-14 01:58:36'),
(61, 9, 'spend', -100, 'Unlocked profile upgrade: BT21 RJ Avatar', '{\"asset_key\":\"rj-avatar\"}', '2026-05-14 01:58:41', '2026-05-14 01:58:41'),
(62, 9, 'spend', -100, 'Unlocked profile upgrade: BT21 SHOOKY Avatar', '{\"asset_key\":\"shooky-avatar\"}', '2026-05-14 01:58:46', '2026-05-14 01:58:46'),
(63, 9, 'spend', -100, 'Unlocked profile upgrade: BT21 COOKY Avatar', '{\"asset_key\":\"cooky-avatar\"}', '2026-05-14 01:58:51', '2026-05-14 01:58:51'),
(64, 9, 'spend', -180, 'Unlocked profile upgrade: BT21 CHIMMY Bundle', '{\"asset_key\":\"chimmy-bundle\"}', '2026-05-14 01:58:57', '2026-05-14 01:58:57');

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
  `theme_class` varchar(255) DEFAULT NULL,
  `badge_label` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profile_assets`
--

INSERT INTO `profile_assets` (`id`, `key`, `label`, `type`, `description`, `cost`, `image_path`, `gradient`, `sort_order`, `is_active`, `created_at`, `updated_at`, `avatar_image`, `theme_class`, `badge_label`) VALUES
(25, 'purple-heart', 'Purple Heart Starter', 'bundle', 'Default ARMY starter profile bundle.', 0, 'favicons/logo.png', 'linear-gradient(135deg,#581c87,#a855f7,#111827)', 1, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', 'favicons/logo.png', 'purple-heart-theme', NULL),
(26, 'chimmy-avatar', 'BT21 CHIMMY Avatar', 'avatar', 'CUTE CHIMMY ENERGY 😭💛', 100, 'favicons/CHIMMY.png', NULL, 2, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', NULL, NULL, NULL),
(27, 'chimmy-theme', 'BT21 CHIMMY Theme', 'theme', 'Yellow cozy CHIMMY vibes.', 120, NULL, 'linear-gradient(135deg,#facc15,#fde68a,#78350f)', 3, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', NULL, 'chimmy-theme', NULL),
(28, 'chimmy-bundle', 'BT21 CHIMMY Bundle', 'bundle', 'Full CHIMMY profile pack.', 180, 'favicons/CHIMMY.png', 'linear-gradient(135deg,#facc15,#fde68a,#78350f)', 4, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', 'favicons/CHIMMY.png', 'chimmy-theme', NULL),
(29, 'tata-avatar', 'BT21 TATA Avatar', 'avatar', 'TATA chaotic energy.', 100, 'favicons/TATA.png', NULL, 5, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', NULL, NULL, NULL),
(30, 'tata-theme', 'BT21 TATA Theme', 'theme', 'Red cosmic TATA vibes.', 120, NULL, 'linear-gradient(135deg,#ef4444,#7f1d1d,#111827)', 6, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', NULL, 'tata-theme', NULL),
(31, 'tata-bundle', 'BT21 TATA Bundle', 'bundle', 'Full TATA profile pack.', 180, 'favicons/TATA.png', 'linear-gradient(135deg,#ef4444,#7f1d1d,#111827)', 7, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', 'favicons/TATA.png', 'tata-theme', NULL),
(32, 'koya-avatar', 'BT21 KOYA Avatar', 'avatar', 'Sleepy KOYA vibes.', 100, 'favicons/KOYA.png', NULL, 8, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', NULL, NULL, NULL),
(33, 'koya-theme', 'BT21 KOYA Theme', 'theme', 'Dreamy blue KOYA galaxy.', 120, NULL, 'linear-gradient(135deg,#60a5fa,#1e3a8a,#111827)', 9, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', NULL, 'koya-theme', NULL),
(34, 'koya-bundle', 'BT21 KOYA Bundle', 'bundle', 'Full KOYA profile pack.', 180, 'favicons/KOYA.png', 'linear-gradient(135deg,#60a5fa,#1e3a8a,#111827)', 10, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', 'favicons/KOYA.png', 'koya-theme', NULL),
(35, 'rj-avatar', 'BT21 RJ Avatar', 'avatar', 'Soft fluffy RJ vibes.', 100, 'favicons/RJ.png', NULL, 11, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', NULL, NULL, NULL),
(36, 'rj-bundle', 'BT21 RJ Bundle', 'bundle', 'Full RJ profile pack.', 180, 'favicons/RJ.png', 'linear-gradient(135deg,#f8fafc,#d1d5db,#6b7280)', 12, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', 'favicons/RJ.png', 'rj-theme', NULL),
(37, 'shooky-avatar', 'BT21 SHOOKY Avatar', 'avatar', 'Sassy SHOOKY chaos.', 100, 'favicons/SHOOKY.png', NULL, 13, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', NULL, NULL, NULL),
(38, 'shooky-bundle', 'BT21 SHOOKY Bundle', 'bundle', 'Full SHOOKY profile pack.', 180, 'favicons/SHOOKY.png', 'linear-gradient(135deg,#92400e,#451a03,#111827)', 14, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', 'favicons/SHOOKY.png', 'shooky-theme', NULL),
(39, 'cooky-avatar', 'BT21 COOKY Avatar', 'avatar', 'Buff pink bunny energy.', 100, 'favicons/COOKY.png', NULL, 15, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', NULL, NULL, NULL),
(40, 'cooky-bundle', 'BT21 COOKY Bundle', 'bundle', 'Full COOKY profile pack.', 180, 'favicons/COOKY.png', 'linear-gradient(135deg,#f472b6,#831843,#111827)', 16, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', 'favicons/COOKY.png', 'cooky-theme', NULL),
(41, 'mang-avatar', 'BT21 MANG Avatar', 'avatar', 'Mysterious dance horse vibes.', 100, 'favicons/MANG.png', NULL, 17, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', NULL, NULL, NULL),
(42, 'mang-bundle', 'BT21 MANG Bundle', 'bundle', 'Full MANG profile pack.', 180, 'favicons/MANG.png', 'linear-gradient(135deg,#a855f7,#312e81,#111827)', 18, 1, '2026-05-09 21:01:10', '2026-05-09 21:01:10', 'favicons/MANG.png', 'mang-theme', NULL),
(43, 'bt21-van-avatar', 'BT21 VAN Avatar', 'avatar', '⚔️POWERFUL GUARDIAN ENERGY 🛡️🥷🏽', 100, 'profile-assets/van-1778738237-aEPLiX.png', NULL, 0, 1, '2026-05-14 01:57:17', '2026-05-14 01:57:17', 'profile-assets/van-1778738237-uKlVNG.png', NULL, NULL);

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
(10, 'quiz-bts-101-start-here', 'BTS 101: Start Here Quiz', 'BTS 101', 'easy', 'A beginner-safe quiz for Baby ARMYs learning who BTS are, how many members there are, and where to check official facts.', 'learning/baby-army-cover-1778695016-5ZvZtZ.jfif', 0, 10, 25, 1, 1, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(11, 'quiz-members-and-bt21-map', 'Members + BT21 Map Quiz', 'Members', 'easy', 'A clean quiz about the seven BTS members and the difference between BTS members and BT21 characters.', 'learning/download-4-1778739383-HbPd6e.jpg', 0, 10, 25, 2, 1, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(12, 'quiz-baby-army-start-here', 'Baby ARMY Starter Quiz', 'BTS 101', 'easy', 'A soft starter quiz for new ARMYs using only stable beginner BTS facts.', 'learning/yoongi-20130604-1778694994-2kZwlG.jpg', 0, 10, 25, 3, 1, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(13, 'quiz-seven-bts-members', 'The 7 BTS Members Quiz', 'Members', 'easy', 'Practice the official seven-member lineup and respectful fan learning basics.', 'learning/bts0t7-1778740081-UrWA9b.jpg', 0, 10, 25, 4, 1, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(14, 'quiz-discography-starter', 'BTS Discography Starter Quiz', 'Music', 'medium', 'A beginner quiz about official discography, albums, eras, and safe learning habits.', 'media-gallery/bts-discography-cover.jpg', 0, 15, 35, 5, 0, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(15, 'quiz-love-yourself-guide', 'LOVE YOURSELF Era Quiz', 'Music', 'medium', 'A quiz about the Love Yourself era using official album-page facts and careful wording.', 'media-gallery/love-yourself-cover.jpg', 0, 15, 35, 6, 0, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(16, 'quiz-proof-anthology-guide', 'Proof Anthology Quiz', 'Music', 'medium', 'A quiz about Proof as an anthology album and why it helps Baby ARMYs explore BTS history.', 'media-gallery/proof-cover.jpg', 0, 15, 35, 7, 0, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(17, 'quiz-official-sources-guide', 'Official Sources Quiz', 'ARMY Culture', 'easy', 'A quiz about checking BTS facts safely and avoiding fake viral claims.', 'media-gallery/official-sources-cover.jpg', 0, 10, 25, 8, 0, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(18, 'quiz-bts-comeback-2026', 'BTS Comeback 2026 Quiz', 'BTS 101', 'medium', 'A careful quiz for your comeback topic, focused on source-checking and not spreading unverified claims.', 'learning/bts-the-comeback-live-arirang-1778694632-lUVOpg.jpg', 0, 15, 35, 9, 0, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29');

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
(40, 10, 'What does BTS also refer to?', '[\"Bangtan Sonyeondan\", \"Big Time Stars\", \"Bright Team Seoul\", \"Born To Sing\"]', 0, 'BTS is also known as Bangtan Sonyeondan.', 10, 1, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(41, 10, 'How many members are in BTS?', '[\"5\", \"6\", \"7\", \"8\"]', 2, 'BTS has seven members.', 10, 2, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(42, 10, 'Which list contains only BTS members?', '[\"RM, Jin, SUGA, j-hope, Jimin, V, Jung Kook\", \"RM, Jin, Yeonjun, Jimin, V, Jung Kook, SUGA\", \"Jin, SUGA, Lisa, Jimin, V, RM, Jung Kook\", \"RM, Jin, Felix, j-hope, Jimin, V, Jung Kook\"]', 0, 'The official lineup is RM, Jin, SUGA, j-hope, Jimin, V, and Jung Kook.', 10, 3, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(43, 10, 'Which source is safest for checking basic BTS member facts?', '[\"Official BIGHIT profile\", \"Random comment section\", \"Unverified fan edit\", \"Meme page\"]', 0, 'Official sources are safest for basic facts.', 10, 4, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(44, 10, 'What should a Baby ARMY do before sharing a BTS fact?', '[\"Check a trusted source\", \"Share instantly\", \"Only trust screenshots\", \"Ignore dates\"]', 0, 'Checking sources helps avoid false information.', 10, 5, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(45, 11, 'What is BT21 on your learning page?', '[\"A character universe connected to BTS\", \"A BTS album title\", \"A music award name\", \"A concert venue\"]', 0, 'BT21 refers to the character universe connected to BTS, not the seven human members themselves.', 10, 1, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(46, 11, 'What is the best way to explain BTS members and BT21 to Baby ARMYs?', '[\"BTS members are real artists; BT21 are characters\", \"BT21 replaced BTS\", \"BT21 are album producers\", \"BTS and BT21 are the same exact thing\"]', 0, 'Keep it clear: BTS members are real artists, while BT21 are characters.', 10, 2, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(47, 11, 'Which BTS member name is officially styled with a hyphen?', '[\"j-hope\", \"J Hopee\", \"Hope-J\", \"Jhope King\"]', 0, 'The official stage name is styled j-hope.', 10, 3, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(48, 11, 'Which is the correct official spelling used by BIGHIT?', '[\"Jung Kook\", \"JungCook\", \"Jungkookiee\", \"Jung Kookie Only\"]', 0, 'The official profile uses Jung Kook.', 10, 4, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(49, 11, 'Why should the BT21 page stay separate from member profiles?', '[\"Because BT21 characters need their own fun character space\", \"Because members should be hidden\", \"Because BT21 is not allowed on fan sites\", \"Because profiles should have no images\"]', 0, 'A separate BT21 space keeps member profiles respectful and gives characters a fun colorful section.', 10, 5, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(50, 12, 'What is the best starting point for a Baby ARMY?', '[\"Learn the members and use official sources\", \"Memorize every rumor\", \"Only read fanwars\", \"Skip all official pages\"]', 0, 'Baby ARMYs should start with members, music, and trusted official sources.', 10, 1, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(51, 12, 'What is ARMY?', '[\"The name used by BTS fans\", \"A BTS member\", \"A BT21 character\", \"A solo album\"]', 0, 'ARMY is the name used by BTS fans.', 10, 2, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(52, 12, 'Which statement is most respectful?', '[\"BTS members are real artists and should be described accurately\", \"Rumors are always facts\", \"Edits are official sources\", \"Fan theories must be presented as confirmed\"]', 0, 'Respectful fan content should be accurate and clearly sourced.', 10, 3, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(53, 12, 'Which official place helps Baby ARMYs learn the member lineup?', '[\"BIGHIT BTS profile\", \"Random repost account\", \"Unlabeled screenshot\", \"Comment rumor thread\"]', 0, 'The BIGHIT BTS profile is an official source for member information.', 10, 4, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(54, 12, 'What should your site avoid?', '[\"Fake claims and unsourced drama\", \"Official links\", \"Respectful wording\", \"Beginner guides\"]', 0, 'Avoid fake claims and unsourced drama to keep the site trustworthy.', 10, 5, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(55, 13, 'Which member list is correct?', '[\"RM, Jin, SUGA, j-hope, Jimin, V, Jung Kook\", \"RM, Jin, SUGA, Jisoo, Jimin, V, Jung Kook\", \"RM, Jin, SUGA, Yeonjun, Jimin, V, Jung Kook\", \"RM, Jin, Felix, j-hope, Jimin, V, Jung Kook\"]', 0, 'BTS has seven members: RM, Jin, SUGA, j-hope, Jimin, V, and Jung Kook.', 10, 1, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(56, 13, 'Which name is written in all caps on the official BTS profile?', '[\"SUGA\", \"Suga Min\", \"Sugaaa\", \"Yoongi Only\"]', 0, 'The official stage name is SUGA.', 10, 2, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(57, 13, 'What is the safest wording for member roles?', '[\"Use broad respectful descriptions and official profile facts\", \"Invent private details\", \"Use rumors as facts\", \"Make dramatic claims with no source\"]', 0, 'Use respectful descriptions and official facts.', 10, 3, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(58, 13, 'Why does the number 7 matter in BTS learning?', '[\"BTS has seven members\", \"BTS has seven official fandoms\", \"BTS debuted in 2007\", \"BTS has only seven songs\"]', 0, 'Seven matters because BTS has seven members.', 10, 4, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(59, 13, 'What should a member quiz test?', '[\"Clear public facts and respectful knowledge\", \"Private rumors\", \"Fake gossip\", \"Unverified claims\"]', 0, 'A good fan quiz should use clear public facts and respectful knowledge.', 10, 5, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(60, 14, 'What does discography mean?', '[\"A list of music releases\", \"A food menu\", \"A dance-only game\", \"A profile avatar\"]', 0, 'Discography means the official list of music releases.', 15, 1, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(61, 14, 'What is a good way for Baby ARMYs to explore BTS music?', '[\"One era at a time\", \"Memorize everything in one day\", \"Only read comments\", \"Ignore official pages\"]', 0, 'One era at a time is easier and safer for learning.', 15, 2, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(62, 14, 'Which official page helps users explore BTS albums?', '[\"BTS official discography\", \"Random comments\", \"A meme page\", \"A deleted screenshot\"]', 0, 'The official BTS discography page is the best album map.', 15, 3, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(63, 14, 'Which BTS debut-era release is connected to No More Dream?', '[\"2 COOL 4 SKOOL\", \"Proof\", \"LOVE YOURSELF Answer\", \"BE\"]', 0, 'BIGHIT connects No More Dream with 2 COOL 4 SKOOL.', 15, 4, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(64, 14, 'What should come before fan theories when studying an era?', '[\"Official release facts\", \"Unverified rumors\", \"Random screenshots\", \"Fake hidden meanings\"]', 0, 'Official release facts should come first.', 15, 5, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(65, 15, 'How does BIGHIT describe LOVE YOURSELF 結 ANSWER?', '[\"The final piece of the puzzle\", \"The first BTS single album\", \"A cooking show\", \"A fan-made playlist\"]', 0, 'BIGHIT describes LOVE YOURSELF 結 ANSWER as the final piece of the puzzle.', 15, 1, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(66, 15, 'What is a careful way to teach the Love Yourself era?', '[\"Use official album pages and avoid presenting theories as facts\", \"Make up hidden lore\", \"Use only rumors\", \"Ignore album context\"]', 0, 'Official album pages and careful wording keep the lesson trustworthy.', 15, 2, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(67, 15, 'Which theme is commonly connected with the Love Yourself learning path?', '[\"Self-reflection and self-acceptance\", \"Cooking recipes\", \"Airport schedules only\", \"Football results\"]', 0, 'The Love Yourself learning path is commonly connected with self-reflection and self-acceptance.', 15, 3, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(68, 15, 'What should your site call fan interpretations?', '[\"Interpretations or theories\", \"Confirmed official facts\", \"Legal announcements\", \"Private documents\"]', 0, 'Fan interpretations should be labeled clearly, not treated as confirmed facts.', 15, 4, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(69, 15, 'What does a beginner learn from this era?', '[\"BTS can connect music, message, visuals, and emotion\", \"BTS only makes one type of song\", \"BTS has no album concepts\", \"Only memes matter\"]', 0, 'The era helps beginners see how BTS connects music, message, visuals, and emotion.', 15, 5, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(70, 16, 'What type of album is Proof?', '[\"Anthology album\", \"Debut single album\", \"Fan-made playlist\", \"Only a concert poster\"]', 0, 'BIGHIT describes Proof as an anthology album.', 15, 1, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(71, 16, 'When did BIGHIT say Proof was released?', '[\"June 10, 2022\", \"June 13, 2013\", \"August 24, 2018\", \"January 1, 2026\"]', 0, 'The official Proof page says it was released on June 10, 2022.', 15, 2, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(72, 16, 'What does BIGHIT call Proof?', '[\"The core of BTS history\", \"A fashion catalog only\", \"A random remix board\", \"A fan theory page\"]', 0, 'BIGHIT describes Proof as the core of BTS history.', 15, 3, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(73, 16, 'Why is Proof useful for Baby ARMYs?', '[\"It works like a doorway into BTS history\", \"It removes all older eras\", \"It is not connected to BTS music\", \"It is only a meme\"]', 0, 'Proof can help new fans explore BTS history and earlier releases.', 15, 4, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(74, 16, 'What should learners do after listening to Proof?', '[\"Explore the original eras behind the songs\", \"Assume Proof is the only BTS release\", \"Ignore older albums\", \"Only read comments\"]', 0, 'Proof can be a map into the original releases and eras.', 15, 5, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(75, 17, 'Which source is safest for official member names?', '[\"BIGHIT BTS profile\", \"Unverified edit\", \"Random screenshot\", \"Comment section\"]', 0, 'The BIGHIT BTS profile is an official source.', 10, 1, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(76, 17, 'Which source is safest for official album information?', '[\"BIGHIT BTS discography\", \"A meme page\", \"A fanwar thread\", \"A random reupload\"]', 0, 'The official discography is best for album facts.', 10, 2, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(77, 17, 'What should be checked before posting a BTS update?', '[\"Source and date\", \"Only font color\", \"Emoji count\", \"Number of likes only\"]', 0, 'Checking source and date helps avoid spreading old or false information.', 10, 3, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(78, 17, 'What is wrong with presenting fan theories as facts?', '[\"It can mislead people\", \"It makes the site official\", \"It improves accuracy\", \"It replaces sources\"]', 0, 'Fan theories should be labeled clearly so users are not misled.', 10, 4, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(79, 17, 'What makes your website more trustworthy?', '[\"Official links and careful wording\", \"Fake drama\", \"Unverified claims\", \"No sources ever\"]', 0, 'Official links and careful wording make the site more trusted.', 10, 5, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(80, 18, 'For a current comeback topic, what is the safest rule?', '[\"Only publish confirmed updates with sources\", \"Post every rumor fast\", \"Ignore dates\", \"Use fake screenshots\"]', 0, 'Current-event pages should use confirmed sources and dates.', 15, 1, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(81, 18, 'What should you do if a comeback detail is not confirmed?', '[\"Label it as unconfirmed or do not post it\", \"Write it as fact\", \"Make it dramatic\", \"Hide the source\"]', 0, 'Unconfirmed information should not be presented as fact.', 15, 2, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(82, 18, 'What belongs in a responsible comeback update?', '[\"Title, date, source link, and careful wording\", \"No source and big claims\", \"Private rumors\", \"Fake schedules\"]', 0, 'A responsible update should include source links and careful wording.', 15, 3, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(83, 18, 'Which type of link should comeback posts prefer?', '[\"Official or trusted source links\", \"Random screenshots only\", \"Rumor accounts only\", \"Broken links\"]', 0, 'Official or trusted links are safer for current BTS updates.', 15, 4, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29'),
(84, 18, 'Why should your comeback quiz avoid fixed claims unless verified?', '[\"Because current details can change\", \"Because facts are boring\", \"Because users do not care\", \"Because sources do not matter\"]', 0, 'Current information can change, so verified source-based wording is safer.', 15, 5, 1, '2026-05-14 06:46:29', '2026-05-14 06:46:29');

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
('a300Gm5a3mA5HS8Z982bNS4mttIrmWLSOihrxWuj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid3FKMzMzZEw2TmNSa1pTRzJCWFplRThOV1VLTzB1aGh4Q09jR2kyUyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9fQ==', 1778820281),
('C6FoH0CIv7OdyBOfajzyDg89ydjVGCHu5FGkZJq7', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSTdGWDVJTGRaOGZnMExYVThvRDlKWTBZYzhzMmo2cjdQZklRc0dSZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9sZWFybmluZy1tYXRlcmlhbHMiO3M6NToicm91dGUiO3M6MzA6ImFkbWluLmxlYXJuaW5nLW1hdGVyaWFscy5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1778696843),
('r4D3EPLAWEtJlF9xpmMGmhO7P8AkxdzhNBSAS6TB', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicTVVaHIzeHdOaDBEMkxZWXVCSFB4MkNPTmU3T3ZhbDBlUlpXdUppdyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sZWFybi9idHMtbWVtYmVycy1vZmZpY2lhbC1ndWlkZSI7czo1OiJyb3V0ZSI7czoxMDoibGVhcm4uc2hvdyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1778741836),
('tK17yhf8F2ZOE7ZlKo6qQ5Di1toGQpaKuVHaQnJn', 9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMldMajJaNnM3MmZ6SmNVRVhVcWI1cE11ckYxOVRBbFl3RW94dktHRCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sZWFybi9idHMtbWVtYmVycy1vZmZpY2lhbC1ndWlkZSI7czo1OiJyb3V0ZSI7czoxMDoibGVhcm4uc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjk7fQ==', 1778742721),
('TNDKZOsuWH3pM363uFLj5uprvswPBwovm5McACXk', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMTNTcVF6cU1XVG5ZWEc4aFpQc08xT3pUSGJsTUZqOHBOSVlibmhVaSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9idHMtYWNoaWV2ZW1lbnRzIjtzOjU6InJvdXRlIjtzOjEyOiJhY2hpZXZlbWVudHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1778698617),
('zCYrkFkxp0AtReaWgW1HCEnjHYhmaNb4MwqX500h', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNTV0alRFVXJxQ0JNRGNxdDN4ZlhXZjRhd1NiTHZlc1JvZnU5ZHdNQSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9sZWFybmluZy1tYXRlcmlhbHMiO3M6NToicm91dGUiO3M6MzA6ImFkbWluLmxlYXJuaW5nLW1hdGVyaWFscy5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1778742715);

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
(1, 'site_title', 'BangTan', '2026-05-08 12:00:00', '2026-05-15 00:37:00'),
(2, 'site_subtitle', 'A dark purple BTS learning website with member profiles, songs, gallery, quotes, BT21 anatomy profiles, quizzes, points, streaks, and leaderboard.', '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(3, 'hero_kicker', 'BTS FOREVER · ARMY HOMEBASE', '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(4, 'hero_title', 'BangTan', '2026-05-08 12:00:00', '2026-05-15 00:37:00'),
(5, 'hero_body', 'A fan-made BTS hub where ARMY can learn, explore member vaults, take quizzes, earn points, unlock profile upgrades, and climb the leaderboard.', '2026-05-08 12:00:00', '2026-05-08 12:00:00'),
(6, 'footer_text', 'BangTan is a fan-made website created with love. Please support official BTS channels whenever possible.', '2026-05-08 12:00:00', '2026-05-15 00:37:00'),
(7, 'admin_email', 'support@bangtan.info', '2026-05-08 12:00:00', '2026-05-15 00:37:00'),
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
  `badge_key` varchar(255) DEFAULT NULL,
  `profile_visibility` varchar(255) NOT NULL DEFAULT 'public',
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

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `is_admin`, `avatar_key`, `profile_theme`, `badge_key`, `profile_visibility`, `bio`, `points`, `streak_days`, `last_streak_date`, `google_id`, `auth_provider`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mehak Arman', '⊹ฺ Frostnap⁷♪⟭⟬VH3W💜 ⊹ฺ', 'admin@bangtan.info', NULL, '$2y$12$dRyzUmm6ZFILv2wl1fOHCuy7iDEwUIZKUbskdVo7xa7kkxW.yHRZe', 1, 'purple-heart', 'galaxy-purple', NULL, 'public', NULL, 7777777, 1, '2026-05-10', NULL, 'email', 'a8AinkDAnUYzIn1VdQTHzJPVCmskI0XAhm6WCO2xr5wtM1eW0vSOfpc4aJWA', '2026-05-08 12:00:00', '2026-05-15 00:39:16'),
(7, 'Hamdan Arman', '6_7', 'hamdanarmaan@gmail.com', NULL, '$2y$12$XlDYktFO5OCirbPfsr0lk.Za5MnDJTKA1M.wLnX4XpPw8a7y.pyV2', 0, 'favicons/TATA.png', 'tata-theme', NULL, 'public', '67', 50, 1, '2026-05-12', NULL, 'email', 'q72pd1t26Z2AfLP0rTAPGpgyhKryCXpHVuOQTpmML3O9q5M6BDr74QdfiDqm', '2026-05-09 12:45:32', '2026-05-12 11:32:30'),
(8, 'Mahreen Arman', 'ARMY_BTS_0t7I_-6-7', 'mahreenarmaan10@gmail.com', NULL, '$2y$12$8GBbL5u6jEM/cuM36lpWgukiBg2q8fqjxwKQUzwJq9DT.oLACoR5.', 0, 'favicons/logo.png', 'purple-heart-theme', NULL, 'public', '6-7', 50, 0, NULL, NULL, 'email', NULL, '2026-05-10 10:48:30', '2026-05-10 10:49:48'),
(9, 'Mehak Arman', '7Minus1_is_0', 'mehakarmaan1@gmail.com', NULL, '$2y$12$OwEKnd8rtzpeFqvdhHFCw.CmYIMHxvAlYw1mw9lTY0moK0om8.zc2', 0, 'favicons/TATA.png', 'tata-theme', 'MeeehAk_ArMy_0t7', 'public', 'Hiiii Mehak here BTS FOREVERRRRRRRRR -I’m here to celebrate BTS, connect with ARMY, and keep my favorite songs, moments, and memories in one place.', 7777777, 7777777, '2026-05-14', NULL, 'email', 'cCE6P684AIkQxjHtscFznezJzgZOZMEgFOGISIwGd0BboRdYqNFGNJ2JYExR', '2026-05-12 13:37:19', '2026-05-14 02:04:55');

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
(29, 8, 25, '2026-05-10 14:48:30'),
(30, 9, 25, '2026-05-12 17:37:20'),
(31, 9, 31, '2026-05-12 17:39:16'),
(32, 9, 29, '2026-05-12 17:39:35'),
(33, 9, 30, '2026-05-12 17:42:32'),
(34, 9, 43, '2026-05-14 05:57:51'),
(35, 9, 27, '2026-05-14 05:57:55'),
(36, 9, 26, '2026-05-14 05:57:58'),
(37, 9, 33, '2026-05-14 05:58:03'),
(38, 9, 34, '2026-05-14 05:58:09'),
(39, 9, 38, '2026-05-14 05:58:13'),
(40, 9, 40, '2026-05-14 05:58:18'),
(41, 9, 36, '2026-05-14 05:58:22'),
(42, 9, 32, '2026-05-14 05:58:27'),
(43, 9, 41, '2026-05-14 05:58:31'),
(44, 9, 42, '2026-05-14 05:58:36'),
(45, 9, 35, '2026-05-14 05:58:41'),
(46, 9, 37, '2026-05-14 05:58:46'),
(47, 9, 39, '2026-05-14 05:58:51'),
(48, 9, 28, '2026-05-14 05:58:57');

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
(3, 8, 5, NULL, NULL, NULL, '2026-05-10 10:50:44', '2026-05-10 10:50:44'),
(4, 9, 6, NULL, NULL, NULL, '2026-05-13 03:34:47', '2026-05-13 03:34:47');

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
-- Indexes for table `bts_updates`
--
ALTER TABLE `bts_updates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bts_updates_slug_unique` (`slug`);

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
-- Indexes for table `media_albums`
--
ALTER TABLE `media_albums`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_albums_slug_unique` (`slug`);

--
-- Indexes for table `media_items`
--
ALTER TABLE `media_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_items_media_album_id_foreign` (`media_album_id`);

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
-- AUTO_INCREMENT for table `bts_updates`
--
ALTER TABLE `bts_updates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `daily_checkins`
--
ALTER TABLE `daily_checkins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `media_albums`
--
ALTER TABLE `media_albums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `media_items`
--
ALTER TABLE `media_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `nav_items`
--
ALTER TABLE `nav_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `point_transactions`
--
ALTER TABLE `point_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `profile_assets`
--
ALTER TABLE `profile_assets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `quiz_games`
--
ALTER TABLE `quiz_games`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `quiz_game_attempts`
--
ALTER TABLE `quiz_game_attempts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quiz_game_questions`
--
ALTER TABLE `quiz_game_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_profile_assets`
--
ALTER TABLE `user_profile_assets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daily_checkins`
--
ALTER TABLE `daily_checkins`
  ADD CONSTRAINT `daily_checkins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `media_items`
--
ALTER TABLE `media_items`
  ADD CONSTRAINT `media_items_media_album_id_foreign` FOREIGN KEY (`media_album_id`) REFERENCES `media_albums` (`id`) ON DELETE SET NULL;

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
