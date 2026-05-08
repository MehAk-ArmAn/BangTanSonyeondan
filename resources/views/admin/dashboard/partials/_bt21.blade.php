<section class="admin-card professional-card" id="bt21">
    <div class="admin-card-header">
        <div>
            <p class="admin-eyebrow">Characters</p>
            <h2>BT21 Footer + Anatomy Profiles</h2>
        </div>
        <span class="admin-chip">Footer + BT21 page</span>
    </div>

    <p class="admin-note">These records control the BT21 page and footer links. Slugs become links like <code>/bt21#koya</code>.</p>

    <details class="admin-details professional-details" open>
        <summary><span>Add New BT21 Character</span><small>Creates a new public BT21 card</small></summary>
        <div class="admin-grid-form inside-details">
            <label>Name<input name="new_bt21[name]" placeholder="KOYA"></label>
            <label>Slug<input name="new_bt21[slug]" placeholder="koya"></label>
            <label>Member Name<input name="new_bt21[member_name]" placeholder="RM"></label>
            <label>Emoji<input name="new_bt21[emoji]" placeholder="🐨"></label>
            <label>Image Path<input name="new_bt21[image]" placeholder="favicons/KOYA.png"></label>
            <label>Upload Image<input type="file" name="new_bt21_image_file" accept="image/*"></label>
            <label>Accent Color<input name="new_bt21[accent_color]" value="#a855f7"></label>
            <label>Sort Order<input type="number" name="new_bt21[sort_order]" value="0"></label>
            <label class="span-2">Mood<textarea name="new_bt21[mood]" placeholder="Sleepy genius dream koala"></textarea></label>
            <label class="span-2">Power<textarea name="new_bt21[power]" placeholder="Deep thinking + soft leader energy"></textarea></label>
            <label class="span-2">Anatomy Notes - one per line<textarea name="new_bt21[anatomy_text]"></textarea></label>
            <label class="span-2">Moves - one per line<textarea name="new_bt21[moves_text]"></textarea></label>
            <input type="hidden" name="new_bt21[is_active]" value="0">
            <label class="check-row"><input type="checkbox" name="new_bt21[is_active]" value="1" checked> Active</label>
        </div>
    </details>

    <div class="admin-accordion-list">
        @foreach($bt21List as $character)
            <details class="admin-details professional-details">
                <summary>
                    <span>{{ $character->emoji }} {{ $character->name }}</span>
                    <small>{{ $character->member_name }} · /bt21#{{ $character->slug }}</small>
                </summary>

                <div class="admin-grid-form inside-details">
                    <label>Name<input name="bt21[{{ $character->id }}][name]" value="{{ old("bt21.$character->id.name", $character->name) }}"></label>
                    <label>Slug<input name="bt21[{{ $character->id }}][slug]" value="{{ old("bt21.$character->id.slug", $character->slug) }}"></label>
                    <label>Member Name<input name="bt21[{{ $character->id }}][member_name]" value="{{ old("bt21.$character->id.member_name", $character->member_name) }}"></label>
                    <label>Emoji<input name="bt21[{{ $character->id }}][emoji]" value="{{ old("bt21.$character->id.emoji", $character->emoji) }}"></label>
                    <label>Image Path<input name="bt21[{{ $character->id }}][image]" value="{{ old("bt21.$character->id.image", $character->image) }}"></label>
                    <label>Replace Image<input type="file" name="bt21_image_files[{{ $character->id }}]" accept="image/*"></label>
                    <label>Accent Color<input name="bt21[{{ $character->id }}][accent_color]" value="{{ old("bt21.$character->id.accent_color", $character->accent_color) }}"></label>
                    <label>Sort Order<input type="number" name="bt21[{{ $character->id }}][sort_order]" value="{{ old("bt21.$character->id.sort_order", $character->sort_order) }}"></label>
                    <label class="span-2">Mood<textarea name="bt21[{{ $character->id }}][mood]">{{ old("bt21.$character->id.mood", $character->mood) }}</textarea></label>
                    <label class="span-2">Power<textarea name="bt21[{{ $character->id }}][power]">{{ old("bt21.$character->id.power", $character->power) }}</textarea></label>
                    <label class="span-2">Anatomy Notes<textarea name="bt21[{{ $character->id }}][anatomy_text]">{{ old("bt21.$character->id.anatomy_text", implode("\n", $character->anatomy ?? [])) }}</textarea></label>
                    <label class="span-2">Moves<textarea name="bt21[{{ $character->id }}][moves_text]">{{ old("bt21.$character->id.moves_text", implode("\n", $character->moves ?? [])) }}</textarea></label>
                    <input type="hidden" name="bt21[{{ $character->id }}][is_active]" value="0">
                    <label class="check-row"><input type="checkbox" name="bt21[{{ $character->id }}][is_active]" value="1" {{ old("bt21.$character->id.is_active", $character->is_active) ? 'checked' : '' }}> Active</label>
                    <label class="delete-check span-2"><input type="checkbox" name="bt21[{{ $character->id }}][delete]" value="1"> Delete this BT21 character on Save All</label>
                </div>
            </details>
        @endforeach
    </div>
</section>
