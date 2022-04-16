<?php namespace App\Rules;

use Illuminate\Validation\Rule;

class LifeSlug
{
    public static function rules($model): array
    {
        return [
            'bail',
            'required',
            'string',
            Rule::unique('artists', 'slug')->ignore($model, 'slug'),
            Rule::unique('cities', 'slug')->ignore($model, 'slug'),
            Rule::unique('gigs', 'slug')->ignore($model, 'slug'),
            Rule::unique('trips', 'slug')
                ->where('user_id', 1)
                ->ignore($model, 'slug'),
        ];
    }
}
