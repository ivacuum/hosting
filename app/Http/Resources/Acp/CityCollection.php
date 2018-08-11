<?php namespace App\Http\Resources\Acp;

use App\City;

class CityCollection extends ResourceCollection
{
    public function with($request)
    {
        return [
            'meta' => [
                'new_url' => \Auth::user()->can('create', City::class) ? path('Acp\Cities@create') : null,
            ],
        ];
    }
}