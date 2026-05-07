{{--
    BTS COPIES - EDIT PAGE
    ======================
    FIX:
    - Uses layout
    - Same update form
    - Same data binding
--}}

@extends('layouts.frontend.app')

@section('title', '⋆✦✧⋆ BTS Copies Creator ⋆✦✧⋆')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/bts_copies.css') }}">
@endpush

@section('content')
    <div class="container">
        <h2>🧩 BTS Copies Creator</h2>

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

        {{-- Edit form --}}
        <form method="POST" action="{{ route('bts_copies.update', $copy->id) }}">
            @csrf
            @method('PUT')

            <label>BTS Member *</label>
            <select name="bts_name" required>
                <option value="">⋆✦✧⋆ Select BTS Member ⋆✦✧⋆</option>
                @foreach($members as $name)
                    <option value="{{ $name }}" {{ $copy->bts_name == $name ? 'selected' : '' }}>
                        ⋆✦✧⋆ {{ $name }} ⋆✦✧⋆
                    </option>
                @endforeach
            </select>
            <br>
            <br>

            <label>Copy Extra Name</label>
            <input type="text" name="copy_extra_name" value="{{ old('copy_extra_name', $copy->copy_extra_name) }}" placeholder="e.g. BTS, Beyond The Scenes, LY">

            <label>Copy Title *</label>
            <input type="text" name="copy_title" value="{{ old('copy_title', $copy->copy_title) }}" placeholder="Must include BTS Name inside it" required>

            <div class="hint">
                Rule: the title must contain the BTS Name
                (example: <i>BTS_nickname - Copy for _ member</i>)
            </div>

            <label>Description</label>
            <textarea name="description" rows="6" placeholder="Write details...">{{ old('description', $copy->description) }}</textarea>

            <button type="submit">Save Copy ✅</button>
        </form>
    </div>
@endsection
