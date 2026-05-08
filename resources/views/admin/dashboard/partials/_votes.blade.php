<section class="admin-card professional-card" id="votes">
    <div class="admin-card-header">
        <div>
            <p class="admin-eyebrow">Analytics</p>
            <h2>Vote Results</h2>
        </div>
    </div>

    <div class="admin-stats vote-stats">
        @forelse($voteStats as $stat)
            <div><span>{{ $stat->member_name }}</span><b>{{ $stat->total }}</b></div>
        @empty
            <p>No votes yet.</p>
        @endforelse
    </div>
</section>
