<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;

class User extends Resource
{
    public static $model = \App\User::class;
    public static $title = 'email';
    public static $search = [
        'id',
        'email',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Login')
                ->rules('max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:255')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            DateTime::make('Created At')->exceptOnForms(),
            DateTime::make('Updated At')->onlyOnDetail(),
            DateTime::make('Last Login At')->exceptOnForms(),
            DateTime::make('Password Changed At')->exceptOnForms(),
        ];
    }
}
