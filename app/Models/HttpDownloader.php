<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Support\Facades\Http;
use Spatie\MediaLibrary\Downloaders\Downloader;
use Spatie\MediaLibrary\MediaCollections\Exceptions\UnreachableUrl;

class HttpDownloader implements Downloader
{
    public function getTempFile(string $url): string
    {
        if ( ! $stream = Http::get($url)->body()) {
            throw UnreachableUrl::create($url);
        }

        $temporaryFile = tempnam(sys_get_temp_dir(), 'media-library');

        file_put_contents($temporaryFile, $stream);

        return $temporaryFile;
    }
}
