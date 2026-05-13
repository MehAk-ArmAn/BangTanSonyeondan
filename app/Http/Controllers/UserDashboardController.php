<?php

namespace App\Http\Controllers;

use App\Models\DailyCheckin;
use App\Models\LearningMaterial;
use App\Models\PointTransaction;
use App\Models\ProfileAsset;
use App\Models\QuizGame;
use App\Models\QuizGameAttempt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserDashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $today = today();
        $skin = $this->profileSkin($user);
        $displayStreak = $this->currentStreak($user);

        $rank = User::where('is_admin', false)
            ->where('points', '>', $user->points)
            ->count() + 1;

        return view('user.dashboard', [
            'user' => $user,
            'skin' => $skin,
            'displayStreak' => $displayStreak,
            'rank' => $rank,

            'materials' => LearningMaterial::where('is_active', true)
                ->orderByDesc('is_featured')
                ->orderBy('sort_order')
                ->orderBy('title')
                ->limit(6)
                ->get(),

            'quizzes' => QuizGame::where('is_active', true)
                ->withCount(['questions' => fn ($q) => $q->where('is_active', true)])
                ->orderByDesc('is_featured')
                ->orderBy('sort_order')
                ->orderBy('title')
                ->limit(6)
                ->get(),

            'recentAttempts' => QuizGameAttempt::with('quiz')
                ->where('user_id', $user->id)
                ->latest()
                ->limit(5)
                ->get(),

            'recentPoints' => PointTransaction::where('user_id', $user->id)
                ->latest()
                ->limit(8)
                ->get(),

            'leaderboard' => User::where('is_admin', false)
                ->orderByDesc('points')
                ->orderBy('name')
                ->limit(8)
                ->get(),

            'communityUsers' => User::where('is_admin', false)
                ->where(function ($query) {
                    $query->where('profile_visibility', 'public')
                        ->orWhereNull('profile_visibility');
                })
                ->where('id', '!=', $user->id)
                ->orderByDesc('points')
                ->orderBy('name')
                ->limit(6)
                ->get(),

            'checkedInToday' => DailyCheckin::where('user_id', $user->id)
                ->whereDate('checkin_date', $today)
                ->exists(),

            'assets' => ProfileAsset::where('is_active', true)
                ->orderBy('sort_order')
                ->get(),

            'unlockedAssetIds' => $user->unlockedAssets()
                ->pluck('profile_assets.id')
                ->toArray(),
        ]);
    }

    public function checkin(Request $request)
    {
        $user = Auth::user();
        $today = today();

        $alreadyCheckedToday = DailyCheckin::where('user_id', $user->id)
            ->whereDate('checkin_date', $today)
            ->exists();

        if ($alreadyCheckedToday) {
            return back()->with('success', 'You already claimed today’s streak points. Come back tomorrow.');
        }

        $currentStreak = $this->currentStreak($user);
        $newStreak = $currentStreak + 1;

        $points = min(10 + ($newStreak * 2), 40);

        DailyCheckin::create([
            'user_id' => $user->id,
            'checkin_date' => $today,
            'points_earned' => $points,
            'streak_after' => $newStreak,
        ]);

        $user->forceFill([
            'points' => $user->points + $points,
            'streak_days' => $newStreak,
            'last_streak_date' => $today,
        ])->save();

        PointTransaction::create([
            'user_id' => $user->id,
            'type' => 'earn',
            'points' => $points,
            'reason' => 'Daily streak check-in',
            'meta' => ['streak_days' => $newStreak],
        ]);

        return back()->with('success', "Daily streak claimed! +{$points} points. Your streak is now {$newStreak} days.");
    }

    public function profile()
    {
        $user = Auth::user();

        return view('profile.edit', [
            'user' => $user,
            'assets' => ProfileAsset::where('is_active', true)->orderBy('sort_order')->get(),
            'unlockedAssetIds' => $user->unlockedAssets()->pluck('profile_assets.id')->toArray(),
            'displayStreak' => $this->currentStreak($user),
            'skin' => $this->profileSkin($user),
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'username' => [
                'nullable',
                'alpha_dash',
                'min:3',
                'max:30',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'bio' => ['nullable', 'string', 'max:500'],
            'profile_asset' => ['nullable', 'string', 'max:120'],
            'profile_visibility' => ['nullable', Rule::in(['public', 'private'])],
        ]);

        $nextAvatar = $user->avatar_key ?: 'favicons/logo.png';
        $nextTheme = $user->profile_theme ?: 'galaxy-purple';
        $nextBadge = $user->badge_key ?? null;

        if (! empty($data['profile_asset'])) {
            $unlockedKeys = $user->unlockedAssets()
                ->pluck('profile_assets.key')
                ->toArray();

            $freeKeys = ProfileAsset::where('is_active', true)
                ->where('cost', 0)
                ->pluck('key')
                ->toArray();

            $allowedKeys = array_unique(array_merge($unlockedKeys, $freeKeys));

            $asset = ProfileAsset::where('is_active', true)
                ->where('key', $data['profile_asset'])
                ->whereIn('key', $allowedKeys)
                ->first();

            if (! $asset) {
                return back()
                    ->withInput()
                    ->with('error', 'That profile upgrade is locked. Earn points or unlock it first.');
            }

            $assetType = strtolower((string) $asset->type);
            $assetAvatar = $asset->avatar_image ?: $asset->image_path;
            $assetTheme = $asset->theme_class ?: ($assetType === 'theme' ? $asset->key : null);
            $assetBadge = $asset->badge_label ?: ($assetType === 'badge' ? $asset->label : null);

            if ($assetType === 'bundle') {
                $nextAvatar = $assetAvatar ?: $nextAvatar;
                $nextTheme = $assetTheme ?: $nextTheme;
                $nextBadge = $assetBadge ?: $nextBadge;
            } elseif ($assetType === 'avatar') {
                $nextAvatar = $assetAvatar ?: $asset->key;
            } elseif ($assetType === 'theme') {
                $nextTheme = $assetTheme ?: $asset->key;
            } elseif ($assetType === 'badge') {
                $nextBadge = $assetBadge ?: $asset->label;
            } else {
                $nextAvatar = $assetAvatar ?: $nextAvatar;
                $nextTheme = $assetTheme ?: $nextTheme;
                $nextBadge = $assetBadge ?: $nextBadge;
            }
        }

        $user->forceFill([
            'name' => $data['name'],
            'username' => $data['username'] ?: null,
            'bio' => $data['bio'] ?: null,
            'avatar_key' => $nextAvatar,
            'profile_theme' => $nextTheme,
            'badge_key' => $nextBadge,
            'profile_visibility' => $data['profile_visibility'] ?? ($user->profile_visibility ?? 'public'),
        ])->save();

        return back()->with('success', 'Profile updated! Your avatar, theme, badge, and dashboard vibe are saved.');
    }

    public function unlockAsset(ProfileAsset $asset)
    {
        $user = Auth::user();

        if (! $asset->is_active) {
            abort(404);
        }

        if ($user->unlockedAssets()->where('profile_assets.id', $asset->id)->exists()) {
            return back()->with('success', 'You already unlocked this upgrade.');
        }

        if ($user->points < $asset->cost) {
            return back()->with('error', 'Not enough points yet. Take quizzes or claim streaks first.');
        }

        DB::transaction(function () use ($user, $asset) {
            $user->decrement('points', $asset->cost);
            $user->unlockedAssets()->syncWithoutDetaching([$asset->id]);

            PointTransaction::create([
                'user_id' => $user->id,
                'type' => 'spend',
                'points' => -$asset->cost,
                'reason' => 'Unlocked profile upgrade: ' . $asset->label,
                'meta' => ['asset_key' => $asset->key],
            ]);
        });

        return back()->with('success', 'Upgrade unlocked.');
    }

    public function community(Request $request)
    {
        $query = trim((string) $request->query('q', ''));

        $users = User::where('is_admin', false)
            ->where(function ($q) {
                $q->where('profile_visibility', 'public')
                    ->orWhereNull('profile_visibility');
            })
            ->when($query !== '', function ($q) use ($query) {
                $like = '%' . $query . '%';

                $q->where(function ($inner) use ($like) {
                    $inner->where('name', 'like', $like)
                        ->orWhere('username', 'like', $like)
                        ->orWhere('bio', 'like', $like);
                });
            })
            ->orderByDesc('points')
            ->orderBy('name')
            ->paginate(18)
            ->withQueryString();

        return view('user.community', [
            'users' => $users,
            'query' => $query,
        ]);
    }

    public function publicProfile(string $profile)
    {
        $profileUser = User::where(function ($q) {
                $q->where('profile_visibility', 'public')
                    ->orWhereNull('profile_visibility');
            })
            ->where(function ($query) use ($profile) {
                $query->where('username', $profile);

                if (str_starts_with($profile, 'army-')) {
                    $query->orWhere('id', (int) str_replace('army-', '', $profile));
                }
            })
            ->firstOrFail();

        return view('user.public-profile', [
            'profileUser' => $profileUser,
            'skin' => $this->profileSkin($profileUser),
            'recentAttempts' => QuizGameAttempt::with('quiz')->where('user_id', $profileUser->id)->latest()->limit(4)->get(),
            'recentPoints' => PointTransaction::where('user_id', $profileUser->id)->latest()->limit(6)->get(),
        ]);
    }

    private function currentStreak(User $user): int
    {
        $dates = DailyCheckin::where('user_id', $user->id)
            ->orderByDesc('checkin_date')
            ->pluck('checkin_date')
            ->map(fn ($date) => Carbon::parse($date)->toDateString())
            ->unique()
            ->values();

        if ($dates->isEmpty()) {
            return 0;
        }

        $today = today();
        $yesterday = today()->subDay();

        $latestDate = Carbon::parse($dates->first());

        if (! $latestDate->isSameDay($today) && ! $latestDate->isSameDay($yesterday)) {
            return 0;
        }

        $expectedDate = $latestDate->copy();
        $streak = 0;

        foreach ($dates as $date) {
            $checkinDate = Carbon::parse($date);

            if ($checkinDate->isSameDay($expectedDate)) {
                $streak++;
                $expectedDate->subDay();
            } else {
                break;
            }
        }

        return $streak;
    }

    private function profileSkin(User $user): array
    {
        $themeAsset = ProfileAsset::where('is_active', true)
            ->where(function ($query) use ($user) {
                $query->where('key', $user->profile_theme)
                    ->orWhere('theme_class', $user->profile_theme);
            })
            ->first();

        $avatarAsset = ProfileAsset::where('is_active', true)
            ->where(function ($query) use ($user) {
                $query->where('key', $user->avatar_key)
                    ->orWhere('avatar_image', $user->avatar_key)
                    ->orWhere('image_path', $user->avatar_key);
            })
            ->first();

        $badgeAsset = $user->badge_key
            ? ProfileAsset::where('is_active', true)
                ->where(function ($query) use ($user) {
                    $query->where('key', $user->badge_key)
                        ->orWhere('badge_label', $user->badge_key)
                        ->orWhere('label', $user->badge_key);
                })
                ->first()
            : null;

        $gradient = $themeAsset?->gradient ?: match ($user->profile_theme) {
            'crimson-stage' => 'linear-gradient(135deg,#111827,#7f1d1d,#581c87)',
            'night-black' => 'linear-gradient(135deg,#020617,#111827,#3b0764)',
            'galaxy-stage' => 'linear-gradient(135deg,#0f172a,#4c1d95,#7e22ce)',
            default => 'linear-gradient(135deg,#2e1065,#581c87,#111827)',
        };

        return [
            'avatar' => $avatarAsset?->avatar_image ?: $avatarAsset?->image_path ?: $user->avatar_key ?: 'favicons/logo.png',
            'theme' => $themeAsset?->theme_class ?: $user->profile_theme ?: 'galaxy-purple',
            'gradient' => $gradient,
            'badge' => $badgeAsset?->badge_label ?: $badgeAsset?->label ?: $user->badge_key ?: 'ARMY Forever',
            'assetLabel' => $themeAsset?->label ?: 'Custom Profile Theme',
        ];
    }
}
