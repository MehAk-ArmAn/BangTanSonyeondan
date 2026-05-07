{{--
|--------------------------------------------------------------------------
| Frontend layout
|--------------------------------------------------------------------------
| Every normal visitor page extends this file.
--}}
<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.frontend.partials.head')
</head>
<body>
    <div class="purple-orb orb-one"></div>
    <div class="purple-orb orb-two"></div>

    @include('layouts.frontend.partials.navbar')

    <main class="page-shell">
        @yield('content')
    </main>

    @include('layouts.frontend.partials.footer')
    @stack('scripts')
</body>
</html>

