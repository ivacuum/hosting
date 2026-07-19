<?php

namespace App\Domain\Life\Factory;

use App\Domain\Life\Models\City;
use App\Domain\Life\Models\Country;
use App\Domain\Spatial\Point;

class CityFactory
{
    private Point|null $point = null;
    private string|null $slug = null;
    private string|null $titleEn = null;
    private string|null $titleRu = null;

    private int|Country|CountryFactory|null $country = null;

    public function create(): City
    {
        $city = $this->make();
        $city->country_id ??= ($this->country instanceof CountryFactory ? $this->country : CountryFactory::new())->create()->id;
        $city->save();

        return $city;
    }

    public function make(): City
    {
        $title = fake()->city() . ' ' . fake()->randomDigit();

        $titleEn = $this->titleEn ?? $title;
        $titleRu = $this->titleRu ?? $title;

        $city = new City;
        $city->iata = '';
        $city->slug = $this->slug ?? \Str::slug($titleEn);
        $city->point = $this->point ?? new Point(fake()->latitude(), fake()->longitude());
        $city->views = fake()->optional(0.9, 0)->numberBetween(1, 10000);
        $city->hashtags = mb_strtolower(str_replace(' ', '', $titleEn));
        $city->title_en = $titleEn;
        $city->title_ru = $titleRu;
        $city->country_id = match (true) {
            $this->country instanceof Country => $this->country->id,
            is_int($this->country) => $this->country,
            default => null,
        };

        return $city;
    }

    public static function new(): self
    {
        return new self;
    }

    #[\NoDiscard]
    public function withCountry(int|Country|CountryFactory|null $country = null): self
    {
        return clone ($this, ['country' => $country ?? CountryFactory::new()]);
    }

    #[\NoDiscard]
    public function withPoint(Point $point): self
    {
        return clone ($this, ['point' => $point]);
    }

    #[\NoDiscard]
    public function withSlug(string $slug): self
    {
        return clone ($this, ['slug' => $slug]);
    }

    #[\NoDiscard]
    public function withTitle(string $titleRu, string $titleEn): self
    {
        return clone ($this, [
            'titleEn' => $titleEn,
            'titleRu' => $titleRu,
        ]);
    }
}
