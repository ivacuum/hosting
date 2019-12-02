<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields;

class News extends Resource
{
    public static $group = 'Resources';
    public static $model = \App\News::class;
    public static $title = 'title';
    public static $search = [
        'id',
        'title',
    ];

    public function fields(Request $request)
    {
        return [
            Fields\ID::make()->sortable(),
            Fields\BelongsTo::make('User')->hideFromIndex(),
            Fields\Text::make('Title')->rules('max:255'),
            Fields\Boolean::make('Published', 'status'),
            Fields\Select::make('Locale')->options([
                'en' => 'English',
                'ru' => 'Russian',
            ])->onlyOnForms(),
            Fields\Number::make('Views')->sortable()->exceptOnForms(),
            Fields\Markdown::make('Markdown')->stacked(),
            Fields\DateTime::make('Created At')->exceptOnForms(),
            Fields\DateTime::make('Updated At')->onlyOnDetail(),
        ];
    }
}
