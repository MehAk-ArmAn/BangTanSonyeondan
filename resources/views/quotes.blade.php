{{-- Quotes page. --}}
@extends('layouts.frontend.app')
@section('title', 'BTS Quotes · BangTanSonyeondan')
@section('content')
<section class="page-hero small">
    <span class="eyebrow">Purple Words</span>
    <h1>BTS Quotes & Fan Notes</h1>
    <p>Clean quote cards for comfort, energy, and ARMY mood resets.</p>
</section>
<div class="quote-grid">
    @foreach($quotes as $quote)
        <article class="quote-card">
            <span>{{ $quote->context ?: 'Quote' }}</span>
            <p>“{{ $quote->quote }}”</p>
            <h3>{{ $quote->source }}</h3>
        </article>
    @endforeach
</div>
@endsection
