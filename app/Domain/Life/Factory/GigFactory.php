<?php

namespace App\Domain\Life\Factory;

use App\Domain\Life\GigStatus;
use App\Domain\Life\Models\Artist;
use App\Domain\Life\Models\City;
use App\Domain\Life\Models\Gig;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;

class GigFactory
{
    private string|null $slug = null;
    private CarbonInterface|string|null $date = null;
    private string|null $englishTitle = null;
    private string|null $russianTitle = null;
    private string|null $metaImage = null;
    private string|null $englishMetaDescription = null;
    private string|null $russianMetaDescription = null;
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
        $gig->date = $this->date ?? CarbonImmutable::instance(fake()->dateTimeBetween('-4 years'))->startOfDay();
        $gig->slug = $this->slug ?? \Str::slug($title);
        $gig->views = fake()->optional(0.9, 0)->numberBetween(1, 10000);
        $gig->status = $this->status;
        $gig->city_id = match (true) {
            $this->city instanceof City => $this->city->id,
            is_int($this->city) => $this->city,
            default => null,
        };
        $gig->title_en = $this->englishTitle ?? $title;
        $gig->title_ru = $this->russianTitle ?? $title;
        $gig->meta_image = $this->metaImage ?? '';
        $gig->meta_description_en = $this->englishMetaDescription ?? '';
        $gig->meta_description_ru = $this->russianMetaDescription ?? '';
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
    public function withDate(CarbonInterface|string $date): self
    {
        return clone ($this, ['date' => $date]);
    }

    #[\NoDiscard]
    public function withMetaDescription(string $russianMetaDescription, string $englishMetaDescription): self
    {
        return clone ($this, [
            'russianMetaDescription' => $russianMetaDescription,
            'englishMetaDescription' => $englishMetaDescription,
        ]);
    }

    #[\NoDiscard]
    public function withMetaImage(string $metaImage): self
    {
        return clone ($this, ['metaImage' => $metaImage]);
    }

    #[\NoDiscard]
    public function withSlug(string $slug): self
    {
        return clone ($this, ['slug' => $slug]);
    }

    #[\NoDiscard]
    public function withStatus(GigStatus $status): self
    {
        return clone ($this, ['status' => $status]);
    }

    #[\NoDiscard]
    public function withTitle(string $russianTitle, string $englishTitle): self
    {
        return clone ($this, [
            'russianTitle' => $russianTitle,
            'englishTitle' => $englishTitle,
        ]);
    }
}
