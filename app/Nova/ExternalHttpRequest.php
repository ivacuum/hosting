<?php namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields;

class ExternalHttpRequest extends Resource
{
    public static $group = 'Site';
    public static $model = \App\ExternalHttpRequest::class;
    public static $title = 'id';
    public static $search = [];

    public function fields(Request $request)
    {
        return [
            Fields\ID::make()->sortable(),
            Fields\Text::make('Service Name'),
            Fields\Text::make('Method'),
            Fields\Text::make('Scheme'),
            Fields\Text::make('Host'),
            Fields\Text::make('Path'),
            Fields\Text::make('Query')->hideFromIndex(),
            Fields\Code::make('Request Headers')->json(),
            Fields\Text::make('Request Body')->hideFromIndex(),
            Fields\Code::make('Response Headers')->json(),
            Fields\Code::make('Response Body')->json(),
            Fields\Code::make('Raw Response Body', 'response_body'),
            Fields\Number::make('Response Size')->hideFromIndex(),
            Fields\Number::make('Total Time µs', 'total_time_us')->hideFromIndex(),
            Fields\Number::make('HTTP Code'),
            Fields\Number::make('HTTP Version')->hideFromIndex(),
            Fields\Number::make('Redirect Count')->hideFromIndex(),
            Fields\Number::make('Redirect Time µs', 'redirect_time_us')->hideFromIndex(),
            Fields\Text::make('Redirect URL')->hideFromIndex(),
            Fields\DateTime::make('Created At'),
        ];
    }
}
