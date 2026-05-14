<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfileAsset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q', ''));

        return view('admin.users.index', [
            'users' => User::query()
                ->when($search !== '', function ($q) use ($search) {
                    $like = '%' . $search . '%';

                    $q->where(function ($inner) use ($like) {
                        $inner->where('name', 'like', $like)
                            ->orWhere('username', 'like', $like)
                            ->orWhere('email', 'like', $like);
                    });
                })
                ->orderByDesc('points')
                ->orderBy('name')
                ->paginate(25)
                ->withQueryString(),

            'assets' => ProfileAsset::orderBy('type')->orderBy('label')->get(),
            'search' => $search,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'username' => ['nullable', 'alpha_dash', 'min:3', 'max:30', Rule::unique('users', 'username')->ignore($user->id)],
            'bio' => ['nullable', 'string', 'max:500'],
            'points' => ['nullable', 'integer', 'min:0'],
            'streak_days' => ['nullable', 'integer', 'min:0'],
            'avatar_key' => ['nullable', 'string', 'max:1000'],
            'profile_theme' => ['nullable', 'string', 'max:180'],
            'badge_key' => ['nullable', 'string', 'max:180'],
            'profile_visibility' => ['required', Rule::in(['public', 'private'])],
            'is_admin' => ['nullable', 'boolean'],
        ]);

        $user->forceFill([
            'name' => $data['name'],
            'username' => $data['username'] ?: null,
            'bio' => $data['bio'] ?: null,
            'points' => (int) ($data['points'] ?? 0),
            'streak_days' => (int) ($data['streak_days'] ?? 0),
            'avatar_key' => $data['avatar_key'] ?: null,
            'profile_theme' => $data['profile_theme'] ?: 'galaxy-purple',
            'badge_key' => $data['badge_key'] ?: null,
            'profile_visibility' => $data['profile_visibility'],
            'is_admin' => $request->boolean('is_admin'),
        ])->save();

        return back()->with('success', 'User profile updated by admin.');
    }

    public function syncAssets(Request $request, User $user)
    {
        $data = $request->validate([
            'asset_ids' => ['nullable', 'array'],
            'asset_ids.*' => ['integer', 'exists:profile_assets,id'],
        ]);

        $syncData = collect($data['asset_ids'] ?? [])
            ->mapWithKeys(fn ($id) => [$id => ['unlocked_at' => now()]])
            ->toArray();

        $user->unlockedAssets()->sync($syncData);

        return back()->with('success', 'User profile packs updated.');
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot delete your own admin account.');
        }

        $user->delete();

        return back()->with('success', 'User deleted.');
    }
}
