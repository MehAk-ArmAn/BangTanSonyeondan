<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\UploadsAdminImages;
use App\Http\Controllers\Controller;
use App\Models\SongImage;
use Illuminate\Http\Request;

class SongsController extends Controller
{
    use UploadsAdminImages;

    public function index()
    {
        return view('admin.songs.index', [
            'songsList' => SongImage::orderBy('sort_order')->orderByDesc('release_date')->orderByDesc('id')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $uploaded = $this->uploadAdminImage($request->file('image_file'), 'songs');
        if ($uploaded) $data['image'] = $uploaded;
        $data['is_active'] = $request->boolean('is_active', true);
        unset($data['image_file']);
        SongImage::create($data);
        return back()->with('success', 'Song added.');
    }

    public function update(Request $request, SongImage $song)
    {
        $data = $this->validated($request);
        $uploaded = $this->uploadAdminImage($request->file('image_file'), 'songs');
        if ($uploaded) $data['image'] = $uploaded;
        $data['is_active'] = $request->boolean('is_active');
        unset($data['image_file']);
        $song->update($data);
        return back()->with('success', 'Song updated.');
    }

    public function destroy(SongImage $song)
    {
        $song->delete();
        return back()->with('success', 'Song deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'string', 'max:1000'],
            'image_file' => ['nullable', 'image', 'max:4096'],
            'release_date' => ['nullable', 'date'],
            'era' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }
}
