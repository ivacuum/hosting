<?php namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields;

/** @mixin \App\Notification */
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
            Fields\Text::make('Type', fn () => $this->basename()),
            Fields\KeyValue::make('Data'),
            Fields\DateTime::make('Created At')->exceptOnForms(),
            Fields\DateTime::make('Read At')->exceptOnForms(),
        ];
    }
}
