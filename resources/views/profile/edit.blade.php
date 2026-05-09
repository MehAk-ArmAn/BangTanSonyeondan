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

    <form name="profile_asset" method="POST" action="{{ route('profile.update') }}" class="glass-panel profile-form">
        @csrf
        @method('PUT')

        <h2>Your profile</h2>

        <label>Name
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
        </label>

        <label>Username
            <input type="text" name="username" value="{{ old('username', $user->username) }}">
        </label>

        <label>Bio
            <textarea name="bio" maxlength="500">{{ old('bio', $user->bio) }}</textarea>
        </label>

        <label>Avatar
            <select name="avatar_key">

                {{-- 💜 DEFAULT STARTER (always visible) --}}
                @foreach($availableAssets->where('key','purple-heart') as $asset)
                    <option value="{{ $asset->key }}"
                        @selected(old('avatar_key', $user->avatar_key) === $asset->key)
                    >
                        {{ $asset->label }} (Default)
                    </option>
                @endforeach

                {{-- 👤 NORMAL AVATARS --}}
                @foreach($availableAssets->where('type','avatar') as $asset)
                    <option value="{{ $asset->key }}"
                        @selected(old('avatar_key', $user->avatar_key) === $asset->key)
                    >
                        {{ $asset->label }}
                    </option>
                @endforeach

            </select>
        </label>
        <label>Theme
            <select name="profile_theme">

                {{-- 💜 DEFAULT STARTER THEME --}}
                @foreach($availableAssets->where('key','purple-heart') as $asset)
                    <option value="{{ $asset->key }}"
                        @selected(old('profile_theme', $user->profile_theme) === $asset->key)
                    >
                        {{ $asset->label }} (Default)
                    </option>
                @endforeach

                {{-- 🎨 NORMAL THEMES --}}
                @foreach($availableAssets->where('type','theme') as $asset)
                    <option value="{{ $asset->key }}"
                        @selected(old('profile_theme', $user->profile_theme) === $asset->key)
                    >
                        {{ $asset->label }}
                    </option>
                @endforeach

            </select>
        </label>

        <button class="btn primary" type="submit">Save profile</button>
    </form>

    <div class="glass-panel profile-preview">
        <h2>Preview</h2>

        <div class="profile-preview-card {{ $user->profile_theme }}">

            @php
                $selectedAvatar = $assets->firstWhere('key', $user->profile_asset)
                     ?? $assets->firstWhere('key', 'purple-heart'); // fallback starter
            @endphp

            <div class="avatar-bubble">

                @if($selectedAvatar && $selectedAvatar->image_path)
                    <img 
                        src="{{ asset($selectedAvatar->image_path) }}"
                        alt="{{ $selectedAvatar->label }}"
                        class="profile-avatar-image"
                    >
                @else
                    💜
                @endif

            </div>

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

    <!-- SEARCH + FILTER BAR -->
    <div style="margin-bottom:20px;">
        <input 
            type="text" 
            id="assetSearch"
            placeholder="Search bundles, avatars, themes..."
        >

        <select id="assetFilter">
            <option value="all">All</option>
            <option value="bundle">Bundles</option>
            <option value="avatar">Avatars</option>
            <option value="theme">Themes</option>
        </select>
    </div>

    <div class="asset-grid">

        @foreach($assets as $asset)

            <article 
                class="asset-card"
                data-name="{{ strtolower($asset->label) }}"
                data-type="{{ strtolower($asset->type) }}"
                style="--asset-gradient: {{ $asset->gradient ?: 'linear-gradient(135deg,#4c1d95,#111827)' }}"
            >

                <div class="asset-swatch">

                    @if($asset->image_path)
                        <img 
                            src="{{ asset($asset->image_path) }}"
                            alt="{{ $asset->label }}"
                            class="asset-image"
                        >
                    @else
                        <span>✨</span>
                    @endif

                </div>

                <span>{{ $asset->type }}</span>
                <h3>{{ $asset->label }}</h3>
                <p>{{ $asset->description }}</p>
                <b>{{ $asset->cost }} points</b>

                @if(in_array($asset->id, $unlockedAssetIds) || (int) $asset->cost === 0)
                    <button class="btn ghost" disabled>Unlocked</button>
                @else
                    <form method="POST" action="{{ route('profile.assets.unlock', $asset) }}">
                        @csrf
                        <button class="btn primary" type="submit">Unlock</button>
                    </form>
                @endif

            </article>

        @endforeach

    </div>

</section>

@endsection 