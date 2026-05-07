{{--
|--------------------------------------------------------------------------
| Public footer
|--------------------------------------------------------------------------
| Dynamic contact/footer/social data comes from site_settings table.
--}}
<footer class="site-footer">
    <div class="footer-grid">
        <div>
            <img class="footer-logo" src="{{ asset('favicons/logo.png') }}" alt="BangTanSonyeondan logo">
            <p>{{ $siteSettings['footer_text'] ?? 'A fan-made BangTanSonyeondan website for ARMY.' }}</p>
        </div>

        <div>
            <h3>Explore</h3>
            @foreach($navItems as $item)
                <a href="{{ url($item->url) }}">{{ $item->label }}</a>
            @endforeach
        </div>

        <div>
            <h3>Members</h3>
            @foreach($members as $member)
                <a href="{{ route('member.show', $member->slug ?: $member->name) }}">{{ $member->emoji }} {{ $member->stage_name ?: $member->nickname }}</a>
            @endforeach
        </div>

        <div>
            <h3>Contact</h3>
            <p>{{ $adminEmail }}</p>
            <p>{{ $location }}</p>
            <div class="social-row">
                @if($instagram)<a href="{{ $instagram }}" target="_blank">Instagram</a>@endif
                @if($twitter)<a href="{{ $twitter }}" target="_blank">X</a>@endif
                @if($youtube)<a href="{{ $youtube }}" target="_blank">YouTube</a>@endif
                @if($tiktok)<a href="{{ $tiktok }}" target="_blank">TikTok</a>@endif
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <span>Â© {{ date('Y') }} {{ $siteSettings['site_title'] ?? 'BangTanSonyeondan' }}.</span>
        <span>Created by {{ $name }} Â· Fan-made Â· Support official BTS content.</span>
    </div>
</footer>

