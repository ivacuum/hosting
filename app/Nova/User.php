<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields;

class User extends Resource
{
    public static $group = 'Site';
    public static $model = \App\User::class;
    public static $title = 'email';
    public static $search = [
        'id',
        'email',
    ];

    public function fields(Request $request)
    {
        return [
            Fields\ID::make()->sortable(),

            Fields\Text::make('Login')
                ->rules('max:255'),

            Fields\Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:255')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Fields\Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            Fields\DateTime::make('Created At')->exceptOnForms(),
            Fields\DateTime::make('Updated At')->onlyOnDetail(),
            Fields\DateTime::make('Last Login At')->exceptOnForms(),
            Fields\DateTime::make('Password Changed At')->exceptOnForms(),

            Fields\HasMany::make('Chat Messages', 'chatMessages'),
            Fields\HasMany::make('Comments'),
            Fields\HasMany::make('External Identities', 'externalIdentities'),
        ];
    }
}
