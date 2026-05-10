@extends('layouts.admin.app')
@section('title', 'Users · BTS Admin')
@section('page_heading', 'User Control Room')
@section('content')
@include('admin.partials.page-nav')

<section class="admin-card professional-card">
    <div class="admin-card-header">
        <div>
            <p class="admin-eyebrow">ARMY accounts</p>
            <h2>Manage users, points, streaks, roles, profile packs</h2>
        </div>
        <span class="admin-chip">{{ number_format($totalUsers) }} total users</span>
    </div>

    <div class="admin-stats-grid users-stats-grid">
        <div><span>Total Users</span><b>{{ number_format($totalUsers) }}</b></div>
        <div><span>Admin Users</span><b>{{ number_format($adminUsers) }}</b></div>
        <div><span>ARMY Users</span><b>{{ number_format($armyUsers) }}</b></div>
        <div><span>Profile Packs</span><b>{{ number_format($profileAssets->count()) }}</b></div>
    </div>
</section>

<section class="admin-card professional-card">
    <div class="admin-card-header">
        <div>
            <p class="admin-eyebrow">Create</p>
            <h2>Add a new user</h2>
        </div>
        <span class="admin-chip">Password required</span>
    </div>

    <form method="POST" action="{{ route('admin.users.store') }}" class="admin-grid-form admin-user-create-form">
        @csrf
        <label>Name<input name="name" value="{{ old('name') }}" required></label>
        <label>Username<input name="username" value="{{ old('username') }}" placeholder="example: armygirl7"></label>
        <label>Email<input type="email" name="email" value="{{ old('email') }}" required></label>
        <label>Password<input type="password" name="password" placeholder="Minimum 8 characters" required></label>
        <label>Starting Points<input type="number" name="points" value="{{ old('points', 50) }}" min="0" max="999999999999999" required></label>
        <label>Streak Days<input type="number" name="streak_days" value="{{ old('streak_days', 0) }}" min="0"></label>
        <label>Last Streak Date<input type="date" name="last_streak_date" value="{{ old('last_streak_date') }}"></label>
        <label>Profile Pack
            <select name="selected_profile_asset">
                <option value="">Default purple profile</option>
                @foreach($profileAssets as $asset)
                    <option value="{{ $asset->id }}">{{ $asset->label }} — {{ number_format($asset->cost) }} pts</option>
                @endforeach
            </select>
        </label>
        <label class="span-2">Bio<textarea name="bio" maxlength="500" placeholder="A real intro for this user profile...">{{ old('bio') }}</textarea></label>
        <label class="check-row span-2"><input type="checkbox" name="is_admin" value="1"> Make this user an admin</label>
        <button class="span-2">Create User</button>
    </form>
</section>

<section class="admin-card professional-card">
    <div class="admin-card-header">
        <div>
            <p class="admin-eyebrow">Search</p>
            <h2>Find a user</h2>
        </div>
        <span class="admin-chip">Name / username / email / bio</span>
    </div>

    <form method="GET" action="{{ route('admin.users.index') }}" class="admin-user-search">
        <input name="q" value="{{ $search }}" placeholder="Search users...">
        <button>Search</button>
        @if($search)
            <a href="{{ route('admin.users.index') }}">Clear</a>
        @endif
    </form>
</section>

@forelse($users as $user)
<section class="admin-card professional-card admin-user-card">
    <div class="admin-card-header">
        <div>
            <p class="admin-eyebrow">User #{{ $user->id }}</p>
            <h2>{{ $user->displayName() }}</h2>
            <p class="admin-user-meta">{{ $user->email }} · Joined {{ optional($user->created_at)->format('d M Y') }}</p>
        </div>
        <span class="admin-chip {{ $user->is_admin ? 'danger-chip' : '' }}">
            {{ $user->is_admin ? 'Admin' : 'ARMY User' }} · {{ number_format($user->points) }} pts
        </span>
    </div>

    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="admin-grid-form admin-user-edit-form">
        @csrf
        @method('PUT')

        <label>Name<input name="name" value="{{ old('name', $user->name) }}" required></label>
        <label>Username<input name="username" value="{{ old('username', $user->username) }}" placeholder="No spaces, letters/numbers/dashes only"></label>
        <label>Email<input type="email" name="email" value="{{ old('email', $user->email) }}" required></label>
        <label>New Password<input type="password" name="password" placeholder="Leave empty to keep current password"></label>
        <label>Points<input type="number" name="points" value="{{ old('points', $user->points) }}" min="0" max="999999999999999" required></label>
        <label>Streak Days<input type="number" name="streak_days" value="{{ old('streak_days', $user->streak_days) }}" min="0" required></label>
        <label>Last Streak Date<input type="date" name="last_streak_date" value="{{ old('last_streak_date', optional($user->last_streak_date)->format('Y-m-d')) }}"></label>
        <label>Apply Profile Pack
            <select name="selected_profile_asset">
                <option value="">Keep current look</option>
                @foreach($profileAssets as $asset)
                    @php
                        $assetAvatar = $asset->avatar_image ?: ($asset->image_path ?: $asset->key);
                        $assetTheme = $asset->theme_class ?: ($asset->gradient ?: $asset->key);
                        $isCurrentVisual = $user->avatar_key === $assetAvatar || $user->profile_theme === $assetTheme;
                    @endphp
                    <option value="{{ $asset->id }}" {{ $isCurrentVisual ? 'selected' : '' }}>
                        {{ $asset->label }} — {{ number_format($asset->cost) }} pts
                    </option>
                @endforeach
            </select>
        </label>

        <label class="span-2">Bio<textarea name="bio" maxlength="500" placeholder="Profile intro visible to real users...">{{ old('bio', $user->bio) }}</textarea></label>

        <div class="span-2 admin-unlock-box">
            <p class="admin-unlock-title">Unlocked profile packs</p>
            <div class="admin-unlock-grid">
                @foreach($profileAssets as $asset)
                    <label class="check-row admin-unlock-item">
                        <input
                            type="checkbox"
                            name="unlocked_assets[]"
                            value="{{ $asset->id }}"
                            {{ $user->unlockedAssets->contains('id', $asset->id) ? 'checked' : '' }}
                        >
                        <span>{{ $asset->label }} <small>{{ number_format($asset->cost) }} pts</small></span>
                    </label>
                @endforeach
            </div>
        </div>

        <label class="check-row">
            <input type="checkbox" name="is_admin" value="1" {{ $user->is_admin ? 'checked' : '' }} {{ auth()->id() === $user->id ? 'disabled' : '' }}>
            Admin access
        </label>

        @if(auth()->id() === $user->id)
            <p class="admin-note">You cannot remove admin access from your own account here, so you do not lock yourself out.</p>
        @endif

        <button class="span-2">Save User Changes</button>
    </form>

    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="admin-user-delete-form" onsubmit="return confirm('Delete this user? This cannot be undone.');">
        @csrf
        @method('DELETE')
        <button type="submit" class="danger" {{ auth()->id() === $user->id ? 'disabled' : '' }}>Delete User</button>
    </form>
</section>
@empty
<section class="admin-card professional-card">
    <p class="admin-note">No users found.</p>
</section>
@endforelse

<div class="admin-pagination">
    {{ $users->links() }}
</div>
@endsection
