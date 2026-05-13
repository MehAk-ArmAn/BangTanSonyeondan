<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LearningMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class LearningMaterialsController extends Controller
{
    public function index()
    {
        return view('admin.learning-materials.index', [
            'materials' => LearningMaterial::orderBy('sort_order')
                ->orderBy('title')
                ->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['title']);
        $data['links'] = $this->parseLinks($request->input('links_text'));
        $data['fun_facts'] = $this->parseSimpleLines($request->input('fun_facts_text'));
        $data['history_notes'] = $this->parseSimpleLines($request->input('history_notes_text'));

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active', true);

        if ($uploadedCover = $this->uploadToLearningFolder($request, 'image_file')) {
            $data['image_path'] = $uploadedCover;
        }

        if ($uploadedPoster = $this->uploadToLearningFolder($request, 'video_poster_file')) {
            $data['video_poster'] = $uploadedPoster;
        }

        $uploadedGallery = $this->uploadMultipleToLearningFolder($request, 'gallery_files');

        if (! empty($uploadedGallery)) {
            $existingGallery = $this->decodeList($data['gallery_images'] ?? []);
            $data['gallery_images'] = array_values(array_merge($existingGallery, $uploadedGallery));
        } else {
            $data['gallery_images'] = $this->decodeList($data['gallery_images'] ?? []);
        }

        unset(
            $data['image_file'],
            $data['video_poster_file'],
            $data['gallery_files'],
            $data['links_text'],
            $data['fun_facts_text'],
            $data['history_notes_text']
        );

        LearningMaterial::create($data);

        return back()->with('success', 'Learning material created.');
    }

    public function update(Request $request, LearningMaterial $learningMaterial)
    {
        $data = $this->validated($request, $learningMaterial->id);

        $data['slug'] = $data['slug']
            ? $this->uniqueSlug($data['slug'], $learningMaterial->id)
            : $this->uniqueSlug($data['title'], $learningMaterial->id);

        $data['links'] = $this->parseLinks($request->input('links_text'));
        $data['fun_facts'] = $this->parseSimpleLines($request->input('fun_facts_text'));
        $data['history_notes'] = $this->parseSimpleLines($request->input('history_notes_text'));

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');

        if ($uploadedCover = $this->uploadToLearningFolder($request, 'image_file')) {
            $data['image_path'] = $uploadedCover;
        }

        if ($uploadedPoster = $this->uploadToLearningFolder($request, 'video_poster_file')) {
            $data['video_poster'] = $uploadedPoster;
        }

        $uploadedGallery = $this->uploadMultipleToLearningFolder($request, 'gallery_files');

        if (! empty($uploadedGallery)) {
            $existingGallery = $this->decodeList($data['gallery_images'] ?? $learningMaterial->gallery_images ?? []);
            $data['gallery_images'] = array_values(array_merge($existingGallery, $uploadedGallery));
        } else {
            $data['gallery_images'] = $this->decodeList($data['gallery_images'] ?? []);
        }

        unset(
            $data['image_file'],
            $data['video_poster_file'],
            $data['gallery_files'],
            $data['links_text'],
            $data['fun_facts_text'],
            $data['history_notes_text']
        );

        $learningMaterial->update($data);

        return back()->with('success', 'Learning material saved.');
    }

    public function destroy(LearningMaterial $learningMaterial)
    {
        $learningMaterial->delete();

        return back()->with('success', 'Learning material deleted.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('learning_materials', 'slug')->ignore($ignoreId),
            ],

            'category' => ['nullable', 'string', 'max:160'],
            'topic_type' => ['nullable', 'string', 'max:160'],
            'difficulty' => ['nullable', 'string', 'max:80'],
            'excerpt' => ['nullable', 'string', 'max:900'],
            'body' => ['nullable', 'string'],

            /*
             * IMPORTANT:
             * DB paths must be like:
             * learning/bts-101-cover.jpg
             */
            'image_path' => ['nullable', 'string', 'max:1000'],
            'video_poster' => ['nullable', 'string', 'max:1000'],
            'gallery_images' => ['nullable'],

            'official_url' => ['nullable', 'url', 'max:1000'],
            'youtube_url' => ['nullable', 'url', 'max:1000'],
            'source_label' => ['nullable', 'string', 'max:180'],

            'links_text' => ['nullable', 'string'],
            'fun_facts_text' => ['nullable', 'string'],
            'history_notes_text' => ['nullable', 'string'],

            'image_file' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,jfif,png,webp,gif',
                'max:8192',
            ],

            'video_poster_file' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,jfif,png,webp,gif',
                'max:8192',
            ],

            'gallery_files.*' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,jfif,png,webp,gif',
                'max:8192',
            ],
            'gallery_files.*' => ['nullable', 'image', 'max:8192'],

            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }

    private function uploadToLearningFolder(Request $request, string $field): ?string
    {
        if (! $request->hasFile($field)) {
            return null;
        }

        $file = $request->file($field);

        if (! $file || ! $file->isValid()) {
            return null;
        }

        $extension = strtolower($file->getClientOriginalExtension() ?: 'jpg');
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeName = Str::slug($originalName) ?: 'learning-image';
        $fileName = $safeName . '-' . time() . '-' . Str::random(6) . '.' . $extension;

        $relativeFolder = 'learning';
        $publicFolder = public_path($relativeFolder);

        if (! is_dir($publicFolder)) {
            mkdir($publicFolder, 0755, true);
        }

        $file->move($publicFolder, $fileName);

        return $relativeFolder . '/' . $fileName;
    }

    private function uploadMultipleToLearningFolder(Request $request, string $field): array
    {
        if (! $request->hasFile($field)) {
            return [];
        }

        $paths = [];

        foreach ((array) $request->file($field) as $file) {
            if (! $file || ! $file->isValid()) {
                continue;
            }

            $extension = strtolower($file->getClientOriginalExtension() ?: 'jpg');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safeName = Str::slug($originalName) ?: 'learning-gallery';
            $fileName = $safeName . '-' . time() . '-' . Str::random(6) . '.' . $extension;

            $relativeFolder = 'learning';
            $publicFolder = public_path($relativeFolder);

            if (! is_dir($publicFolder)) {
                mkdir($publicFolder, 0755, true);
            }

            $file->move($publicFolder, $fileName);

            $paths[] = $relativeFolder . '/' . $fileName;
        }

        return $paths;
    }

    private function parseLinks(?string $text): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $text))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->map(function ($line) {
                $parts = array_map('trim', explode('|', $line));

                return [
                    'label' => $parts[0] ?? 'Open link',
                    'url' => $parts[1] ?? '',
                    'type' => $parts[2] ?? 'Source',
                ];
            })
            ->filter(fn ($link) => filter_var($link['url'], FILTER_VALIDATE_URL))
            ->values()
            ->all();
    }

    private function parseSimpleLines(?string $text): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $text))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }

    private function decodeList($value): array
    {
        if (is_array($value)) {
            return array_values(array_filter($value));
        }

        if (is_string($value) && trim($value) !== '') {
            $decoded = json_decode($value, true);

            if (is_array($decoded)) {
                return array_values(array_filter($decoded));
            }

            return collect(preg_split('/\r\n|\r|\n/', $value))
                ->map(fn ($line) => trim($line))
                ->filter()
                ->values()
                ->all();
        }

        return [];
    }

    private function uniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $base = Str::slug($value) ?: 'learning-material';
        $slug = $base;
        $counter = 2;

        while (
            LearningMaterial::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
