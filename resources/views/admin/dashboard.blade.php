{{--
|--------------------------------------------------------------------------
| Admin dashboard
|--------------------------------------------------------------------------
| Professional bulk-edit admin dashboard.
| Existing records, new records, deletes, settings and uploads are saved
| through one final Save All Changes button at the bottom.
--}}
@extends('layouts.admin.app')

@section('title', 'Dashboard · BTS Admin')
@section('page_heading', 'Dashboard 💜')

@section('content')
    @include('admin.dashboard.partials._overview')

    @if(session('success'))
        <div class="admin-alert success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="admin-alert danger">
            <strong>Please fix these:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="admin-page-shell">
        <aside class="admin-side-nav" aria-label="Admin sections">
            <a href="#settings">Site Settings</a>
            <a href="#navigation">Navigation</a>
            <a href="#members">Member Vaults</a>
            <a href="#quotes">Quotes</a>
            <a href="#songs">Songs</a>
            <a href="#gallery">Gallery</a>
            <a href="#timeline">Timeline</a>
            <a href="#votes">Vote Results</a>
        </aside>

        <div class="admin-main-panel">
            <form id="admin-save-all-form" method="POST" action="{{ route('admin.dashboard.saveAll') }}" enctype="multipart/form-data">
                @csrf

                @include('admin.dashboard.partials._settings')
                @include('admin.dashboard.partials._navigation')
                @include('admin.dashboard.partials._members')
                @include('admin.dashboard.partials._quotes')
                @include('admin.dashboard.partials._songs')
                @include('admin.dashboard.partials._gallery')
                @include('admin.dashboard.partials._timeline')

                <section class="admin-save-panel" id="save-all">
                    <div>
                        <h2>Ready to publish?</h2>
                        <p>Review your changes, then save everything in one clean update.</p>
                    </div>
                    <button type="submit" class="admin-save-all-btn">Save All Changes</button>
                </section>

                <div class="admin-sticky-save">
                    <span>Unsaved dashboard edits will stay local until you save.</span>
                    <button type="submit">Save All</button>
                </div>
            </form>

            @include('admin.dashboard.partials._votes')
        </div>
    </div>
@endsection
