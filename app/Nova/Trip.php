<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields;

class Trip extends Resource
{
    public static $group = 'Life';
    public static $model = \App\Trip::class;
    public static $title = 'title';
    public static $search = [
        'id',
        'title_en',
        'title_ru',
    ];
    protected static $defaultOrderBy = ['date_start' => 'desc'];

    public function fields(Request $request)
    {
        return [
            Fields\BelongsTo::make('User')->hideFromIndex(),
            Fields\BelongsTo::make('City')->hideFromIndex(),
            Fields\Text::make('Title')->onlyOnIndex(),
            Fields\Text::make('Title RU')->rules('max:255')->hideFromIndex(),
            Fields\Text::make('Title EN')->rules('max:255')->hideFromIndex(),
            Fields\Text::make('Date', function (\App\Trip $trip) {
                return $trip->localizedDate();
            })->asHtml(),
            Fields\Text::make('Slug')->rules('max:255'),
            Fields\Date::make('Date Start')->onlyOnForms(),
            Fields\Date::make('Date End')->onlyOnForms(),
            Fields\Select::make('Status')->options([
                \App\Trip::STATUS_HIDDEN => 'Hidden',
                \App\Trip::STATUS_INACTIVE => 'Inactive',
                \App\Trip::STATUS_PUBLISHED => 'Published',
            ])->displayUsingLabels(),
            Fields\Text::make('Meta Title RU')->rules('max:255')->hideFromIndex(),
            Fields\Text::make('Meta Title EN')->rules('max:255')->hideFromIndex(),
            Fields\Text::make('Meta Description RU')->rules('max:255')->hideFromIndex(),
            Fields\Text::make('Meta Description EN')->rules('max:255')->hideFromIndex(),
            Fields\Text::make('Meta Image')->rules('max:255')->hideFromIndex(),
            Fields\Number::make('Views')->exceptOnForms(),
            Fields\DateTime::make('Created At')->onlyOnDetail(),
            Fields\DateTime::make('Updated At')->onlyOnDetail(),
        ];
    }
}
