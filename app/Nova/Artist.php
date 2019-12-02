<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields;

class Artist extends Resource
{
    public static $group = 'Life';
    public static $model = \App\Artist::class;
    public static $title = 'title';
    public static $search = [
        'id',
        'title',
    ];

    public function fields(Request $request)
    {
        return [
            Fields\ID::make()->sortable(),
            Fields\HasMany::make('Gigs'),
            Fields\Text::make('Title')->rules('max:255'),
            Fields\Text::make('Slug')->rules('max:255'),
            Fields\DateTime::make('Created At')->exceptOnForms(),
            Fields\DateTime::make('Updated At')->onlyOnDetail(),
        ];
    }
}
