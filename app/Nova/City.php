<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields;

class City extends Resource
{
    public static $group = 'Life';
    public static $model = \App\City::class;
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
            Fields\BelongsTo::make('Country'),
            Fields\Text::make('Title')->onlyOnIndex(),
            Fields\Text::make('Title RU')->rules('max:255')->hideFromIndex(),
            Fields\Text::make('Title EN')->rules('max:255')->hideFromIndex(),
            Fields\Text::make('Slug')->rules('max:255'),
            Fields\Text::make('IATA')->hideFromIndex(),
            Fields\Text::make('Lat'),
            Fields\Text::make('Lon'),
            Fields\DateTime::make('Created At')->onlyOnDetail(),
            Fields\DateTime::make('Updated At')->onlyOnDetail(),

            Fields\HasMany::make('Gigs'),
            Fields\HasMany::make('Trips'),
        ];
    }
}
