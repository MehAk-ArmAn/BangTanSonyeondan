-- BangTanSonyeondan Professional Glow-Up DB Update
-- Run this in phpMyAdmin if you do NOT want to use Laravel migrations/seeders.
-- Recommended Laravel way:
--   php artisan migrate
--   php artisan db:seed --class=GlowUpContentSeeder

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` longtext NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `site_settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `nav_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `sort_order` int unsigned NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `votes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `member_id` bigint unsigned NULL,
  `member_name` varchar(255) NULL,
  `ip_address` varchar(255) NULL,
  `user_agent` text NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `votes_member_id_index` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `timeline_events` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `year` varchar(20) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'Milestone',
  `title` varchar(255) NOT NULL,
  `body` longtext NULL,
  `bullet_points` json NULL,
  `image_paths` json NULL,
  `sort_order` int unsigned NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Safe column upgrades. MariaDB 10.4 supports IF NOT EXISTS.
ALTER TABLE `members`
  ADD COLUMN IF NOT EXISTS `slug` varchar(255) NULL AFTER `id`,
  ADD COLUMN IF NOT EXISTS `stage_name` varchar(255) NULL AFTER `name`,
  ADD COLUMN IF NOT EXISTS `korean_name` varchar(255) NULL AFTER `stage_name`,
  ADD COLUMN IF NOT EXISTS `birth_date` date NULL AFTER `korean_name`,
  ADD COLUMN IF NOT EXISTS `birthplace` varchar(255) NULL AFTER `birth_date`,
  ADD COLUMN IF NOT EXISTS `emoji` varchar(20) NULL AFTER `birthplace`,
  ADD COLUMN IF NOT EXISTS `accent_color` varchar(30) NULL AFTER `emoji`,
  ADD COLUMN IF NOT EXISTS `bt21_character` varchar(255) NULL AFTER `accent_color`,
  ADD COLUMN IF NOT EXISTS `intro_title` varchar(255) NULL AFTER `bt21_character`,
  ADD COLUMN IF NOT EXISTS `profile_story` longtext NULL AFTER `quote`,
  ADD COLUMN IF NOT EXISTS `fun_facts` json NULL AFTER `profile_story`,
  ADD COLUMN IF NOT EXISTS `skill_tags` json NULL AFTER `fun_facts`,
  ADD COLUMN IF NOT EXISTS `spotify_url` varchar(1000) NULL AFTER `skill_tags`,
  ADD COLUMN IF NOT EXISTS `instagram_url` varchar(1000) NULL AFTER `spotify_url`,
  ADD COLUMN IF NOT EXISTS `sort_order` int unsigned NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `is_active` tinyint(1) NOT NULL DEFAULT 1;

ALTER TABLE `gallery_images`
  ADD COLUMN IF NOT EXISTS `caption` varchar(255) NULL AFTER `img_path`,
  ADD COLUMN IF NOT EXISTS `category` varchar(255) NOT NULL DEFAULT 'Gallery' AFTER `caption`,
  ADD COLUMN IF NOT EXISTS `sort_order` int unsigned NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `is_active` tinyint(1) NOT NULL DEFAULT 1,
  ADD COLUMN IF NOT EXISTS `created_at` timestamp NULL DEFAULT NULL,
  ADD COLUMN IF NOT EXISTS `updated_at` timestamp NULL DEFAULT NULL;

ALTER TABLE `quotes`
  ADD COLUMN IF NOT EXISTS `context` varchar(255) NULL AFTER `quote`,
  ADD COLUMN IF NOT EXISTS `is_active` tinyint(1) NOT NULL DEFAULT 1;

ALTER TABLE `songs_images`
  ADD COLUMN IF NOT EXISTS `release_date` date NULL AFTER `img_path`,
  ADD COLUMN IF NOT EXISTS `description` text NULL AFTER `release_date`,
  ADD COLUMN IF NOT EXISTS `era` varchar(255) NULL AFTER `description`,
  ADD COLUMN IF NOT EXISTS `spotify_url` varchar(1000) NULL AFTER `era`,
  ADD COLUMN IF NOT EXISTS `sort_order` int unsigned NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `is_active` tinyint(1) NOT NULL DEFAULT 1;

