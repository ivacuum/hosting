<?php namespace App\Rules;

use App\Artist;
use App\City;
use App\Gig;
use App\Trip;
use Illuminate\Validation\Rule;

class LifeSlug
{
    public static function rules($model): array
    {
        return [
            'bail',
            'required',
            'string',
            Rule::unique(Artist::class, 'slug')->ignoreModel($model),
            Rule::unique(City::class, 'slug')->ignoreModel($model),
            Rule::unique(Gig::class, 'slug')->ignoreModel($model),
            Rule::unique(Trip::class, 'slug')
                ->where('user_id', 1)
                ->ignoreModel($model),
        ];
    }
}
