<?php

/*
| Paste these imports at the top of DashboardController.php if missing:
|
| use Illuminate\Http\Request;
| use Illuminate\Support\Facades\DB;
| use Illuminate\Support\Facades\Schema;
*/

public function saveAll(Request $request)
{
    DB::transaction(function () use ($request) {
        $this->saveSettings($request->input('settings', []));
        $this->saveNavigation($request->input('nav', []), $request->input('new_nav', []));
        $this->saveMembers($request->input('members', []), $request->file('member_image_files', []));
        $this->saveQuotes($request->input('quotes', []), $request->input('new_quote', []));
        $this->saveSongs($request->input('songs', []), $request->file('song_image_files', []), $request->input('new_song', []), $request->file('new_song_image_file'));
        $this->saveGallery($request->input('gallery', []), $request->file('gallery_image_files', []), $request->input('new_gallery', []), $request->file('new_gallery_image_file'));
        $this->saveTimeline($request->input('timeline', []), $request->input('new_timeline', []));
    });

    return back()->with('success', 'All dashboard changes were saved successfully.');
}

private function saveSettings(array $settings): void
{
    foreach ($settings as $key => $value) {
        DB::table('site_settings')->updateOrInsert(
            ['key' => $key],
            $this->withTimestamps('site_settings', ['value' => $value ?? ''], true)
        );
    }
}

private function saveNavigation(array $items, array $newItem): void
{
    foreach ($items as $id => $data) {
        if (!empty($data['delete'])) {
            DB::table('nav_items')->where('id', $id)->delete();
            continue;
        }

        DB::table('nav_items')->where('id', $id)->update($this->withTimestamps('nav_items', [
            'label' => $data['label'] ?? '',
            'url' => $data['url'] ?? '#',
            'sort_order' => (int)($data['sort_order'] ?? 0),
            'is_active' => (int)($data['is_active'] ?? 0),
        ]));
    }

    if (!empty($newItem['label']) || !empty($newItem['url'])) {
        DB::table('nav_items')->insert($this->withTimestamps('nav_items', [
            'label' => $newItem['label'] ?? 'New Link',
            'url' => $newItem['url'] ?? '#',
            'sort_order' => (int)($newItem['sort_order'] ?? 0),
            'is_active' => (int)($newItem['is_active'] ?? 0),
        ], true));
    }
}

private function saveMembers(array $members, array $files): void
{
    foreach ($members as $id => $data) {
        $payload = [
            'name' => $data['name'] ?? '',
            'stage_name' => $data['stage_name'] ?? null,
            'nickname' => $data['nickname'] ?? null,
            'korean_name' => $data['korean_name'] ?? null,
            'role' => $data['role'] ?? null,
            'birth_date' => $this->nullableDate($data['birth_date'] ?? null),
            'birthplace' => $data['birthplace'] ?? null,
            'emoji' => $data['emoji'] ?? null,
            'accent_color' => $data['accent_color'] ?? null,
            'bt21_character' => $data['bt21_character'] ?? null,
            'intro_title' => $data['intro_title'] ?? null,
            'image' => $data['image'] ?? null,
            'favicon' => $data['favicon'] ?? null,
            'sort_order' => (int)($data['sort_order'] ?? 0),
            'quote' => $data['quote'] ?? null,
            'profile_story' => $data['profile_story'] ?? null,
            'skill_tags' => json_encode($this->linesToArray($data['skill_tags_text'] ?? '')),
            'fun_facts' => json_encode($this->linesToArray($data['fun_facts_text'] ?? '')),
            'is_active' => (int)($data['is_active'] ?? 0),
        ];

        $uploaded = $this->storePublicImage($files[$id] ?? null, 'members');
        if ($uploaded) {
            $payload['image'] = $uploaded;
        }

        DB::table('members')->where('id', $id)->update($this->withTimestamps('members', $payload));
    }
}

private function saveQuotes(array $quotes, array $newQuote): void
{
    foreach ($quotes as $id => $data) {
        if (!empty($data['delete'])) {
            DB::table('quotes')->where('id', $id)->delete();
            continue;
        }

        DB::table('quotes')->where('id', $id)->update($this->withTimestamps('quotes', [
            'source' => $data['source'] ?? '',
            'context' => $data['context'] ?? null,
            'quote' => $data['quote'] ?? '',
            'is_active' => (int)($data['is_active'] ?? 0),
        ]));
    }

    if (!empty($newQuote['quote'])) {
        DB::table('quotes')->insert($this->withTimestamps('quotes', [
            'source' => $newQuote['source'] ?? 'BTS',
            'context' => $newQuote['context'] ?? null,
            'quote' => $newQuote['quote'],
            'is_active' => (int)($newQuote['is_active'] ?? 0),
        ], true));
    }
}

