<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="{{ $siteSettings['site_subtitle'] ?? 'A dark purple BangTanSonyeondan fan website for BTS learning, quizzes, points, BT21, songs, gallery, and ARMY community.' }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="app-url" content="{{ url('/') }}">
<title>@yield('title', $siteSettings['site_title'] ?? 'BangTanSonyeondan')</title>
<link rel="shortcut icon" href="{{ asset('favicons/logo.png') }}" type="image/x-icon">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&family=Poppins:wght@500;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/bts-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/bts-learn-quiz.css') }}">