@extends('layouts.admin.app')
@section('title', 'Members · BTS Admin')
@section('page_heading', 'Member Vaults')
@section('content')
@include('admin.partials.page-nav')

@foreach($membersList as $member)
<section class="admin-card professional-card">
    <div class="admin-card-header"><div><p class="admin-eyebrow">Profile</p><h2>{{ $member->emoji }} {{ $member->stage_name ?: $member->name }}</h2></div><span class="admin-chip">{{ $member->role }}</span></div>
    <form method="POST" action="{{ route('admin.members.update', $member) }}" enctype="multipart/form-data" class="admin-grid-form">
        @csrf @method('PUT')
        <label>Name<input name="name" value="{{ $member->name }}" required></label>
        <label>Stage Name<input name="stage_name" value="{{ $member->stage_name }}"></label>
        <label>Nickname<input name="nickname" value="{{ $member->nickname }}"></label>
        <label>Korean Name<input name="korean_name" value="{{ $member->korean_name }}"></label>
        <label>Role<input name="role" value="{{ $member->role }}"></label>
        <label>Birth Date<input type="date" name="birth_date" value="{{ optional($member->birth_date)->format('Y-m-d') }}"></label>
        <label>Birthplace<input name="birthplace" value="{{ $member->birthplace }}"></label>
        <label>Emoji<input name="emoji" value="{{ $member->emoji }}"></label>
        <label>Accent Color<input name="accent_color" value="{{ $member->accent_color }}"></label>
        <label>BT21 Character<input name="bt21_character" value="{{ $member->bt21_character }}"></label>
        <label>Intro Title<input name="intro_title" value="{{ $member->intro_title }}"></label>
        <label>Image Path<input name="image" value="{{ $member->image }}"></label>
        <label>Upload New Image<input type="file" name="image_file" accept="image/*"></label>
        <label>Favicon<input name="favicon" value="{{ $member->favicon }}"></label>
        <label>Sort Order<input type="number" name="sort_order" value="{{ $member->sort_order }}"></label>
        <label class="span-2">Short Bio<textarea name="short_bio">{{ $member->short_bio }}</textarea></label>
        <label class="span-2">Long Bio<textarea name="long_bio">{{ $member->long_bio }}</textarea></label>
        <label class="span-2">Fun Facts - one per line<textarea name="fun_facts_text">{{ implode("\n", $member->fun_facts ?? []) }}</textarea></label>
        <label class="check-row"><input type="checkbox" name="is_active" value="1" {{ $member->is_active ? 'checked' : '' }}> Active</label>
        <button class="span-2">Save Member</button>
    </form>
</section>
@endforeach
@endsection
