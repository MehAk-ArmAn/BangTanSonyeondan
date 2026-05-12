<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\UploadsAdminImages;
use App\Http\Controllers\Controller;
use App\Models\BtsUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BtsUpdatesController extends Controller
{
    use UploadsAdminImages;

    public function index()
    {
        return view('admin.updates.index', [
            'updates' => BtsUpdate::orderByDesc('is_pinned')
                ->orderByDesc('published_at')
                ->orderByDesc('id')
                ->get(),

            'categories' => BtsUpdate::whereNotNull('category')
                ->select('category')
                ->distinct()
                ->orderBy('category')
                ->pluck('category'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['title']);
        $data['links'] = $this->parseLinks($request->input('links_text'));

        $data['is_pinned'] = $request->boolean('is_pinned');
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active', true);

        if (! $request->filled('published_at')) {
            $data['published_at'] = now();
        }

        $uploadedImage = $this->uploadAdminImage($request->file('image_file'), 'updates');
        if ($uploadedImage) {
            $data['image_path'] = $uploadedImage;
        }

        $uploadedVideo = $this->uploadVideo($request);
        if ($uploadedVideo) {
            $data['video_path'] = $uploadedVideo;
        }

        unset($data['image_file'], $data['video_file'], $data['links_text']);

        BtsUpdate::create($data);

        return back()->with('success', 'Latest update published.');
    }

    public function update(Request $request, BtsUpdate $update)
    {
        $data = $this->validated($request, $update->id);

        $data['slug'] = $data['slug']
            ? $this->uniqueSlug($data['slug'], $update->id)
            : $this->uniqueSlug($data['title'], $update->id);

        $data['links'] = $this->parseLinks($request->input('links_text'));

        $data['is_pinned'] = $request->boolean('is_pinned');
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');

        $uploadedImage = $this->uploadAdminImage($request->file('image_file'), 'updates');
        if ($uploadedImage) {
            $data['image_path'] = $uploadedImage;
        }

        $uploadedVideo = $this->uploadVideo($request);
        if ($uploadedVideo) {
            $data['video_path'] = $uploadedVideo;
        }

        unset($data['image_file'], $data['video_file'], $data['links_text']);

        $update->update($data);

        return back()->with('success', 'Latest update saved.');
    }

    public function destroy(BtsUpdate $update)
    {
        $update->delete();

        return back()->with('success', 'Latest update deleted.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('bts_updates', 'slug')->ignore($ignoreId),
            ],

            'category' => ['nullable', 'string', 'max:120'],
            'source_label' => ['nullable', 'string', 'max:160'],
            'excerpt' => ['nullable', 'string', 'max:700'],
            'body' => ['nullable', 'string'],

            'image_path' => ['nullable', 'string', 'max:1000'],
            'image_file' => ['nullable', 'image', 'max:5120'],

            'video_url' => ['nullable', 'url', 'max:1000'],
            'video_path' => ['nullable', 'string', 'max:1000'],
            'video_file' => ['nullable', 'file', 'mimetypes:video/mp4,video/webm,video/quicktime', 'max:51200'],

            'links_text' => ['nullable', 'string'],

            'published_at' => ['nullable', 'date'],
            'sort_order' => ['nullable', 'integer', 'min:0'],

            'is_pinned' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }

    private function parseLinks(?string $text): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $text))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->map(function ($line) {
                $parts = array_map('trim', explode('|', $line));

                return [
                    'label' => $parts[0] ?? 'Link',
                    'url' => $parts[1] ?? '',
                    'type' => $parts[2] ?? 'Source',
                ];
            })
            ->filter(fn ($link) => filter_var($link['url'], FILTER_VALIDATE_URL))
            ->values()
            ->all();
    }

    private function uniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $base = Str::slug($value) ?: 'bts-update';
        $slug = $base;
        $counter = 2;

        while (
            BtsUpdate::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    private function uploadVideo(Request $request): ?string
    {
        if (! $request->hasFile('video_file')) {
            return null;
        }

        $file = $request->file('video_file');

        if (! $file || ! $file->isValid()) {
            return null;
        }

        return 'storage/' . $file->store('admin/updates/videos', 'public');
    }
}