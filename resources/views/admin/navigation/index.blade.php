@extends('layouts.admin.app')
@section('title', 'Navigation · BTS Admin')
@section('page_heading', 'Navigation')
@section('content')
@include('admin.partials.page-nav')

<section class="admin-card professional-card">
    <div class="admin-card-header"><div><p class="admin-eyebrow">Menu builder</p><h2>Add Link</h2></div></div>
    <form method="POST" action="{{ route('admin.navigation.store') }}" class="admin-row-form">
        @csrf
        <input name="label" placeholder="Label" required>
        <input name="url" placeholder="/songs or /bt21" required>
        <input type="number" name="sort_order" value="0">
        <label class="check-row"><input type="checkbox" name="is_active" value="1" checked> Active</label>
        <button>Add Link</button>
    </form>
</section>

<section class="admin-card professional-card">
    <div class="admin-card-header"><div><p class="admin-eyebrow">Existing links</p><h2>Edit Navigation</h2></div></div>
    <div class="admin-table-wrap professional-table"><table><thead><tr><th>Label</th><th>URL</th><th>Order</th><th>Status</th><th>Save</th><th>Delete</th></tr></thead><tbody>
        @foreach($navList as $item)
            <tr>
                <form method="POST" action="{{ route('admin.navigation.update', $item) }}">@csrf @method('PUT')
                    <td><input name="label" value="{{ $item->label }}"></td>
                    <td><input name="url" value="{{ $item->url }}"></td>
                    <td><input type="number" name="sort_order" value="{{ $item->sort_order }}"></td>
                    <td><label class="check-row"><input type="checkbox" name="is_active" value="1" {{ $item->is_active ? 'checked' : '' }}> Active</label></td>
                    <td><button>Save</button></td>
                </form>
                <td><form method="POST" action="{{ route('admin.navigation.destroy', $item) }}" onsubmit="return confirm('Delete this link?')">@csrf @method('DELETE')<button class="danger">Delete</button></form></td>
            </tr>
        @endforeach
    </tbody></table></div>
</section>
@endsection
