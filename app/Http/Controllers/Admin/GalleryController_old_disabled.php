<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\UploadsAdminImages;
use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    use UploadsAdminImages;

    public function index()
    {
        return view('admin.gallery.index', [
            'galleryList' => GalleryImage::orderBy('sort_order')->orderByDesc('id')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $uploaded = $this->uploadAdminImage($request->file('image_file'), 'gallery');
        if ($uploaded) $data['image'] = $uploaded;
        $data['is_active'] = $request->boolean('is_active', true);
        unset($data['image_file']);
        GalleryImage::create($data);
        return back()->with('success', 'Gallery item added.');
    }

    public function update(Request $request, GalleryImage $gallery)
    {
        $data = $this->validated($request);
        $uploaded = $this->uploadAdminImage($request->file('image_file'), 'gallery');
        if ($uploaded) $data['image'] = $uploaded;
        $data['is_active'] = $request->boolean('is_active');
        unset($data['image_file']);
        $gallery->update($data);
        return back()->with('success', 'Gallery item updated.');
    }

    public function destroy(GalleryImage $gallery)
    {
        $gallery->delete();
        return back()->with('success', 'Gallery item deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'string', 'max:1000'],
            'image_file' => ['nullable', 'image', 'max:4096'],
            'caption' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }
}
