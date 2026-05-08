<?php

namespace App\Http\Controllers;

use App\Models\Bt21Character;
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
        $characters = Bt21Character::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

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
