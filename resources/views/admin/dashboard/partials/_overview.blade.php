<section class="admin-stats" id="overview">
    <div><span>Members</span><b>{{ $membersList->count() }}</b></div>
    <div><span>Songs</span><b>{{ $songsList->count() }}</b></div>
    <div><span>Gallery</span><b>{{ $galleryList->count() }}</b></div>
    <div><span>Votes</span><b>{{ $voteStats->sum('total') }}</b></div>
</section>
