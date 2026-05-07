{{--
|--------------------------------------------------------------------------
| Public navbar
|--------------------------------------------------------------------------
| Links come from nav_items table. Member links come from members table.
--}}
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

    <a class="nav-cta" href="{{ route('vote') }}">Vote ðŸ’œ</a>
</header>

