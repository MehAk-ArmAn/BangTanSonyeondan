{{--
    BTS COPIES - CREATE PAGE
    ========================
    FIX:
    - Uses layout
    - Same form
    - Same validation display
--}}

@extends('layouts.frontend.app')

@section('title', 'â‹†âœ¦âœ§â‹† BTS Copies Creator â‹†âœ¦âœ§â‹†')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/bts_copies.css') }}">
@endpush

@section('content')
    <div class="container">
        <h2>ðŸ§© BTS Copies Creator</h2>

        {{-- Success message --}}
        @if (session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        {{-- Validation errors --}}
        @if ($errors->any())
            <div class="alert error">
                <b>Fix these:</b>
                <ul>
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Create form --}}
        <form method="POST" action="{{ route('bts_copies.store') }}">
            @csrf

            <label>BTS Member *</label>
            <select name="bts_name" required>
                <option value="">â‹†âœ¦âœ§â‹† Select BTS Member â‹†âœ¦âœ§â‹†</option>
                @foreach($members as $name)
                    <option value="{{ $name }}">â‹†âœ¦âœ§â‹† {{ $name }} â‹†âœ¦âœ§â‹†</option>
                @endforeach
            </select>
            <br>
            <br>

            <label>Copy Extra Name</label>
            <input type="text" name="copy_extra_name" value="{{ old('copy_extra_name') }}" placeholder="e.g. BTS, Beyond The Scenes, LY">

            <label>Copy Title *</label>
            <input type="text" name="copy_title" value="{{ old('copy_title') }}" placeholder="Must include BTS Name inside it" required>

            <div class="hint">
                Rule: the title must contain the BTS Name
                (example: <i>BTS_nickname - Copy for _ member</i>)
            </div>

            <label>Description</label>
            <textarea name="description" rows="6" placeholder="Write details...">{{ old('description') }}</textarea>

            <button type="submit">Save Copy âœ…</button>
        </form>
    </div>
@endsection

