<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields;

class Country extends Resource
{
    public static $group = 'Life';
    public static $model = \App\Country::class;
    public static $title = 'title';
    public static $search = [
        'id',
        'title_en',
        'title_ru',
    ];

    public function fields(Request $request)
    {
        return [
            Fields\ID::make()->sortable(),
            Fields\HasMany::make('Cities'),
            Fields\Text::make('Title')->onlyOnIndex(),
            Fields\Text::make('Title RU')->rules('max:255')->hideFromIndex(),
            Fields\Text::make('Title EN')->rules('max:255')->hideFromIndex(),
            Fields\Text::make('Slug')->rules('max:255'),
            Fields\Text::make('Emoji'),
            Fields\DateTime::make('Created At')->onlyOnDetail(),
            Fields\DateTime::make('Updated At')->onlyOnDetail(),
        ];
    }
}
