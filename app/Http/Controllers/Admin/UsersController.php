<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PointTransaction;
use App\Models\ProfileAsset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q'));

        $users = User::query()
            ->with('unlockedAssets')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($inner) use ($search) {
                    $inner->where('name', 'like', "%{$search}%")
                        ->orWhere('username', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('bio', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('is_admin')
            ->orderByDesc('points')
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        return view('admin.users.index', [
            'users' => $users,
            'profileAssets' => ProfileAsset::orderBy('sort_order')->orderBy('label')->get(),
            'search' => $search,
            'totalUsers' => User::count(),
            'adminUsers' => User::where('is_admin', true)->count(),
            'armyUsers' => User::where('is_admin', false)->count(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'username' => ['nullable', 'alpha_dash', 'min:3', 'max:30', 'unique:users,username'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
            'bio' => ['nullable', 'string', 'max:500'],
            'points' => ['required', 'integer', 'min:0', 'max:999999999999999'],
            'streak_days' => ['nullable', 'integer', 'min:0', 'max:999999'],
            'last_streak_date' => ['nullable', 'date'],
            'is_admin' => ['nullable', 'boolean'],
            'selected_profile_asset' => ['nullable', 'exists:profile_assets,id'],
            'unlocked_assets' => ['nullable', 'array'],
            'unlocked_assets.*' => ['integer', 'exists:profile_assets,id'],
        ]);

        $asset = !empty($data['selected_profile_asset'])
            ? ProfileAsset::find($data['selected_profile_asset'])
            : null;

        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'] ?? null,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'bio' => $data['bio'] ?? null,
            'points' => (int) $data['points'],
            'streak_days' => (int) ($data['streak_days'] ?? 0),
            'last_streak_date' => $data['last_streak_date'] ?? null,
            'is_admin' => $request->boolean('is_admin'),
            'avatar_key' => $this->assetAvatarValue($asset),
            'profile_theme' => $this->assetThemeValue($asset),
            'auth_provider' => 'email',
        ]);

        $this->syncUnlockedAssets($user, $data['unlocked_assets'] ?? [], $asset);

        if ($user->points > 0) {
            PointTransaction::create([
                'user_id' => $user->id,
                'type' => 'admin_adjustment',
                'points' => $user->points,
                'reason' => 'Admin created user with starter points',
                'meta' => ['admin_id' => Auth::id()],
            ]);
        }

        return back()->with('success', 'User created successfully.');
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'username' => [
                'nullable',
                'alpha_dash',
                'min:3',
                'max:30',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => ['nullable', 'string', 'min:8', 'max:255'],
            'bio' => ['nullable', 'string', 'max:500'],
            'points' => ['required', 'integer', 'min:0', 'max:999999999999999'],
            'streak_days' => ['required', 'integer', 'min:0', 'max:999999'],
            'last_streak_date' => ['nullable', 'date'],
            'is_admin' => ['nullable', 'boolean'],
            'selected_profile_asset' => ['nullable', 'exists:profile_assets,id'],
            'unlocked_assets' => ['nullable', 'array'],
            'unlocked_assets.*' => ['integer', 'exists:profile_assets,id'],
        ]);

        $oldPoints = (int) $user->points;
        $newPoints = (int) $data['points'];

        $asset = !empty($data['selected_profile_asset'])
            ? ProfileAsset::find($data['selected_profile_asset'])
            : null;

        $isAdmin = $request->boolean('is_admin');
        if ((int) $user->id === (int) Auth::id()) {
            $isAdmin = true; // prevents accidentally locking yourself out
        }

        $payload = [
            'name' => $data['name'],
            'username' => $data['username'] ?? null,
            'email' => $data['email'],
            'bio' => $data['bio'] ?? null,
            'points' => $newPoints,
            'streak_days' => (int) $data['streak_days'],
            'last_streak_date' => $data['last_streak_date'] ?? null,
            'is_admin' => $isAdmin,
        ];

        if ($asset) {
            $payload['avatar_key'] = $this->assetAvatarValue($asset);
            $payload['profile_theme'] = $this->assetThemeValue($asset);
        }

        if (!empty($data['password'])) {
            $payload['password'] = Hash::make($data['password']);
        }

        $user->update($payload);
        $this->syncUnlockedAssets($user, $data['unlocked_assets'] ?? [], $asset);

        $difference = $newPoints - $oldPoints;
        if ($difference !== 0) {
            PointTransaction::create([
                'user_id' => $user->id,
                'type' => 'admin_adjustment',
                'points' => $difference,
                'reason' => 'Admin points adjustment',
                'meta' => [
                    'admin_id' => Auth::id(),
                    'old_points' => $oldPoints,
                    'new_points' => $newPoints,
                ],
            ]);
        }

        return back()->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if ((int) $user->id === (int) Auth::id()) {
            return back()->with('error', 'You cannot delete your own admin account while logged in.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }

    private function syncUnlockedAssets(User $user, array $assetIds, ?ProfileAsset $selectedAsset = null): void
    {
        $assetIds = collect($assetIds)
            ->filter()
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values()
            ->all();

        if ($selectedAsset) {
            $assetIds[] = (int) $selectedAsset->id;
            $assetIds = array_values(array_unique($assetIds));
        }

        $user->unlockedAssets()->sync($assetIds);
    }

    private function assetAvatarValue(?ProfileAsset $asset): string
    {
        if (!$asset) {
            return 'purple-heart';
        }

        return $asset->avatar_image ?: ($asset->image_path ?: $asset->key);
    }

    private function assetThemeValue(?ProfileAsset $asset): string
    {
        if (!$asset) {
            return 'galaxy-purple';
        }

        return $asset->theme_class ?: ($asset->gradient ?: $asset->key);
    }
}
