@extends('layouts.frontend.app')
@section('title', 'BT21 · BangTanSonyeondan')
@section('content')
<section class="page-hero small bt21-hero">
    <span class="eyebrow">Cute Side Quest</span>
    <h1>BT21 Animated Anatomy Profiles</h1>
    <p>BT21 is now fun, colorful, and character-focused — not a shortcut back to member vaults.</p>
</section>

<div class="bt21-grid">
    @foreach($characters as $character)
        <article class="bt21-card" style="--accent: {{ $character['accent'] }}">
            <div class="bt21-orbit">
                <img src="{{ asset($character['image']) }}" alt="{{ $character['name'] }}">
            </div>
            <div class="bt21-body">
                <span>{{ $character['member'] }} character</span>
                <h2>{{ $character['name'] }}</h2>
                <p>{{ $character['mood'] }}</p>
                <strong>{{ $character['power'] }}</strong>
                <div class="anatomy-list">
                    <h3>Anatomy notes</h3>
                    <ul>
                        @foreach($character['anatomy'] as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="move-row">
                    @foreach($character['moves'] as $move)
                        <span>{{ $move }}</span>
                    @endforeach
                </div>
            </div>
        </article>
    @endforeach
</div>
@endsection
