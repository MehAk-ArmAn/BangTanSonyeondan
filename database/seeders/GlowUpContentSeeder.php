<?php

namespace Database\Seeders;

use App\Models\GalleryImage;
use App\Models\LearningLesson;
use App\Models\Member;
use App\Models\NavItem;
use App\Models\ProfileAsset;
use App\Models\QuizQuestion;
use App\Models\Quote;
use App\Models\SiteSetting;
use App\Models\SongImage;
use App\Models\TimelineEvent;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GlowUpContentSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@bangtansonyeondan.com'],
            [
                'name' => 'BTS Admin',
                'username' => 'bts_admin',
                'password' => Hash::make('Army@2026!'),
                'is_admin' => true,
                'avatar_key' => 'purple-heart',
                'profile_theme' => 'galaxy-purple',
                'points' => 0,
                'auth_provider' => 'email',
            ]
        );

        $demoUsers = [
            ['MehakARMY', 'mehak_army', 'mehak@example.com', 680, 9, 'BTS forever. Purple blood mode on.'],
            ['PurpleMochi', 'purple_mochi', 'mochi@example.com', 520, 6, 'Learning every era one quiz at a time.'],
            ['MoonChild', 'moon_child', 'moon@example.com', 430, 4, 'RM lyrics saved my brain.'],
            ['GoldenBunny', 'golden_bunny', 'bunny@example.com', 390, 3, 'Quiz first, sleep later.'],
        ];

        foreach ($demoUsers as [$name, $username, $email, $points, $streak, $bio]) {
            User::updateOrCreate(['email' => $email], [
                'name' => $name,
                'username' => $username,
                'password' => Hash::make('Army@2026!'),
                'is_admin' => false,
                'avatar_key' => 'purple-heart',
                'profile_theme' => 'galaxy-purple',
                'bio' => $bio,
                'points' => $points,
                'streak_days' => $streak,
                'auth_provider' => 'email',
            ]);
        }

        $settings = [
            'site_title' => 'BangTanSonyeondan',
            'site_subtitle' => 'A dark purple BTS learning website with member profiles, songs, gallery, quotes, BT21 anatomy profiles, quizzes, points, streaks, and leaderboard.',
            'hero_kicker' => 'BTS FOREVER · ARMY HOMEBASE',
            'hero_title' => 'BangTanSonyeondan',
            'hero_body' => 'A fan-made BTS hub where ARMY can learn, explore member vaults, take quizzes, earn points, unlock profile upgrades, and climb the leaderboard.',
            'footer_text' => 'BangTanSonyeondan is a fan-made website created with love. Please support official BTS channels whenever possible.',
            'admin_email' => 'hello@bangtansonyeondan.com',
            'location' => 'ARMY Hub',
            'creator_name' => 'Mehak Arman',
            'phone' => '',
            'instagram' => '',
            'linkedin' => '',
            'twitter' => '',
            'youtube' => '',
            'tiktok' => '',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        $navItems = [
            ['Home', '/', 1],
            ['Members', '/#members', 2],
            ['Learn', '/learn', 3],
            ['Timeline', '/bts-achievements', 4],
            ['Songs', '/songs', 5],
            ['Gallery', '/gallery', 6],
            ['Quotes', '/quotes', 7],
            ['BT21', '/bt21', 8],
            ['Leaderboard', '/leaderboard', 9],
            ['Vote', '/vote', 10],
        ];

        foreach ($navItems as [$label, $url, $order]) {
            NavItem::updateOrCreate(['url' => $url], [
                'label' => $label,
                'sort_order' => $order,
                'is_active' => true,
            ]);
        }

        $members = [
            [
                'slug' => 'rm', 'name' => 'Kim Namjoon', 'stage_name' => 'RM', 'nickname' => 'RM',
                'korean_name' => 'Kim Namjoon', 'role' => 'Leader · Rapper · Lyricist', 'birth_date' => '1994-09-12',
                'birthplace' => 'Ilsan/Goyang, South Korea', 'emoji' => 'KOYA', 'accent_color' => '#7c3aed',
                'bt21_character' => 'KOYA', 'image' => 'rm.jfif', 'favicon' => 'KOYA.png', 'sort_order' => 1,
                'intro_title' => 'The thoughtful leader who turns chaos into poetry.',
                'quote' => 'A calm brain, a giant heart, and words that feel like a deep purple sky.',
                'profile_story' => 'RM is the leader and one of the strongest creative voices behind BTS. His vault focuses on leadership, lyrics, art energy, and reflective comfort.',
                'skill_tags' => ['Leadership', 'Rap', 'Lyrics', 'Art lover', 'English speaker'],
                'fun_facts' => ['Known for thoughtful speeches and interviews.', 'Loves museums, books, nature, and art spaces.', 'Represents the soft-intellectual side of BTS energy.'],
            ],
            [
                'slug' => 'jin', 'name' => 'Kim Seokjin', 'stage_name' => 'Jin', 'nickname' => 'Jin',
                'korean_name' => 'Kim Seokjin', 'role' => 'Vocalist · Visual · Worldwide Handsome', 'birth_date' => '1992-12-04',
                'birthplace' => 'Gwacheon, South Korea', 'emoji' => 'RJ', 'accent_color' => '#ec4899',
                'bt21_character' => 'RJ', 'image' => 'jin.jfif', 'favicon' => 'RJ.png', 'sort_order' => 2,
                'intro_title' => 'The worldwide handsome mood-maker with silver vocals.',
                'quote' => 'A vocal prince with dad jokes, elegance, and full chaos mode unlocked.',
                'profile_story' => 'Jin brings warmth, humor, confidence, and emotional vocals. His vault feels wholesome, royal, funny, and secretly powerful.',
                'skill_tags' => ['Vocal', 'Visual', 'Variety', 'Confidence', 'Humor'],
                'fun_facts' => ['Known for Worldwide Handsome energy.', 'Often brings comfort through emotional solo songs.', 'Can turn any serious moment into a legendary meme.'],
            ],
            [
                'slug' => 'suga', 'name' => 'Min Yoongi', 'stage_name' => 'SUGA', 'nickname' => 'Suga',
                'korean_name' => 'Min Yoongi', 'role' => 'Rapper · Producer · Songwriter', 'birth_date' => '1993-03-09',
                'birthplace' => 'Daegu, South Korea', 'emoji' => 'SHOOKY', 'accent_color' => '#64748b',
                'bt21_character' => 'SHOOKY', 'image' => 'suga.jfif', 'favicon' => 'SHOOKY.png', 'sort_order' => 3,
                'intro_title' => 'The quiet producer with savage lyrics and soft-core honesty.',
                'quote' => 'Calm outside, thunder in the studio, comfort in the lyrics.',
                'profile_story' => 'SUGA is the production brain, sharp rapper, and emotional storyteller. His page is moody, cinematic, and honest.',
                'skill_tags' => ['Rap', 'Production', 'Piano', 'Songwriting', 'Agust D'],
                'fun_facts' => ['Known for direct, honest writing.', 'Has a strong producer identity beyond performance.', 'His calm vibe is half sleepy cat, half studio monster.'],
            ],
            [
                'slug' => 'jhope', 'name' => 'Jung Hoseok', 'stage_name' => 'j-hope', 'nickname' => 'Hobi',
                'korean_name' => 'Jung Hoseok', 'role' => 'Rapper · Main Dancer · Performance Leader', 'birth_date' => '1994-02-18',
                'birthplace' => 'Gwangju, South Korea', 'emoji' => 'MANG', 'accent_color' => '#f59e0b',
                'bt21_character' => 'MANG', 'image' => 'jhope.jfif', 'favicon' => 'MANG.png', 'sort_order' => 4,
                'intro_title' => 'The sunshine engine who turns practice into fireworks.',
                'quote' => 'Bright smile, beast-mode dance lines, and stage energy that wakes the planet.',
                'profile_story' => 'j-hope is movement, precision, and joy. His vault feels like stage lights switching on: dance practice, sunshine, rap flow, and motivation.',
                'skill_tags' => ['Dance', 'Rap', 'Performance', 'Choreography', 'Energy'],
                'fun_facts' => ['Known for powerful dance leadership.', 'Brings bright energy with serious discipline.', 'His stage presence can flip a whole room instantly.'],
            ],
            [
                'slug' => 'jimin', 'name' => 'Park Jimin', 'stage_name' => 'Jimin', 'nickname' => 'Jimin',
                'korean_name' => 'Park Jimin', 'role' => 'Vocalist · Dancer', 'birth_date' => '1995-10-13',
                'birthplace' => 'Busan, South Korea', 'emoji' => 'CHIMMY', 'accent_color' => '#a855f7',
                'bt21_character' => 'CHIMMY', 'image' => 'jimin.jfif', 'favicon' => 'CHIMMY.png', 'sort_order' => 5,
                'intro_title' => 'The graceful performer with angel vocals and lethal duality.',
                'quote' => 'Soft voice, sharp movement, and stage duality that should honestly be illegal.',
                'profile_story' => 'Jimin brings elegance, emotion, and powerful dance detail. His vault feels delicate and dramatic at the same time.',
                'skill_tags' => ['Dance', 'Vocal', 'Performance', 'Duality', 'Contemporary'],
                'fun_facts' => ['Known for expressive dance lines.', 'Balances softness and intensity on stage.', 'Has one of the most recognizable performance auras in BTS.'],
            ],
            [
                'slug' => 'v', 'name' => 'Kim Taehyung', 'stage_name' => 'V', 'nickname' => 'V',
                'korean_name' => 'Kim Taehyung', 'role' => 'Vocalist · Visual · Actor', 'birth_date' => '1995-12-30',
                'birthplace' => 'Daegu, South Korea', 'emoji' => 'TATA', 'accent_color' => '#14b8a6',
                'bt21_character' => 'TATA', 'image' => 'v.jfif', 'favicon' => 'TATA.png', 'sort_order' => 6,
                'intro_title' => 'The velvet-voiced art prince with cinematic energy.',
                'quote' => 'Jazz soul, deep voice, model aura, and facial expressions that tell whole stories.',
                'profile_story' => 'V brings color, mood, and a film-like presence. His vault feels like vintage jazz, fashion editorials, soft photography, and mysterious charisma.',
                'skill_tags' => ['Vocal', 'Jazz tone', 'Visual', 'Acting', 'Fashion'],
                'fun_facts' => ['Known for a deep, warm vocal color.', 'Loves art, photography, jazz, and classic aesthetics.', 'His expressions can change a whole stage mood.'],
            ],
            [
                'slug' => 'jungkook', 'name' => 'Jeon Jungkook', 'stage_name' => 'Jung Kook', 'nickname' => 'JK',
                'korean_name' => 'Jeon Jungkook', 'role' => 'Main Vocalist · Performer · Golden Maknae', 'birth_date' => '1997-09-01',
                'birthplace' => 'Busan, South Korea', 'emoji' => 'COOKY', 'accent_color' => '#22c55e',
                'bt21_character' => 'COOKY', 'image' => 'jk.jfif', 'favicon' => 'COOKY.png', 'sort_order' => 7,
                'intro_title' => 'The golden maknae built like a final boss character.',
                'quote' => 'Vocals, dance, sports, art, chaos — bro downloaded the all-rounder expansion pack.',
                'profile_story' => 'Jung Kook is the powerhouse all-rounder: vocals, dance, performance, athletic energy, and playful maknae chaos.',
                'skill_tags' => ['Vocal', 'Dance', 'Performance', 'Sports', 'Golden Maknae'],
                'fun_facts' => ['Known as the Golden Maknae.', 'Has strong vocals and sharp stage focus.', 'Somehow manages to be both chaotic and perfectionist.'],
            ],
        ];

        foreach ($members as $member) {
            Member::updateOrCreate(['name' => $member['name']], array_merge($member, ['is_active' => true]));
        }

        $quotes = [
            ['RM', 'Some songs feel like a map back to yourself.', 'Reflection'],
            ['Jin', 'Confidence can be funny, soft, and powerful at the same time.', 'Comfort'],
            ['SUGA', 'Healing is not always loud. Sometimes it is just honest.', 'Honesty'],
            ['j-hope', 'Energy is a choice, and he chooses sunshine with discipline.', 'Motivation'],
            ['Jimin', 'Grace hits hardest when it carries emotion.', 'Performance'],
            ['V', 'A deep voice can turn one quiet second into cinema.', 'Mood'],
            ['Jung Kook', 'Talent becomes legendary when effort refuses to sleep.', 'Growth'],
            ['ARMY', 'Seven people. Millions of stories. One purple stage.', 'Fandom'],
        ];

        foreach ($quotes as [$source, $quote, $context]) {
            Quote::updateOrCreate(['source' => $source, 'quote' => $quote], ['context' => $context, 'is_active' => true]);
        }

        $songs = [
            ['No More Dream', 'imgs/songs/1.jfif', '2013-06-12', 'Debut era attitude: bold, raw, and hungry.', 'School Trilogy', 1],
            ['I NEED U', 'imgs/songs/5.jfif', '2015-04-29', 'A turning-point era with youth, pain, and cinematic emotion.', 'HYYH', 2],
            ['Spring Day', 'imgs/songs/10.jfif', '2017-02-13', 'A timeless comfort song with soft winter-to-spring feeling.', 'You Never Walk Alone', 3],
            ['DNA', 'imgs/songs/13.jfif', '2017-09-18', 'Bright, colorful, and made for global discovery.', 'Love Yourself', 4],
            ['FAKE LOVE', 'imgs/songs/16.jfif', '2018-05-18', 'Dark, dramatic, and iconic for the Love Yourself era.', 'Love Yourself', 5],
            ['IDOL', 'imgs/songs/18.jfif', '2018-08-24', 'A loud celebration of identity and performance.', 'Love Yourself', 6],
            ['Boy With Luv', 'imgs/songs/21.jfif', '2019-04-12', 'Sweet pop energy with a worldwide sing-along feeling.', 'Map of the Soul', 7],
            ['Black Swan', 'imgs/songs/24.jfif', '2020-01-17', 'Art-film energy, shadow themes, and elegant darkness.', 'Map of the Soul', 8],
            ['Dynamite', 'imgs/songs/27.jfif', '2020-08-21', 'Disco-bright global pop with instant serotonin.', 'English Singles', 9],
            ['Life Goes On', 'imgs/songs/30.jfif', '2020-11-20', 'Soft pandemic-era comfort wrapped in warmth.', 'BE', 10],
            ['Butter', 'imgs/songs/33.jfif', '2021-05-21', 'Smooth, playful, and built for summer domination.', 'English Singles', 11],
            ['Permission to Dance', 'imgs/songs/36.jfif', '2021-07-09', 'A hopeful, open-air celebration of moving again.', 'English Singles', 12],
            ['Yet To Come', 'imgs/songs/40.jfif', '2022-06-10', 'A reflective promise that the best is still ahead.', 'Proof', 13],
            ['Run BTS', 'imgs/songs/43.jfif', '2022-06-10', 'Hard-hitting proof that BTS never stopped running.', 'Proof', 14],
            ['Take Two', 'imgs/songs/46.jfif', '2023-06-09', 'A fan-letter feeling made for ARMY and anniversary season.', 'Anniversary', 15],
        ];

        foreach ($songs as [$name, $img, $date, $description, $era, $order]) {
            SongImage::updateOrCreate(['name' => $name], [
                'img_path' => $img, 'release_date' => $date, 'description' => $description,
                'era' => $era, 'sort_order' => $order, 'is_active' => true,
            ]);
        }

        $timeline = [
            ['2013', 'Debut', 'Debut with 2 Cool 4 Skool', 'BTS began their journey with a sharp hip-hop identity, rookie energy, and a message that questioned pressure placed on young people.', ['Debut era begins', 'ARMY origin story starts', 'School Trilogy foundation'], ['imgs/timeline/2013/1.jfif', 'imgs/timeline/2013/2.jfif'], 1],
            ['2016', 'Recognition', 'First major awards and wider recognition', 'BTS started moving from promising rookies to serious award-season names, building momentum through performance and storytelling.', ['Korean award visibility increases', 'Bigger stages', 'Fandom grows stronger'], [], 2],
            ['2017', 'Global', 'Billboard breakthrough and global attention', 'BTS moved from rising stars to global conversation, with international fandom becoming impossible to ignore.', ['Global fanbase grows rapidly', 'US award-show visibility increases', 'Love Yourself era begins'], ['imgs/timeline/2017/1.jfif', 'imgs/timeline/2017/2.jfif'], 3],
            ['2018', 'Message', 'Love Yourself and Speak Yourself impact', 'Their message expanded beyond music into self-love, youth voice, and cultural impact.', ['Love Yourself message becomes central', 'Bigger stadium-scale presence', 'Global media focus'], ['imgs/timeline/2018/1.jfif', 'imgs/timeline/2018/2.jfif'], 4],
            ['2020', 'Record Era', 'Dynamite, BE, and worldwide comfort', 'BTS reached another global peak while releasing music that brought brightness and comfort during a difficult year.', ['Dynamite era explodes worldwide', 'BE carries a softer healing tone', 'BTS becomes a household global pop name'], ['imgs/timeline/2020/1.jfif', 'imgs/timeline/2020/2.jfif'], 5],
            ['2021', 'Stadium Pop', 'Butter and Permission to Dance', 'BTS leaned into polished pop brightness while keeping the fan connection strong.', ['English singles era continues', 'Performance scale grows', 'ARMY moments everywhere'], [], 6],
            ['2022', 'Reflection', 'Proof anthology era', 'Proof looked back across the group journey and framed their story as something still moving forward.', ['Anthology project', 'Career reflection', 'Promise of the future'], [], 7],
            ['2023-2025', 'Solo Chapter', 'Solo era and individual colors', 'Each member explored solo identity, showing different sounds, styles, and personal artistic colors while the seven-member story stayed connected.', ['Solo albums and singles', 'Member identities shine', 'Group bond remains central'], ['imgs/timeline/2023/1.jfif', 'imgs/timeline/2023/2.jfif', 'imgs/timeline/2023/3.jfif'], 8],
        ];

        foreach ($timeline as [$year, $category, $title, $body, $bullets, $images, $order]) {
            TimelineEvent::updateOrCreate(['year' => $year, 'title' => $title], [
                'category' => $category, 'body' => $body, 'bullet_points' => $bullets,
                'image_paths' => $images, 'sort_order' => $order, 'is_active' => true,
            ]);
        }

        $gallery = [
            ['Purple Energy', 'extra_gallery/BTS.jfif', 'Group energy for the hero mood.', 'Group', 1],
            ['Meme Museum', 'extra_gallery/HAHAHA.jfif', 'Because BTS funny moments deserve a museum wing.', 'Meme', 2],
            ['Run Era Mood', 'extra_gallery/run.jfif', 'High-energy era card.', 'Era', 3],
            ['Life Goes On Comfort', 'extra_gallery/lifeGoesOn.jfif', 'Soft comfort energy.', 'Era', 4],
            ['Taekook Moment', 'extra_gallery/taekook.jfif', 'Friendship member moment.', 'Members', 5],
            ['Jimin Smile', 'extra_gallery/jiminSmile.jfif', 'Soft gallery highlight.', 'Members', 6],
            ['Jin Smile', 'extra_gallery/jinSmile.jfif', 'Worldwide handsome gallery highlight.', 'Members', 7],
            ['SUGA Mood', 'extra_gallery/suga.jfif', 'Calm but powerful.', 'Members', 8],
        ];

        foreach ($gallery as [$name, $path, $caption, $category, $order]) {
            GalleryImage::updateOrCreate(['name' => $name, 'img_path' => $path], [
                'caption' => $caption, 'category' => $category, 'sort_order' => $order, 'is_active' => true,
            ]);
        }

        $lessons = [
            [
                'slug' => 'bts-origin-story', 'title' => 'BTS Origin Story', 'category' => 'BTS 101',
                'excerpt' => 'Learn how BTS started, what their early identity was, and why their message felt different.',
                'body' => "BTS debuted in 2013 with a hip-hop-heavy identity and a message focused on young people, pressure, dreams, and self-expression.\n\nTheir early school trilogy was not just about looking cool. It questioned expectations and gave fans lyrics that felt direct. This is why the website teaches the story first: BTS is easier to understand when you see the message behind the eras.\n\nKey idea: BTS grew because music, performance, personality, and ARMY connection all worked together.",
                'reward_points' => 30, 'sort_order' => 1,
                'questions' => [
                    ['Which year did BTS debut?', ['2011', '2013', '2016', '2020'], 1, 'BTS debuted in 2013.'],
                    ['What was a major theme in early BTS music?', ['Youth pressure and dreams', 'Cooking shows only', 'Space travel only', 'Sports commentary'], 0, 'Early BTS lyrics often explored youth, pressure, dreams, and identity.'],
                    ['Why is learning the story important?', ['It makes quizzes harder only', 'It helps fans understand the message behind the eras', 'It replaces the songs', 'It hides member profiles'], 1, 'The story gives meaning to songs, eras, and achievements.'],
                ],
            ],
            [
                'slug' => 'members-and-roles', 'title' => 'Members and Roles', 'category' => 'Member Vaults',
                'excerpt' => 'A simple guide to the seven members, their broad roles, and the energy each one brings.',
                'body' => "BTS has seven members: RM, Jin, SUGA, j-hope, Jimin, V, and Jung Kook.\n\nRM is the leader and rapper. Jin brings vocals, humor, and comfort. SUGA is a rapper and producer. j-hope is a dancer, rapper, and performance leader. Jimin brings vocals and dance with graceful detail. V brings deep vocals and cinematic mood. Jung Kook is the main vocalist and all-rounder.\n\nThe member vault pages are built so each profile feels personal instead of being just a boring card.",
                'reward_points' => 30, 'sort_order' => 2,
                'questions' => [
                    ['Who is the leader of BTS?', ['Jin', 'RM', 'Jimin', 'V'], 1, 'RM is the leader.'],
                    ['Which member is often called the Golden Maknae?', ['Jung Kook', 'SUGA', 'j-hope', 'Jin'], 0, 'Jung Kook is widely known as the Golden Maknae.'],
                    ['Which member is strongly linked with dance leadership and sunshine energy?', ['RM', 'j-hope', 'V', 'SUGA'], 1, 'j-hope is known for dance, performance, and bright energy.'],
                ],
            ],
            [
                'slug' => 'bt21-anatomy', 'title' => 'BT21 Character Anatomy', 'category' => 'BT21',
                'excerpt' => 'Learn what BT21 means on this site and why each character has its own animated profile zone.',
                'body' => "BT21 is treated as its own colorful side quest in this final project. Instead of linking back to member vaults, the BT21 page has character anatomy notes, fun powers, and animated cards.\n\nKOYA, RJ, SHOOKY, MANG, CHIMMY, TATA, and COOKY each get a playful identity. This keeps the BTS member profiles serious and detailed while letting BT21 stay cute, bright, and chaotic.",
                'reward_points' => 30, 'sort_order' => 3,
                'questions' => [
                    ['What is fixed about the new BT21 page?', ['It routes only to admin', 'It has its own fun character anatomy profiles', 'It deletes all characters', 'It becomes a plain text page'], 1, 'The final BT21 page is its own colorful anatomy profile section.'],
                    ['Which BT21 character is linked with Jin?', ['RJ', 'KOYA', 'COOKY', 'MANG'], 0, 'RJ is Jin’s BT21 character.'],
                    ['Which BT21 character is linked with V?', ['SHOOKY', 'TATA', 'CHIMMY', 'RJ'], 1, 'TATA is V’s BT21 character.'],
                ],
            ],
        ];

        foreach ($lessons as $lessonData) {
            $questions = $lessonData['questions'];
            unset($lessonData['questions']);
            $lesson = LearningLesson::updateOrCreate(['slug' => $lessonData['slug']], array_merge($lessonData, ['is_active' => true]));
            foreach ($questions as $order => [$question, $options, $correct, $explanation]) {
                QuizQuestion::updateOrCreate([
                    'learning_lesson_id' => $lesson->id,
                    'question' => $question,
                ], [
                    'options' => $options,
                    'correct_option' => $correct,
                    'explanation' => $explanation,
                    'points' => 10,
                    'sort_order' => $order + 1,
                    'is_active' => true,
                ]);
            }
        }

        $assets = [
            ['purple-heart', 'Purple Heart Starter', 'avatar', 'Default soft purple ARMY avatar asset.', 0, 'linear-gradient(135deg,#581c87,#a855f7,#111827)', 1],
            ['galaxy-purple', 'Galaxy Purple Theme', 'theme', 'Free default black and purple profile theme.', 0, 'linear-gradient(135deg,#2e1065,#581c87,#111827)', 2],
            ['galaxy-stage', 'Galaxy Stage Theme', 'theme', 'Dark galaxy profile card with purple glow.', 120, 'linear-gradient(135deg,#0f172a,#4c1d95,#7e22ce)', 3],
            ['night-black', 'Night Black Theme', 'theme', 'Clean black profile card with soft purple edges.', 80, 'linear-gradient(135deg,#020617,#111827,#3b0764)', 4],
            ['crimson-stage', 'Crimson Stage Theme', 'theme', 'Black, purple, and red concert-energy profile theme.', 160, 'linear-gradient(135deg,#111827,#7f1d1d,#581c87)', 5],
            ['bt21-spark', 'BT21 Spark Badge', 'badge', 'Cute BT21-style sparkle badge for playful profiles.', 90, 'linear-gradient(135deg,#fde68a,#f0abfc,#93c5fd)', 6],
        ];

        foreach ($assets as [$key, $label, $type, $description, $cost, $gradient, $order]) {
            ProfileAsset::updateOrCreate(['key' => $key], [
                'label' => $label,
                'type' => $type,
                'description' => $description,
                'cost' => $cost,
                'gradient' => $gradient,
                'sort_order' => $order,
                'is_active' => true,
            ]);
        }
    }
}
