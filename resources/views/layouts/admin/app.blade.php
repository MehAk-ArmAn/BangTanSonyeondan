{{-- Admin dashboard layout: sidebar + content. --}}
<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.admin.partials.head')
</head>
<body class="admin-body">
    @include('layouts.admin.partials.sidebar')
    <main class="admin-main">
        @include('layouts.admin.partials.alerts')
        @include('layouts.admin.partials.topbar')
        @yield('content')
    </main>
    @stack('scripts')
</body>
</html>

