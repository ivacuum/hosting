<?php namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields;

/** @mixin \App\File */
class File extends Resource
{
    public static $group = 'Resources';
    public static $model = \App\File::class;
    public static $title = 'title';
    public static $search = [];

    public function fields(Request $request)
    {
        return [
            Fields\ID::make()->sortable(),
            Fields\Text::make('Folder')->hideFromIndex(),
            Fields\Text::make('Title'),
            Fields\Text::make('File', fn () => "{$this->slug}.{$this->extension}")->exceptOnForms(),
            Fields\Number::make('Size', fn () => \ViewHelper::size($this->size))->asHtml(),
            Fields\Text::make('Slug')->onlyOnForms(),
            Fields\Text::make('Extension')->onlyOnForms(),
            Fields\Boolean::make('Published', 'status'),
            Fields\Number::make('Downloads')->exceptOnForms()->sortable(),
            Fields\DateTime::make('Created At')->onlyOnDetail(),
            Fields\DateTime::make('Updated At')->onlyOnDetail(),
        ];
    }
}
