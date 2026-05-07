{{-- Admin flash/validation alerts. --}}
@if (session('success'))
    <div class="admin-alert success">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="admin-alert error">{{ session('error') }}</div>
@endif
@if ($errors->any())
    <div class="admin-alert error">{{ $errors->first() }}</div>
@endif
