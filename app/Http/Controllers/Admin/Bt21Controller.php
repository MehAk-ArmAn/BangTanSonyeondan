<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\UploadsAdminImages;
use App\Http\Controllers\Controller;
use App\Models\Bt21Character;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Bt21Controller extends Controller
{
    use UploadsAdminImages;

    public function index()
    {
        return view('admin.bt21.index', [
            'bt21List' => Bt21Character::orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function store(Request $request)
    {
        Bt21Character::create($this->prepare($request));
        return back()->with('success', 'BT21 character added.');
    }

    public function update(Request $request, Bt21Character $bt21)
    {
        $bt21->update($this->prepare($request));
        return back()->with('success', 'BT21 character updated.');
    }

    public function destroy(Bt21Character $bt21)
    {
        $bt21->delete();
        return back()->with('success', 'BT21 character deleted.');
    }

    private function prepare(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'member_name' => ['nullable', 'string', 'max:255'],
            'emoji' => ['nullable', 'string', 'max:50'],
            'image' => ['nullable', 'string', 'max:1000'],
            'image_file' => ['nullable', 'image', 'max:4096'],
            'accent_color' => ['nullable', 'string', 'max:50'],
            'mood' => ['nullable', 'string'],
            'power' => ['nullable', 'string'],
            'anatomy_text' => ['nullable', 'string'],
            'moves_text' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $uploaded = $this->uploadAdminImage($request->file('image_file'), 'bt21');
        if ($uploaded) $data['image'] = $uploaded;
        $data['slug'] = Str::slug($data['slug'] ?: $data['name']);
        $data['anatomy'] = $this->linesToArray($request->input('anatomy_text'));
        $data['moves'] = $this->linesToArray($request->input('moves_text'));
        $data['is_active'] = $request->boolean('is_active', true);
        unset($data['image_file'], $data['anatomy_text'], $data['moves_text']);
        return $data;
    }
}
