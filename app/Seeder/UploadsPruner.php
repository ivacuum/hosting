<?php namespace App\Seeder;

use Illuminate\Database\Seeder;

class UploadsPruner extends Seeder
{
    public function run()
    {
        $this->pruneAvatars();
        $this->pruneGallery();
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
}
