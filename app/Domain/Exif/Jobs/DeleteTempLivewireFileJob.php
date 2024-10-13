<?php

namespace App\Domain\Exif\Jobs;

use App\Jobs\AbstractJob;
use Livewire\Features\SupportFileUploads\FileUploadConfiguration;

class DeleteTempLivewireFileJob extends AbstractJob
{
    public $delay = 60 * 5;

    public function __construct(private string $filename) {}

    public function handle()
    {
        \Storage::disk(FileUploadConfiguration::disk())
            ->delete(FileUploadConfiguration::directory() . '/' . $this->filename);
    }
}
