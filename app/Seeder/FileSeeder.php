<?php

namespace App\Seeder;

use App\Factory\FileFactory;
use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
    private const int COUNT = 5;

    public function run(): void
    {
        $files = [];

        for ($i = 0; $i < self::COUNT; $i++) {
            $files[] = FileFactory::new()->create();
        }

        $files[] = FileFactory::new()->hidden()->create();

        foreach ($files as $file) {
            \Storage::disk('files')->put($file->path(), '');
        }
    }
}
