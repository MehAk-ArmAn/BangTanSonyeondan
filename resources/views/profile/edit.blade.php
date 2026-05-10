@extends('layouts.frontend.app')
@section('title', 'Edit Profile · BangTanSonyeondan')

@section('content')
@php
    $assets = collect($assets ?? []);
    $unlockedAssetIds = collect($unlockedAssetIds ?? [])->map(fn ($id) => (int) $id)->toArray();

    $availableAssets = $assets
        ->filter(fn ($asset) => in_array((int) $asset->id, $unlockedAssetIds, true) || (int) $asset->cost === 0)
        ->values();

    $lockedAssets = $assets
        ->filter(fn ($asset) => ! in_array((int) $asset->id, $unlockedAssetIds, true) && (int) $asset->cost > 0)
        ->values();

    $assetAvatar = fn ($asset) => $asset?->avatar_image ?: $asset?->image_path;
    $assetTheme = fn ($asset) => $asset?->theme_class ?: (strtolower((string) $asset?->type) === 'theme' ? $asset?->key : null);
    $fallbackGradient = 'linear-gradient(135deg,#2e1065,#581c87,#111827)';

    $currentAvatar = $user->avatar_key ?: 'favicons/logo.png';
    $currentTheme = $user->profile_theme ?: 'galaxy-purple';

    $matchedAsset = $assets->first(function ($asset) use ($user, $currentAvatar, $currentTheme, $assetAvatar, $assetTheme) {
        return $asset->key === $user->avatar_key
            || $asset->key === $user->profile_theme
            || $assetAvatar($asset) === $currentAvatar
            || $assetTheme($asset) === $currentTheme;
    });

    $selectedKey = old('profile_asset')
        ?: optional($matchedAsset)->key
        ?: optional($availableAssets->first())->key
        ?: 'purple-heart';

    $selectedAsset = $assets->firstWhere('key', $selectedKey) ?: $availableAssets->first();

    if ($selectedAsset) {
        $previewAvatar = $assetAvatar($selectedAsset) ?: $currentAvatar ?: 'favicons/logo.png';
        $previewTheme = $assetTheme($selectedAsset) ?: $currentTheme;
        $previewGradient = $selectedAsset->gradient ?: $fallbackGradient;
    } else {
        $previewAvatar = $currentAvatar ?: 'favicons/logo.png';
        $previewTheme = $currentTheme;
        $previewGradient = $fallbackGradient;
    }

    $previewName = old('username', $user->username) ?: old('name', $user->name);
    $previewBio = old('bio', $user->bio) ?: 'Hiiii Mehak here BTS FOREVERRRRRRRRR -I’m here to celebrate BTS, connect with ARMY, and keep my favorite songs, moments, and memories in one place.';
@endphp

<section class="profile-studio-hero">
    <div class="profile-hero-copy">
        <span class="eyebrow">ARMY profile studio</span>
        <h1>Make your profile feel like your bias-coded era.</h1>
        <p>Edit your name, username, bio, and profile vibe pack. Unlock BT21 avatars and themes using quiz + streak points.</p>

        <div class="profile-hero-pills" aria-label="Profile summary">
            <span>💜 {{ number_format($user->points) }} points</span>
            <span>🔥 {{ (int) $user->streak_days }} day streak</span>
            <span>✨ {{ count($unlockedAssetIds) }} unlocked</span>
        </div>
    </div>

    <div class="profile-hero-card" style="--profile-card-gradient: {{ $previewGradient }}">
        <div class="profile-hero-glow"></div>
        <div class="profile-mini-avatar">
            @if($previewAvatar)
                <img src="{{ asset($previewAvatar) }}" alt="Selected profile avatar">
            @else
                <span>💜</span>
            @endif
        </div>
        <strong>{{ $previewName }}</strong>
        <small>{{ optional($selectedAsset)->label ?? 'Purple Heart Starter' }}</small>
    </div>
</section>

