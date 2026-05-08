<section class="admin-card professional-card" id="settings">
    <div class="admin-card-header">
        <div>
            <p class="admin-eyebrow">Core identity</p>
            <h2>Site Settings</h2>
        </div>
        <span class="admin-chip">Saved with Save All</span>
    </div>

    <div class="admin-grid-form">
        @foreach([
            'site_title' => 'Site Title',
            'site_subtitle' => 'Site Subtitle',
            'hero_kicker' => 'Hero Kicker',
            'hero_title' => 'Hero Title',
            'admin_email' => 'Email',
            'location' => 'Location',
            'creator_name' => 'Creator Name',
            'phone' => 'Phone',
            'instagram' => 'Instagram URL',
            'twitter' => 'X/Twitter URL',
            'youtube' => 'YouTube URL',
            'tiktok' => 'TikTok URL',
        ] as $key => $label)
            <label>{{ $label }}
                <input name="settings[{{ $key }}]" value="{{ old("settings.$key", $settings[$key] ?? '') }}">
            </label>
        @endforeach

        <label class="span-2">Hero Body
            <textarea name="settings[hero_body]">{{ old('settings.hero_body', $settings['hero_body'] ?? '') }}</textarea>
        </label>

        <label class="span-2">Footer Text
            <textarea name="settings[footer_text]">{{ old('settings.footer_text', $settings['footer_text'] ?? '') }}</textarea>
        </label>
    </div>
</section>
