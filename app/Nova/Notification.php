<?php namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields;

class Notification extends Resource
{
    public static $group = 'Site';
    public static $model = \App\Notification::class;
    public static $title = 'id';
    public static $search = [];

    public function fields(Request $request)
    {
        return [
            Fields\ID::make()->hideFromIndex(),
            Fields\MorphTo::make('Notifiable'),
            Fields\Text::make('Type', function (\App\Notification $notification) {
                return $notification->basename();
            }),
            Fields\KeyValue::make('Data'),
            Fields\DateTime::make('Created At')->exceptOnForms(),
            Fields\DateTime::make('Read At')->exceptOnForms(),
        ];
    }
}