-- Admin user. Default login after this SQL:
-- Email: admin@bangtansonyeondan.com
-- Password: Army@2026!
INSERT INTO `users` (`name`, `email`, `password`, `created_at`, `updated_at`)
VALUES ('BTS Admin', 'admin@bangtansonyeondan.com', '$2y$12$jvALgX8e.R/0Zli/IQd9mOJD.0L0bPGDsIL1SwbOgBeWfVC8wBnyO', NOW(), NOW())
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `password` = VALUES(`password`), `updated_at` = NOW();

INSERT INTO `site_settings` (`key`, `value`, `created_at`, `updated_at`) VALUES
('site_title','BangTanSonyeondan',NOW(),NOW()),
('site_subtitle','A purple-red, polished BangTanSonyeondan website for BTS members, music, memories, quotes, timelines, and ARMY energy.',NOW(),NOW()),
('hero_kicker','âŸ­âŸ¬ BTS FOREVER Â· ARMY HOMEBASE âŸ¬âŸ­',NOW(),NOW()),
('hero_title','✨💜 ＢＡＮＧＴＡＮ ＳＯＮＹＥＯＮＤＡＮ 💜✨ — fun, organized, purple-red, and actually useful.',NOW(),NOW()),
('hero_body','Explore member vaults, eras, songs, quotes, gallery moments, votes, and timeline highlights in one clean BangTanSonyeondan website built for real ARMY browsing.',NOW(),NOW()),
('footer_text','BangTanSonyeondan is a fan-made website created with love. Please support official BTS channels whenever possible.',NOW(),NOW()),
('admin_email','hello@bangtansonyeondan.com',NOW(),NOW()),
('location','ARMY Hub',NOW(),NOW()),
('creator_name','Mehak Arman',NOW(),NOW())
ON DUPLICATE KEY UPDATE `value`=VALUES(`value`), `updated_at`=NOW();

DELETE FROM `nav_items`;
INSERT INTO `nav_items` (`label`,`url`,`sort_order`,`is_active`,`created_at`,`updated_at`) VALUES
('Home','/',1,1,NOW(),NOW()),('Members','/#members',2,1,NOW(),NOW()),('Timeline','/bts-achievements',3,1,NOW(),NOW()),('Songs','/songs',4,1,NOW(),NOW()),('Gallery','/gallery',5,1,NOW(),NOW()),('Quotes','/quotes',6,1,NOW(),NOW()),('BT21','/bt21',7,1,NOW(),NOW()),('Vote','/vote',8,1,NOW(),NOW());

