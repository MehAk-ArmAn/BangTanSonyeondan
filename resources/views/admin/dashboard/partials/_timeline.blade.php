<section class="admin-card professional-card" id="timeline">
    <div class="admin-card-header">
        <div>
            <p class="admin-eyebrow">History</p>
            <h2>Timeline</h2>
        </div>
        <span class="admin-chip">Milestones</span>
    </div>

    <details class="admin-details professional-details" open>
        <summary><span>Add New Timeline Event</span><small>Saved with Save All</small></summary>
        <div class="admin-grid-form inside-details">
            <label>Year<input name="new_timeline[year]" placeholder="2013"></label>
            <label>Category<input name="new_timeline[category]" value="Milestone"></label>
            <label class="span-2">Title<input name="new_timeline[title]" placeholder="Event title"></label>
            <label class="span-2">Body<textarea name="new_timeline[body]" placeholder="Short story"></textarea></label>
            <label class="span-2">Bullet Points - one per line<textarea name="new_timeline[bullet_points_text]"></textarea></label>
            <label class="span-2">Image Paths - one per line<textarea name="new_timeline[image_paths_text]"></textarea></label>
            <label>Order<input type="number" name="new_timeline[sort_order]" value="0"></label>
            <input type="hidden" name="new_timeline[is_active]" value="0">
            <label class="check-row"><input type="checkbox" name="new_timeline[is_active]" value="1" checked> Active</label>
        </div>
    </details>

    <div class="admin-accordion-list">
        @foreach($timelineList as $event)
            <details class="admin-details professional-details">
                <summary><span>{{ $event->year }} · {{ $event->title }}</span><small>{{ $event->category }}</small></summary>
                <div class="admin-grid-form inside-details">
                    <label>Year<input name="timeline[{{ $event->id }}][year]" value="{{ old("timeline.$event->id.year", $event->year) }}"></label>
                    <label>Category<input name="timeline[{{ $event->id }}][category]" value="{{ old("timeline.$event->id.category", $event->category) }}"></label>
                    <label class="span-2">Title<input name="timeline[{{ $event->id }}][title]" value="{{ old("timeline.$event->id.title", $event->title) }}"></label>
                    <label class="span-2">Body<textarea name="timeline[{{ $event->id }}][body]">{{ old("timeline.$event->id.body", $event->body) }}</textarea></label>
                    <label class="span-2">Bullet Points<textarea name="timeline[{{ $event->id }}][bullet_points_text]">{{ old("timeline.$event->id.bullet_points_text", implode("\n", $event->bullet_points ?? [])) }}</textarea></label>
                    <label class="span-2">Image Paths<textarea name="timeline[{{ $event->id }}][image_paths_text]">{{ old("timeline.$event->id.image_paths_text", implode("\n", $event->image_paths ?? [])) }}</textarea></label>
                    <label>Order<input type="number" name="timeline[{{ $event->id }}][sort_order]" value="{{ old("timeline.$event->id.sort_order", $event->sort_order) }}"></label>
                    <input type="hidden" name="timeline[{{ $event->id }}][is_active]" value="0">
                    <label class="check-row"><input type="checkbox" name="timeline[{{ $event->id }}][is_active]" value="1" {{ old("timeline.$event->id.is_active", $event->is_active) ? 'checked' : '' }}> Active</label>
                    <label class="delete-check span-2"><input type="checkbox" name="timeline[{{ $event->id }}][delete]" value="1"> Delete this event on Save All</label>
                </div>
            </details>
        @endforeach
    </div>
</section>
