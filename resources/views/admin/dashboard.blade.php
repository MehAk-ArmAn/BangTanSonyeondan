{{--
|--------------------------------------------------------------------------
| Admin dashboard
|--------------------------------------------------------------------------
| One clean control room for the whole website. Every form posts to routes
| handled by DashboardController.
--}}
@extends('layouts.admin.app')
@section('title', 'Dashboard · BTS Admin')
@section('page_heading', 'Dashboard 💜')
@section('content')
<section class="admin-stats" id="overview">
    <div><span>Members</span><b>{{ $membersList->count() }}</b></div>
    <div><span>Songs</span><b>{{ $songsList->count() }}</b></div>
    <div><span>Gallery</span><b>{{ $galleryList->count() }}</b></div>
    <div><span>BT21</span><b>{{ $bt21List->count() }}</b></div>
</section>

<section class="admin-card" id="settings">
    <h2>Site Settings</h2>
    <form method="POST" action="{{ route('admin.settings.update') }}" class="admin-grid-form">
        @csrf
        @foreach(['site_title'=>'Site Title','site_subtitle'=>'Site Subtitle','hero_kicker'=>'Hero Kicker','hero_title'=>'Hero Title','admin_email'=>'Email','location'=>'Location','creator_name'=>'Creator Name','phone'=>'Phone','instagram'=>'Instagram URL','twitter'=>'X/Twitter URL','youtube'=>'YouTube URL','tiktok'=>'TikTok URL'] as $key => $label)
            <label>{{ $label }}<input name="{{ $key }}" value="{{ old($key, $settings[$key] ?? '') }}"></label>
        @endforeach
        <label class="span-2">Hero Body<textarea name="hero_body">{{ old('hero_body', $settings['hero_body'] ?? '') }}</textarea></label>
        <label class="span-2">Footer Text<textarea name="footer_text">{{ old('footer_text', $settings['footer_text'] ?? '') }}</textarea></label>
        <button class="span-2">Save Settings</button>
    </form>
</section>

<section class="admin-card" id="password">
    <h2>Update Admin Password</h2>
    <form method="POST" action="{{ route('admin.password.update') }}" class="admin-row-form">
        @csrf
        <input type="password" name="password" placeholder="New password" required>
        <input type="password" name="password_confirmation" placeholder="Confirm password" required>
        <button>Change Password</button>
    </form>
    <p class="admin-note">Password must be at least 8 characters. Login email is controlled from the users table.</p>
</section>

<section class="admin-card" id="navigation">
    <h2>Navigation</h2>
    <form method="POST" action="{{ route('admin.nav.store') }}" class="admin-row-form">
        @csrf
        <input name="label" placeholder="Label" required>
        <input name="url" placeholder="/songs or /#members" required>
        <input type="number" name="sort_order" value="0">
        <label class="check-row"><input type="checkbox" name="is_active" value="1" checked> Active</label>
        <button>Add</button>
    </form>
    <div class="admin-table-wrap"><table><tr><th>Label</th><th>URL</th><th>Order</th><th>Active</th><th>Action</th></tr>
        @foreach($navList as $item)
            <tr><form method="POST" action="{{ route('admin.nav.update', $item) }}">@csrf @method('PUT')
                <td><input name="label" value="{{ $item->label }}"></td><td><input name="url" value="{{ $item->url }}"></td><td><input type="number" name="sort_order" value="{{ $item->sort_order }}"></td><td><input type="checkbox" name="is_active" value="1" {{ $item->is_active ? 'checked' : '' }}></td><td><button>Save</button></form><form method="POST" action="{{ route('admin.nav.delete', $item) }}" onsubmit="return confirm('Delete nav item?')">@csrf @method('DELETE')<button class="danger">Delete</button></form></td>
            </tr>
        @endforeach
    </table></div>
</section>