-- Update member vaults. Existing rows are upgraded by real name.
UPDATE `members` SET `slug`='rm',`stage_name`='RM',`korean_name`='ê¹€ë‚¨ì¤€',`birth_date`='1994-09-12',`birthplace`='Ilsan/Goyang, South Korea',`emoji`='ðŸ¨',`accent_color`='#7c3aed',`bt21_character`='KOYA',`intro_title`='The thoughtful leader who turns chaos into poetry.',`profile_story`='RM is the group leader and one of the strongest creative voices behind BTS. His vault is leadership, lyrics, art energy, and reflective purple aura.',`skill_tags`=JSON_ARRAY('Leadership','Rap','Lyrics','Art lover','English speaker'),`fun_facts`=JSON_ARRAY('Known for deep speeches and thoughtful interviews.','Loves museums, books, nature, and art spaces.','Represents the soft-intellectual side of BTS energy.'),`sort_order`=1,`is_active`=1 WHERE `name`='Kim Namjoon';
UPDATE `members` SET `slug`='jin',`stage_name`='Jin',`korean_name`='ê¹€ì„ì§„',`birth_date`='1992-12-04',`birthplace`='Gwacheon, South Korea',`emoji`='ðŸ¹',`accent_color`='#ec4899',`bt21_character`='RJ',`intro_title`='The worldwide handsome mood-maker with silver vocals.',`profile_story`='Jin brings warmth, humor, confidence, and emotional vocals. His vault feels like a sparkling royal comedy room: wholesome, iconic, and secretly powerful.',`skill_tags`=JSON_ARRAY('Vocal','Visual','Variety','Confidence','Humor'),`fun_facts`=JSON_ARRAY('Known for Worldwide Handsome energy.','Often brings comfort through emotional solo songs.','Can turn any serious moment into a legendary meme.'),`sort_order`=2,`is_active`=1 WHERE `name`='Kim Seokjin';
UPDATE `members` SET `slug`='suga',`stage_name`='SUGA',`korean_name`='ë¯¼ìœ¤ê¸°',`birth_date`='1993-03-09',`birthplace`='Daegu, South Korea',`emoji`='ðŸ±',`accent_color`='#64748b',`bt21_character`='SHOOKY',`intro_title`='The quiet producer with savage lyrics and soft-core honesty.',`profile_story`='SUGA is the production brain, sharp rapper, and emotional storyteller. His vault is moody, cinematic, and honest.',`skill_tags`=JSON_ARRAY('Rap','Production','Piano','Songwriting','Agust D'),`fun_facts`=JSON_ARRAY('Known for direct, honest writing.','Has a strong producer identity beyond performance.','Calm vibe: half sleepy cat, half studio monster.'),`sort_order`=3,`is_active`=1 WHERE `name`='Min Yoongi';
UPDATE `members` SET `slug`='jhope',`stage_name`='j-hope',`korean_name`='ì •í˜¸ì„',`birth_date`='1994-02-18',`birthplace`='Gwangju, South Korea',`emoji`='ðŸŒž',`accent_color`='#f59e0b',`bt21_character`='MANG',`intro_title`='The sunshine engine who turns practice into fireworks.',`profile_story`='j-hope is movement, precision, and joy. His vault feels like stage lights switching on: dance practice, sunshine, rap flow, and motivation.',`skill_tags`=JSON_ARRAY('Dance','Rap','Performance','Choreography','Energy'),`fun_facts`=JSON_ARRAY('Known for powerful dance leadership.','Bright energy backed by serious discipline.','His stage presence can flip a whole room instantly.'),`sort_order`=4,`is_active`=1 WHERE `name`='Jung Hoseok';
UPDATE `members` SET `slug`='jimin',`stage_name`='Jimin',`korean_name`='ë°•ì§€ë¯¼',`birth_date`='1995-10-13',`birthplace`='Busan, South Korea',`emoji`='ðŸ£',`accent_color`='#a855f7',`bt21_character`='CHIMMY',`intro_title`='The graceful performer with angel vocals and lethal duality.',`profile_story`='Jimin brings elegance, emotion, and powerful dance detail. His vault feels delicate and dramatic at the same time.',`skill_tags`=JSON_ARRAY('Dance','Vocal','Performance','Duality','Contemporary'),`fun_facts`=JSON_ARRAY('Known for expressive dance lines.','Balances softness and intensity on stage.','Has one of the most recognizable performance auras in BTS.'),`sort_order`=5,`is_active`=1 WHERE `name`='Park Jimin';
UPDATE `members` SET `slug`='v',`stage_name`='V',`korean_name`='ê¹€íƒœí˜•',`birth_date`='1995-12-30',`birthplace`='Daegu, South Korea',`emoji`='ðŸ»',`accent_color`='#14b8a6',`bt21_character`='TATA',`intro_title`='The velvet-voiced art prince with cinematic energy.',`profile_story`='V brings color, mood, and a film-like presence. His vault feels like vintage jazz, fashion editorials, soft photography, and charisma.',`skill_tags`=JSON_ARRAY('Vocal','Jazz tone','Visual','Acting','Fashion'),`fun_facts`=JSON_ARRAY('Known for a deep, warm vocal color.','Loves art, photography, jazz, and classic aesthetics.','His expressions can change a whole stage mood.'),`sort_order`=6,`is_active`=1 WHERE `name`='Kim Taehyung';
UPDATE `members` SET `slug`='jungkook',`stage_name`='Jung Kook',`korean_name`='ì „ì •êµ­',`birth_date`='1997-09-01',`birthplace`='Busan, South Korea',`emoji`='ðŸ°',`accent_color`='#22c55e',`bt21_character`='COOKY',`intro_title`='The golden maknae built like a final boss character.',`profile_story`='Jung Kook is the powerhouse all-rounder: vocals, dance, performance, athletic energy, and playful maknae chaos.',`skill_tags`=JSON_ARRAY('Vocal','Dance','Performance','Sports','Golden Maknae'),`fun_facts`=JSON_ARRAY('Known as the Golden Maknae.','Has strong vocals and sharp stage focus.','Somehow both chaotic and perfectionist.'),`sort_order`=7,`is_active`=1 WHERE `name`='Jeon Jungkook';

