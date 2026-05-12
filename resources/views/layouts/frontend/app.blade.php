<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.frontend.partials.head')
    @stack('styles')
</head>
<body>
    <div class="purple-orb orb-one"></div>
    <div class="purple-orb orb-two"></div>
    <div class="bg-photo-wash"></div>

    @include('layouts.frontend.partials.navbar')

    <main class="page-shell">
        <div id="flashData"
             data-success="{{ session('success') }}"
             data-error="{{ session('error') ?: ($errors->any() ? $errors->first() : '') }}"></div>

        <noscript>
            @if (session('success'))
                <div class="public-alert success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="public-alert error">{{ session('error') }}</div>
            @endif
            @if ($errors->any())
                <div class="public-alert error">{{ $errors->first() }}</div>
            @endif
        </noscript>

        @yield('content')
    </main>

    @include('layouts.frontend.partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/bts.js') }}"></script>
    @stack('scripts')
</body>
</html>