<section class="profile-studio-grid">
    <form method="POST" action="{{ route('profile.update') }}" class="glass-panel profile-editor-card" id="armyProfileForm">
        @csrf
        @method('PUT')

        <div class="profile-card-heading">
            <span class="eyebrow">Edit details</span>
            <h2>Your ARMY identity</h2>
            <p>Keep it cute, readable, and totally you.</p>
        </div>

        <div class="profile-field-grid">
            <label class="profile-field">Display name
                <input id="profileNameInput" type="text" name="name" value="{{ old('name', $user->name) }}" maxlength="120" required placeholder="MehakARMY">
            </label>

            <label class="profile-field">Username
                <input id="profileUsernameInput" type="text" name="username" value="{{ old('username', $user->username) }}" maxlength="30" placeholder="purple_mochi">
                <small>Use letters, numbers, dashes, and underscores only.</small>
            </label>
        </div>

        <label class="profile-field">Bio
            <textarea id="profileBioInput" name="bio" maxlength="500" placeholder="Tell people a little about you — your BTS journey, your favorite era, your bias, or what being part of ARMY means to you. Basically, Write your ARMY intro...">{{ old('bio', $user->bio) }}</textarea>
            <small><span id="bioCount">{{ strlen(old('bio', $user->bio ?? '')) }}</span>/500 characters</small>
        </label>

        <div class="profile-card-heading mini-heading">
            <span class="eyebrow">Choose vibe</span>
            <h2>Unlocked profile packs</h2>
            <p>Pick one unlocked asset below. Bundles can update both avatar + theme together.</p>
        </div>

        <div class="profile-tools-row">
            <input type="search" id="assetSearch" placeholder="Search avatars, themes, bundles...">
            <select id="assetFilter" aria-label="Filter profile assets">
                <option value="all">All unlocked</option>
                <option value="bundle">Bundles</option>
                <option value="avatar">Avatars</option>
                <option value="theme">Themes</option>
                <option value="badge">Badges</option>
            </select>
        </div>

        <div class="profile-choice-grid" id="profileChoiceGrid">
            @forelse($availableAssets as $asset)
                @php
                    $type = strtolower((string) $asset->type);
                    $avatarPath = $assetAvatar($asset);
                    $themeClass = $assetTheme($asset) ?: $currentTheme;
                    $gradient = $asset->gradient ?: $fallbackGradient;
                    $isSelected = $selectedKey === $asset->key;
                @endphp

                <label
                    class="profile-choice-card asset-card {{ $isSelected ? 'is-selected' : '' }}"
                    data-name="{{ strtolower($asset->label . ' ' . $asset->description) }}"
                    data-type="{{ $type }}"
                    data-label="{{ $asset->label }}"
                    data-description="{{ $asset->description }}"
                    data-avatar="{{ $avatarPath }}"
                    data-theme="{{ $themeClass }}"
                    data-gradient="{{ $gradient }}"
                    style="--asset-gradient: {{ $gradient }}"
                >
                    <input type="radio" name="profile_asset" value="{{ $asset->key }}" @checked($isSelected)>

                    <span class="asset-type-chip">{{ $asset->type }}</span>

                    <div class="profile-choice-media">
                        @if($avatarPath)
                            <img src="{{ asset($avatarPath) }}" alt="{{ $asset->label }}">
                        @else
                            <span>{{ $type === 'theme' ? '🎨' : ($type === 'badge' ? '🏷️' : '💜') }}</span>
                        @endif
                    </div>

                    <strong>{{ $asset->label }}</strong>
                    <small>{{ $asset->description ?: 'Profile upgrade ready.' }}</small>

                    <em>{{ (int) $asset->cost === 0 ? 'Free' : (int) $asset->cost . ' pts' }}</em>
                </label>
            @empty
                <div class="profile-empty-state">
                    <h3>No profile assets found.</h3>
                    <p>Add profile assets from the database/admin seed, then come back here.</p>
                </div>
            @endforelse
        </div>

        <div class="profile-form-actions">
            <a class="btn ghost" href="{{ route('user.dashboard') }}">Back to dashboard</a>
            <button class="btn primary profile-save-btn" type="submit">Save profile glow-up</button>
        </div>
    </form>

    <aside class="glass-panel profile-preview-panel">
        <div class="profile-preview-sticky">
            <div class="profile-card-heading">
                <span class="eyebrow">Live preview</span>
                <h2>How it’ll look</h2>
            </div>

            <div id="profilePreviewCard" class="profile-preview-card profile-studio-preview {{ $previewTheme }}" style="--profile-card-gradient: {{ $previewGradient }}">
                <div class="preview-orbit orbit-a"></div>
                <div class="preview-orbit orbit-b"></div>

                <div class="avatar-bubble profile-avatar-bubble">
                    @if($previewAvatar)
                        <img id="profilePreviewAvatar" src="{{ asset($previewAvatar) }}" alt="Profile avatar" class="profile-avatar-image">
                    @else
                        <span id="profilePreviewEmoji">💜</span>
                    @endif
                </div>

                <div class="profile-badges">
                    <span id="profilePreviewAsset" class="preview-asset-label">{{ optional($selectedAsset)->label ?? 'Purple Heart Starter' }}</span>
                </div>

                <h3 id="profilePreviewName">{{ $previewName }}</h3>
                <p id="profilePreviewBio">{{ $previewBio }}</p>

                <div class="preview-stat-row">
                    <b>{{ number_format($user->points) }} pts</b>
                    <b>{{ (int) $user->streak_days }} streak</b>
                </div>
            </div>

            <div class="profile-tip-card">
                <strong>tiny tip:</strong>
                <p>Quizzes + daily check-ins give points. More points = more cute profile chaos unlocked.</p>
            </div>
        </div>
    </aside>
</section>

<section class="section-block profile-shop-section">
    <div class="section-heading">
        <span class="eyebrow">Profile shop</span>
        <h2>Locked upgrades waiting for you.</h2>
        <p>Unlock them with points, then return to the editor and apply the vibe.</p>
    </div>

    <div class="asset-grid profile-shop-grid">
        @forelse($lockedAssets as $asset)
            <article
                class="asset-card profile-shop-card"
                data-name="{{ strtolower($asset->label . ' ' . $asset->description) }}"
                data-type="{{ strtolower($asset->type) }}"
                style="--asset-gradient: {{ $asset->gradient ?: $fallbackGradient }}"
            >
                <div class="asset-swatch">
                    @if($assetAvatar($asset))
                        <img src="{{ asset($assetAvatar($asset)) }}" alt="{{ $asset->label }}" class="asset-image">
                    @else
                        <span>{{ strtolower($asset->type) === 'theme' ? '🎨' : '✨' }}</span>
                    @endif
                </div>

                <span>{{ $asset->type }}</span>
                <h3>{{ $asset->label }}</h3>
                <p>{{ $asset->description }}</p>
                <b>{{ number_format($asset->cost) }} points</b>

                <form method="POST" action="{{ route('profile.assets.unlock', $asset) }}">
                    @csrf
                    <button class="btn primary" type="submit" {{ $user->points < $asset->cost ? 'disabled' : '' }}>
                        {{ $user->points < $asset->cost ? 'Need more points' : 'Unlock now' }}
                    </button>
                </form>
            </article>
        @empty
            <div class="glass-panel profile-empty-state">
                <h3>Bestie you unlocked everything available.</h3>
                <p>That profile shop is cleared. Absolute ARMY collector energy.</p>
            </div>
        @endforelse
    </div>
</section>
@endsection
