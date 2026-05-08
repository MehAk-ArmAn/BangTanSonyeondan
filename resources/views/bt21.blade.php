@extends('layouts.frontend.app')
@section('title', 'BT21 · BangTanSonyeondan')
@section('content')
<section class="page-hero small bt21-hero">
    <span class="eyebrow">Cute Side Quest</span>
    <h1>BT21 Animated Anatomy Profiles</h1>
    <p>BT21 is now fun, colorful, character-focused, and fully editable from the admin panel.</p>
</section>

<div class="bt21-grid">
    @forelse($characters as $character)
        <article id="{{ $character->slug }}" class="bt21-card" style="--accent: {{ $character->accent_color ?: '#a855f7' }}">
            <div class="bt21-orbit">
                <img src="{{ asset($character->image ?: 'favicons/logo.png') }}" alt="{{ $character->name }}">
            </div>
            <div class="bt21-body">
                <span>{{ $character->member_name ?: 'BT21' }} character</span>
                <h2>{{ $character->emoji }} {{ $character->name }}</h2>
                <p>{{ $character->mood }}</p>
                <strong>{{ $character->power }}</strong>

                @if(!empty($character->anatomy))
                    <div class="anatomy-list">
                        <h3>Anatomy notes</h3>
                        <ul>
                            @foreach($character->anatomy as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(!empty($character->moves))
                    <div class="move-row">
                        @foreach($character->moves as $move)
                            <span>{{ $move }}</span>
                        @endforeach
                    </div>
                @endif
            </div>
        </article>
    @empty
        <div class="glass-panel">
            <h2>No BT21 characters yet</h2>
            <p>Add BT21 characters from the admin panel and they will appear here automatically.</p>
        </div>
    @endforelse
</div>
@endsection