DELETE FROM `quotes`;
INSERT INTO `quotes` (`source`,`quote`,`context`,`is_active`,`created_at`,`updated_at`) VALUES
('RM','Some songs feel like a map back to yourself.','Reflection',1,NOW(),NOW()),('Jin','Confidence can be funny, soft, and powerful at the same time.','Comfort',1,NOW(),NOW()),('SUGA','Healing is not always loud. Sometimes it is just honest.','Honesty',1,NOW(),NOW()),('j-hope','Energy is a choice, and he chooses sunshine with discipline.','Motivation',1,NOW(),NOW()),('Jimin','Grace hits hardest when it carries emotion.','Performance',1,NOW(),NOW()),('V','A deep voice can turn one quiet second into cinema.','Mood',1,NOW(),NOW()),('Jung Kook','Talent becomes legendary when effort refuses to sleep.','Growth',1,NOW(),NOW()),('ARMY','Seven people. Millions of stories. One purple-red stage.','Fandom',1,NOW(),NOW());

DELETE FROM `timeline_events`;
INSERT INTO `timeline_events` (`year`,`category`,`title`,`body`,`bullet_points`,`image_paths`,`sort_order`,`is_active`,`created_at`,`updated_at`) VALUES
('2013','Debut','Debut with 2 Cool 4 Skool','BTS began their journey with a sharp hip-hop identity, rookie energy, and a message that questioned pressure placed on young people.',JSON_ARRAY('Debut era begins','ARMY origin story starts','School Trilogy foundation'),JSON_ARRAY('imgs/timeline/2013/1.jfif','imgs/timeline/2013/2.jfif'),1,1,NOW(),NOW()),
('2015','Breakthrough','The Most Beautiful Moment in Life era','The HYYH era gave BTS a deeper cinematic identity with youth, friendship, struggle, and growth at the center.',JSON_ARRAY('Emotional storytelling expands','Music videos become lore-heavy','BTS identity matures'),JSON_ARRAY(),2,1,NOW(),NOW()),
('2017','Global','Billboard breakthrough and wider global attention','BTS moved from rising stars to global conversation, with social reach and international fandom becoming impossible to ignore.',JSON_ARRAY('Global fanbase grows rapidly','US award-show visibility increases','Love Yourself era begins'),JSON_ARRAY('imgs/timeline/2017/1.jfif','imgs/timeline/2017/2.jfif'),3,1,NOW(),NOW()),
('2018','Message','Love Yourself and Speak Yourself impact','Their message expanded beyond music into self-love, youth voice, and cultural impact.',JSON_ARRAY('Love Yourself message becomes central','Bigger stadium-scale presence','Global media focus'),JSON_ARRAY('imgs/timeline/2018/1.jfif','imgs/timeline/2018/2.jfif'),4,1,NOW(),NOW()),
('2020','Record Era','Dynamite, BE, and worldwide comfort','BTS reached another global peak while releasing music that brought brightness and comfort during a difficult year.',JSON_ARRAY('Dynamite era explodes worldwide','BE carries a softer healing tone','BTS becomes a household global pop name'),JSON_ARRAY('imgs/timeline/2020/1.jfif','imgs/timeline/2020/2.jfif'),5,1,NOW(),NOW()),
('2022','Reflection','Proof anthology era','Proof looked back across the group journey and framed their story as something still moving forward.',JSON_ARRAY('Anthology project','Career reflection','Promise of the future'),JSON_ARRAY(),7,1,NOW(),NOW()),
('2023â€“2025','Solo Chapter','Solo era and individual colors','Each member explored solo identity, showing different sounds, styles, and personal artistic colors while the seven-member story stayed connected.',JSON_ARRAY('Solo albums and singles','Member identities shine','Group bond remains central'),JSON_ARRAY('imgs/timeline/2023/1.jfif','imgs/timeline/2023/2.jfif','imgs/timeline/2023/3.jfif'),8,1,NOW(),NOW());

