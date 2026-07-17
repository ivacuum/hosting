<?php

namespace App\Domain\Exif\Jobs;

use App\Jobs\AbstractJob;
use Illuminate\Queue\Attributes\Delay;
use Livewire\Features\SupportFileUploads\FileUploadConfiguration;

#[Delay(60 * 5)]
class DeleteTempLivewireFileJob extends AbstractJob
{
    public function __construct(private string $filename) {}

    public function handle()
    {
        \Storage::disk(FileUploadConfiguration::disk())
            ->delete(FileUploadConfiguration::directory() . '/' . $this->filename);
    }
}
