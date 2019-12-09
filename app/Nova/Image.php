<?php namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields;

/** @mixin \App\Image */
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
            Fields\BelongsTo::make('User')->searchable(),
            Fields\Image::make('Image', function () {
                return $this->thumbnailUrl();
            })->thumbnail(function ($image) {
                return $image;
            }),
            Fields\Number::make('Size', function () {
                return \ViewHelper::size($this->size);
            })->exceptOnForms()->asHtml(),
            Fields\Number::make('Views')->exceptOnForms(),
            Fields\DateTime::make('Created At')->exceptOnForms(),
            Fields\DateTime::make('Updated At')->onlyOnDetail(),
        ];
    }
}
