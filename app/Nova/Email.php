<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields;

class Email extends Resource
{
    public static $group = 'Site';
    public static $model = \App\Email::class;
    public static $title = 'to';
    public static $search = [];

    public function fields(Request $request)
    {
        return [
            Fields\ID::make()->sortable(),
            Fields\BelongsTo::make('User')->hideFromIndex(),
            Fields\MorphTo::make('Rel')->hideFromIndex(),
            Fields\Text::make('To'),
            Fields\Text::make('Template'),
            Fields\Text::make('Locale'),
            Fields\Number::make('Clicks')->sortable()->exceptOnForms(),
            Fields\Number::make('Views')->sortable()->exceptOnForms(),
            Fields\DateTime::make('Created At')->onlyOnDetail(),
            Fields\DateTime::make('Updated At')->onlyOnDetail(),
        ];
    }
}
