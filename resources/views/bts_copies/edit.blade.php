@extends('layouts.frontend.app')
@section('title', 'Edit BTS Copy')
@push('styles')<link rel="stylesheet" href="{{ asset('css/bts_copies.css') }}">@endpush
@section('content')
<div class="container">
    <h2>Edit BTS Copy</h2>
    <form method="POST" action="{{ route('bts_copies.update', $btsCopy) }}">
        @csrf
        @method('PUT')
        <label>BTS Member *</label>
        <select name="bts_name" required>
            <option value="">Select BTS Member</option>
            @foreach($memberNames as $name)
                <option value="{{ $name }}" @selected(old('bts_name', $btsCopy->bts_name) === $name)>{{ $name }}</option>
            @endforeach
        </select>
        <label>Copy Extra Name</label>
        <input type="text" name="copy_extra_name" value="{{ old('copy_extra_name', $btsCopy->copy_extra_name) }}">
        <label>Copy Title *</label>
        <input type="text" name="copy_title" value="{{ old('copy_title', $btsCopy->copy_title) }}" required>
        <label>Description</label>
        <textarea name="description" rows="6">{{ old('description', $btsCopy->description) }}</textarea>
        <button type="submit">Save Copy</button>
    </form>
</div>
@endsection
