<?php namespace App\Nova;

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
    public static $defaultOrderBy = ['title' => 'asc'];

    public function fields(Request $request)
    {
        return [
            Fields\Text::make('Title')->rules('max:255')->sortable(),
            Fields\Text::make('Slug')->rules('max:255'),
            Fields\DateTime::make('Created At')->onlyOnDetail(),
            Fields\DateTime::make('Updated At')->onlyOnDetail(),
            Fields\HasMany::make('Gigs'),
        ];
    }
}
