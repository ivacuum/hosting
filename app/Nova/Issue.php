<?php namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields;

class Issue extends Resource
{
    public static $group = 'Site';
    public static $model = \App\Issue::class;
    public static $title = 'title';
    public static $search = [
        'id',
    ];

    public function fields(Request $request)
    {
        return [
            Fields\ID::make()->sortable(),
            Fields\BelongsTo::make('User')->searchable(),
            Fields\Text::make('Name')->exceptOnForms(),
            Fields\Text::make('Email')->exceptOnForms(),
            Fields\Text::make('Title')->exceptOnForms(),
            Fields\Text::make('Text')->exceptOnForms(),
            Fields\Text::make('Page')->exceptOnForms(),
            Fields\Select::make('Status')->options([
                \App\Issue::STATUS_PENDING => 'Pending',
                \App\Issue::STATUS_OPEN => 'Open',
                \App\Issue::STATUS_CLOSED => 'Closed',
            ])->displayUsingLabels(),
            Fields\DateTime::make('Created At')->exceptOnForms(),
            Fields\DateTime::make('Updated At')->onlyOnDetail(),

            Fields\HasMany::make('Comments'),
        ];
    }
}
