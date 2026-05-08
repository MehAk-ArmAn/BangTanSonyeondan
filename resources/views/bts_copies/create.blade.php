@extends('layouts.frontend.app')
@section('title', 'BTS Copies Creator')
@push('styles')<link rel="stylesheet" href="{{ asset('css/bts_copies.css') }}">@endpush
@section('content')
<div class="container">
    <h2>BTS Copies Creator</h2>
    <form method="POST" action="{{ route('bts_copies.store') }}">
        @csrf
        <label>BTS Member *</label>
        <select name="bts_name" required>
            <option value="">Select BTS Member</option>
            @foreach($memberNames as $name)
                <option value="{{ $name }}" @selected(old('bts_name') === $name)>{{ $name }}</option>
            @endforeach
        </select>
        <label>Copy Extra Name</label>
        <input type="text" name="copy_extra_name" value="{{ old('copy_extra_name') }}" placeholder="e.g. nickname, fan title, era">
        <label>Copy Title *</label>
        <input type="text" name="copy_title" value="{{ old('copy_title') }}" required>
        <label>Description</label>
        <textarea name="description" rows="6">{{ old('description') }}</textarea>
        <button type="submit">Save Copy</button>
    </form>
</div>
@endsection
