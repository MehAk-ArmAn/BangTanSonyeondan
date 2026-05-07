{{--
|--------------------------------------------------------------------------
| Frontend head partial
|--------------------------------------------------------------------------
| Used by all public pages. Keep global CSS here so every page stays consistent.
--}}
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="{{ $siteSettings['site_subtitle'] ?? 'A purple BTS fan archive for ARMY.' }}">
<title>@yield('title', $siteSettings['site_title'] ?? 'BangTanSonyeondan Archive')</title>
<link rel="shortcut icon" href="{{ asset('favicons/logo.png') }}" type="image/x-icon">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/bts-ui.css') }}">
@stack('styles')
