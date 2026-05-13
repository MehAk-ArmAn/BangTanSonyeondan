<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaAlbum;
use App\Models\MediaItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class MediaGalleryController extends Controller
{
    public function index()
    {
        return view('admin.media-gallery.index', [
            'albums' => MediaAlbum::with(['items' => fn ($q) => $q->orderBy('sort_order')->orderByDesc('created_at')])
                ->orderBy('sort_order')
                ->orderBy('title')
                ->get(),

            'items' => MediaItem::with('album')
                ->orderByDesc('created_at')
                ->limit(60)
                ->get(),
        ]);
    }

    public function storeAlbum(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:media_albums,slug'],
            'description' => ['nullable', 'string'],
            'cover_path' => ['nullable', 'string', 'max:1000'],
            'cover_file' => ['nullable', 'image', 'max:5120'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['slug'] = $data['slug'] ?: $this->uniqueAlbumSlug($data['title']);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active', true);

        if ($uploaded = $this->uploadFile($request, 'cover_file', 'albums')) {
            $data['cover_path'] = $uploaded;
        }

        unset($data['cover_file']);

        MediaAlbum::create($data);

        return back()->with('success', 'Album created.');
    }

    public function updateAlbum(Request $request, MediaAlbum $album)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('media_albums', 'slug')->ignore($album->id),
            ],

            'description' => ['nullable', 'string'],
            'cover_path' => ['nullable', 'string', 'max:1000'],
            'cover_file' => ['nullable', 'image', 'max:5120'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['slug'] = $data['slug'] ?: $this->uniqueAlbumSlug($data['title'], $album->id);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');

        if ($uploaded = $this->uploadFile($request, 'cover_file', 'albums')) {
            $data['cover_path'] = $uploaded;
        }

        unset($data['cover_file']);

        $album->update($data);

        return back()->with('success', 'Album saved.');
    }

    public function destroyAlbum(MediaAlbum $album)
    {
        $album->delete();

        return back()->with('success', 'Album deleted.');
    }

    public function storeItem(Request $request)
    {
        $data = $this->validatedItem($request);

        if ($uploaded = $this->uploadFile($request, 'media_file', 'items')) {
            $data['file_path'] = $uploaded;
        }

        if ($uploadedThumb = $this->uploadFile($request, 'thumbnail_file', 'thumbs')) {
            $data['thumbnail_path'] = $uploadedThumb;
        }

        $data['media_type'] = $data['media_type'] ?: 'image';
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active', true);

        unset($data['media_file'], $data['thumbnail_file']);

        MediaItem::create($data);

        return back()->with('success', 'Media item added.');
    }

    public function updateItem(Request $request, MediaItem $item)
    {
        $data = $this->validatedItem($request);

        if ($uploaded = $this->uploadFile($request, 'media_file', 'items')) {
            $data['file_path'] = $uploaded;
        }

        if ($uploadedThumb = $this->uploadFile($request, 'thumbnail_file', 'thumbs')) {
            $data['thumbnail_path'] = $uploadedThumb;
        }

        $data['media_type'] = $data['media_type'] ?: 'image';
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');

        unset($data['media_file'], $data['thumbnail_file']);

        $item->update($data);

        return back()->with('success', 'Media item saved.');
    }

    public function destroyItem(MediaItem $item)
    {
        $item->delete();

        return back()->with('success', 'Media item deleted.');
    }

    private function validatedItem(Request $request): array
    {
        return $request->validate([
            'media_album_id' => ['nullable', 'exists:media_albums,id'],
            'media_type' => ['required', Rule::in(['image', 'video', 'youtube'])],
            'title' => ['required', 'string', 'max:255'],
            'caption' => ['nullable', 'string'],
            'file_path' => ['nullable', 'string', 'max:1000'],
            'media_file' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,gif,mp4,webm,mov', 'max:51200'],
            'thumbnail_path' => ['nullable', 'string', 'max:1000'],
            'thumbnail_file' => ['nullable', 'image', 'max:5120'],
            'video_url' => ['nullable', 'url', 'max:1000'],
            'tags' => ['nullable', 'string', 'max:1000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'taken_at' => ['nullable', 'date'],
        ]);
    }

    private function uploadFile(Request $request, string $field, string $folder): ?string
    {
        if (! $request->hasFile($field)) {
            return null;
        }

        $file = $request->file($field);

        if (! $file || ! $file->isValid()) {
            return null;
        }

        return 'storage/' . $file->store('admin/media-gallery/' . $folder, 'public');
    }

    private function uniqueAlbumSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'album';
        $slug = $base;
        $counter = 2;

        while (
            MediaAlbum::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
