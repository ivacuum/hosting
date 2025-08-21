<?php

namespace App\Domain\Life\Rule;

use App\Domain\Life\Models\Artist;
use App\Domain\Life\Models\City;
use App\Domain\Life\Models\Gig;
use App\Domain\Life\Models\Trip;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class LifeSlug
{
    public static function rules(Artist|City|Gig|Trip $model): array
    {
        return [
            'bail',
            'required',
            'string',
            Rule::unique(Artist::class, 'slug')
                ->when($model instanceof Artist, fn (Unique $rule) => $rule->ignoreModel($model)),
            Rule::unique(City::class, 'slug')
                ->when($model instanceof City, fn (Unique $rule) => $rule->ignoreModel($model)),
            Rule::unique(Gig::class, 'slug')
                ->when($model instanceof Gig, fn (Unique $rule) => $rule->ignoreModel($model)),
            Rule::unique(Trip::class, 'slug')
                ->where('user_id', 1)
                ->when($model instanceof Trip, fn (Unique $rule) => $rule->ignoreModel($model)),
        ];
    }
}
