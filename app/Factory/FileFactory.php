<?php

namespace App\Factory;

use App\Domain\FileStatus;
use App\File;

class FileFactory
{
    private FileStatus $status = FileStatus::Published;

    public function create(): File
    {
        $file = $this->make();
        $file->save();

        return $file;
    }

    #[\NoDiscard]
    public function hidden(): self
    {
        return $this->withStatus(FileStatus::Hidden);
    }

    public function make(): File
    {
        $title = fake()->lexify('??????????');

        $file = new File;
        $file->size = fake()->numberBetween(1000, 1_000_000);
        $file->slug = \Str::slug($title);
        $file->title = $title;
        $file->folder = fake()->word();
        $file->status = $this->status;
        $file->extension = fake()->fileExtension();
        $file->downloads = fake()->optional(0.9, 0)->numberBetween(1, 10000);

        return $file;
    }

    public static function new(): self
    {
        return new self;
    }

    #[\NoDiscard]
    public function withStatus(FileStatus $status): self
    {
        return clone ($this, ['status' => $status]);
    }
}