private function saveSongs(array $songs, array $files, array $newSong, $newSongFile = null): void
{
    foreach ($songs as $id => $data) {
        if (!empty($data['delete'])) {
            DB::table('songs')->where('id', $id)->delete();
            continue;
        }

        $payload = [
            'name' => $data['name'] ?? '',
            'era' => $data['era'] ?? null,
            'release_date' => $this->nullableDate($data['release_date'] ?? null),
            'img_path' => $data['img_path'] ?? null,
            'description' => $data['description'] ?? null,
            'is_active' => (int)($data['is_active'] ?? 0),
        ];

        $uploaded = $this->storePublicImage($files[$id] ?? null, 'songs');
        if ($uploaded) {
            $payload['img_path'] = $uploaded;
        }

        DB::table('songs')->where('id', $id)->update($this->withTimestamps('songs', $payload));
    }

    if (!empty($newSong['name'])) {
        $imgPath = $newSong['img_path'] ?? null;
        $uploaded = $this->storePublicImage($newSongFile, 'songs');
        if ($uploaded) {
            $imgPath = $uploaded;
        }

        DB::table('songs')->insert($this->withTimestamps('songs', [
            'name' => $newSong['name'],
            'era' => $newSong['era'] ?? null,
            'release_date' => $this->nullableDate($newSong['release_date'] ?? null),
            'img_path' => $imgPath,
            'description' => $newSong['description'] ?? null,
            'sort_order' => (int)($newSong['sort_order'] ?? 0),
            'is_active' => (int)($newSong['is_active'] ?? 0),
        ], true));
    }
}

private function saveGallery(array $gallery, array $files, array $newGallery, $newGalleryFile = null): void
{
    foreach ($gallery as $id => $data) {
        if (!empty($data['delete'])) {
            DB::table('gallery_items')->where('id', $id)->delete();
            continue;
        }

        $payload = [
            'name' => $data['name'] ?? '',
            'category' => $data['category'] ?? null,
            'img_path' => $data['img_path'] ?? null,
            'is_active' => (int)($data['is_active'] ?? 0),
        ];

        $uploaded = $this->storePublicImage($files[$id] ?? null, 'gallery');
        if ($uploaded) {
            $payload['img_path'] = $uploaded;
        }

        DB::table('gallery_items')->where('id', $id)->update($this->withTimestamps('gallery_items', $payload));
    }

    if (!empty($newGallery['name']) || !empty($newGallery['img_path']) || $newGalleryFile) {
        $imgPath = $newGallery['img_path'] ?? null;
        $uploaded = $this->storePublicImage($newGalleryFile, 'gallery');
        if ($uploaded) {
            $imgPath = $uploaded;
        }

        DB::table('gallery_items')->insert($this->withTimestamps('gallery_items', [
            'name' => $newGallery['name'] ?? 'New Gallery Image',
            'category' => $newGallery['category'] ?? null,
            'img_path' => $imgPath,
            'is_active' => (int)($newGallery['is_active'] ?? 0),
        ], true));
    }
}

private function saveTimeline(array $events, array $newEvent): void
{
    foreach ($events as $id => $data) {
        if (!empty($data['delete'])) {
            DB::table('timeline_events')->where('id', $id)->delete();
            continue;
        }

        DB::table('timeline_events')->where('id', $id)->update($this->withTimestamps('timeline_events', [
            'year' => $data['year'] ?? '',
            'category' => $data['category'] ?? 'Milestone',
            'title' => $data['title'] ?? '',
            'body' => $data['body'] ?? null,
            'bullet_points' => json_encode($this->linesToArray($data['bullet_points_text'] ?? '')),
            'image_paths' => json_encode($this->linesToArray($data['image_paths_text'] ?? '')),
            'sort_order' => (int)($data['sort_order'] ?? 0),
            'is_active' => (int)($data['is_active'] ?? 0),
        ]));
    }

    if (!empty($newEvent['year']) || !empty($newEvent['title'])) {
        DB::table('timeline_events')->insert($this->withTimestamps('timeline_events', [
            'year' => $newEvent['year'] ?? '',
            'category' => $newEvent['category'] ?? 'Milestone',
            'title' => $newEvent['title'] ?? 'New Timeline Event',
            'body' => $newEvent['body'] ?? null,
            'bullet_points' => json_encode($this->linesToArray($newEvent['bullet_points_text'] ?? '')),
            'image_paths' => json_encode($this->linesToArray($newEvent['image_paths_text'] ?? '')),
            'sort_order' => (int)($newEvent['sort_order'] ?? 0),
            'is_active' => (int)($newEvent['is_active'] ?? 0),
        ], true));
    }
}

private function storePublicImage($file, string $folder): ?string
{
    if (!$file || !$file->isValid()) {
        return null;
    }

    return 'storage/' . $file->store("admin/$folder", 'public');
}

private function linesToArray(?string $text): array
{
    return collect(preg_split('/\r\n|\r|\n/', (string)$text))
        ->map(fn ($line) => trim($line))
        ->filter()
        ->values()
        ->all();
}

private function nullableDate(?string $value): ?string
{
    return filled($value) ? $value : null;
}

private function withTimestamps(string $table, array $data, bool $creating = false): array
{
    $now = now();

    if (Schema::hasColumn($table, 'updated_at')) {
        $data['updated_at'] = $now;
    }

    if ($creating && Schema::hasColumn($table, 'created_at')) {
        $data['created_at'] = $now;
    }

    return $data;
}
