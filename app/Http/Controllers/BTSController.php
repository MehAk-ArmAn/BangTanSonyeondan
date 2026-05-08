<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use App\Models\Member;
use App\Models\Quote;
use App\Models\SongImage;
use App\Models\TimelineEvent;
use App\Models\Vote;
use Illuminate\Http\Request;

class BTSController extends Controller
{
    public function home()
    {
        return view('welcome', [
            'featuredMembers' => Member::where('is_active', true)->orderBy('sort_order')->get(),
            'featuredQuotes' => Quote::where('is_active', true)->latest()->limit(4)->get(),
            'featuredSongs' => SongImage::where('is_active', true)->orderByDesc('release_date')->limit(6)->get(),
            'featuredTimeline' => TimelineEvent::where('is_active', true)->orderBy('sort_order')->limit(5)->get(),
            'galleryPreview' => GalleryImage::where('is_active', true)->orderBy('sort_order')->limit(8)->get(),
        ]);
    }

    public function memberPage(string $slug)
    {
        $decoded = urldecode($slug);

        $member = Member::where('is_active', true)
            ->where(function ($query) use ($slug, $decoded) {
                $query->where('slug', $slug)
                    ->orWhere('name', $decoded)
                    ->orWhere('nickname', $decoded)
                    ->orWhere('stage_name', $decoded);
            })
            ->firstOrFail();

        $relatedQuotes = Quote::where('is_active', true)
            ->where('source', 'like', '%' . ($member->stage_name ?: $member->nickname ?: $member->name) . '%')
            ->latest()
            ->limit(3)
            ->get();

        return view('member', compact('member', 'relatedQuotes'));
    }

    public function quotes()
    {
        $quotes = Quote::where('is_active', true)->latest()->get();

        return view('quotes', compact('quotes'));
    }

    public function bt21()
    {
        $characters = collect([
            [
                'name' => 'KOYA', 'member' => 'RM', 'image' => 'favicons/KOYA.png', 'accent' => '#7c3aed',
                'mood' => 'Sleepy genius dream koala', 'power' => 'Deep thinking + soft leader energy',
                'anatomy' => ['Detachable ears for extra cute chaos', 'Big brain for ideas, lyrics, and tiny naps', 'Soft sleepy eyes but secretly alert'],
                'moves' => ['Dream cloud float', 'Leader calm shield', 'Idea sparkle burst'],
            ],
            [
                'name' => 'RJ', 'member' => 'Jin', 'image' => 'favicons/RJ.png', 'accent' => '#ec4899',
                'mood' => 'Fluffy royal alpaca', 'power' => 'Comfort food aura + worldwide handsome confidence',
                'anatomy' => ['Cloud-fluff body built for warm hugs', 'Chef-core heart full of snacks', 'Tiny royal steps with maximum elegance'],
                'moves' => ['WWH wink', 'Warm hug blanket', 'Snack shield'],
            ],
            [
                'name' => 'SHOOKY', 'member' => 'SUGA', 'image' => 'favicons/SHOOKY.png', 'accent' => '#64748b',
                'mood' => 'Tiny savage cookie', 'power' => 'Studio focus + low-key chaos',
                'anatomy' => ['Small body, giant attitude', 'Crispy edge for savage comments', 'Producer brain hidden in cookie mode'],
                'moves' => ['Savage crumb shot', 'Studio silence mode', 'Sleepy dodge'],
            ],
            [
                'name' => 'MANG', 'member' => 'j-hope', 'image' => 'favicons/MANG.png', 'accent' => '#f59e0b',
                'mood' => 'Masked dance sunshine', 'power' => 'Rhythm, hope, and stage fireworks',
                'anatomy' => ['Mystery mask for performance mode', 'Dance-core legs with unlimited stamina', 'Sunshine battery in the chest'],
                'moves' => ['Hope beam', 'Dance combo spin', 'Stage spark jump'],
            ],
            [
                'name' => 'CHIMMY', 'member' => 'Jimin', 'image' => 'favicons/CHIMMY.png', 'accent' => '#a855f7',
                'mood' => 'Yellow hoodie puppy', 'power' => 'Sweetness + stage duality',
                'anatomy' => ['Soft hoodie armor', 'Tiny paws for dramatic cuteness', 'Duality switch hidden under the hood'],
                'moves' => ['Puppy charm', 'Graceful spin', 'Duality glow'],
            ],
            [
                'name' => 'TATA', 'member' => 'V', 'image' => 'favicons/TATA.png', 'accent' => '#14b8a6',
                'mood' => 'Alien heart prince', 'power' => 'Cinematic imagination + artsy mystery',
                'anatomy' => ['Heart-shaped head from Planet BT', 'Tiny limbs, huge personality', 'Mood detector for aesthetic moments'],
                'moves' => ['Alien heart pulse', 'Vintage jazz aura', 'Expression freeze frame'],
            ],
            [
                'name' => 'COOKY', 'member' => 'Jung Kook', 'image' => 'favicons/COOKY.png', 'accent' => '#22c55e',
                'mood' => 'Pink bunny gym beast', 'power' => 'Golden maknae energy + playful courage',
                'anatomy' => ['Bunny ears tuned for challenges', 'Tiny body with gym-boss power', 'Heart mark loaded with confidence'],
                'moves' => ['Golden jump', 'Boxing bunny combo', 'Challenge accepted dash'],
            ],
        ]);

        return view('bt21', compact('characters'));
    }


