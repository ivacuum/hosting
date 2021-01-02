<?php namespace App\Seeder;

use App\Torrent;
use Illuminate\Database\Seeder;

class UploadsPruner extends Seeder
{
    public function run()
    {
        $this->pruneAvatars();
        $this->pruneGallery();
        $this->pruneSearchIndex();
        $this->pruneTemp();
    }

    private function pruneAvatars()
    {
        $storage = \Storage::disk('avatars');
        $storage->delete($storage->allFiles());
    }

    private function pruneGallery()
    {
        $storage = \Storage::disk('gallery');
        $storage->delete($storage->allFiles());

        foreach ($storage->allDirectories() as $dir) {
            $storage->deleteDirectory($dir);
        }
    }

    private function pruneSearchIndex()
    {
        Torrent::removeAllFromSearch();
    }

    private function pruneTemp()
    {
        $storage = \Storage::disk('temp');

        $files = collect($storage->allFiles())
            ->filter(fn ($file) => $file !== '.gitignore')
            ->all();

        $storage->delete($files);
    }
}
