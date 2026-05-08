<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings.index', [
            'settings' => SiteSetting::pluck('value', 'key')->toArray(),
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'site_title' => ['nullable', 'string', 'max:255'],
            'site_subtitle' => ['nullable', 'string', 'max:500'],
            'hero_kicker' => ['nullable', 'string', 'max:255'],
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_body' => ['nullable', 'string', 'max:1500'],
            'footer_text' => ['nullable', 'string', 'max:1500'],
            'admin_email' => ['nullable', 'email', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'creator_name' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'url', 'max:1000'],
            'twitter' => ['nullable', 'url', 'max:1000'],
            'youtube' => ['nullable', 'url', 'max:1000'],
            'tiktok' => ['nullable', 'url', 'max:1000'],
        ]);

        foreach ($data as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return back()->with('success', 'Site settings saved.');
    }

    public function password(Request $request)
    {
        $data = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        Auth::user()->forceFill(['password' => Hash::make($data['password'])])->save();

        return back()->with('success', 'Admin password updated.');
    }
}
