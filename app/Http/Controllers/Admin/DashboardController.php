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

    private function linesToArray(?string $text): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $text))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }
}

