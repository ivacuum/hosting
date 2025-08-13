<?php

namespace App\Observers;

use App\File;
use Illuminate\Support\Str;

class FileObserver
{
    public function saving(File $file)
    {
        $this->maintainConsistency($file);
    }

    private function maintainConsistency(File $file): void
    {
        $file->slug = Str::trim($file->slug);
        $file->title = Str::trim($file->title);
        $file->folder = Str::trim($file->folder);
        $file->extension = Str::trim($file->extension);
    }
}
