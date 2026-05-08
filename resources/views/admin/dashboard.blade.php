@extends('layouts.admin.app')
@section('title', 'Dashboard · BTS Admin')
@section('page_heading', 'Dashboard 💜')

@section('content')
<div class="admin-page-shell">
    <aside class="admin-side-nav">
        <a href="#overview">Overview</a>
        <a href="#settings">Site Settings</a>
        <a href="#navigation">Navigation</a>
        <a href="#bt21">BT21</a>
        <a href="#members">Members</a>
        <a href="#quotes">Quotes</a>
        <a href="#songs">Songs</a>
        <a href="#gallery">Gallery</a>
        <a href="#timeline">Timeline</a>
        <a href="#votes">Vote Results</a>
    </aside>

    <main class="admin-main-panel">
        @if(session('success'))
            <div class="admin-alert success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="admin-alert danger">
                <strong>Fix these first:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="admin-save-all-form" method="POST" action="{{ route('admin.dashboard.saveAll') }}" enctype="multipart/form-data">
            @csrf

            @include('admin.dashboard.partials._overview')
            @include('admin.dashboard.partials._settings')
            @include('admin.dashboard.partials._navigation')
            @include('admin.dashboard.partials._bt21')
            @include('admin.dashboard.partials._members')
            @include('admin.dashboard.partials._quotes')
            @include('admin.dashboard.partials._songs')
            @include('admin.dashboard.partials._gallery')
            @include('admin.dashboard.partials._timeline')
            @include('admin.dashboard.partials._votes')

            <section class="admin-save-panel">
                <div>
                    <h2>Save everything</h2>
                    <p>All edits, new rows, uploads, active toggles, and delete checks save together.</p>
                </div>
                <button type="submit" class="admin-save-all-btn">Save All Changes</button>
            </section>

            <div class="admin-sticky-save">
                <span>Made changes? Save before leaving this page.</span>
                <button type="submit">Save All</button>
            </div>
        </form>
    </main>
</div>
@endsection
