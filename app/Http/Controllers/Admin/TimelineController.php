<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\UploadsAdminImages;
use App\Http\Controllers\Controller;
use App\Models\TimelineEvent;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    use UploadsAdminImages;

    public function index()
    {
        return view('admin.timeline.index', [
            'timelineList' => TimelineEvent::orderBy('sort_order')->orderBy('year')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->prepare($request);
        TimelineEvent::create($data);
        return back()->with('success', 'Timeline event added.');
    }

    public function update(Request $request, TimelineEvent $timeline)
    {
        $timeline->update($this->prepare($request));
        return back()->with('success', 'Timeline event updated.');
    }

    public function destroy(TimelineEvent $timeline)
    {
        $timeline->delete();
        return back()->with('success', 'Timeline event deleted.');
    }

    private function prepare(Request $request): array
    {
        $data = $request->validate([
            'year' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'body' => ['nullable', 'string'],
            'bullet_points_text' => ['nullable', 'string'],
            'image_paths_text' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['bullet_points'] = $this->linesToArray($request->input('bullet_points_text'));
        $data['image_paths'] = $this->linesToArray($request->input('image_paths_text'));
        $data['is_active'] = $request->boolean('is_active', true);
        unset($data['bullet_points_text'], $data['image_paths_text']);
        return $data;
    }
}
