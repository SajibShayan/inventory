<?php

declare(strict_types=1);

namespace App\Action;

use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

class UploadImageAction
{
    public function __construct(public readonly string $dir = 'images')
    {
    }

    public function execute(File|UploadedFile $file, $options = []): false|string
    {
        $path = $file->storeAs($this->dir, $file->hashName(), 'public');
        if ($path === false) {
            return false;
        }

        return $path;
    }
}
