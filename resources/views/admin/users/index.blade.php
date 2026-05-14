@extends('layouts.admin.app')

@section('title', 'Users · Admin')
@section('page_heading', 'Users & Profiles')

@section('content')
@include('admin.partials.page-nav')

<section class="admin-card professional-card">
    <div class="admin-card-header">
        <div>
            <p class="admin-eyebrow">Community control</p>
            <h2>Manage user profiles</h2>
        </div>
        <span class="admin-chip">{{ $users->total() }} users</span>
    </div>

    <form method="GET" action="{{ route('admin.users.index') }}" class="admin-grid-form">
        <label class="span-2">Search users
            <input name="q" value="{{ $search }}" placeholder="Search name, username, email...">
        </label>

        <button>Search</button>
    </form>
</section>

<section class="admin-card professional-card">
    @foreach($users as $user)
        <details class="admin-details professional-details">
            <summary>
                <span>{{ $user->displayName() }}</span>
                <small>{{ $user->email }} · {{ number_format($user->points) }} pts · {{ $user->profile_visibility ?? 'public' }}</small>
            </summary>

            <form method="POST" action="{{ route('admin.users.update', $user) }}" class="admin-grid-form admin-super-form inside-details">
                @csrf
                @method('PUT')

                <label>Name
                    <input name="name" value="{{ $user->name }}" required>
                </label>

                <label>Username
                    <input name="username" value="{{ $user->username }}">
                </label>

                <label>Email
                    <input value="{{ $user->email }}" disabled>
                </label>

                <label>Visibility
                    <select name="profile_visibility">
                        <option value="public" {{ ($user->profile_visibility ?? 'public') === 'public' ? 'selected' : '' }}>Public</option>
                        <option value="private" {{ $user->profile_visibility === 'private' ? 'selected' : '' }}>Private</option>
                    </select>
                </label>

                <label>Points
                    <input type="number" name="points" value="{{ (int) $user->points }}" min="0">
                </label>

                <label>Streak Days
                    <input type="number" name="streak_days" value="{{ (int) $user->streak_days }}" min="0">
                </label>

                <label>Avatar Key / Path
                    <input name="avatar_key" value="{{ $user->avatar_key }}" placeholder="profile-assets/avatar.jfif">
                </label>

                <label>Profile Theme
                    <input name="profile_theme" value="{{ $user->profile_theme }}" placeholder="galaxy-purple">
                </label>

                <label>Badge
                    <input name="badge_key" value="{{ $user->badge_key }}" placeholder="Baby ARMY">
                </label>

                <label class="check-row">
                    <input type="checkbox" name="is_admin" value="1" {{ $user->is_admin ? 'checked' : '' }}> Admin
                </label>

                <label class="span-2">Bio
                    <textarea name="bio" maxlength="500">{{ $user->bio }}</textarea>
                </label>

                <button class="span-2">Save User Profile</button>
            </form>

            <form method="POST" action="{{ route('admin.users.assets.sync', $user) }}" class="inside-details">
                @csrf

                <h3>Unlocked profile packs</h3>

                <div class="admin-checkbox-grid">
                    @php
                        $userAssetIds = $user->unlockedAssets()->pluck('profile_assets.id')->toArray();
                    @endphp

                    @foreach($assets as $asset)
                        <label class="check-row">
                            <input
                                type="checkbox"
                                name="asset_ids[]"
                                value="{{ $asset->id }}"
                                {{ in_array($asset->id, $userAssetIds) ? 'checked' : '' }}
                            >
                            {{ $asset->label }} · {{ strtoupper($asset->type) }}
                        </label>
                    @endforeach
                </div>

                <button>Save User Packs</button>
            </form>

            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inside-details" onsubmit="return confirm('Delete this user?')">
                @csrf
                @method('DELETE')
                <button class="danger">Delete User</button>
            </form>
        </details>
    @endforeach

    <div class="admin-pagination">
        {{ $users->links() }}
    </div>
</section>
@endsection
