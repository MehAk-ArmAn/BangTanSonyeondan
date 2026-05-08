@extends('layouts.frontend.app')
@section('title', 'BTS Copies')
@push('styles')<link rel="stylesheet" href="{{ asset('css/bts_copies.css') }}">@endpush
@section('content')
<div class="container">
    <h2>BTS Copies</h2>
    <a href="{{ route('bts_copies.create') }}">+ Create New Copy</a>
    <table>
        <thead><tr><th>ID</th><th>BTS Member</th><th>Copy Title</th><th>Extra</th><th>Created</th><th>Actions</th></tr></thead>
        <tbody>
            @forelse($copies as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->bts_name }}</td>
                    <td>{{ $c->copy_title }}</td>
                    <td>{{ $c->copy_extra_name }}</td>
                    <td>{{ $c->created_at }}</td>
                    <td>
                        <a class="edit_link" href="{{ route('bts_copies.edit', $c) }}">Edit</a>
                        <form action="{{ route('bts_copies.destroy', $c) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="delete_btn" type="submit" onclick="return confirm('Delete this copy?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">No copies yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
