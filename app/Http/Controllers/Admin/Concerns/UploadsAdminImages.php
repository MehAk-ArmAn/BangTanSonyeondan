<?php

namespace App\Http\Controllers\Admin\Concerns;

use Illuminate\Http\UploadedFile;

trait UploadsAdminImages
{
    protected function uploadAdminImage(?UploadedFile $file, string $folder): ?string
    {
        if (! $file) {
            return null;
        }

        return 'storage/' . $file->store("admin/{$folder}", 'public');
    }

    protected function linesToArray(?string $text): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $text))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }
}
