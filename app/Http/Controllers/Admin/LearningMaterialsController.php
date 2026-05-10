<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LearningMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class LearningMaterialsController extends Controller
{
    public function index()
    {
        return view('admin.learning-materials.index', [
            'materials' => LearningMaterial::orderBy('sort_order')->orderBy('title')->get(),
            'categories' => LearningMaterial::select('category')
                ->distinct()
                ->orderBy('category')
                ->pluck('category'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['links'] = $this->parseLinks($request->input('links_text'));
        $data['is_active'] = $request->boolean('is_active', true);
        $data['is_featured'] = $request->boolean('is_featured');

        $uploaded = $this->uploadAdminImage($request, 'image_file', 'learning');
        if ($uploaded) {
            $data['image_path'] = $uploaded;
        }

        unset($data['image_file'], $data['links_text']);

        LearningMaterial::create($data);

        return back()->with('success', 'Learning material added successfully.');
    }

    public function update(Request $request, LearningMaterial $learning_material)
    {
        $data = $this->validated($request, $learning_material->id);

        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['links'] = $this->parseLinks($request->input('links_text'));
        $data['is_active'] = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');

        $uploaded = $this->uploadAdminImage($request, 'image_file', 'learning');
        if ($uploaded) {
            $data['image_path'] = $uploaded;
        }

        unset($data['image_file'], $data['links_text']);

        $learning_material->update($data);

        return back()->with('success', 'Learning material updated successfully.');
    }

    public function destroy(LearningMaterial $learning_material)
    {
        $learning_material->delete();

        return back()->with('success', 'Learning material deleted successfully.');
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

            'category' => ['required', 'string', 'max:120'],
            'topic_type' => ['required', 'string', 'max:80'],
            'difficulty' => ['nullable', 'string', 'max:80'],

            'excerpt' => ['nullable', 'string', 'max:600'],
            'body' => ['nullable', 'string'],

            'image_path' => ['nullable', 'string', 'max:1000'],
            'image_file' => ['nullable', 'image', 'max:4096'],

            'official_url' => ['nullable', 'url', 'max:1000'],
            'youtube_url' => ['nullable', 'url', 'max:1000'],
            'source_label' => ['nullable', 'string', 'max:120'],

            'links_text' => ['nullable', 'string'],

            'sort_order' => ['nullable', 'integer', 'min:0'],
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
                    'label' => $parts[0] ?? 'Official link',
                    'url' => $parts[1] ?? '',
                    'type' => $parts[2] ?? 'Official',
                ];
            })
            ->filter(fn ($link) => filter_var($link['url'], FILTER_VALIDATE_URL))
            ->values()
            ->all();
    }

    private function uploadAdminImage(Request $request, string $field, string $folder): ?string
    {
        if (! $request->hasFile($field)) {
            return null;
        }

        $file = $request->file($field);

        if (! $file || ! $file->isValid()) {
            return null;
        }

        $path = $file->store('admin/' . $folder, 'public');

        return 'storage/' . $path;
    }
}
