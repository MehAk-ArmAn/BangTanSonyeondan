{{-- Logged-in admin sidebar. --}}
<aside class="admin-sidebar">
    <a class="admin-brand" href="{{ route('admin.dashboard') }}">
        <img src="{{ asset('favicons/logo.png') }}" alt="Logo">
        <span>BTS Admin</span>
    </a>

    <nav>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.settings.index') }}">Settings</a>
        <a href="{{ route('admin.navigation.index') }}">Navigation</a>
        <a href="{{ route('admin.updates.index') }}">BangTan Updates</a>
        <a href="{{ route('admin.media-gallery.index') }}">Media Gallery</a>
        <a href="{{ route('admin.members.index') }}">Members</a>
        <a href="{{ route('admin.learning-materials.index') }}">Learning</a>
        <a href="{{ route('admin.quizzes.index') }}">Quizzes</a>
        <a href="{{ route('admin.songs.index') }}">Songs</a>
        <a href="{{ route('admin.quotes.index') }}">Quotes</a>
        <a href="{{ route('admin.timeline.index') }}">Timeline</a>
        <a href="{{ route('admin.bt21.index') }}">BT21</a>
        <a href="{{ route('admin.votes.index') }}">Votes</a>
        <a href="{{ route('admin.profile-assets.index') }}">Profile Packs</a>
        <a href="{{ route('admin.users.index') }}">Users</a>

        @if(\Illuminate\Support\Facades\Route::has('admin.users.index'))
            <a href="{{ route('admin.users.index') }}">Users</a>
        @endif

        <a href="{{ route('home') }}" target="_blank">View Site</a>
    </nav>

    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="logout-btn">Logout</button>
    </form>
</aside>
