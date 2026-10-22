<?php

namespace App\Seeder;

use Illuminate\Database\Seeder;

class PruneUploads extends Seeder
{
    public function run(): void
    {
        $this->pruneAvatars();
        $this->pruneGallery();
        $this->pruneTemp();
    }

    private function pruneAvatars(): void
    {
        $storage = \Storage::disk('avatars');
        $storage->delete($storage->allFiles());
    }

    private function pruneGallery(): void
    {
        $storage = \Storage::disk('gallery');
        $storage->delete($storage->allFiles());

        foreach ($storage->allDirectories() as $dir) {
            $storage->deleteDirectory($dir);
        }
    }

    private function pruneTemp(): void
    {
        $storage = \Storage::disk('temp');

        $files = collect($storage->allFiles())
            ->filter(static fn ($file) => $file !== '.gitignore')
            ->all();

        $storage->delete($files);
    }
}
