@extends('layouts.admin.app')
@section('title', 'Timeline · BTS Admin')
@section('page_heading', 'Achievements Timeline')
@section('content')
@include('admin.partials.page-nav')

<section class="admin-card professional-card">
    <div class="admin-card-header"><div><p class="admin-eyebrow">Milestones</p><h2>Add Event</h2></div></div>
    <form method="POST" action="{{ route('admin.timeline.store') }}" class="admin-grid-form">
        @csrf
        <label>Year<input name="year" required></label>
        <label>Category<input name="category"></label>
        <label class="span-2">Title<input name="title" required></label>
        <label class="span-2">Body<textarea name="body"></textarea></label>
        <label class="span-2">Bullet Points - one per line<textarea name="bullet_points_text"></textarea></label>
        <label class="span-2">Image Paths - one per line<textarea name="image_paths_text"></textarea></label>
        <label>Order<input type="number" name="sort_order" value="0"></label>
        <label class="check-row"><input type="checkbox" name="is_active" value="1" checked> Active</label>
        <button class="span-2">Add Timeline Event</button>
    </form>
</section>

@foreach($timelineList as $event)
<section class="admin-card professional-card">
    <form method="POST" action="{{ route('admin.timeline.update', $event) }}" class="admin-grid-form">
        @csrf @method('PUT')
        <label>Year<input name="year" value="{{ $event->year }}" required></label>
        <label>Category<input name="category" value="{{ $event->category }}"></label>
        <label class="span-2">Title<input name="title" value="{{ $event->title }}" required></label>
        <label class="span-2">Body<textarea name="body">{{ $event->body }}</textarea></label>
        <label class="span-2">Bullet Points<textarea name="bullet_points_text">{{ implode("\n", $event->bullet_points ?? []) }}</textarea></label>
        <label class="span-2">Image Paths<textarea name="image_paths_text">{{ implode("\n", $event->image_paths ?? []) }}</textarea></label>
        <label>Order<input type="number" name="sort_order" value="{{ $event->sort_order }}"></label>
        <label class="check-row"><input type="checkbox" name="is_active" value="1" {{ $event->is_active ? 'checked' : '' }}> Active</label>
        <button class="span-2">Save Event</button>
    </form>
    <form method="POST" action="{{ route('admin.timeline.destroy', $event) }}" onsubmit="return confirm('Delete event?')">@csrf @method('DELETE')<button class="danger">Delete Event</button></form>
</section>
@endforeach
@endsection
