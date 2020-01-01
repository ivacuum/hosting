<?php namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields;

/** @mixin \App\Vocabulary */
class Vocabulary extends Resource
{
    public static $group = '🇯🇵 Japanese';
    public static $model = \App\Vocabulary::class;
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
            Fields\Text::make('Kana'),
            Fields\DateTime::make('Created At')->onlyOnDetail(),
            Fields\DateTime::make('Updated At')->onlyOnDetail(),
        ];
    }
}
