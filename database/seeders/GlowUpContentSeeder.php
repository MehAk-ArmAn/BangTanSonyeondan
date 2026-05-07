<?php

namespace Database\Seeders;

use App\Models\GalleryImage;
use App\Models\Member;
use App\Models\NavItem;
use App\Models\Quote;
use App\Models\SiteSetting;
use App\Models\SongImage;
use App\Models\TimelineEvent;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GlowUpContentSeeder extends Seeder
{
    /**
     * Seeds polished starter content for the professional BangTanSonyeondan fan website.
     *
     * Run with:
     * php artisan db:seed --class=GlowUpContentSeeder
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@bangtansonyeondan.com'],
            ['name' => 'BTS Admin', 'password' => Hash::make('Army@2026!')]
        );

        $settings = [
            'site_title' => 'BangTanSonyeondan',
            'site_subtitle' => 'A purple-red, polished BangTanSonyeondan website for BTS members, music, memories, quotes, timelines, and ARMY energy.',
            'hero_kicker' => 'âŸ­âŸ¬ BTS FOREVER Â· ARMY HOMEBASE âŸ¬âŸ­',
            'hero_title' => '✨💜 ＢＡＮＧＴＡＮ ＳＯＮＹＥＯＮＤＡＮ 💜✨ — fun, organized, purple-red, and actually useful.',
            'hero_body' => 'Explore member vaults, eras, songs, quotes, gallery moments, votes, and timeline highlights in one clean BangTanSonyeondan website built for real ARMY browsing.',
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
            ['Timeline', '/bts-achievements', 3],
            ['Songs', '/songs', 4],
            ['Gallery', '/gallery', 5],
            ['Quotes', '/quotes', 6],
            ['BT21', '/bt21', 7],
            ['Vote', '/vote', 8],
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
                'korean_name' => 'ê¹€ë‚¨ì¤€', 'role' => 'Leader Â· Rapper Â· Lyricist', 'birth_date' => '1994-09-12',
                'birthplace' => 'Ilsan/Goyang, South Korea', 'emoji' => 'ðŸ¨', 'accent_color' => '#7c3aed',
                'bt21_character' => 'KOYA', 'image' => 'rm.jfif', 'favicon' => 'KOYA.png', 'sort_order' => 1,
                'intro_title' => 'The thoughtful leader who turns chaos into poetry.',
                'quote' => 'A calm brain, a giant heart, and words that feel like a deep purple sky.',
                'profile_story' => 'RM is the groupâ€™s leader and one of the strongest creative voices behind BTS. His page is built like a mini vault: leadership, lyrics, art energy, and the kind of reflective aura that makes ARMY pause and think.',
                'skill_tags' => ['Leadership', 'Rap', 'Lyrics', 'Art lover', 'English speaker'],
                'fun_facts' => ['Known for deep speeches and thoughtful interviews.', 'Loves museums, books, nature, and art spaces.', 'Represents the soft-intellectual side of BTS energy.'],
            ],
            [
                'slug' => 'jin', 'name' => 'Kim Seokjin', 'stage_name' => 'Jin', 'nickname' => 'Jin',
                'korean_name' => 'ê¹€ì„ì§„', 'role' => 'Vocalist Â· Visual Â· Worldwide Handsome', 'birth_date' => '1992-12-04',
                'birthplace' => 'Gwacheon, South Korea', 'emoji' => 'ðŸ¹', 'accent_color' => '#ec4899',
                'bt21_character' => 'RJ', 'image' => 'jin.jfif', 'favicon' => 'RJ.png', 'sort_order' => 2,
                'intro_title' => 'The worldwide handsome mood-maker with silver vocals.',
                'quote' => 'A vocal prince with dad jokes, elegance, and full chaos mode unlocked.',
                'profile_story' => 'Jin brings warmth, humor, confidence, and emotional vocals. His vault should feel like a sparkling royal comedy room: wholesome, iconic, and secretly very powerful.',
                'skill_tags' => ['Vocal', 'Visual', 'Variety', 'Confidence', 'Humor'],
                'fun_facts' => ['Known for â€œWorldwide Handsomeâ€ energy.', 'Often brings comfort through emotional solo songs.', 'Can turn any serious moment into a legendary meme.'],
            ],
            [
                'slug' => 'suga', 'name' => 'Min Yoongi', 'stage_name' => 'SUGA', 'nickname' => 'Suga',
                'korean_name' => 'ë¯¼ìœ¤ê¸°', 'role' => 'Rapper Â· Producer Â· Songwriter', 'birth_date' => '1993-03-09',
                'birthplace' => 'Daegu, South Korea', 'emoji' => 'ðŸ±', 'accent_color' => '#64748b',
                'bt21_character' => 'SHOOKY', 'image' => 'suga.jfif', 'favicon' => 'SHOOKY.png', 'sort_order' => 3,
                'intro_title' => 'The quiet producer with savage lyrics and soft-core honesty.',
                'quote' => 'Calm on the outside, thunder in the studio, comfort in the lyrics.',
                'profile_story' => 'SUGA is the production brain, sharp rapper, and emotional storyteller. His page should feel moody, cinematic, and honest â€” like late-night headphones and lyrics that hit too hard.',
                'skill_tags' => ['Rap', 'Production', 'Piano', 'Songwriting', 'Agust D'],
                'fun_facts' => ['Known for direct, honest writing.', 'Has a strong producer identity beyond performance.', 'His calm vibe is half sleepy cat, half studio monster.'],
            ],
            [
                'slug' => 'jhope', 'name' => 'Jung Hoseok', 'stage_name' => 'j-hope', 'nickname' => 'Hobi',
                'korean_name' => 'ì •í˜¸ì„', 'role' => 'Rapper Â· Main Dancer Â· Performance Leader', 'birth_date' => '1994-02-18',
                'birthplace' => 'Gwangju, South Korea', 'emoji' => 'ðŸŒž', 'accent_color' => '#f59e0b',
                'bt21_character' => 'MANG', 'image' => 'jhope.jfif', 'favicon' => 'MANG.png', 'sort_order' => 4,
                'intro_title' => 'The sunshine engine who turns practice into fireworks.',
                'quote' => 'Bright smile, beast-mode dance lines, and stage energy that wakes the planet.',
                'profile_story' => 'j-hope is movement, precision, and joy. His vault should feel like stage lights switching on: dance practice, sunshine, rap flow, and a giant dose of motivation.',
                'skill_tags' => ['Dance', 'Rap', 'Performance', 'Choreography', 'Energy'],
                'fun_facts' => ['Known for powerful dance leadership.', 'Brings bright energy but works with serious discipline.', 'His stage presence can flip a whole room instantly.'],
            ],
            [
                'slug' => 'jimin', 'name' => 'Park Jimin', 'stage_name' => 'Jimin', 'nickname' => 'Jimin',
                'korean_name' => 'ë°•ì§€ë¯¼', 'role' => 'Vocalist Â· Dancer', 'birth_date' => '1995-10-13',
                'birthplace' => 'Busan, South Korea', 'emoji' => 'ðŸ£', 'accent_color' => '#a855f7',
                'bt21_character' => 'CHIMMY', 'image' => 'jimin.jfif', 'favicon' => 'CHIMMY.png', 'sort_order' => 5,
                'intro_title' => 'The graceful performer with angel vocals and lethal duality.',
                'quote' => 'Soft voice, sharp movement, and stage duality that should honestly be illegal.',
                'profile_story' => 'Jimin brings elegance, emotion, and powerful dance detail. His vault should feel delicate and dramatic at the same time â€” ballet lines, emotional vocals, and iconic performance moments.',
                'skill_tags' => ['Dance', 'Vocal', 'Performance', 'Duality', 'Contemporary'],
                'fun_facts' => ['Known for expressive dance lines.', 'Balances softness and intensity on stage.', 'Has one of the most recognizable performance auras in BTS.'],
            ],
            [
                'slug' => 'v', 'name' => 'Kim Taehyung', 'stage_name' => 'V', 'nickname' => 'V',
                'korean_name' => 'ê¹€íƒœí˜•', 'role' => 'Vocalist Â· Visual Â· Actor', 'birth_date' => '1995-12-30',
                'birthplace' => 'Daegu, South Korea', 'emoji' => 'ðŸ»', 'accent_color' => '#14b8a6',
                'bt21_character' => 'TATA', 'image' => 'v.jfif', 'favicon' => 'TATA.png', 'sort_order' => 6,
                'intro_title' => 'The velvet-voiced art prince with cinematic energy.',
                'quote' => 'Jazz soul, deep voice, model aura, and facial expressions that tell whole stories.',
                'profile_story' => 'V brings color, mood, and a film-like presence. His vault should feel like vintage jazz, fashion editorials, soft photography, and the most mysterious kind of charisma.',
                'skill_tags' => ['Vocal', 'Jazz tone', 'Visual', 'Acting', 'Fashion'],
                'fun_facts' => ['Known for a deep, warm vocal color.', 'Loves art, photography, jazz, and classic aesthetics.', 'His expressions can change a whole stage mood.'],
            ],
            [
                'slug' => 'jungkook', 'name' => 'Jeon Jungkook', 'stage_name' => 'Jung Kook', 'nickname' => 'JK',
                'korean_name' => 'ì „ì •êµ­', 'role' => 'Main Vocalist Â· Performer Â· Golden Maknae', 'birth_date' => '1997-09-01',
                'birthplace' => 'Busan, South Korea', 'emoji' => 'ðŸ°', 'accent_color' => '#22c55e',
                'bt21_character' => 'COOKY', 'image' => 'jk.jfif', 'favicon' => 'COOKY.png', 'sort_order' => 7,
                'intro_title' => 'The golden maknae built like a final boss character.',
                'quote' => 'Vocals, dance, sports, art, chaos â€” bro downloaded the all-rounder expansion pack.',
                'profile_story' => 'Jung Kook is the powerhouse all-rounder: vocals, dance, performance, athletic energy, and playful maknae chaos. His vault should feel fast, bright, and impossible to ignore.',
                'skill_tags' => ['Vocal', 'Dance', 'Performance', 'Sports', 'Golden Maknae'],
                'fun_facts' => ['Known as the â€œGolden Maknaeâ€.', 'Has strong vocals and sharp stage focus.', 'Somehow manages to be both chaotic and perfectionist.'],
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
            ['ARMY', 'Seven people. Millions of stories. One purple-red stage.', 'Fandom'],
        ];

        foreach ($quotes as [$source, $quote, $context]) {
            Quote::updateOrCreate(['source' => $source, 'quote' => $quote], [
                'context' => $context,
                'is_active' => true,
            ]);
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
                'img_path' => $img,
                'release_date' => $date,
                'description' => $description,
                'era' => $era,
                'sort_order' => $order,
                'is_active' => true,
            ]);
        }

        $timeline = [
            ['2013', 'Debut', 'Debut with 2 Cool 4 Skool', 'BTS began their journey with a sharp hip-hop identity, rookie energy, and a message that questioned pressure placed on young people.', ['Debut era begins', 'ARMY origin story starts', 'School Trilogy foundation'], ['imgs/timeline/2013/1.jfif', 'imgs/timeline/2013/2.jfif'], 1],
            ['2015', 'Breakthrough', 'The Most Beautiful Moment in Life era', 'The HYYH era gave BTS a deeper cinematic identity with youth, friendship, struggle, and growth at the center.', ['Emotional storytelling expands', 'Music videos become lore-heavy', 'BTS identity matures'], [], 2],
            ['2017', 'Global', 'Billboard breakthrough and wider global attention', 'BTS moved from rising stars to global conversation, with social reach and international fandom becoming impossible to ignore.', ['Global fanbase grows rapidly', 'US award-show visibility increases', 'Love Yourself era begins'], ['imgs/timeline/2017/1.jfif', 'imgs/timeline/2017/2.jfif'], 3],
            ['2018', 'Message', 'Love Yourself and Speak Yourself impact', 'Their message expanded beyond music into self-love, youth voice, and cultural impact.', ['Love Yourself message becomes central', 'Bigger stadium-scale presence', 'Global media focus'], ['imgs/timeline/2018/1.jfif', 'imgs/timeline/2018/2.jfif'], 4],
            ['2020', 'Record Era', 'Dynamite, BE, and worldwide comfort', 'BTS reached another global peak while releasing music that brought brightness and comfort during a difficult year.', ['Dynamite era explodes worldwide', 'BE carries a softer healing tone', 'BTS becomes a household global pop name'], ['imgs/timeline/2020/1.jfif', 'imgs/timeline/2020/2.jfif'], 5],
            ['2021', 'Stadium Pop', 'Butter and Permission to Dance', 'BTS leaned into polished pop brightness while keeping the fan connection strong.', ['English singles era continues', 'Performance scale grows', 'ARMY moments everywhere'], [], 6],
            ['2022', 'Reflection', 'Proof anthology era', 'Proof looked back across the groupâ€™s journey and framed their story as something still moving forward.', ['Anthology project', 'Career reflection', 'Promise of the future'], [], 7],
            ['2023â€“2025', 'Solo Chapter', 'Solo era and individual colors', 'Each member explored solo identity, showing different sounds, styles, and personal artistic colors while the seven-member story stayed connected.', ['Solo albums and singles', 'Member identities shine', 'Group bond remains central'], ['imgs/timeline/2023/1.jfif', 'imgs/timeline/2023/2.jfif', 'imgs/timeline/2023/3.jfif'], 8],
        ];

        foreach ($timeline as [$year, $category, $title, $body, $bullets, $images, $order]) {
            TimelineEvent::updateOrCreate(['year' => $year, 'title' => $title], [
                'category' => $category,
                'body' => $body,
                'bullet_points' => $bullets,
                'image_paths' => $images,
                'sort_order' => $order,
                'is_active' => true,
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
                'caption' => $caption,
                'category' => $category,
                'sort_order' => $order,
                'is_active' => true,
            ]);
        }
    }
}


