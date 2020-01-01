<?php namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields;

/** @mixin \App\Kanji */
class Kanji extends Resource
{
    public static $group = '🇯🇵 Japanese';
    public static $model = \App\Kanji::class;
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
            Fields\Text::make('Meaning', fn () => implode('<br>', explode(', ', $this->meaning)))->asHtml(),
            Fields\Text::make('Onyomi')->hideFromIndex(),
            Fields\Text::make('Kunyomi')->hideFromIndex(),
            Fields\Select::make('Important Reading')->options([
                'onyomi' => 'onyomi',
                'kunyomi' => 'kunyomi',
            ])->hideFromIndex(),
            Fields\Text::make('Nanori')->hideFromIndex(),
            Fields\DateTime::make('Created At')->onlyOnDetail(),
            Fields\DateTime::make('Updated At')->onlyOnDetail(),

            Fields\BelongsToMany::make('Radicals'),
            Fields\BelongsToMany::make('Similar Kanji', 'similar', static::class),
        ];
    }
}
