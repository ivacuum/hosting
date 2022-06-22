<?php namespace App\Factory;

use App\Domain\FileStatus;
use App\File;

class FileFactory
{
    private FileStatus $status = FileStatus::Published;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function hidden()
    {
        return $this->withStatus(FileStatus::Hidden);
    }

    public function make()
    {
        $title = fake()->lexify('??????????');

        $model = new File;
        $model->size = fake()->numberBetween(1000, 1_000_000);
        $model->slug = \Str::slug($title);
        $model->title = $title;
        $model->folder = fake()->word();
        $model->status = $this->status;
        $model->extension = fake()->fileExtension();
        $model->downloads = fake()->optional(0.9, 0)->numberBetween(1, 10000);

        return $model;
    }

    public static function new(): self
    {
        return new self;
    }

    public function withStatus(FileStatus $status)
    {
        $factory = clone $this;
        $factory->status = $status;

        return $factory;
    }
}
