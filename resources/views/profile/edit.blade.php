@extends('layouts.frontend.app')
@section('title', 'Edit Profile · BangTanSonyeondan')
@section('content')
@php
    $availableAssets = $assets->filter(fn($asset) => in_array($asset->id, $unlockedAssetIds) || (int) $asset->cost === 0);
    $availableAvatars = $availableAssets->where('type', 'avatar');
    $availableThemes = $availableAssets->where('type', 'theme');
@endphp
<section class="page-hero small">
    <span class="eyebrow">Profile upgrades</span>
    <h1>Customize your ARMY profile.</h1>
    <p>Default assets are free. Extra upgrades can be unlocked with points earned from quizzes and streaks.</p>
</section>

<section class="profile-layout">
    <form method="POST" action="{{ route('profile.update') }}" class="glass-panel profile-form">
        @csrf
        @method('PUT')
        <h2>Your profile</h2>
        <label>Name<input type="text" name="name" value="{{ old('name', $user->name) }}" required></label>
        <label>Username<input type="text" name="username" value="{{ old('username', $user->username) }}"></label>
        <label>Bio<textarea name="bio" maxlength="500">{{ old('bio', $user->bio) }}</textarea></label>
        <label>Avatar
            <select name="avatar_key">
                @foreach($availableAvatars as $asset)
                    <option value="{{ $asset->key }}" @selected(old('avatar_key', $user->avatar_key) === $asset->key)>{{ $asset->label }}</option>
                @endforeach
            </select>
        </label>
        <label>Theme
            <select name="profile_theme">
                @foreach($availableThemes as $asset)
                    <option value="{{ $asset->key }}" @selected(old('profile_theme', $user->profile_theme) === $asset->key)>{{ $asset->label }}</option>
                @endforeach
            </select>
        </label>
        <button class="btn primary" type="submit">Save profile</button>
    </form>

    <div class="glass-panel profile-preview">
        <h2>Preview</h2>
        <div class="profile-preview-card {{ $user->profile_theme }}">
            <div class="avatar-bubble">💜</div>
            <h3>{{ $user->displayName() }}</h3>
            <p>{{ $user->bio ?: 'ARMY profile bio goes here.' }}</p>
            <b>{{ $user->points }} points</b>
        </div>
    </div>
</section>

<section class="section-block">
    <div class="section-heading">
        <span class="eyebrow">Profile shop</span>
        <h2>Unlock cute upgrades with points.</h2>
    </div>
    <div class="asset-grid">
        @foreach($assets as $asset)
            <article class="asset-card" style="--asset-gradient: {{ $asset->gradient ?: 'linear-gradient(135deg,#4c1d95,#111827)' }}">
                <div class="asset-swatch">{{ $asset->type === 'avatar' ? '💜' : ($asset->type === 'theme' ? '🌌' : '✨') }}</div>
                <span>{{ $asset->type }}</span>
                <h3>{{ $asset->label }}</h3>
                <p>{{ $asset->description }}</p>
                <b>{{ $asset->cost }} points</b>
                @if(in_array($asset->id, $unlockedAssetIds) || (int) $asset->cost === 0)
                    <button class="btn ghost" disabled>Unlocked</button>
                @else
                    <form method="POST" action="{{ route('profile.assets.unlock', $asset) }}">@csrf<button class="btn primary" type="submit">Unlock</button></form>
                @endif
            </article>
        @endforeach
    </div>
</section>
@endsection
