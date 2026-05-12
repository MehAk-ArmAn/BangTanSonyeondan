@php
    $adminMenu = [
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Settings', 'url' => route('admin.settings.index')],
        ['label' => 'Navigation', 'url' => route('admin.navigation.index')],
        ['label' => 'Members', 'url' => route('admin.members.index')],
        ['label' => 'Songs', 'url' => route('admin.songs.index')],
        ['label' => 'Gallery', 'url' => route('admin.gallery.index')],
        ['label' => 'Learning', 'url' => route('admin.learning-materials.index')],
        ['label' => 'Quizzes', 'url' => route('admin.quizzes.index')],
        ['label' => 'Quotes', 'url' => route('admin.quotes.index')],
        ['label' => 'Timeline', 'url' => route('admin.timeline.index')],
        ['label' => 'BT21', 'url' => route('admin.bt21.index')],
        ['label' => 'Votes', 'url' => route('admin.votes.index')],
        ['label' => 'BangTan Updates', 'url' => route('admin.updates.index')],
    ];
@endphp

<nav class="admin-section-nav">
    @foreach($adminMenu as $item)
        <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
    @endforeach
</nav>

@if(session('success'))
    <div class="admin-alert success">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="admin-alert danger">
        <strong>Fix these:</strong>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
