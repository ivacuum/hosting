<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class News extends Resource
{
    public static $model = \App\News::class;
    public static $title = 'title';
    public static $search = [
        'id',
        'title',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('User')->hideFromIndex(),
            Text::make('Title')->rules('max:255'),
            Boolean::make('Published', 'status'),

            Select::make('Locale')->options([
                'en' => 'English',
                'ru' => 'Russian',
            ])->onlyOnForms(),

            Number::make('Views')->sortable()->exceptOnForms(),
            Markdown::make('Markdown'),
            DateTime::make('Created At')->exceptOnForms(),
            DateTime::make('Updated At')->onlyOnDetail(),
        ];
    }
}
