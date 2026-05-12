<header class="site-header" id="smartSiteHeader">
    <a href="{{ route('home') }}" class="brand-link" aria-label="BangTanSonyeondan Home">
        <img src="{{ asset('favicons/logo.png') }}" alt="BangTanSonyeondan logo">
        <span>{{ $siteSettings['site_title'] ?? 'BangTanSonyeondan' }}</span>
    </a>

    <nav class="site-nav smart-site-nav" id="smartSiteNav" aria-label="Main navigation">
        <div class="smart-nav-visible" id="smartNavVisible">
            @foreach($navItems as $item)
                <a
                    href="{{ url($item->url) }}"
                    class="smart-nav-item"
                    data-nav-order="{{ $loop->index }}"
                >
                    {{ $item->label }}
                </a>
            @endforeach
        </div>

        <details class="nav-more smart-nav-more" id="smartNavMore">
            <summary>
                More <span>⌄</span>
            </summary>

            <div class="nav-more-menu smart-nav-hidden" id="smartNavHidden"></div>
        </details>
    </nav>

    <form class="nav-search" action="{{ route('search') }}" method="GET" role="search">
        <input type="search" name="q" value="{{ request('q') }}" placeholder="Search BTS, songs, quotes..." aria-label="Search website">
        <button type="submit">Search</button>
    </form>

    <div class="nav-actions">
        @auth
            <a class="nav-cta" href="{{ route('user.dashboard') }}">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link-button">Logout</button>
            </form>
        @else
            <a class="nav-link-button" href="{{ route('login') }}">Login</a>
            <a class="nav-cta" href="{{ route('register') }}">Join ARMY</a>
        @endauth
    </div>
</header>