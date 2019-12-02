<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields;

class Image extends Resource
{
    public static $group = 'Resources';
    public static $model = \App\Image::class;
    public static $title = 'slug';
    public static $search = [
        'id',
        'slug',
    ];

    public function fields(Request $request)
    {
        return [
            Fields\ID::make()->sortable(),
            Fields\BelongsTo::make('User'),
            Fields\Image::make('Image', function (\App\Image $image) {
                return $image->thumbnailUrl();
            })->thumbnail(function ($image) {
                return $image;
            }),
            Fields\Number::make('Size', function (\App\Image $image) {
                return \ViewHelper::size($image->size);
            })->exceptOnForms()->asHtml(),
            Fields\Number::make('Views')->exceptOnForms(),
            Fields\DateTime::make('Created At')->exceptOnForms(),
            Fields\DateTime::make('Updated At')->onlyOnDetail(),
        ];
    }
}
