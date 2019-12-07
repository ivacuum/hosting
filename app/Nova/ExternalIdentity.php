<?php namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields;

class ExternalIdentity extends Resource
{
    public static $group = 'Site';
    public static $model = \App\ExternalIdentity::class;
    public static $title = 'email';
    public static $search = [
        'id',
    ];

    public function fields(Request $request)
    {
        return [
            Fields\ID::make()->sortable(),
            Fields\BelongsTo::make('User'),
            Fields\Text::make('Provider'),
            Fields\Text::make('UID'),
            Fields\Text::make('Email'),
            Fields\DateTime::make('Created At')->exceptOnForms(),
            Fields\DateTime::make('Updated At')->onlyOnDetail(),
        ];
    }
}
