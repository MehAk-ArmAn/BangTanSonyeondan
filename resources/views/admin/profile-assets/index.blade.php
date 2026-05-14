@extends('layouts.admin.app')

@section('title', 'Profile Packs · Admin')
@section('page_heading', 'Profile Packs')

@section('content')
@include('admin.partials.page-nav')

<section class="admin-card professional-card">
    <div class="admin-card-header">
        <div>
            <p class="admin-eyebrow">Profile system</p>
            <h2>Create avatar, theme, badge, or bundle</h2>
        </div>
        <span class="admin-chip">{{ $assets->count() }} packs</span>
    </div>

    <form method="POST" action="{{ route('admin.profile-assets.store') }}" enctype="multipart/form-data" class="admin-grid-form admin-super-form">
        @csrf

        <label>Label
            <input name="label" required placeholder="Purple Galaxy Bundle">
        </label>

        <label>Key
            <input name="key" placeholder="auto if blank">
        </label>

        <label>Type
            <select name="type" required>
                <option value="bundle">Bundle</option>
                <option value="avatar">Avatar</option>
                <option value="theme">Theme</option>
                <option value="badge">Badge</option>
            </select>
        </label>

        <label>Cost
            <input type="number" name="cost" value="0" min="0">
        </label>

        <label class="span-2">Description
            <textarea name="description" placeholder="What this profile pack does..."></textarea>
        </label>

        <label>Image Path
            <input name="image_path" placeholder="profile-assets/cover.jfif">
        </label>

        <label>Upload Image/Cover
            <input type="file" name="image_file" accept="image/*,.jfif,.svg">
        </label>

        <label>Avatar Path
            <input name="avatar_image" placeholder="profile-assets/avatar.jfif">
        </label>

        <label>Upload Avatar
            <input type="file" name="avatar_file" accept="image/*,.jfif,.svg">
        </label>

        <label>Theme Class
            <input name="theme_class" placeholder="galaxy-purple">
        </label>

        <label>Badge Label
            <input name="badge_label" placeholder="Baby ARMY">
        </label>

        <label class="span-2">Gradient
            <input name="gradient" placeholder="linear-gradient(135deg,#2e1065,#581c87,#111827)">
        </label>

        <label>Sort Order
            <input type="number" name="sort_order" value="0" min="0">
        </label>

        <label class="check-row">
            <input type="checkbox" name="is_active" value="1" checked> Active
        </label>

        <button class="span-2">Create Profile Pack</button>
    </form>
</section>

<section class="admin-card professional-card">
    <div class="admin-card-header">
        <div>
            <p class="admin-eyebrow">Manage</p>
            <h2>Existing profile packs</h2>
        </div>
    </div>

    @foreach($assets as $asset)
        <details class="admin-details professional-details">
            <summary>
                <span>{{ $asset->label }}</span>
                <small>{{ strtoupper($asset->type) }} · {{ (int) $asset->cost }} pts · {{ $asset->is_active ? 'Active' : 'Hidden' }}</small>
            </summary>

            <form method="POST" action="{{ route('admin.profile-assets.update', $asset) }}" enctype="multipart/form-data" class="admin-grid-form admin-super-form inside-details">
                @csrf
                @method('PUT')

                <label>Label
                    <input name="label" value="{{ $asset->label }}" required>
                </label>

                <label>Key
                    <input name="key" value="{{ $asset->key }}">
                </label>

                <label>Type
                    <select name="type" required>
                        @foreach(['bundle', 'avatar', 'theme', 'badge'] as $type)
                            <option value="{{ $type }}" {{ $asset->type === $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                        @endforeach
                    </select>
                </label>

                <label>Cost
                    <input type="number" name="cost" value="{{ (int) $asset->cost }}" min="0">
                </label>

                <label class="span-2">Description
                    <textarea name="description">{{ $asset->description }}</textarea>
                </label>

                <label>Image Path
                    <input name="image_path" value="{{ $asset->image_path }}">
                </label>

                <label>Upload New Image/Cover
                    <input type="file" name="image_file" accept="image/*,.jfif,.svg">
                </label>

                <label>Avatar Path
                    <input name="avatar_image" value="{{ $asset->avatar_image }}">
                </label>

                <label>Upload New Avatar
                    <input type="file" name="avatar_file" accept="image/*,.jfif,.svg">
                </label>

                <label>Theme Class
                    <input name="theme_class" value="{{ $asset->theme_class }}">
                </label>

                <label>Badge Label
                    <input name="badge_label" value="{{ $asset->badge_label }}">
                </label>

                <label class="span-2">Gradient
                    <input name="gradient" value="{{ $asset->gradient }}">
                </label>

                <label>Sort Order
                    <input type="number" name="sort_order" value="{{ (int) $asset->sort_order }}" min="0">
                </label>

                <label class="check-row">
                    <input type="checkbox" name="is_active" value="1" {{ $asset->is_active ? 'checked' : '' }}> Active
                </label>

                <div class="span-2 admin-media-preview">
                    @if($asset->avatar_image || $asset->image_path)
                        <img src="{{ asset($asset->avatar_image ?: $asset->image_path) }}" alt="{{ $asset->label }}">
                    @endif
                    <span>{{ $asset->gradient }}</span>
                </div>

                <button class="span-2">Save Profile Pack</button>
            </form>

            <form method="POST" action="{{ route('admin.profile-assets.destroy', $asset) }}" class="inside-details" onsubmit="return confirm('Delete this profile pack?')">
                @csrf
                @method('DELETE')
                <button class="danger">Delete Profile Pack</button>
            </form>
        </details>
    @endforeach
</section>
@endsection
