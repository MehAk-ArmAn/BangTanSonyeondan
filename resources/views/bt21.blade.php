{{-- BT21 page driven by member data. --}}
@extends('layouts.frontend.app')
@section('title', 'BT21 Â· BangTanSonyeondan')
@section('content')
<section class="page-hero small">
    <span class="eyebrow">Cute Side Quest</span>
    <h1>BT21 Character Corner</h1>
    <p>A clean mini section connecting each member vault with their BT21 character.</p>
</section>
<div class="member-grid">
    @foreach($characters as $member)
        <a class="member-tile" href="{{ route('member.show', $member->slug ?: $member->name) }}" style="--accent: {{ $member->accent_color ?? '#a855f7' }}">
            <img src="{{ $member->faviconUrl() }}" alt="{{ $member->bt21_character }}">
            <div>
                <span>{{ $member->emoji }} {{ $member->stage_name }}</span>
                <h3>{{ $member->bt21_character }}</h3>
                <p>{{ $member->intro_title }}</p>
            </div>
        </a>
    @endforeach
</div>
@endsection

