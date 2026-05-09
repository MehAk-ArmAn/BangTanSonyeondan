{{-- Logged-in admin sidebar. --}}
<aside class="admin-sidebar">
    <a class="admin-brand" href="{{ route('admin.dashboard') }}">
        <img src="{{ asset('favicons/logo.png') }}" alt="Logo">
        <span>BTS Admin</span>
    </a>

    <nav>
        <a href="/admin/overview">Overview</a>
        <a href="/admin/settings">Settings</a>
        <a href="/admin/settings#password">Password</a>
        <a href="/admin/navigation">Navigation</a>
        <a href="/admin/members">Members</a>
        <a href="/admin/quotes">Quotes</a>
        <a href="/admin/songs">Songs</a>
        <a href="/admin/gallery">Gallery</a>
        <a href="/admin/timeline">Timeline</a>
        <a href="/admin/votes">Votes</a>
        <a href="{{ route('home') }}" target="_blank">View Site</a>
    </nav>

    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="logout-btn">Logout</button>
    </form>
</aside>

