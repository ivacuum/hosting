<?php namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields;

class Radical extends Resource
{
    public static $group = 'Japanese';
    public static $model = \App\Radical::class;
    public static $title = 'character';
    public static $search = [
        'id',
        'meaning',
    ];
    protected static $defaultOrderBy = ['level' => 'asc'];

    public function fields(Request $request)
    {
        return [
            Fields\Number::make('Level')->sortable(),
            Fields\Text::make('Character'),
            Fields\Text::make('Meaning', function (\App\Radical $radical) {
                return implode('<br>', explode(', ', $radical->meaning));
            })->asHtml(),
            Fields\Text::make('Image'),
            Fields\DateTime::make('Created At')->onlyOnDetail(),
            Fields\DateTime::make('Updated At')->onlyOnDetail(),

            Fields\BelongsToMany::make('Kanjis'),
        ];
    }
}
