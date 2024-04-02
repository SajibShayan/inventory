<?php

namespace App\Action;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;

class DeleteImageAction
{
    /**
     * @throws FileNotFoundException
     */
    public function execute(string $path): bool
    {
        $path = 'public/'.$path;
        if (! Storage::exists($path)) {
            throw new FileNotFoundException("The file \"$path\" does not exist");
        }

        return Storage::delete($path);
    }
}
