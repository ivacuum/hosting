<?php namespace App\Factory;

use App\Domain\GigStatus;
use App\Gig;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\WithFaker;

class GigFactory
{
    use WithFaker;

    private $cityId;
    private $artistId;
    private GigStatus $status = GigStatus::Published;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
    {
        $title = "{$this->faker->word} {$this->faker->numberBetween(2000, 3000)}";

        $model = new Gig;
        $model->date = CarbonImmutable::instance($this->faker->dateTimeBetween('-4 years'))->startOfDay();
        $model->slug = \Str::slug($title);
        $model->views = $this->faker->optional(0.9, 0)->numberBetween(1, 10000);
        $model->status = $this->status;
        $model->city_id = $this->cityId ?? CityFactory::new()->create()->id;
        $model->title_en = $title;
        $model->title_ru = $title;
        $model->artist_id = $this->artistId ?? ArtistFactory::new()->create()->id;

        return $model;
    }

    public static function new(): self
    {
        return tap(new self, function (self $factory) {
            $factory->setUpFaker();
        });
    }

    public function withArtistId(int $artistId)
    {
        $factory = clone $this;
        $factory->artistId = $artistId;

        return $factory;
    }

    public function withCityId(int $cityId)
    {
        $factory = clone $this;
        $factory->cityId = $cityId;

        return $factory;
    }
}
