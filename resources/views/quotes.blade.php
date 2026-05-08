@extends('layouts.frontend.app')
@section('title', 'BTS Quotes · BangTanSonyeondan')
@section('content')
<section class="page-hero small">
    <span class="eyebrow">Quote Vault</span>
    <h1>Quotes</h1>
    <p>Soft, motivational, and dramatic BTS-inspired quote cards for ARMY browsing.</p>
</section>

<section class="quote-grid">
    @foreach($quotes as $quote)
        <article class="quote-card" id="quote-{{ $quote->id }}">
            <span>{{ $quote->context ?: 'BangTanSonyeondan' }}</span>
            <p>“{{ $quote->quote }}”</p>
            <h3>{{ $quote->source }}</h3>
        </article>
    @endforeach
</section>
@endsection
