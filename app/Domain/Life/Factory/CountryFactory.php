<?php

namespace App\Domain\Life\Factory;

use App\Domain\Life\Models\Country;

class CountryFactory
{
    private int|null $id = null;
    private string|null $slug = null;

    public function create(): Country
    {
        $country = $this->make();
        $country->save();

        return $country;
    }

    public function make(): Country
    {
        $title = fake()->country() . ' ' . fake()->randomDigit();

        $country = new Country;
        $country->id = $this->id;
        $country->slug = $this->slug ?? 'country-' . \Str::uuid();
        $country->emoji = '';
        $country->views = fake()->optional(0.9, 0)->numberBetween(1, 10000);
        $country->hashtags = mb_strtolower(str_replace(' ', '', $title));
        $country->title_en = $title;
        $country->title_ru = $title;

        return $country;
    }

    public static function new(): self
    {
        return new self;
    }

    #[\NoDiscard]
    public function withId(int $id): self
    {
        return clone ($this, ['id' => $id]);
    }

    #[\NoDiscard]
    public function withSlug(string $slug): self
    {
        return clone ($this, ['slug' => $slug]);
    }
}
