<?php namespace App\Factory;

use App\Domain\FileStatus;
use App\File;
use Illuminate\Foundation\Testing\WithFaker;

class FileFactory
{
    use WithFaker;

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
        $title = $this->faker->lexify('??????????');

        $model = new File;
        $model->size = $this->faker->numberBetween(1000, 1_000_000);
        $model->slug = \Str::slug($title);
        $model->title = $title;
        $model->folder = $this->faker->word;
        $model->status = $this->status;
        $model->extension = $this->faker->fileExtension();
        $model->downloads = $this->faker->optional(0.9, 0)->numberBetween(1, 10000);

        return $model;
    }

    public static function new(): self
    {
        return tap(new self, function (self $factory) {
            $factory->setUpFaker();
        });
    }

    public function withStatus(FileStatus $status)
    {
        $factory = clone $this;
        $factory->status = $status;

        return $factory;
    }
}
