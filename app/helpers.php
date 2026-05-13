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