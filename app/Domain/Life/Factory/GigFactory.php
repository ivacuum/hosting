<?php

namespace App\Domain\Life\Factory;

use App\Domain\Life\GigStatus;
use App\Domain\Life\Models\Artist;
use App\Domain\Life\Models\City;
use App\Domain\Life\Models\Gig;
use Carbon\CarbonImmutable;

class GigFactory
{
    private int|null $cityId = null;
    private int|null $artistId = null;
    private string|null $slug = null;
    private GigStatus $status = GigStatus::Published;

    private CityFactory|null $cityFactory = null;
    private ArtistFactory|null $artistFactory = null;

    public function create(): Gig
    {
        $gig = $this->make();
        $gig->city_id ??= ($this->cityFactory ?? CityFactory::new())->create()->id;
        $gig->artist_id ??= ($this->artistFactory ?? ArtistFactory::new())->create()->id;
        $gig->save();

        return $gig;
    }

    public function make(): Gig
    {
        $title = fake()->word() . ' ' . fake()->numberBetween(2000, 3000);

        $gig = new Gig;
        $gig->date = CarbonImmutable::instance(fake()->dateTimeBetween('-4 years'))->startOfDay();
        $gig->slug = $this->slug ?? \Str::slug($title);
        $gig->views = fake()->optional(0.9, 0)->numberBetween(1, 10000);
        $gig->status = $this->status;
        $gig->city_id = $this->cityId;
        $gig->title_en = $title;
        $gig->title_ru = $title;
        $gig->artist_id = $this->artistId;

        return $gig;
    }

    public static function new(): self
    {
        return new self;
    }

    #[\NoDiscard]
    public function withArtist(int|Artist|ArtistFactory $artist): self
    {
        return match (true) {
            $artist instanceof Artist => clone ($this, [
                'artistId' => $artist->id,
                'artistFactory' => null,
            ]),
            $artist instanceof ArtistFactory => clone ($this, [
                'artistId' => null,
                'artistFactory' => $artist,
            ]),
            default => clone ($this, [
                'artistId' => $artist,
                'artistFactory' => null,
            ]),
        };
    }

    #[\NoDiscard]
    public function withCity(int|City|CityFactory $city): self
    {
        return match (true) {
            $city instanceof City => clone ($this, [
                'cityId' => $city->id,
                'cityFactory' => null,
            ]),
            $city instanceof CityFactory => clone ($this, [
                'cityId' => null,
                'cityFactory' => $city,
            ]),
            default => clone ($this, [
                'cityId' => $city,
                'cityFactory' => null,
            ]),
        };
    }

    #[\NoDiscard]
    public function withSlug(string $slug): self
    {
        return clone ($this, ['slug' => $slug]);
    }
}
