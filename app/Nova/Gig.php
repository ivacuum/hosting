<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields;

class Gig extends Resource
{
    public static $group = 'Life';
    public static $model = \App\Gig::class;
    public static $title = 'title';
    public static $search = [
        'id',
        'title_en',
        'title_ru',
    ];
    protected static $defaultOrderBy = ['date' => 'desc'];

    public function fields(Request $request)
    {
        return [
            Fields\BelongsTo::make('Artist')->hideFromIndex(),
            Fields\BelongsTo::make('City')->hideFromIndex(),
            Fields\Text::make('Title')->onlyOnIndex(),
            Fields\Text::make('Title RU')->rules('max:255')->hideFromIndex(),
            Fields\Text::make('Title EN')->rules('max:255')->hideFromIndex(),
            Fields\Text::make('Slug')->rules('max:255'),
            Fields\Date::make('Date'),
            Fields\Select::make('Status')->options([
                \App\Gig::STATUS_HIDDEN => 'Hidden',
                \App\Gig::STATUS_PUBLISHED => 'Published',
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
