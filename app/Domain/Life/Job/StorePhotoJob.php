<?php

namespace App\Domain\Life\Job;

use App\Domain\ImageConverter\ImageConverter;
use App\Jobs\AbstractJob;

class StorePhotoJob extends AbstractJob
{
    public function __construct(
        private string $sourceFilePath,
        private string $destinationFilePath,
    ) {}

    public function handle(ImageConverter $imageConverter)
    {
        $image = $imageConverter
            ->autoOrient()
            ->resize(2000, 2000)
            ->quality(75)
            ->convert($this->sourceFilePath);

        \Storage::disk('photos')
            ->putFileAs(
                dirname($this->destinationFilePath),
                $image,
                basename($this->destinationFilePath)
            );
    }
}