<section class="admin-card" id="bt21">
    <h2>BT21 Footer + Anatomy Profiles</h2>
    <p class="admin-note">These records control the BT21 page and the BT21 footer links. The footer links jump to <code>/bt21#slug</code>, so keep slugs simple like <code>koya</code>, <code>rj</code>, <code>shooky</code>.</p>

    <form method="POST" action="{{ route('admin.bt21.store') }}" enctype="multipart/form-data" class="admin-grid-form">
        @csrf
        <label>Name<input name="name" placeholder="KOYA" required></label>
        <label>Slug<input name="slug" placeholder="koya"></label>
        <label>Member Name<input name="member_name" placeholder="RM"></label>
        <label>Emoji<input name="emoji" placeholder="🐨"></label>
        <label>Image Path<input name="image" placeholder="favicons/KOYA.png"></label>
        <label>Upload Image<input type="file" name="image_file" accept="image/*"></label>
        <label>Accent Color<input name="accent_color" value="#a855f7"></label>
        <label>Order<input type="number" name="sort_order" value="0"></label>
        <label class="span-2">Mood<textarea name="mood" placeholder="Sleepy genius dream koala"></textarea></label>
        <label class="span-2">Power<textarea name="power" placeholder="Deep thinking + soft leader energy"></textarea></label>
        <label class="span-2">Anatomy Notes - one per line<textarea name="anatomy_text"></textarea></label>
        <label class="span-2">Moves - one per line<textarea name="moves_text"></textarea></label>
        <label class="check-row"><input type="checkbox" name="is_active" value="1" checked> Active</label>
        <button class="span-2">Add BT21 Character</button>
    </form>

    @foreach($bt21List as $character)
        <details class="admin-details">
            <summary>{{ $character->emoji }} {{ $character->name }} <span>{{ $character->member_name }} · /bt21#{{ $character->slug }}</span></summary>
            <form method="POST" action="{{ route('admin.bt21.update', $character) }}" enctype="multipart/form-data" class="admin-grid-form">
                @csrf @method('PUT')
                <label>Name<input name="name" value="{{ $character->name }}" required></label>
                <label>Slug<input name="slug" value="{{ $character->slug }}"></label>
                <label>Member Name<input name="member_name" value="{{ $character->member_name }}"></label>
                <label>Emoji<input name="emoji" value="{{ $character->emoji }}"></label>
                <label>Image Path<input name="image" value="{{ $character->image }}"></label>
                <label>Upload New Image<input type="file" name="image_file" accept="image/*"></label>
                <label>Accent Color<input name="accent_color" value="{{ $character->accent_color }}"></label>
                <label>Order<input type="number" name="sort_order" value="{{ $character->sort_order }}"></label>
                <label class="span-2">Mood<textarea name="mood">{{ $character->mood }}</textarea></label>
                <label class="span-2">Power<textarea name="power">{{ $character->power }}</textarea></label>
                <label class="span-2">Anatomy Notes<textarea name="anatomy_text">{{ implode("\n", $character->anatomy ?? []) }}</textarea></label>
                <label class="span-2">Moves<textarea name="moves_text">{{ implode("\n", $character->moves ?? []) }}</textarea></label>
                <label class="check-row"><input type="checkbox" name="is_active" value="1" {{ $character->is_active ? 'checked' : '' }}> Active</label>
                <button class="span-2">Save BT21 Character</button>
            </form>
            <form method="POST" action="{{ route('admin.bt21.delete', $character) }}" onsubmit="return confirm('Delete BT21 character?')">
                @csrf @method('DELETE')
                <button class="danger">Delete BT21 Character</button>
            </form>
        </details>
    @endforeach
</section>