DELETE FROM `songs_images`;
INSERT INTO `songs_images` (`name`,`img_path`,`release_date`,`description`,`era`,`sort_order`,`is_active`,`created_at`,`updated_at`) VALUES
('No More Dream','imgs/songs/1.jfif','2013-06-12','Debut era attitude: bold, raw, and hungry.','School Trilogy',1,1,NOW(),NOW()),
('I NEED U','imgs/songs/5.jfif','2015-04-29','A turning-point era with youth, pain, and cinematic emotion.','HYYH',2,1,NOW(),NOW()),
('Spring Day','imgs/songs/10.jfif','2017-02-13','A timeless comfort song with soft winter-to-spring feeling.','You Never Walk Alone',3,1,NOW(),NOW()),
('DNA','imgs/songs/13.jfif','2017-09-18','Bright, colorful, and made for global discovery.','Love Yourself',4,1,NOW(),NOW()),
('FAKE LOVE','imgs/songs/16.jfif','2018-05-18','Dark, dramatic, and iconic for the Love Yourself era.','Love Yourself',5,1,NOW(),NOW()),
('IDOL','imgs/songs/18.jfif','2018-08-24','A loud celebration of identity and performance.','Love Yourself',6,1,NOW(),NOW()),
('Boy With Luv','imgs/songs/21.jfif','2019-04-12','Sweet pop energy with a worldwide sing-along feeling.','Map of the Soul',7,1,NOW(),NOW()),
('Black Swan','imgs/songs/24.jfif','2020-01-17','Art-film energy, shadow themes, and elegant darkness.','Map of the Soul',8,1,NOW(),NOW()),
('Dynamite','imgs/songs/27.jfif','2020-08-21','Disco-bright global pop with instant serotonin.','English Singles',9,1,NOW(),NOW()),
('Life Goes On','imgs/songs/30.jfif','2020-11-20','Soft pandemic-era comfort wrapped in warmth.','BE',10,1,NOW(),NOW()),
('Butter','imgs/songs/33.jfif','2021-05-21','Smooth, playful, and built for summer domination.','English Singles',11,1,NOW(),NOW()),
('Permission to Dance','imgs/songs/36.jfif','2021-07-09','A hopeful, open-air celebration of moving again.','English Singles',12,1,NOW(),NOW()),
('Yet To Come','imgs/songs/40.jfif','2022-06-10','A reflective promise that the best is still ahead.','Proof',13,1,NOW(),NOW()),
('Run BTS','imgs/songs/43.jfif','2022-06-10','Hard-hitting proof that BTS never stopped running.','Proof',14,1,NOW(),NOW()),
('Take Two','imgs/songs/46.jfif','2023-06-09','A fan-letter feeling made for ARMY and anniversary season.','Anniversary',15,1,NOW(),NOW());

UPDATE `gallery_images` SET `category`='Gallery', `caption`=COALESCE(`caption`, `name`), `is_active`=1 WHERE `category` IS NULL OR `category`='';
UPDATE `gallery_images` SET `sort_order`=`id` WHERE `sort_order`=0 OR `sort_order` IS NULL;


