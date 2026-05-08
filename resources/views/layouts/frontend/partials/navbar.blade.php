<header class="site-header">
    <a href="{{ route('home') }}" class="brand-link" aria-label="BangTanSonyeondan Home">
        <img src="{{ asset('favicons/logo.png') }}" alt="BangTanSonyeondan logo">
        <span>{{ $siteSettings['site_title'] ?? 'BangTanSonyeondan' }}</span>
    </a>

    <nav class="site-nav" aria-label="Main navigation">
        @foreach($navItems as $item)
            <a href="{{ url($item->url) }}">{{ $item->label }}</a>
        @endforeach
    </nav>

    <form class="nav-search" action="{{ route('search') }}" method="GET" role="search">
        <input type="search" name="q" value="{{ request('q') }}" placeholder="Search BTS, songs, quotes..." aria-label="Search website">
        <button type="submit">Search</button>
    </form>

    <div class="nav-actions">
        @auth
            <a class="nav-cta" href="{{ route('user.dashboard') }}">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="nav-link-button">Logout</button></form>
        @else
            <a class="nav-link-button" href="{{ route('login') }}">Login</a>
            <a class="nav-cta" href="{{ route('register') }}">Join ARMY</a>
        @endauth
    </div>
</header>
