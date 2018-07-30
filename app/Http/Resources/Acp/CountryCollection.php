<?php namespace App\Http\Resources\Acp;

use App\Country;

class CountryCollection extends ResourceCollection
{
    public function with($request)
    {
        return [
            'meta' => [
                'new_url' => \Auth::user()->can('create', Country::class) ? path('Acp\Countries@create') : null,
            ],
        ];
    }
}
