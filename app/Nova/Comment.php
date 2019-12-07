<?php namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields;

class Comment extends Resource
{
    public static $group = 'Resources';
    public static $model = \App\Comment::class;
    public static $title = 'title';
    public static $search = [
        'id',
    ];

    public function fields(Request $request)
    {
        return [
            Fields\ID::make()->sortable(),
            Fields\BelongsTo::make('User'),
            Fields\Select::make('Status')->options([
                \App\Comment::STATUS_HIDDEN => 'Hidden',
                \App\Comment::STATUS_PUBLISHED => 'Published',
                \App\Comment::STATUS_PENDING => 'Pending',
            ])->displayUsingLabels(),
            Fields\Text::make('HTML')->asHtml(),
            Fields\DateTime::make('Created At')->exceptOnForms(),
            Fields\DateTime::make('Updated At')->onlyOnDetail(),
        ];
    }
}