<section class="admin-card" id="members">
    <h2>Member Vaults</h2>
    @foreach($membersList as $member)
        <details class="admin-details">
            <summary>{{ $member->emoji }} {{ $member->stage_name ?: $member->name }} <span>{{ $member->role }}</span></summary>
            <form method="POST" action="{{ route('admin.members.update', $member) }}" enctype="multipart/form-data" class="admin-grid-form">
                @csrf @method('PUT')
                <label>Name<input name="name" value="{{ $member->name }}" required></label>
                <label>Stage Name<input name="stage_name" value="{{ $member->stage_name }}"></label>
                <label>Nickname<input name="nickname" value="{{ $member->nickname }}"></label>
                <label>Korean Name<input name="korean_name" value="{{ $member->korean_name }}"></label>
                <label>Role<input name="role" value="{{ $member->role }}"></label>
                <label>Birth Date<input type="date" name="birth_date" value="{{ optional($member->birth_date)->format('Y-m-d') }}"></label>
                <label>Birthplace<input name="birthplace" value="{{ $member->birthplace }}"></label>
                <label>Emoji<input name="emoji" value="{{ $member->emoji }}"></label>
                <label>Accent Color<input name="accent_color" value="{{ $member->accent_color }}"></label>
                <label>BT21 Character<input name="bt21_character" value="{{ $member->bt21_character }}"></label>
                <label>Intro Title<input name="intro_title" value="{{ $member->intro_title }}"></label>
                <label>Image Path<input name="image" value="{{ $member->image }}"></label>
                <label>Upload New Image<input type="file" name="image_file" accept="image/*"></label>
                <label>Favicon File<input name="favicon" value="{{ $member->favicon }}"></label>
                <label>Sort Order<input type="number" name="sort_order" value="{{ $member->sort_order }}"></label>
                <label class="span-2">Quote<textarea name="quote">{{ $member->quote }}</textarea></label>
                <label class="span-2">Profile Story<textarea name="profile_story">{{ $member->profile_story }}</textarea></label>
                <label class="span-2">Skill Tags - one per line<textarea name="skill_tags_text">{{ implode("\n", $member->skill_tags ?? []) }}</textarea></label>
                <label class="span-2">Fun Facts - one per line<textarea name="fun_facts_text">{{ implode("\n", $member->fun_facts ?? []) }}</textarea></label>
                <label class="check-row"><input type="checkbox" name="is_active" value="1" {{ $member->is_active ? 'checked' : '' }}> Active</label>
                <button class="span-2">Save Member</button>
            </form>
        </details>
    @endforeach
</section>

<section class="admin-card" id="quotes">
    <h2>Quotes</h2>
    <form method="POST" action="{{ route('admin.quotes.store') }}" class="admin-row-form wide">@csrf
        <input name="source" placeholder="Source" required><input name="context" placeholder="Context"><textarea name="quote" placeholder="Quote" required></textarea><label class="check-row"><input type="checkbox" name="is_active" value="1" checked> Active</label><button>Add</button>
    </form>
    <div class="admin-table-wrap"><table><tr><th>Source</th><th>Context</th><th>Quote</th><th>Active</th><th>Action</th></tr>
        @foreach($quotesList as $quote)<tr><form method="POST" action="{{ route('admin.quotes.update', $quote) }}">@csrf @method('PUT')<td><input name="source" value="{{ $quote->source }}"></td><td><input name="context" value="{{ $quote->context }}"></td><td><textarea name="quote">{{ $quote->quote }}</textarea></td><td><input type="checkbox" name="is_active" value="1" {{ $quote->is_active ? 'checked' : '' }}></td><td><button>Save</button></form><form method="POST" action="{{ route('admin.quotes.delete', $quote) }}" onsubmit="return confirm('Delete quote?')">@csrf @method('DELETE')<button class="danger">Delete</button></form></td></tr>@endforeach
    </table></div>
</section>

<section class="admin-card" id="songs">
    <h2>Songs</h2>
    <form method="POST" action="{{ route('admin.songs.store') }}" enctype="multipart/form-data" class="admin-grid-form">@csrf
        <label>Name<input name="name" required></label><label>Image Path<input name="img_path" placeholder="imgs/songs/1.jfif"></label><label>Upload Image<input type="file" name="image_file" accept="image/*"></label><label>Release Date<input type="date" name="release_date"></label><label>Era<input name="era"></label><label>Order<input type="number" name="sort_order" value="0"></label><label class="span-2">Description<textarea name="description"></textarea></label><label class="check-row"><input type="checkbox" name="is_active" value="1" checked> Active</label><button>Add Song</button>
    </form>
    <div class="admin-table-wrap"><table><tr><th>Name</th><th>Era</th><th>Date</th><th>Image</th><th>Active</th><th>Action</th></tr>
        @foreach($songsList as $song)<tr><form method="POST" action="{{ route('admin.songs.update', $song) }}" enctype="multipart/form-data">@csrf @method('PUT')<td><input name="name" value="{{ $song->name }}"></td><td><input name="era" value="{{ $song->era }}"></td><td><input type="date" name="release_date" value="{{ optional($song->release_date)->format('Y-m-d') }}"></td><td><input name="img_path" value="{{ $song->img_path }}"><input type="file" name="image_file" accept="image/*"></td><td><input type="checkbox" name="is_active" value="1" {{ $song->is_active ? 'checked' : '' }}></td><td><textarea name="description">{{ $song->description }}</textarea><button>Save</button></form><form method="POST" action="{{ route('admin.songs.delete', $song) }}" onsubmit="return confirm('Delete song?')">@csrf @method('DELETE')<button class="danger">Delete</button></form></td></tr>@endforeach
    </table></div>