    public function search(Request $request)
    {
        $query = trim((string) $request->query('q', ''));

        $results = [
            'members' => collect(),
            'songs' => collect(),
            'quotes' => collect(),
            'timeline' => collect(),
            'lessons' => collect(),
        ];

        if ($query !== '') {
            $like = '%' . $query . '%';

            $results['members'] = Member::where('is_active', true)
                ->where(function ($q) use ($like) {
                    $q->where('name', 'like', $like)
                        ->orWhere('stage_name', 'like', $like)
                        ->orWhere('role', 'like', $like)
                        ->orWhere('profile_story', 'like', $like)
                        ->orWhere('bt21_character', 'like', $like);
                })
                ->orderBy('sort_order')
                ->limit(8)
                ->get();

            $results['songs'] = SongImage::where('is_active', true)
                ->where(function ($q) use ($like) {
                    $q->where('name', 'like', $like)
                        ->orWhere('era', 'like', $like)
                        ->orWhere('description', 'like', $like);
                })
                ->orderByDesc('release_date')
                ->limit(8)
                ->get();

            $results['quotes'] = Quote::where('is_active', true)
                ->where(function ($q) use ($like) {
                    $q->where('source', 'like', $like)
                        ->orWhere('quote', 'like', $like)
                        ->orWhere('context', 'like', $like);
                })
                ->latest()
                ->limit(8)
                ->get();

            $results['timeline'] = TimelineEvent::where('is_active', true)
                ->where(function ($q) use ($like) {
                    $q->where('year', 'like', $like)
                        ->orWhere('category', 'like', $like)
                        ->orWhere('title', 'like', $like)
                        ->orWhere('body', 'like', $like);
                })
                ->orderBy('sort_order')
                ->limit(8)
                ->get();

            $results['lessons'] = \App\Models\LearningLesson::where('is_active', true)
                ->where(function ($q) use ($like) {
                    $q->where('title', 'like', $like)
                        ->orWhere('category', 'like', $like)
                        ->orWhere('excerpt', 'like', $like)
                        ->orWhere('body', 'like', $like);
                })
                ->orderBy('sort_order')
                ->limit(8)
                ->get();
        }

        return view('search', compact('query', 'results'));
    }

    public function achievements()
    {
        $events = TimelineEvent::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('year')
            ->get();

        return view('bts-achievements', compact('events'));
    }

    public function showVoteForm()
    {
        $members = Member::where('is_active', true)->orderBy('sort_order')->orderBy('id')->get();

        $voteStats = Vote::selectRaw('member_id, member_name, count(*) as total')
            ->groupBy('member_id', 'member_name')
            ->orderByDesc('total')
            ->get();

        return view('vote', compact('members', 'voteStats'));
    }

    public function handleVote(Request $request)
    {
        $data = $request->validate([
            'member_id' => ['required', 'exists:members,id'],
        ]);

        $member = Member::findOrFail($data['member_id']);

        Vote::create([
            'member_id' => $member->id,
            'member_name' => $member->stage_name ?: $member->nickname ?: $member->name,
            'ip_address' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 500),
        ]);

        return back()->with('success', 'You voted for ' . ($member->stage_name ?: $member->nickname) . ' 💜');
    }
}
