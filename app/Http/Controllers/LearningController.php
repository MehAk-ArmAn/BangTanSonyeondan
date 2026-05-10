<?php

namespace App\Http\Controllers;

use App\Models\LearningMaterial;
use App\Models\User;
use Illuminate\Http\Request;

class LearningController extends Controller
{
    public function index(Request $request)
    {
        $query = trim((string) $request->query('q', ''));
        $category = trim((string) $request->query('category', ''));
        $type = trim((string) $request->query('type', ''));

        $materialsQuery = LearningMaterial::visible()
            ->when($query !== '', function ($q) use ($query) {
                $like = '%' . $query . '%';
                $q->where(function ($inner) use ($like) {
                    $inner->where('title', 'like', $like)
                        ->orWhere('category', 'like', $like)
                        ->orWhere('topic_type', 'like', $like)
                        ->orWhere('excerpt', 'like', $like)
                        ->orWhere('body', 'like', $like);
                });
            })
            ->when($category !== '', fn ($q) => $q->where('category', $category))
            ->when($type !== '', fn ($q) => $q->where('topic_type', $type));

        return view('learn.index', [
            'materials' => $materialsQuery->orderByDesc('is_featured')->orderBy('sort_order')->orderBy('title')->get(),
            'categories' => LearningMaterial::visible()->select('category')->distinct()->orderBy('category')->pluck('category'),
            'types' => LearningMaterial::visible()->select('topic_type')->distinct()->orderBy('topic_type')->pluck('topic_type'),
            'query' => $query,
            'category' => $category,
            'type' => $type,
        ]);
    }

    public function show(string $slug)
    {
        $material = LearningMaterial::visible()
            ->where('slug', $slug)
            ->firstOrFail();

        $related = LearningMaterial::visible()
            ->where('id', '!=', $material->id)
            ->where(function ($query) use ($material) {
                $query->where('category', $material->category)
                    ->orWhere('topic_type', $material->topic_type);
            })
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        return view('learn.show', compact('material', 'related'));
    }

    public function leaderboard()
    {
        return view('learn.leaderboard', [
            'users' => User::where('is_admin', false)->orderByDesc('points')->orderBy('name')->limit(50)->get(),
        ]);
    }
}
