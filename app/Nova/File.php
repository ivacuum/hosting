<?php namespace App\Nova;

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
            Fields\Text::make('File', function (\App\File $file) {
                return "{$file->slug}.{$file->extension}";
            })->exceptOnForms(),
            Fields\Number::make('Size', function (\App\File $file) {
                return \ViewHelper::size($file->size);
            })->asHtml(),
            Fields\Text::make('Slug')->onlyOnForms(),
            Fields\Text::make('Extension')->onlyOnForms(),
            Fields\Boolean::make('Published', 'status'),
            Fields\Number::make('Downloads')->exceptOnForms()->sortable(),
            Fields\DateTime::make('Created At')->onlyOnDetail(),
            Fields\DateTime::make('Updated At')->onlyOnDetail(),
        ];
    }
}
