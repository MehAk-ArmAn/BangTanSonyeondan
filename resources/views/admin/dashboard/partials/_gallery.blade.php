<section class="admin-card professional-card" id="gallery">
    <div class="admin-card-header">
        <div>
            <p class="admin-eyebrow">Media</p>
            <h2>Gallery</h2>
        </div>
        <span class="admin-chip">Visual library</span>
    </div>

    <div class="admin-grid-form compact-new-box">
        <label>New Image Name<input name="new_gallery[name]" placeholder="Name"></label>
        <label>Category<input name="new_gallery[category]" placeholder="Category"></label>
        <label>Image Path<input name="new_gallery[img_path]" placeholder="extra_gallery/BTS.jfif"></label>
        <label>Upload Image<input type="file" name="new_gallery_image_file" accept="image/*"></label>
        <input type="hidden" name="new_gallery[is_active]" value="0">
        <label class="check-row"><input type="checkbox" name="new_gallery[is_active]" value="1" checked> Active</label>
    </div>

    <div class="mini-grid professional-mini-grid">
        @foreach($galleryList as $pic)
            <article class="mini-card professional-mini-card">
                <img src="{{ asset($pic->img_path) }}" alt="{{ $pic->name }}">
                <div class="mini-card-body">
                    <label>Name<input name="gallery[{{ $pic->id }}][name]" value="{{ old("gallery.$pic->id.name", $pic->name) }}"></label>
                    <label>Category<input name="gallery[{{ $pic->id }}][category]" value="{{ old("gallery.$pic->id.category", $pic->category) }}"></label>
                    <label>Path<input name="gallery[{{ $pic->id }}][img_path]" value="{{ old("gallery.$pic->id.img_path", $pic->img_path) }}"></label>
                    <label>Replace Image<input type="file" name="gallery_image_files[{{ $pic->id }}]" accept="image/*"></label>
                    <input type="hidden" name="gallery[{{ $pic->id }}][is_active]" value="0">
                    <label class="check-row"><input type="checkbox" name="gallery[{{ $pic->id }}][is_active]" value="1" {{ old("gallery.$pic->id.is_active", $pic->is_active) ? 'checked' : '' }}> Active</label>
                    <label class="delete-check"><input type="checkbox" name="gallery[{{ $pic->id }}][delete]" value="1"> Delete on Save All</label>
                </div>
            </article>
        @endforeach
    </div>
</section>
