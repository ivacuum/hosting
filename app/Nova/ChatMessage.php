<?php namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields;

class ChatMessage extends Resource
{
    public static $group = 'Resources';
    public static $model = \App\ChatMessage::class;
    public static $title = 'title';
    public static $search = [
        'id',
    ];

    public function fields(Request $request)
    {
        return [
            Fields\ID::make()->sortable(),
            Fields\BelongsTo::make('User')->searchable(),
            Fields\Text::make('IP')->onlyOnDetail(),
            Fields\Select::make('Status')->options([
                \App\ChatMessage::STATUS_HIDDEN => 'Hidden',
                \App\ChatMessage::STATUS_PUBLISHED => 'Published',
            ])->displayUsingLabels(),
            Fields\Text::make('Text'),
            Fields\DateTime::make('Created At')->exceptOnForms(),
            Fields\DateTime::make('Updated At')->onlyOnDetail(),
        ];
    }
}
