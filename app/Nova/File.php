<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields;

class File extends Resource
{
    public static $group = 'Resources';
    public static $model = \App\File::class;
    public static $title = 'title';
    public static $search = [];
    public static $globallySearchable = false;

    public function fields(Request $request)
    {
        return [
            Fields\ID::make()->sortable(),
            Fields\Text::make('Folder')->hideFromIndex(),
            Fields\Text::make('Title'),
            Fields\Text::make('Slug'),
            Fields\Number::make('Size'),
            Fields\Text::make('Extension'),
            Fields\Boolean::make('Published', 'status'),
            Fields\Number::make('Downloads')->exceptOnForms(),
            Fields\DateTime::make('Created At')->onlyOnDetail(),
            Fields\DateTime::make('Updated At')->onlyOnDetail(),
        ];
    }
}
