<?php

namespace App\Http\Controllers;

use App\Models\DailyCheckin;
use App\Models\LearningLesson;
use App\Models\PointTransaction;
use App\Models\ProfileAsset;
use App\Models\QuizAttempt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserDashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $today = today();

        return view('user.dashboard', [
            'user' => $user,
            'lessons' => LearningLesson::where('is_active', true)->orderBy('sort_order')->limit(6)->get(),
            'recentAttempts' => QuizAttempt::with('lesson')->where('user_id', $user->id)->latest()->limit(5)->get(),
            'recentPoints' => PointTransaction::where('user_id', $user->id)->latest()->limit(8)->get(),
            'leaderboard' => User::where('is_admin', false)->orderByDesc('points')->orderBy('name')->limit(8)->get(),
            'checkedInToday' => DailyCheckin::where('user_id', $user->id)->whereDate('checkin_date', $today)->exists(),
            'assets' => ProfileAsset::where('is_active', true)->orderBy('sort_order')->get(),
            'unlockedAssetIds' => $user->unlockedAssets()->pluck('profile_assets.id')->toArray(),
        ]);
    }

    public function checkin(Request $request)
    {
        $user = Auth::user();
        $today = today();

        if (DailyCheckin::where('user_id', $user->id)->whereDate('checkin_date', $today)->exists()) {
            return back()->with('success', 'You already claimed today’s streak points. Come back tomorrow.');
        }

        $yesterday = $today->copy()->subDay();
        $newStreak = $user->last_streak_date && Carbon::parse($user->last_streak_date)->isSameDay($yesterday)
            ? $user->streak_days + 1
            : 1;

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

        return back()->with('success', "Daily streak claimed! +{$points} points.");
    }

    public function profile()
    {
        $user = Auth::user();

        return view('profile.edit', [
            'user' => $user,
            'assets' => ProfileAsset::where('is_active', true)->orderBy('sort_order')->get(),
            'unlockedAssetIds' => $user->unlockedAssets()->pluck('profile_assets.id')->toArray(),
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
            'profile_asset' => ['required', 'string', 'max:120'],
        ]);

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

        $nextAvatar = $user->avatar_key ?: 'favicons/logo.png';
        $nextTheme = $user->profile_theme ?: 'galaxy-purple';
        $assetType = strtolower((string) $asset->type);
        $assetAvatar = $asset->avatar_image ?: $asset->image_path;
        $assetTheme = $asset->theme_class ?: ($assetType === 'theme' ? $asset->key : null);

        if ($assetType === 'bundle') {
            $nextAvatar = $assetAvatar ?: $nextAvatar;
            $nextTheme = $assetTheme ?: $nextTheme;
        } elseif ($assetType === 'avatar') {
            $nextAvatar = $assetAvatar ?: $asset->key;
        } elseif ($assetType === 'theme') {
            $nextTheme = $assetTheme ?: $asset->key;
        } else {
            $nextAvatar = $assetAvatar ?: $nextAvatar;
            $nextTheme = $assetTheme ?: $nextTheme;
        }

        $user->forceFill([
            'name' => $data['name'],
            'username' => $data['username'] ?: null,
            'bio' => $data['bio'] ?: null,
            'avatar_key' => $nextAvatar,
            'profile_theme' => $nextTheme,
        ])->save();

        return back()->with('success', 'Profile updated! Your ARMY vibe is saved.');
    }

    public function unlockAsset(ProfileAsset $asset)
    {
        $user = Auth::user();

        if (!$asset->is_active) {
            abort(404);
        }

        if ($user->unlockedAssets()->where('profile_assets.id', $asset->id)->exists()) {
            return back()->with('success', 'You already unlocked this upgrade.');
        }

        if ($user->points < $asset->cost) {
            return back()->with('error', 'Not enough points yet. Take quizzes or claim streaks first.');
        }

        $user->decrement('points', $asset->cost);
        $user->unlockedAssets()->syncWithoutDetaching([$asset->id]);

        PointTransaction::create([
            'user_id' => $user->id,
            'type' => 'spend',
            'points' => -$asset->cost,
            'reason' => 'Unlocked profile upgrade: ' . $asset->label,
            'meta' => ['asset_key' => $asset->key],
        ]);

        return back()->with('success', 'Upgrade unlocked.');
    }
}