</section>

<section class="admin-card" id="gallery">
    <h2>Gallery</h2>
    <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data" class="admin-row-form wide">@csrf
        <input name="name" placeholder="Name" required><input name="category" placeholder="Category"><input name="img_path" placeholder="extra_gallery/BTS.jfif"><input type="file" name="image_file" accept="image/*"><label class="check-row"><input type="checkbox" name="is_active" value="1" checked> Active</label><button>Add</button>
    </form>
    <div class="mini-grid">@foreach($galleryList as $pic)<article class="mini-card"><img src="{{ asset($pic->img_path) }}" alt="{{ $pic->name }}"><b>{{ $pic->name }}</b><span>{{ $pic->category }}</span><form method="POST" action="{{ route('admin.gallery.delete', $pic) }}" onsubmit="return confirm('Delete image?')">@csrf @method('DELETE')<button class="danger">Delete</button></form></article>@endforeach</div>
</section>

<section class="admin-card" id="timeline">
    <h2>Timeline</h2>
    <form method="POST" action="{{ route('admin.timeline.store') }}" class="admin-grid-form">@csrf
        <label>Year<input name="year" required></label><label>Category<input name="category" value="Milestone"></label><label class="span-2">Title<input name="title" required></label><label class="span-2">Body<textarea name="body"></textarea></label><label class="span-2">Bullet Points - one per line<textarea name="bullet_points_text"></textarea></label><label class="span-2">Image Paths - one per line<textarea name="image_paths_text"></textarea></label><label>Order<input type="number" name="sort_order" value="0"></label><label class="check-row"><input type="checkbox" name="is_active" value="1" checked> Active</label><button class="span-2">Add Timeline Event</button>
    </form>
    @foreach($timelineList as $event)<details class="admin-details"><summary>{{ $event->year }} · {{ $event->title }}</summary><form method="POST" action="{{ route('admin.timeline.update', $event) }}" class="admin-grid-form">@csrf @method('PUT')<label>Year<input name="year" value="{{ $event->year }}"></label><label>Category<input name="category" value="{{ $event->category }}"></label><label class="span-2">Title<input name="title" value="{{ $event->title }}"></label><label class="span-2">Body<textarea name="body">{{ $event->body }}</textarea></label><label class="span-2">Bullet Points<textarea name="bullet_points_text">{{ implode("\n", $event->bullet_points ?? []) }}</textarea></label><label class="span-2">Image Paths<textarea name="image_paths_text">{{ implode("\n", $event->image_paths ?? []) }}</textarea></label><label>Order<input type="number" name="sort_order" value="{{ $event->sort_order }}"></label><label class="check-row"><input type="checkbox" name="is_active" value="1" {{ $event->is_active ? 'checked' : '' }}> Active</label><button>Save Event</button></form><form method="POST" action="{{ route('admin.timeline.delete', $event) }}" onsubmit="return confirm('Delete timeline event?')">@csrf @method('DELETE')<button class="danger">Delete Event</button></form></details>@endforeach
</section>

<section class="admin-card" id="votes">
    <h2>Vote Results</h2>
    <div class="admin-stats">@forelse($voteStats as $stat)<div><span>{{ $stat->member_name }}</span><b>{{ $stat->total }}</b></div>@empty<p>No votes yet.</p>@endforelse</div>
</section>
@endsection

