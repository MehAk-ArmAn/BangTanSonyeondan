<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PointTransaction;
use App\Models\ProfileAsset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PublicAuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'username' => ['nullable', 'alpha_dash', 'min:3', 'max:30', Rule::unique('users', 'username')],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $username = $data['username'] ?: Str::slug($data['name']) . random_int(100, 999);

        $user = User::create([
            'name' => $data['name'],
            'username' => $username,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'avatar_key' => 'purple-heart',
            'profile_theme' => 'galaxy-purple',
            'points' => 50,
            'streak_days' => 0,
            'is_admin' => false,
            'auth_provider' => 'email',
        ]);

        PointTransaction::create([
            'user_id' => $user->id,
            'type' => 'earn',
            'points' => 50,
            'reason' => 'Welcome bonus',
            'meta' => ['source' => 'registration'],
        ]);

        $freeAssetIds = ProfileAsset::whereIn('key', ['purple-heart', 'galaxy-purple'])
            ->orWhere('cost', 0)
            ->pluck('id')
            ->toArray();

        if (!empty($freeAssetIds)) {
            $user->unlockedAssets()->syncWithoutDetaching($freeAssetIds);
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('user.dashboard')->with('success', 'Welcome to the ARMY hub! You got 50 starter points.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('user.dashboard'))->with('success', 'Welcome back, ARMY.');
        }

        return back()->withErrors(['email' => 'Invalid email or password.'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Logged out safely.');
    }

    public function googleNotice()
    {
        return view('auth.google-notice');
    }
}
