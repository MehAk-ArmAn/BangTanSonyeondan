{{-- Admin auth layout: login page only, no sidebar. --}}
<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.admin.partials.head')
</head>
<body class="admin-auth-body">
    @include('layouts.admin.partials.alerts')
    @yield('content')
    @stack('scripts')
</body>
</html>

