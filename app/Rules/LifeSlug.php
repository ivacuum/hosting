<?php

namespace App\Rules;

use App\Artist;
use App\City;
use App\Gig;
use App\Trip;
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
