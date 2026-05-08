<section class="admin-card professional-card" id="songs">
    <div class="admin-card-header">
        <div>
            <p class="admin-eyebrow">Discography</p>
            <h2>Songs</h2>
        </div>
        <span class="admin-chip">Music content</span>
    </div>

    <div class="admin-table-wrap professional-table">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Era</th>
                    <th>Date</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Active</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($songsList as $song)
                    <tr>
                        <td><input name="songs[{{ $song->id }}][name]" value="{{ old("songs.$song->id.name", $song->name) }}"></td>
                        <td><input name="songs[{{ $song->id }}][era]" value="{{ old("songs.$song->id.era", $song->era) }}"></td>
                        <td><input type="date" name="songs[{{ $song->id }}][release_date]" value="{{ old("songs.$song->id.release_date", optional($song->release_date)->format('Y-m-d')) }}"></td>
                        <td>
                            <input name="songs[{{ $song->id }}][img_path]" value="{{ old("songs.$song->id.img_path", $song->img_path) }}" placeholder="imgs/songs/file.jpg">
                            <input type="file" name="song_image_files[{{ $song->id }}]" accept="image/*">
                        </td>
                        <td><textarea name="songs[{{ $song->id }}][description]">{{ old("songs.$song->id.description", $song->description) }}</textarea></td>
                        <td>
                            <input type="hidden" name="songs[{{ $song->id }}][is_active]" value="0">
                            <label class="switch-mini"><input type="checkbox" name="songs[{{ $song->id }}][is_active]" value="1" {{ old("songs.$song->id.is_active", $song->is_active) ? 'checked' : '' }}> Active</label>
                        </td>
                        <td><label class="delete-check"><input type="checkbox" name="songs[{{ $song->id }}][delete]" value="1"> Delete</label></td>
                    </tr>
                @endforeach

                <tr class="new-row">
                    <td><input name="new_song[name]" placeholder="New song name"></td>
                    <td><input name="new_song[era]" placeholder="Era"></td>
                    <td><input type="date" name="new_song[release_date]"></td>
                    <td>
                        <input name="new_song[img_path]" placeholder="imgs/songs/file.jpg">
                        <input type="file" name="new_song_image_file" accept="image/*">
                    </td>
                    <td><textarea name="new_song[description]" placeholder="Description"></textarea></td>
                    <td>
                        <input type="hidden" name="new_song[is_active]" value="0">
                        <label class="switch-mini"><input type="checkbox" name="new_song[is_active]" value="1" checked> Active</label>
                    </td>
                    <td><span class="muted">New</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
