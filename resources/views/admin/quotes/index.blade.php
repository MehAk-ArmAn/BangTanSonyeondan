@extends('layouts.admin.app')
@section('title', 'Quotes · BTS Admin')
@section('page_heading', 'Quotes')
@section('content')
@include('admin.partials.page-nav')

<section class="admin-card professional-card">
    <div class="admin-card-header"><div><p class="admin-eyebrow">Words</p><h2>Add Quote</h2></div></div>
    <form method="POST" action="{{ route('admin.quotes.store') }}" class="admin-grid-form">
        @csrf
        <label class="span-2">Quote<textarea name="quote" required></textarea></label>
        <label>Author<input name="author"></label>
        <label>Source<input name="source"></label>
        <label>Order<input type="number" name="sort_order" value="0"></label>
        <label class="check-row"><input type="checkbox" name="is_active" value="1" checked> Active</label>
        <button class="span-2">Add Quote</button>
    </form>
</section>

@foreach($quotesList as $quote)
<section class="admin-card professional-card">
    <form method="POST" action="{{ route('admin.quotes.update', $quote) }}" class="admin-grid-form">
        @csrf @method('PUT')
        <label class="span-2">Quote<textarea name="quote" required>{{ $quote->quote }}</textarea></label>
        <label>Author<input name="author" value="{{ $quote->author }}"></label>
        <label>Source<input name="source" value="{{ $quote->source }}"></label>
        <label>Order<input type="number" name="sort_order" value="{{ $quote->sort_order }}"></label>
        <label class="check-row"><input type="checkbox" name="is_active" value="1" {{ $quote->is_active ? 'checked' : '' }}> Active</label>
        <button class="span-2">Save Quote</button>
    </form>
    <form method="POST" action="{{ route('admin.quotes.destroy', $quote) }}" onsubmit="return confirm('Delete quote?')">@csrf @method('DELETE')<button class="danger">Delete Quote</button></form>
</section>
@endforeach
@endsection
