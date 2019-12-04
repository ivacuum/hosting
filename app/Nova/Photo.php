<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields;

class Photo extends Resource
{
    public static $group = 'Life';
    public static $model = \App\Photo::class;
    public static $title = 'slug';
    public static $search = [
        'id',
        'slug',
    ];

    public function fields(Request $request)
    {
        return [
            Fields\Text::make('Slug')->exceptOnForms(),
            Fields\Text::make('Lat'),
            Fields\Text::make('Lon'),
            Fields\Select::make('Status')->options([
                \App\Photo::STATUS_HIDDEN => 'Hidden',
                \App\Photo::STATUS_PUBLISHED => 'Published',
            ])->displayUsingLabels(),
            Fields\Number::make('Views')->exceptOnForms(),
            Fields\DateTime::make('Created At')->onlyOnDetail(),
            Fields\DateTime::make('Updated At')->onlyOnDetail(),

            Fields\MorphToMany::make('Tags'),
        ];
    }
}
