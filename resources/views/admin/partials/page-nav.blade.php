@php
    $adminMenu = [];

    $addAdminLink = function ($label, $routeName) use (&$adminMenu) {
        if (\Illuminate\Support\Facades\Route::has($routeName)) {
            $adminMenu[] = [
                'label' => $label,
                'url' => route($routeName),
            ];
        }
    };

    $addAdminLink('Dashboard', 'admin.dashboard');
    $addAdminLink('Settings', 'admin.settings.index');
    $addAdminLink('Navigation', 'admin.navigation.index');
    $addAdminLink('BangTan Updates', 'admin.updates.index');
    $addAdminLink('Media Gallery', 'admin.media-gallery.index');
    $addAdminLink('Members', 'admin.members.index');
    $addAdminLink('Learning', 'admin.learning-materials.index');
    $addAdminLink('Quizzes', 'admin.quizzes.index');
    $addAdminLink('Songs', 'admin.songs.index');
    $addAdminLink('Quotes', 'admin.quotes.index');
    $addAdminLink('Timeline', 'admin.timeline.index');
    $addAdminLink('BT21', 'admin.bt21.index');
    $addAdminLink('Votes', 'admin.votes.index');
    $addAdminLink('Users', 'admin.users.index');
@endphp

<nav class="admin-section-nav">
    @foreach($adminMenu as $item)
        <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
    @endforeach
</nav>
