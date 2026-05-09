@php
    $footerTitle = $siteSettings['site_title'] ?? 'BangTanSonyeondan';
    $footerText = $siteSettings['footer_text'] ?? 'A fan-made BangTanSonyeondan website for ARMY. Learn, quiz, collect points, and support official BTS content.';
    $creatorName = $name ?? 'ARMY';
@endphp

<footer class="site-footer">
    <div class="footer-glow footer-glow-one"></div>
    <div class="footer-glow footer-glow-two"></div>

    <div class="footer-shell">
        <div class="footer-brand-card">
            <a href="{{ url('/') }}" class="footer-brand-link" aria-label="Go to homepage">
                <img class="footer-logo" src="{{ asset('favicons/logo.png') }}" alt="{{ $footerTitle }} logo">
                <div>
                    <h2>{{ $footerTitle }}</h2>
                    <span>Fan-made ARMY learning universe</span>
                </div>
            </a>

            <p>{{ $footerText }}</p>

            <div class="footer-mini-badges">
                <a href="{{ url('/learn') }}">Learn BTS</a>
                <a href="{{ url('/learn') }}">Take quizzes</a>
                <a href="{{ url('/learn') }}">Earn points</a>
            </div>
        </div>

        <div class="footer-grid">
            <div class="footer-column">
                <h3>Explore</h3>
                @forelse($navItems as $item)
                    <a href="{{ url($item->url) }}">{{ $item->label }}</a>
                @empty
                    <a href="{{ url('/') }}">Home</a>
                @endforelse
            </div>

            <div class="footer-column">
                <h3>Members</h3>

                <div class="footer-links-grid">
                    @foreach($members as $member)
                        <a href="{{ route('member.show', $member->slug ?: $member->name) }}">
                            <span>{{ $member->name }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="footer-column">
                <h3>BT21</h3>

                <div class="bt21-footer-buttons">
                    <a href="{{ url('/bt21#koya') }}">🐨 KOYA</a>
                    <a href="{{ url('/bt21#rj') }}">🦙 RJ</a>
                    <a href="{{ url('/bt21#shooky') }}">🍪 SHOOKY</a>
                    <a href="{{ url('/bt21#mang') }}">🕺 MANG</a>
                    <a href="{{ url('/bt21#chimmy') }}">🐶 CHIMMY</a>
                    <a href="{{ url('/bt21#tata') }}">💜 TATA</a>
                    <a href="{{ url('/bt21#cooky') }}">🐰 COOKY</a>
                    <a href="{{ url('/bt21#van') }}">🤖 VAN</a>
                </div>
            </div>

            <div class="footer-column">
                <h3>Community</h3>
                <p class="footer-contact-line">{{ $adminEmail }}</p>
                <p class="footer-contact-line">{{ $location }}</p>

                <div class="social-row">
                    @if($instagram)<a href="{{ $instagram }}" target="_blank" rel="noopener noreferrer">Instagram</a>@endif
                    @if($twitter)<a href="{{ $twitter }}" target="_blank" rel="noopener noreferrer">X</a>@endif
                    @if($youtube)<a href="{{ $youtube }}" target="_blank" rel="noopener noreferrer">YouTube</a>@endif
                    @if($tiktok)<a href="{{ $tiktok }}" target="_blank" rel="noopener noreferrer">TikTok</a>@endif
                </div>

                @guest
                    <a class="footer-login-link" href="{{ route('register') }}">Join the leaderboard</a>
                @else
                    <a class="footer-login-link" href="{{ route('user.dashboard') }}">Open dashboard</a>
                @endguest
            </div>
        </div>

        <div class="footer-bottom">
            <span>© {{ date('Y') }} {{ $footerTitle }}.</span>
            <span>Created by {{ $creatorName }} · Fan-made · Support official BTS content.</span>
        </div>
    </div>
</footer>
