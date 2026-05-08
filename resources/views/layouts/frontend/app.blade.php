<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.frontend.partials.head')
</head>
<body>
    <div class="purple-orb orb-one"></div>
    <div class="purple-orb orb-two"></div>
    <div class="bg-photo-wash"></div>

    @include('layouts.frontend.partials.navbar')

    <main class="page-shell">
        @if (session('success'))
            <div class="public-alert success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="public-alert error">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="public-alert error">{{ $errors->first() }}</div>
        @endif
        @yield('content')
    </main>

    @include('layouts.frontend.partials.footer')
    @stack('scripts')
</body>
</html>
