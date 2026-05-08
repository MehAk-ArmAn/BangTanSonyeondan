<section class="admin-card professional-card" id="members">
    <div class="admin-card-header">
        <div>
            <p class="admin-eyebrow">Profiles</p>
            <h2>Member Vaults</h2>
        </div>
        <span class="admin-chip">Images + stories</span>
    </div>

    <div class="admin-accordion-list">
        @foreach($membersList as $member)
            <details class="admin-details professional-details">
                <summary>
                    <span>{{ $member->emoji }} {{ $member->stage_name ?: $member->name }}</span>
                    <small>{{ $member->role }}</small>
                </summary>

                <div class="admin-grid-form inside-details">
                    <label>Name<input name="members[{{ $member->id }}][name]" value="{{ old("members.$member->id.name", $member->name) }}" required></label>
                    <label>Stage Name<input name="members[{{ $member->id }}][stage_name]" value="{{ old("members.$member->id.stage_name", $member->stage_name) }}"></label>
                    <label>Nickname<input name="members[{{ $member->id }}][nickname]" value="{{ old("members.$member->id.nickname", $member->nickname) }}"></label>
                    <label>Korean Name<input name="members[{{ $member->id }}][korean_name]" value="{{ old("members.$member->id.korean_name", $member->korean_name) }}"></label>
                    <label>Role<input name="members[{{ $member->id }}][role]" value="{{ old("members.$member->id.role", $member->role) }}"></label>
                    <label>Birth Date<input type="date" name="members[{{ $member->id }}][birth_date]" value="{{ old("members.$member->id.birth_date", optional($member->birth_date)->format('Y-m-d')) }}"></label>
                    <label>Birthplace<input name="members[{{ $member->id }}][birthplace]" value="{{ old("members.$member->id.birthplace", $member->birthplace) }}"></label>
                    <label>Emoji<input name="members[{{ $member->id }}][emoji]" value="{{ old("members.$member->id.emoji", $member->emoji) }}"></label>
                    <label>Accent Color<input name="members[{{ $member->id }}][accent_color]" value="{{ old("members.$member->id.accent_color", $member->accent_color) }}"></label>
                    <label>BT21 Character<input name="members[{{ $member->id }}][bt21_character]" value="{{ old("members.$member->id.bt21_character", $member->bt21_character) }}"></label>
                    <label>Intro Title<input name="members[{{ $member->id }}][intro_title]" value="{{ old("members.$member->id.intro_title", $member->intro_title) }}"></label>
                    <label>Current Image Path<input name="members[{{ $member->id }}][image]" value="{{ old("members.$member->id.image", $member->image) }}"></label>
                    <label>Upload New Image<input type="file" name="member_image_files[{{ $member->id }}]" accept="image/*"></label>
                    <label>Favicon File<input name="members[{{ $member->id }}][favicon]" value="{{ old("members.$member->id.favicon", $member->favicon) }}"></label>
                    <label>Sort Order<input type="number" name="members[{{ $member->id }}][sort_order]" value="{{ old("members.$member->id.sort_order", $member->sort_order) }}"></label>

                    <label class="span-2">Quote<textarea name="members[{{ $member->id }}][quote]">{{ old("members.$member->id.quote", $member->quote) }}</textarea></label>
                    <label class="span-2">Profile Story<textarea name="members[{{ $member->id }}][profile_story]">{{ old("members.$member->id.profile_story", $member->profile_story) }}</textarea></label>
                    <label class="span-2">Skill Tags - one per line<textarea name="members[{{ $member->id }}][skill_tags_text]">{{ old("members.$member->id.skill_tags_text", implode("\n", $member->skill_tags ?? [])) }}</textarea></label>
                    <label class="span-2">Fun Facts - one per line<textarea name="members[{{ $member->id }}][fun_facts_text]">{{ old("members.$member->id.fun_facts_text", implode("\n", $member->fun_facts ?? [])) }}</textarea></label>

                    <input type="hidden" name="members[{{ $member->id }}][is_active]" value="0">
                    <label class="check-row"><input type="checkbox" name="members[{{ $member->id }}][is_active]" value="1" {{ old("members.$member->id.is_active", $member->is_active) ? 'checked' : '' }}> Active</label>
                </div>
            </details>
        @endforeach
    </div>
</section>
