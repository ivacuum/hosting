<?php

namespace App\Domain\Life\Factory;

use App\Domain\Life\GigStatus;
use App\Domain\Life\Models\Artist;
use App\Domain\Life\Models\City;
use App\Domain\Life\Models\Gig;
use Carbon\CarbonImmutable;

class GigFactory
{
    private string|null $slug = null;
    private GigStatus $status = GigStatus::Published;

    private int|Artist|ArtistFactory|null $artist = null;
    private int|City|CityFactory|null $city = null;

    public function create(): Gig
    {
        $gig = $this->make();
        $gig->city_id ??= ($this->city instanceof CityFactory ? $this->city : CityFactory::new())->create()->id;
        $gig->artist_id ??= ($this->artist instanceof ArtistFactory ? $this->artist : ArtistFactory::new())->create()->id;
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
        $gig->city_id = match (true) {
            $this->city instanceof City => $this->city->id,
            is_int($this->city) => $this->city,
            default => null,
        };
        $gig->title_en = $title;
        $gig->title_ru = $title;
        $gig->artist_id = match (true) {
            $this->artist instanceof Artist => $this->artist->id,
            is_int($this->artist) => $this->artist,
            default => null,
        };

        return $gig;
    }

    public static function new(): self
    {
        return new self;
    }

    #[\NoDiscard]
    public function withArtist(int|Artist|ArtistFactory $artist): self
    {
        return clone ($this, ['artist' => $artist]);
    }

    #[\NoDiscard]
    public function withCity(int|City|CityFactory $city): self
    {
        return clone ($this, ['city' => $city]);
    }

    #[\NoDiscard]
    public function withSlug(string $slug): self
    {
        return clone ($this, ['slug' => $slug]);
    }
}
