{{-- Logged-in admin sidebar. --}}
<aside class="admin-sidebar">
    <a class="admin-brand" href="{{ route('admin.dashboard') }}">
        <img src="{{ asset('favicons/logo.png') }}" alt="Logo">
        <span>BTS Admin</span>
    </a>

    <nav>
        <a href="#overview">Overview</a>
        <a href="#settings">Settings</a>
        <a href="#password">Password</a>
        <a href="#navigation">Navigation</a>
        <a href="#members">Members</a>
        <a href="#quotes">Quotes</a>
        <a href="#songs">Songs</a>
        <a href="#gallery">Gallery</a>
        <a href="#timeline">Timeline</a>
        <a href="#votes">Votes</a>
        <a href="{{ route('home') }}" target="_blank">View Site</a>
    </nav>

    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="logout-btn">Logout</button>
    </form>
</aside>

