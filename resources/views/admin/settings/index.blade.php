@extends('layouts.admin.app')
@section('title', 'Settings · BTS Admin')
@section('page_heading', 'Site Settings')
@section('content')
@include('admin.partials.page-nav')

<section class="admin-card professional-card">
    <div class="admin-card-header"><div><p class="admin-eyebrow">Core identity</p><h2>Site Settings</h2></div><span class="admin-chip">Header + footer</span></div>
    <form method="POST" action="{{ route('admin.settings.update') }}" class="admin-grid-form">
        @csrf
        @foreach([
            'site_title'=>'Site Title','site_subtitle'=>'Site Subtitle','hero_kicker'=>'Hero Kicker','hero_title'=>'Hero Title','admin_email'=>'Email','location'=>'Location','creator_name'=>'Creator Name','phone'=>'Phone','instagram'=>'Instagram URL','twitter'=>'X/Twitter URL','youtube'=>'YouTube URL','tiktok'=>'TikTok URL'
        ] as $key => $label)
            <label>{{ $label }}<input name="{{ $key }}" value="{{ old($key, $settings[$key] ?? '') }}"></label>
        @endforeach
        <label class="span-2">Hero Body<textarea name="hero_body">{{ old('hero_body', $settings['hero_body'] ?? '') }}</textarea></label>
        <label class="span-2">Footer Text<textarea name="footer_text">{{ old('footer_text', $settings['footer_text'] ?? '') }}</textarea></label>
        <button class="span-2">Save Site Settings</button>
    </form>
</section>

<section class="admin-card professional-card">
    <div class="admin-card-header"><div><p class="admin-eyebrow">Security</p><h2>Change Admin Password</h2></div></div>
    <form method="POST" action="{{ route('admin.settings.password') }}" class="admin-row-form">
        @csrf
        <input type="password" name="password" placeholder="New password" required>
        <input type="password" name="password_confirmation" placeholder="Confirm password" required>
        <button>Update Password</button>
    </form>
</section>
@endsection
