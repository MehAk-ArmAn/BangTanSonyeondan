<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bt21Character;
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
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


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
            'bt21List' => Bt21Character::orderBy('sort_order')->orderBy('id')->get(),
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

    public function storeBt21(Request $request)
    {
        $data = $this->validateBt21($request);
        Bt21Character::create($data);

        return back()->with('success', 'BT21 character added.');
    }

    public function updateBt21(Request $request, Bt21Character $bt21Character)
    {
        $data = $this->validateBt21($request, false, $bt21Character);
        $bt21Character->update($data);

        return back()->with('success', 'BT21 character updated.');
    }

    public function deleteBt21(Bt21Character $bt21Character)
    {
        $bt21Character->delete();

        return back()->with('success', 'BT21 character deleted.');
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

    private function validateBt21(Request $request, bool $defaultActive = true, ?Bt21Character $existing = null): array
    {
        $slugForValidation = Str::slug($request->input('slug') ?: $request->input('name'));
        $request->merge(['slug' => $slugForValidation]);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('bt21_characters', 'slug')->ignore($existing?->id)],
            'member_name' => ['nullable', 'string', 'max:255'],
            'emoji' => ['nullable', 'string', 'max:40'],
            'image' => ['nullable', 'string', 'max:255'],
            'accent_color' => ['nullable', 'string', 'max:30'],
            'mood' => ['nullable', 'string', 'max:500'],
            'power' => ['nullable', 'string', 'max:500'],
            'anatomy_text' => ['nullable', 'string', 'max:5000'],
            'moves_text' => ['nullable', 'string', 'max:3000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'image_file' => ['nullable', 'image', 'max:4096'],
        ]);

        $data['slug'] = $slugForValidation;
        $data['accent_color'] = $data['accent_color'] ?: '#a855f7';
        $data['anatomy'] = $this->linesToArray($request->input('anatomy_text'));
        $data['moves'] = $this->linesToArray($request->input('moves_text'));
        $data['is_active'] = $request->boolean('is_active', $defaultActive);

        unset($data['anatomy_text'], $data['moves_text'], $data['image_file']);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('uploads/bt21', 'public');
            $data['image'] = 'storage/' . $path;
        }

        return $data;
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

    public function saveAll(Request $request)
    {
        DB::transaction(function () use ($request) {
            $this->saveSettings($request->input('settings', []));
            $this->saveNavigation($request->input('nav', []), $request->input('new_nav', []));
            $this->saveBt21($request->input('bt21', []), $request->file('bt21_image_files', []), $request->input('new_bt21', []), $request->file('new_bt21_image_file'));
            $this->saveMembers($request->input('members', []), $request->file('member_image_files', []));
            $this->saveQuotes($request->input('quotes', []), $request->input('new_quote', []));
            $this->saveSongs($request->input('songs', []), $request->file('song_image_files', []), $request->input('new_song', []), $request->file('new_song_image_file'));
            $this->saveGallery($request->input('gallery', []), $request->file('gallery_image_files', []), $request->input('new_gallery', []), $request->file('new_gallery_image_file'));
            $this->saveTimeline($request->input('timeline', []), $request->input('new_timeline', []));
        });

        return back()->with('success', 'All dashboard changes were saved successfully.');
    }

    private function saveSettings(array $settings): void
    {
        foreach ($settings as $key => $value) {
            DB::table('site_settings')->updateOrInsert(
                ['key' => $key],
                $this->withTimestamps('site_settings', ['value' => $value ?? ''], true)
            );
        }
    }

    private function saveNavigation(array $items, array $newItem): void
    {
        foreach ($items as $id => $data) {
            if (!empty($data['delete'])) {
                DB::table('nav_items')->where('id', $id)->delete();
                continue;
            }

            DB::table('nav_items')->where('id', $id)->update($this->withTimestamps('nav_items', [
                'label' => $data['label'] ?? '',
                'url' => $data['url'] ?? '#',
                'sort_order' => (int)($data['sort_order'] ?? 0),
                'is_active' => (int)($data['is_active'] ?? 0),
            ]));
        }

        if (!empty($newItem['label']) || !empty($newItem['url'])) {
            DB::table('nav_items')->insert($this->withTimestamps('nav_items', [
                'label' => $newItem['label'] ?? 'New Link',
                'url' => $newItem['url'] ?? '#',
                'sort_order' => (int)($newItem['sort_order'] ?? 0),
                'is_active' => (int)($newItem['is_active'] ?? 0),
            ], true));
        }
    }


    private function saveBt21(array $characters, array $files, array $newCharacter, $newCharacterFile = null): void
    {
        foreach ($characters as $id => $data) {
            if (!empty($data['delete'])) {
                DB::table('bt21_characters')->where('id', $id)->delete();
                continue;
            }

            $payload = [
                'name' => $data['name'] ?? '',
                'slug' => Str::slug($data['slug'] ?? $data['name'] ?? ''),
                'member_name' => $data['member_name'] ?? null,
                'emoji' => $data['emoji'] ?? null,
                'image' => $data['image'] ?? null,
                'accent_color' => $data['accent_color'] ?? '#a855f7',
                'mood' => $data['mood'] ?? null,
                'power' => $data['power'] ?? null,
                'anatomy' => json_encode($this->linesToArray($data['anatomy_text'] ?? '')),
                'moves' => json_encode($this->linesToArray($data['moves_text'] ?? '')),
                'sort_order' => (int)($data['sort_order'] ?? 0),
                'is_active' => (int)($data['is_active'] ?? 0),
            ];

            $uploaded = $this->storePublicImage($files[$id] ?? null, 'bt21');
            if ($uploaded) {
                $payload['image'] = $uploaded;
            }

            DB::table('bt21_characters')->where('id', $id)->update($this->withTimestamps('bt21_characters', $payload));
        }

        if (!empty($newCharacter['name'])) {
            $payload = [
                'name' => $newCharacter['name'] ?? '',
                'slug' => Str::slug($newCharacter['slug'] ?? $newCharacter['name'] ?? ''),
                'member_name' => $newCharacter['member_name'] ?? null,
                'emoji' => $newCharacter['emoji'] ?? null,
                'image' => $newCharacter['image'] ?? null,
                'accent_color' => $newCharacter['accent_color'] ?? '#a855f7',
                'mood' => $newCharacter['mood'] ?? null,
                'power' => $newCharacter['power'] ?? null,
                'anatomy' => json_encode($this->linesToArray($newCharacter['anatomy_text'] ?? '')),
                'moves' => json_encode($this->linesToArray($newCharacter['moves_text'] ?? '')),
                'sort_order' => (int)($newCharacter['sort_order'] ?? 0),
                'is_active' => (int)($newCharacter['is_active'] ?? 0),
            ];

            $uploaded = $this->storePublicImage($newCharacterFile, 'bt21');
            if ($uploaded) {
                $payload['image'] = $uploaded;
            }

            DB::table('bt21_characters')->insert($this->withTimestamps('bt21_characters', $payload, true));
        }
    }

    private function saveMembers(array $members, array $files): void
    {
        foreach ($members as $id => $data) {
            $payload = [
                'name' => $data['name'] ?? '',
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
                'skill_tags' => json_encode($this->linesToArray($data['skill_tags_text'] ?? '')),
                'fun_facts' => json_encode($this->linesToArray($data['fun_facts_text'] ?? '')),
                'is_active' => (int)($data['is_active'] ?? 0),
            ];

            $uploaded = $this->storePublicImage($files[$id] ?? null, 'members');
            if ($uploaded) {
                $payload['image'] = $uploaded;
            }

            DB::table('members')->where('id', $id)->update($this->withTimestamps('members', $payload));
        }
    }

    private function saveQuotes(array $quotes, array $newQuote): void
    {
        foreach ($quotes as $id => $data) {
            if (!empty($data['delete'])) {
                DB::table('quotes')->where('id', $id)->delete();
                continue;
            }

            DB::table('quotes')->where('id', $id)->update($this->withTimestamps('quotes', [
                'source' => $data['source'] ?? '',
                'context' => $data['context'] ?? null,
                'quote' => $data['quote'] ?? '',
                'is_active' => (int)($data['is_active'] ?? 0),
            ]));
        }

        if (!empty($newQuote['quote'])) {
            DB::table('quotes')->insert($this->withTimestamps('quotes', [
                'source' => $newQuote['source'] ?? 'BTS',
                'context' => $newQuote['context'] ?? null,
                'quote' => $newQuote['quote'],
                'is_active' => (int)($newQuote['is_active'] ?? 0),
            ], true));
        }
    }

    private function saveSongs(array $songs, array $files, array $newSong, $newSongFile = null): void
    {
        foreach ($songs as $id => $data) {
            if (!empty($data['delete'])) {
                DB::table('songs')->where('id', $id)->delete();
                continue;
            }

            $payload = [
                'name' => $data['name'] ?? '',
                'era' => $data['era'] ?? null,
                'release_date' => $this->nullableDate($data['release_date'] ?? null),
                'img_path' => $data['img_path'] ?? null,
                'description' => $data['description'] ?? null,
                'is_active' => (int)($data['is_active'] ?? 0),
            ];

            $uploaded = $this->storePublicImage($files[$id] ?? null, 'songs');
            if ($uploaded) {
                $payload['img_path'] = $uploaded;
            }

            DB::table('songs')->where('id', $id)->update($this->withTimestamps('songs', $payload));
        }

        if (!empty($newSong['name'])) {
            $imgPath = $newSong['img_path'] ?? null;
            $uploaded = $this->storePublicImage($newSongFile, 'songs');
            if ($uploaded) {
                $imgPath = $uploaded;
            }

            DB::table('songs')->insert($this->withTimestamps('songs', [
                'name' => $newSong['name'],
                'era' => $newSong['era'] ?? null,
                'release_date' => $this->nullableDate($newSong['release_date'] ?? null),
                'img_path' => $imgPath,
                'description' => $newSong['description'] ?? null,
                'sort_order' => (int)($newSong['sort_order'] ?? 0),
                'is_active' => (int)($newSong['is_active'] ?? 0),
            ], true));
        }
    }

    private function saveGallery(array $gallery, array $files, array $newGallery, $newGalleryFile = null): void
    {
        foreach ($gallery as $id => $data) {
            if (!empty($data['delete'])) {
                DB::table('gallery_items')->where('id', $id)->delete();
                continue;
            }

            $payload = [
                'name' => $data['name'] ?? '',
                'category' => $data['category'] ?? null,
                'img_path' => $data['img_path'] ?? null,
                'is_active' => (int)($data['is_active'] ?? 0),
            ];

            $uploaded = $this->storePublicImage($files[$id] ?? null, 'gallery');
            if ($uploaded) {
                $payload['img_path'] = $uploaded;
            }

            DB::table('gallery_items')->where('id', $id)->update($this->withTimestamps('gallery_items', $payload));
        }

        if (!empty($newGallery['name']) || !empty($newGallery['img_path']) || $newGalleryFile) {
            $imgPath = $newGallery['img_path'] ?? null;
            $uploaded = $this->storePublicImage($newGalleryFile, 'gallery');
            if ($uploaded) {
                $imgPath = $uploaded;
            }

            DB::table('gallery_items')->insert($this->withTimestamps('gallery_items', [
                'name' => $newGallery['name'] ?? 'New Gallery Image',
                'category' => $newGallery['category'] ?? null,
                'img_path' => $imgPath,
                'is_active' => (int)($newGallery['is_active'] ?? 0),
            ], true));
        }
    }

    private function saveTimeline(array $events, array $newEvent): void
    {
        foreach ($events as $id => $data) {
            if (!empty($data['delete'])) {
                DB::table('timeline_events')->where('id', $id)->delete();
                continue;
            }

            DB::table('timeline_events')->where('id', $id)->update($this->withTimestamps('timeline_events', [
                'year' => $data['year'] ?? '',
                'category' => $data['category'] ?? 'Milestone',
                'title' => $data['title'] ?? '',
                'body' => $data['body'] ?? null,
                'bullet_points' => json_encode($this->linesToArray($data['bullet_points_text'] ?? '')),
                'image_paths' => json_encode($this->linesToArray($data['image_paths_text'] ?? '')),
                'sort_order' => (int)($data['sort_order'] ?? 0),
                'is_active' => (int)($data['is_active'] ?? 0),
            ]));
        }

        if (!empty($newEvent['year']) || !empty($newEvent['title'])) {
            DB::table('timeline_events')->insert($this->withTimestamps('timeline_events', [
                'year' => $newEvent['year'] ?? '',
                'category' => $newEvent['category'] ?? 'Milestone',
                'title' => $newEvent['title'] ?? 'New Timeline Event',
                'body' => $newEvent['body'] ?? null,
                'bullet_points' => json_encode($this->linesToArray($newEvent['bullet_points_text'] ?? '')),
                'image_paths' => json_encode($this->linesToArray($newEvent['image_paths_text'] ?? '')),
                'sort_order' => (int)($newEvent['sort_order'] ?? 0),
                'is_active' => (int)($newEvent['is_active'] ?? 0),
            ], true));
        }
    }

    private function storePublicImage($file, string $folder): ?string
    {
        if (!$file || !$file->isValid()) {
            return null;
        }

        return 'storage/' . $file->store("admin/$folder", 'public');
    }

    private function linesToArray(?string $text): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string)$text))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }

    private function nullableDate(?string $value): ?string
    {
        return filled($value) ? $value : null;
    }

    private function withTimestamps(string $table, array $data, bool $creating = false): array
    {
        $now = now();

        if (Schema::hasColumn($table, 'updated_at')) {
            $data['updated_at'] = $now;
        }

        if ($creating && Schema::hasColumn($table, 'created_at')) {
            $data['created_at'] = $now;
        }

        return $data;
    }

}

