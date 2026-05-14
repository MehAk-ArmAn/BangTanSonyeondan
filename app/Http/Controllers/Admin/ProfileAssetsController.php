<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfileAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProfileAssetsController extends Controller
{
    public function index()
    {
        return view('admin.profile-assets.index', [
            'assets' => ProfileAsset::orderBy('sort_order')->orderBy('type')->orderBy('label')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $data['key'] = $this->uniqueKey($data['key'] ?: $data['label']);
        $data['is_active'] = $request->boolean('is_active', true);

        if ($uploaded = $this->uploadAsset($request, 'image_file')) {
            $data['image_path'] = $uploaded;
        }

        if ($uploaded = $this->uploadAsset($request, 'avatar_file')) {
            $data['avatar_image'] = $uploaded;
        }

        unset($data['image_file'], $data['avatar_file']);

        ProfileAsset::create($data);

        return back()->with('success', 'Profile pack created.');
    }

    public function update(Request $request, ProfileAsset $profileAsset)
    {
        $data = $this->validated($request, $profileAsset->id);

        $data['key'] = $data['key']
            ? $this->uniqueKey($data['key'], $profileAsset->id)
            : $this->uniqueKey($data['label'], $profileAsset->id);

        $data['is_active'] = $request->boolean('is_active');

        if ($uploaded = $this->uploadAsset($request, 'image_file')) {
            $data['image_path'] = $uploaded;
        }

        if ($uploaded = $this->uploadAsset($request, 'avatar_file')) {
            $data['avatar_image'] = $uploaded;
        }

        unset($data['image_file'], $data['avatar_file']);

        $profileAsset->update($data);

        return back()->with('success', 'Profile pack saved.');
    }

    public function destroy(ProfileAsset $profileAsset)
    {
        $profileAsset->delete();

        return back()->with('success', 'Profile pack deleted.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'key' => ['nullable', 'string', 'max:120', Rule::unique('profile_assets', 'key')->ignore($ignoreId)],
            'label' => ['required', 'string', 'max:180'],
            'type' => ['required', Rule::in(['avatar', 'theme', 'badge', 'bundle'])],
            'description' => ['nullable', 'string', 'max:1000'],
            'cost' => ['nullable', 'integer', 'min:0'],
            'image_path' => ['nullable', 'string', 'max:1000'],
            'avatar_image' => ['nullable', 'string', 'max:1000'],
            'theme_class' => ['nullable', 'string', 'max:120'],
            'badge_label' => ['nullable', 'string', 'max:180'],
            'gradient' => ['nullable', 'string', 'max:1000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],

            'image_file' => ['nullable', 'file', 'mimes:jpg,jpeg,jfif,png,webp,gif,svg', 'max:8192'],
            'avatar_file' => ['nullable', 'file', 'mimes:jpg,jpeg,jfif,png,webp,gif,svg', 'max:8192'],
        ]);
    }

    private function uploadAsset(Request $request, string $field): ?string
    {
        if (! $request->hasFile($field)) {
            return null;
        }

        $file = $request->file($field);

        if (! $file || ! $file->isValid()) {
            return null;
        }

        $extension = strtolower($file->getClientOriginalExtension() ?: 'jpg');
        $safeName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) ?: 'profile-asset';
        $fileName = $safeName . '-' . time() . '-' . Str::random(6) . '.' . $extension;

        $folder = 'profile-assets';
        $publicFolder = public_path($folder);

        if (! is_dir($publicFolder)) {
            mkdir($publicFolder, 0755, true);
        }

        $file->move($publicFolder, $fileName);

        return $folder . '/' . $fileName;
    }

    private function uniqueKey(string $value, ?int $ignoreId = null): string
    {
        $base = Str::slug($value) ?: 'profile-pack';
        $key = $base;
        $count = 2;

        while (
            ProfileAsset::where('key', $key)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $key = $base . '-' . $count;
            $count++;
        }

        return $key;
    }
}
