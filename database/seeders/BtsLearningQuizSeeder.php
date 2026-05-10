<?php

namespace Database\Seeders;

use App\Models\LearningMaterial;
use App\Models\QuizGame;
use App\Models\QuizGameQuestion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BtsLearningQuizSeeder extends Seeder
{
    public function run(): void
    {
        $materials = [
            [
                'slug' => 'bts-101-official-start-here',
                'title' => 'BTS 101: Start Here',
                'category' => 'BTS 101',
                'topic_type' => 'Guide',
                'difficulty' => 'Beginner',
                'excerpt' => 'A clean starter guide for new ARMY: who BTS are, why they matter, and where to watch official content.',
                'body' => "BTS, also known as Bangtan Sonyeondan, are a seven-member group from South Korea.\n\nUse this page as a starter map: learn the members, check official channels, watch the MVs, then try the quizzes separately in the Quiz Arena.\n\nFor a real fan site, always guide users back to official sources so streams, views, and support go to BTS directly.",
                'image_path' => 'imgs/btsssss.jfif',
                'official_url' => 'https://ibighit.com/bts/eng/',
                'youtube_url' => 'https://www.youtube.com/@BTS',
                'source_label' => 'Official BTS site + BANGTANTV',
                'links' => [
                    ['label' => 'Official BTS Website', 'url' => 'https://ibighit.com/bts/eng/', 'type' => 'Official'],
                    ['label' => 'BANGTANTV YouTube', 'url' => 'https://www.youtube.com/@BTS', 'type' => 'Official YouTube'],
                    ['label' => 'HYBE LABELS YouTube', 'url' => 'https://www.youtube.com/@HYBELABELS', 'type' => 'Official YouTube'],
                ],
                'sort_order' => 1,
                'is_featured' => true,
            ],
            [
                'slug' => 'members-and-bt21-map',
                'title' => 'Members + BT21 Map',
                'category' => 'Members',
                'topic_type' => 'Guide',
                'difficulty' => 'Beginner',
                'excerpt' => 'A quick guide connecting the seven members with their roles, charms, and BT21 characters.',
                'body' => "This topic helps users understand the difference between BTS member profiles and BT21 character pages.\n\nMember pages should feel emotional and story-based. BT21 pages should feel colorful, playful, animated, and character-anatomy focused.",
                'image_path' => 'imgs/gallery/bt21.webp',
                'official_url' => 'https://www.bt21.com/',
                'youtube_url' => 'https://www.youtube.com/@BT21_official',
                'source_label' => 'BT21 Official',
                'links' => [
                    ['label' => 'BT21 Official Website', 'url' => 'https://www.bt21.com/', 'type' => 'Official'],
                    ['label' => 'BT21 Official YouTube', 'url' => 'https://www.youtube.com/@BT21_official', 'type' => 'Official YouTube'],
                ],
                'sort_order' => 2,
                'is_featured' => true,
            ],
            [
                'slug' => 'spring-day-mv-study',
                'title' => 'MV Study: Spring Day',
                'category' => 'Music Videos',
                'topic_type' => 'MV Study',
                'difficulty' => 'Intermediate',
                'excerpt' => 'Watch the official MV, then learn the themes, visuals, and emotional meaning fans connect with Spring Day.',
                'body' => "Spring Day is one of BTS’s most emotional songs. A learning material like this can include: release context, lyrics themes, visual motifs, fan interpretations, and official links.\n\nKeep the quiz separate. This page is for learning, watching, reading, and saving useful links.",
                'image_path' => 'imgs/songs/spring-day.jfif',
                'official_url' => 'https://ibighit.com/bts/eng/discography/detail/you_never_walk_alone.html',
                'youtube_url' => 'https://www.youtube.com/watch?v=xEeFrLSkMm8',
                'source_label' => 'Official MV',
                'links' => [
                    ['label' => 'Spring Day Official MV', 'url' => 'https://www.youtube.com/watch?v=xEeFrLSkMm8', 'type' => 'Official MV'],
                    ['label' => 'You Never Walk Alone Discography', 'url' => 'https://ibighit.com/bts/eng/discography/detail/you_never_walk_alone.html', 'type' => 'Official'],
                ],
                'sort_order' => 3,
                'is_featured' => true,
            ],
            [
                'slug' => 'dynamite-mv-study',
                'title' => 'MV Study: Dynamite',
                'category' => 'Music Videos',
                'topic_type' => 'MV Study',
                'difficulty' => 'Beginner',
                'excerpt' => 'A bright MV guide for Dynamite with official MV link, comeback energy, styling notes, and quiz prep hints.',
                'body' => "Dynamite is perfect for a beginner MV study because it is colorful, easy to recognize, and popular with casual listeners too.\n\nUse this page to explain styling, setting, choreography moments, and the feel-good disco-pop concept.",
                'image_path' => 'imgs/songs/dynamite.jfif',
                'official_url' => 'https://ibighit.com/bts/eng/discography/detail/dynamite.html',
                'youtube_url' => 'https://www.youtube.com/watch?v=gdZLi9oWNZg',
                'source_label' => 'Official MV',
                'links' => [
                    ['label' => 'Dynamite Official MV', 'url' => 'https://www.youtube.com/watch?v=gdZLi9oWNZg', 'type' => 'Official MV'],
                    ['label' => 'Dynamite Discography', 'url' => 'https://ibighit.com/bts/eng/discography/detail/dynamite.html', 'type' => 'Official'],
                ],
                'sort_order' => 4,
                'is_featured' => false,
            ],
            [
                'slug' => 'army-terms-and-fandom-culture',
                'title' => 'ARMY Terms + Fandom Culture',
                'category' => 'ARMY Culture',
                'topic_type' => 'Glossary',
                'difficulty' => 'Beginner',
                'excerpt' => 'A friendly glossary for new users: bias, comeback, era, streaming, purple, borahae, and more.',
                'body' => "This page can become a full glossary. Keep it helpful, warm, and beginner-friendly so new ARMY do not feel lost.\n\nAdmin can keep adding terms and links as the website grows.",
                'image_path' => 'imgs/bts-crowd.jfif',
                'official_url' => 'https://weverse.io/bts/feed',
                'youtube_url' => 'https://www.youtube.com/@BTS',
                'source_label' => 'Official community + videos',
                'links' => [
                    ['label' => 'BTS on Weverse', 'url' => 'https://weverse.io/bts/feed', 'type' => 'Official Community'],
                    ['label' => 'BANGTANTV', 'url' => 'https://www.youtube.com/@BTS', 'type' => 'Official YouTube'],
                ],
                'sort_order' => 5,
                'is_featured' => false,
            ],
        ];

        foreach ($materials as $material) {
            LearningMaterial::updateOrCreate(
                ['slug' => $material['slug']],
                array_merge($material, ['is_active' => true])
            );
        }

        $quizzes = [
            [
                'slug' => 'bts-101-rookie-army',
                'title' => 'BTS 101: Rookie ARMY',
                'category' => 'BTS 101',
                'difficulty' => 'easy',
                'description' => 'Quick starter quiz for new ARMY. Simple, cute, and point-friendly.',
                'cover_image' => 'imgs/btsssss.jfif',
                'points_per_question' => 10,
                'bonus_points' => 20,
                'sort_order' => 1,
                'is_featured' => true,
                'questions' => [
                    ['What does BTS also stand for?', ['Bangtan Sonyeondan', 'Big Time Stars', 'Born To Sing', 'Bright Team Seoul'], 0, 'BTS is also known as Bangtan Sonyeondan.', 10],
                    ['How many members are in BTS?', ['5', '6', '7', '8'], 2, 'BTS has seven members.', 10],
                    ['What color is strongly connected with ARMY love?', ['Blue', 'Purple', 'Orange', 'Green'], 1, 'Purple is deeply connected with BTS and ARMY through borahae.', 10],
                ],
            ],
            [
                'slug' => 'mv-detective-round-one',
                'title' => 'MV Detective: Round One',
                'category' => 'Music Videos',
                'difficulty' => 'medium',
                'description' => 'Spot the MV, era, and concept clues. More points, more drama.',
                'cover_image' => 'imgs/songs/dna.jfif',
                'points_per_question' => 20,
                'bonus_points' => 40,
                'sort_order' => 2,
                'is_featured' => true,
                'questions' => [
                    ['Which BTS song is famous for the line “Cause I-I-I’m in the stars tonight”?', ['DNA', 'Dynamite', 'Black Swan', 'Fire'], 1, 'That line is from Dynamite.', 20],
                    ['Which MV is often connected with emotional longing and winter/spring imagery?', ['Spring Day', 'Idol', 'Dope', 'Butter'], 0, 'Spring Day is known for emotional imagery and longing.', 20],
                    ['Which song title is also a type of genetic molecule?', ['Fire', 'DNA', 'Save Me', 'Mic Drop'], 1, 'DNA is the correct answer.', 20],
                ],
            ],
            [
                'slug' => 'borahae-legend-mode',
                'title' => 'Borahae Legend Mode',
                'category' => 'ARMY Culture',
                'difficulty' => 'hard',
                'description' => 'Harder ARMY culture questions for users who want serious leaderboard energy.',
                'cover_image' => 'imgs/bts-crowd.jfif',
                'points_per_question' => 35,
                'bonus_points' => 80,
                'sort_order' => 3,
                'is_featured' => false,
                'questions' => [
                    ['What does “bias” usually mean in K-pop fandom language?', ['Favorite member', 'Least favorite song', 'Stage outfit', 'Album version'], 0, 'A bias is usually your favorite member.', 35],
                    ['What does “comeback” usually refer to?', ['A new release/promotion period', 'An old concert only', 'A fan account', 'A hairstyle'], 0, 'A comeback is a new release and promotional era.', 35],
                    ['Which platform is commonly used for official artist-fan community updates?', ['Weverse', 'Only maps', 'A calculator app', 'A weather site'], 0, 'Weverse is used for official community updates.', 35],
                ],
            ],
        ];

        foreach ($quizzes as $quizData) {
            $questions = $quizData['questions'];
            unset($quizData['questions']);

            $quiz = QuizGame::updateOrCreate(
                ['slug' => $quizData['slug']],
                array_merge($quizData, [
                    'time_limit_seconds' => $quizData['time_limit_seconds'] ?? 0,
                    'is_active' => true,
                ])
            );

            foreach ($questions as $index => [$question, $options, $correct, $explanation, $points]) {
                QuizGameQuestion::updateOrCreate(
                    [
                        'quiz_game_id' => $quiz->id,
                        'question' => $question,
                    ],
                    [
                        'options' => $options,
                        'correct_option' => $correct,
                        'explanation' => $explanation,
                        'points' => $points,
                        'sort_order' => $index + 1,
                        'is_active' => true,
                    ]
                );
            }
        }
    }
}
