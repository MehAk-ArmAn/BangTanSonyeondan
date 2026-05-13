<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\UploadsAdminImages;
use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MembersController extends Controller
{
    use UploadsAdminImages;

    public function index()
    {
        return view('admin.members.index', [
            'membersList' => Member::orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function update(Request $request, Member $member)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'stage_name' => ['nullable', 'string', 'max:255'],
            'nickname' => ['nullable', 'string', 'max:255'],
            'korean_name' => ['nullable', 'string', 'max:255'],
            'role' => ['nullable', 'string', 'max:255'],
            'birth_date' => ['nullable', 'date'],
            'birthplace' => ['nullable', 'string', 'max:255'],
            'emoji' => ['nullable', 'string', 'max:50'],
            'accent_color' => ['nullable', 'string', 'max:50'],
            'bt21_character' => ['nullable', 'string', 'max:255'],
            'intro_title' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'string', 'max:1000'],
            'image_file' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,jfif,png,webp,gif',
                'max:8192',
            ],
            'favicon' => ['nullable', 'string', 'max:1000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'short_bio' => ['nullable', 'string'],
            'long_bio' => ['nullable', 'string'],
            'fun_facts_text' => ['nullable', 'string'],
        ]);

        $uploaded = $this->uploadAdminImage($request->file('image_file'), 'members');
        if ($uploadedImage = $this->uploadMemberImage($request, 'image_file')) {
            $data['image_path'] = $uploadedImage;
        }

        $data['slug'] = Str::slug($data['stage_name'] ?: $data['name']);
        $data['is_active'] = $request->boolean('is_active');
        $data['fun_facts'] = $this->linesToArray($request->input('fun_facts_text'));
        unset($data['image_file'], $data['fun_facts_text']);

        $member->update($data);
        return back()->with('success', 'Member profile updated.');
    }

    private function uploadMemberImage(\Illuminate\Http\Request $request, string $field): ?string
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
        $safeName = \Illuminate\Support\Str::slug($originalName) ?: 'member';
        $fileName = $safeName . '-' . time() . '-' . \Illuminate\Support\Str::random(6) . '.' . $extension;

        $relativeFolder = 'members';
        $publicFolder = public_path($relativeFolder);

        if (! is_dir($publicFolder)) {
            mkdir($publicFolder, 0755, true);
        }

        $file->move($publicFolder, $fileName);

        return $relativeFolder . '/' . $fileName;
    }
}
