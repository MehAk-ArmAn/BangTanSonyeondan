<?php

if (! function_exists('spark_name')) {
    function spark_name(string $name): string
    {
        return "⋆✦✧⋆ {$name} ⋆✦✧⋆";
    }
}

if (! function_exists('member_asset')) {
    function member_asset(?string $path): string
    {
        $path = trim((string) $path);

        if ($path === '') {
            return 'favicons/logo.png';
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (
            str_starts_with($path, 'members/') ||
            str_starts_with($path, 'imgs/') ||
            str_starts_with($path, 'media-gallery/') ||
            str_starts_with($path, 'storage/') ||
            str_starts_with($path, 'favicons/')
        ) {
            return $path;
        }

        return 'members/' . ltrim($path, '/');
    }
}

if (! function_exists('learning_asset_path')) {
    function learning_asset_path(?string $path): ?string
    {
        $path = trim((string) $path);

        if ($path === '') {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        $knownFolders = ['learning/', 'media-gallery/', 'imgs/', 'storage/'];
        $hasKnownFolder = false;

        foreach ($knownFolders as $folder) {
            if (str_starts_with($path, $folder)) {
                $hasKnownFolder = true;
                break;
            }
        }

        $basePath = $hasKnownFolder ? $path : 'learning/' . ltrim($path, '/');

        if (preg_match('/\.(jpg|jpeg|jfif|png|webp|gif)$/i', $basePath)) {
            return $basePath;
        }

        foreach (['jpg', 'jpeg', 'jfif', 'png', 'webp', 'gif'] as $ext) {
            $try = $basePath . '.' . $ext;

            if (file_exists(public_path($try))) {
                return $try;
            }
        }

        return $basePath;
    }
}
