<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use App\Models\Member;
use App\Models\NavItem;
use App\Models\Quote;
use App\Models\SiteSetting;
use App\Models\SongImage;
use App\Models\TimelineEvent;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    /**
     * Main admin dashboard. All core website content is manageable from here.
     */
    public function index()
    {
        return view('admin.dashboard', [
            'settings' => SiteSetting::pluck('value', 'key')->toArray(),
            'navList' => NavItem::orderBy('sort_order')->orderBy('id')->get(),
            'membersList' => Member::orderBy('sort_order')->orderBy('id')->get(),
            'quotesList' => Quote::latest()->get(),
            'galleryList' => GalleryImage::orderBy('sort_order')->orderByDesc('id')->get(),
            'songsList' => SongImage::orderByDesc('release_date')->orderBy('sort_order')->get(),
            'timelineList' => TimelineEvent::orderBy('sort_order')->orderBy('year')->get(),
            'voteStats' => Vote::selectRaw('member_name, count(*) as total')
                ->groupBy('member_name')
                ->orderByDesc('total')
                ->get(),
        ]);
    }

    public function updateSettings(Request $request)
    {
        $data = $request->validate([
            'site_title' => ['nullable', 'string', 'max:255'],
            'site_subtitle' => ['nullable', 'string', 'max:500'],
            'hero_kicker' => ['nullable', 'string', 'max:255'],
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_body' => ['nullable', 'string', 'max:1200'],
            'footer_text' => ['nullable', 'string', 'max:1500'],
            'admin_email' => ['nullable', 'email', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'creator_name' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'url', 'max:1000'],
            'linkedin' => ['nullable', 'url', 'max:1000'],
            'twitter' => ['nullable', 'url', 'max:1000'],
            'youtube' => ['nullable', 'url', 'max:1000'],
            'tiktok' => ['nullable', 'url', 'max:1000'],
        ]);

        foreach ($data as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return back()->with('success', 'Site settings updated.');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();
        $user->forceFill(['password' => Hash::make($validated['password'])])->save();

        return back()->with('success', 'Admin password updated.');
    }

    public function storeNav(Request $request)
    {
        $data = $request->validate([
            'label' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active', true);
        NavItem::create($data);

        return back()->with('success', 'Navigation item added.');
    }

    public function updateNav(Request $request, NavItem $navItem)
    {
        $data = $request->validate([
            'label' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $navItem->update($data);

        return back()->with('success', 'Navigation item updated.');
    }

    public function deleteNav(NavItem $navItem)
    {
        $navItem->delete();

        return back()->with('success', 'Navigation item deleted.');
    }

    public function updateMember(Request $request, Member $member)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'stage_name' => ['nullable', 'string', 'max:255'],
            'nickname' => ['nullable', 'string', 'max:255'],
            'korean_name' => ['nullable', 'string', 'max:255'],
            'role' => ['nullable', 'string', 'max:255'],
            'birth_date' => ['nullable', 'date'],
            'birthplace' => ['nullable', 'string', 'max:255'],
            'emoji' => ['nullable', 'string', 'max:20'],
            'accent_color' => ['nullable', 'string', 'max:30'],
            'bt21_character' => ['nullable', 'string', 'max:255'],
            'intro_title' => ['nullable', 'string', 'max:255'],
            'quote' => ['nullable', 'string', 'max:800'],
            'profile_story' => ['nullable', 'string', 'max:5000'],
            'image' => ['nullable', 'string', 'max:255'],
            'favicon' => ['nullable', 'string', 'max:255'],
            'spotify_url' => ['nullable', 'url', 'max:1000'],
            'instagram_url' => ['nullable', 'url', 'max:1000'],
            'fun_facts_text' => ['nullable', 'string', 'max:5000'],
            'skill_tags_text' => ['nullable', 'string', 'max:2000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'image_file' => ['nullable', 'image', 'max:4096'],
        ]);

        $data['slug'] = Str::slug($data['stage_name'] ?: $data['nickname'] ?: $data['name']);
        $data['fun_facts'] = $this->linesToArray($request->input('fun_facts_text'));
        $data['skill_tags'] = $this->linesToArray($request->input('skill_tags_text'));
        $data['is_active'] = $request->boolean('is_active');

        unset($data['fun_facts_text'], $data['skill_tags_text'], $data['image_file']);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('uploads/members', 'public');
            $data['image'] = 'storage/' . $path;
        }

        $member->update($data);

        return back()->with('success', 'Member vault updated.');
    }

    public function storeQuote(Request $request)
    {
        $data = $request->validate([
            'source' => ['required', 'string', 'max:255'],
            'quote' => ['required', 'string', 'max:2000'],
            'context' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active', true);
        Quote::create($data);

        return back()->with('success', 'Quote added.');
    }

    public function updateQuote(Request $request, Quote $quote)
    {
        $data = $request->validate([
            'source' => ['required', 'string', 'max:255'],
            'quote' => ['required', 'string', 'max:2000'],
            'context' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $quote->update($data);

        return back()->with('success', 'Quote updated.');
    }

    public function deleteQuote(Quote $quote)
    {
        $quote->delete();

        return back()->with('success', 'Quote deleted.');
    }

    public function storeGallery(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'img_path' => ['nullable', 'string', 'max:255'],
            'caption' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'image_file' => ['nullable', 'image', 'max:4096'],
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('uploads/gallery', 'public');
            $data['img_path'] = 'storage/' . $path;
        }

        $data['category'] = $data['category'] ?: 'Gallery';
        $data['is_active'] = $request->boolean('is_active', true);
        unset($data['image_file']);

        GalleryImage::create($data);

        return back()->with('success', 'Gallery item added.');
    }

    public function deleteGallery(GalleryImage $galleryImage)
    {
        $galleryImage->delete();

        return back()->with('success', 'Gallery item deleted.');
    }

    public function storeSong(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'img_path' => ['nullable', 'string', 'max:255'],
            'release_date' => ['nullable', 'date'],
            'description' => ['nullable', 'string', 'max:2000'],
            'era' => ['nullable', 'string', 'max:255'],
            'spotify_url' => ['nullable', 'url', 'max:1000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'image_file' => ['nullable', 'image', 'max:4096'],
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('uploads/songs', 'public');
            $data['img_path'] = 'storage/' . $path;
        }

        $data['is_active'] = $request->boolean('is_active', true);
        unset($data['image_file']);

        SongImage::create($data);

        return back()->with('success', 'Song added.');
    }

    public function updateSong(Request $request, SongImage $songImage)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'img_path' => ['nullable', 'string', 'max:255'],
            'release_date' => ['nullable', 'date'],
            'description' => ['nullable', 'string', 'max:2000'],
            'era' => ['nullable', 'string', 'max:255'],
            'spotify_url' => ['nullable', 'url', 'max:1000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'image_file' => ['nullable', 'image', 'max:4096'],
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('uploads/songs', 'public');
            $data['img_path'] = 'storage/' . $path;
        }

        $data['is_active'] = $request->boolean('is_active');
        unset($data['image_file']);

        $songImage->update($data);

        return back()->with('success', 'Song updated.');
    }

    public function deleteSong(SongImage $songImage)
    {
        $songImage->delete();

        return back()->with('success', 'Song deleted.');
    }

    public function storeTimeline(Request $request)
    {
        $data = $this->validateTimeline($request);
        TimelineEvent::create($data);

        return back()->with('success', 'Timeline event added.');
    }

    public function updateTimeline(Request $request, TimelineEvent $timelineEvent)
    {
        $data = $this->validateTimeline($request, false);
        $timelineEvent->update($data);

        return back()->with('success', 'Timeline event updated.');
    }

    public function deleteTimeline(TimelineEvent $timelineEvent)
    {
        $timelineEvent->delete();

        return back()->with('success', 'Timeline event deleted.');
    }


    public function saveAll(Request $request)
    {
        $this->saveSettingsBulk($request->input('settings', []));
        $this->saveNavigationBulk($request->input('nav', []), $request->input('new_nav', []));
        $this->saveMembersBulk($request->input('members', []), $request->file('member_image_files', []));
        $this->saveQuotesBulk($request->input('quotes', []), $request->input('new_quote', []));
        $this->saveSongsBulk($request->input('songs', []), $request->file('song_image_files', []), $request->input('new_song', []), $request->file('new_song_image_file'));
        $this->saveGalleryBulk($request->input('gallery', []), $request->file('gallery_image_files', []), $request->input('new_gallery', []), $request->file('new_gallery_image_file'));
        $this->saveTimelineBulk($request->input('timeline', []), $request->input('new_timeline', []));

        return back()->with('success', 'All dashboard changes saved successfully.');
    }

    private function saveSettingsBulk(array $settings): void
    {
        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }

    private function saveNavigationBulk(array $items, array $newItem): void
    {
        foreach ($items as $id => $data) {
            $nav = NavItem::find($id);
            if (!$nav) {
                continue;
            }

            if (!empty($data['delete'])) {
                $nav->delete();
                continue;
            }

            $nav->update([
                'label' => $data['label'] ?? $nav->label,
                'url' => $data['url'] ?? $nav->url,
                'sort_order' => (int)($data['sort_order'] ?? 0),
                'is_active' => !empty($data['is_active']),
            ]);
        }

        if (!empty($newItem['label']) || !empty($newItem['url'])) {
            NavItem::create([
                'label' => $newItem['label'] ?? 'New Link',
                'url' => $newItem['url'] ?? '#',
                'sort_order' => (int)($newItem['sort_order'] ?? 0),
                'is_active' => !empty($newItem['is_active']),
            ]);
        }
    }

    private function saveMembersBulk(array $members, array $files): void
    {
        foreach ($members as $id => $data) {
            $member = Member::find($id);
            if (!$member) {
                continue;
            }

            $payload = [
                'name' => $data['name'] ?? $member->name,
                'stage_name' => $data['stage_name'] ?? null,
                'nickname' => $data['nickname'] ?? null,
                'korean_name' => $data['korean_name'] ?? null,
                'role' => $data['role'] ?? null,
                'birth_date' => $this->nullableDate($data['birth_date'] ?? null),
                'birthplace' => $data['birthplace'] ?? null,
                'emoji' => $data['emoji'] ?? null,
                'accent_color' => $data['accent_color'] ?? null,
                'bt21_character' => $data['bt21_character'] ?? null,
                'intro_title' => $data['intro_title'] ?? null,
                'image' => $data['image'] ?? null,
                'favicon' => $data['favicon'] ?? null,
                'sort_order' => (int)($data['sort_order'] ?? 0),
                'quote' => $data['quote'] ?? null,
                'profile_story' => $data['profile_story'] ?? null,
                'skill_tags' => $this->linesToArray($data['skill_tags_text'] ?? ''),
                'fun_facts' => $this->linesToArray($data['fun_facts_text'] ?? ''),
                'is_active' => !empty($data['is_active']),
            ];

            if (!empty($payload['stage_name']) || !empty($payload['nickname']) || !empty($payload['name'])) {
                $payload['slug'] = Str::slug($payload['stage_name'] ?: $payload['nickname'] ?: $payload['name']);
            }

            if (isset($files[$id]) && $files[$id] && $files[$id]->isValid()) {
                $payload['image'] = 'storage/' . $files[$id]->store('uploads/members', 'public');
            }

            $member->update($payload);
        }
    }

    private function saveQuotesBulk(array $quotes, array $newQuote): void
    {
        foreach ($quotes as $id => $data) {
            $quote = Quote::find($id);
            if (!$quote) {
                continue;
            }

            if (!empty($data['delete'])) {
                $quote->delete();
                continue;
            }

            $quote->update([
                'source' => $data['source'] ?? $quote->source,
                'context' => $data['context'] ?? null,
                'quote' => $data['quote'] ?? $quote->quote,
                'is_active' => !empty($data['is_active']),
            ]);
        }

        if (!empty($newQuote['quote'])) {
            Quote::create([
                'source' => $newQuote['source'] ?? 'BTS',
                'context' => $newQuote['context'] ?? null,
                'quote' => $newQuote['quote'],
                'is_active' => !empty($newQuote['is_active']),
            ]);
        }
    }

    private function saveSongsBulk(array $songs, array $files, array $newSong, $newSongFile = null): void
    {
        foreach ($songs as $id => $data) {
            $song = SongImage::find($id);
            if (!$song) {
                continue;
            }

            if (!empty($data['delete'])) {
                $song->delete();
                continue;
            }

            $payload = [
                'name' => $data['name'] ?? $song->name,
                'era' => $data['era'] ?? null,
                'release_date' => $this->nullableDate($data['release_date'] ?? null),
                'img_path' => $data['img_path'] ?? null,
                'description' => $data['description'] ?? null,
                'is_active' => !empty($data['is_active']),
            ];

            if (isset($files[$id]) && $files[$id] && $files[$id]->isValid()) {
                $payload['img_path'] = 'storage/' . $files[$id]->store('uploads/songs', 'public');
            }

            $song->update($payload);
        }

        if (!empty($newSong['name'])) {
            $imgPath = $newSong['img_path'] ?? null;
            if ($newSongFile && $newSongFile->isValid()) {
                $imgPath = 'storage/' . $newSongFile->store('uploads/songs', 'public');
            }

            SongImage::create([
                'name' => $newSong['name'],
                'era' => $newSong['era'] ?? null,
                'release_date' => $this->nullableDate($newSong['release_date'] ?? null),
                'img_path' => $imgPath,
                'description' => $newSong['description'] ?? null,
                'sort_order' => (int)($newSong['sort_order'] ?? 0),
                'is_active' => !empty($newSong['is_active']),
            ]);
        }
    }

    private function saveGalleryBulk(array $gallery, array $files, array $newGallery, $newGalleryFile = null): void
    {
        foreach ($gallery as $id => $data) {
            $pic = GalleryImage::find($id);
            if (!$pic) {
                continue;
            }

            if (!empty($data['delete'])) {
                $pic->delete();
                continue;
            }

            $payload = [
                'name' => $data['name'] ?? null,
                'category' => $data['category'] ?? null,
                'img_path' => $data['img_path'] ?? null,
                'is_active' => !empty($data['is_active']),
            ];

            if (isset($files[$id]) && $files[$id] && $files[$id]->isValid()) {
                $payload['img_path'] = 'storage/' . $files[$id]->store('uploads/gallery', 'public');
            }

            $pic->update($payload);
        }

        if (!empty($newGallery['name']) || !empty($newGallery['img_path']) || $newGalleryFile) {
            $imgPath = $newGallery['img_path'] ?? null;
            if ($newGalleryFile && $newGalleryFile->isValid()) {
                $imgPath = 'storage/' . $newGalleryFile->store('uploads/gallery', 'public');
            }

            GalleryImage::create([
                'name' => $newGallery['name'] ?? 'New Gallery Image',
                'category' => $newGallery['category'] ?? 'Gallery',
                'img_path' => $imgPath,
                'sort_order' => (int)($newGallery['sort_order'] ?? 0),
                'is_active' => !empty($newGallery['is_active']),
            ]);
        }
    }

    private function saveTimelineBulk(array $events, array $newEvent): void
    {
        foreach ($events as $id => $data) {
            $event = TimelineEvent::find($id);
            if (!$event) {
                continue;
            }

            if (!empty($data['delete'])) {
                $event->delete();
                continue;
            }

            $event->update([
                'year' => $data['year'] ?? $event->year,
                'category' => $data['category'] ?? 'Milestone',
                'title' => $data['title'] ?? $event->title,
                'body' => $data['body'] ?? null,
                'bullet_points' => $this->linesToArray($data['bullet_points_text'] ?? ''),
                'image_paths' => $this->linesToArray($data['image_paths_text'] ?? ''),
                'sort_order' => (int)($data['sort_order'] ?? 0),
                'is_active' => !empty($data['is_active']),
            ]);
        }

        if (!empty($newEvent['year']) || !empty($newEvent['title'])) {
            TimelineEvent::create([
                'year' => $newEvent['year'] ?? '',
                'category' => $newEvent['category'] ?? 'Milestone',
                'title' => $newEvent['title'] ?? 'New Timeline Event',
                'body' => $newEvent['body'] ?? null,
                'bullet_points' => $this->linesToArray($newEvent['bullet_points_text'] ?? ''),
                'image_paths' => $this->linesToArray($newEvent['image_paths_text'] ?? ''),
                'sort_order' => (int)($newEvent['sort_order'] ?? 0),
                'is_active' => !empty($newEvent['is_active']),
            ]);
        }
    }

    private function nullableDate(?string $value): ?string
    {
        return filled($value) ? $value : null;
    }

    private function validateTimeline(Request $request, bool $defaultActive = true): array
    {
        $data = $request->validate([
            'year' => ['required', 'string', 'max:20'],
            'category' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'body' => ['nullable', 'string', 'max:5000'],
            'bullet_points_text' => ['nullable', 'string', 'max:5000'],
            'image_paths_text' => ['nullable', 'string', 'max:5000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['category'] = $data['category'] ?: 'Milestone';
        $data['bullet_points'] = $this->linesToArray($request->input('bullet_points_text'));
        $data['image_paths'] = $this->linesToArray($request->input('image_paths_text'));
        $data['is_active'] = $request->boolean('is_active', $defaultActive);

        unset($data['bullet_points_text'], $data['image_paths_text']);

        return $data;
    }

    private function linesToArray(?string $text): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $text))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }
}

