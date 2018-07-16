<?php namespace App\Http\Resources\Acp;

use App\Trip;

class TripCollection extends ResourceCollection
{
    public function with($request)
    {
        return [
            'meta' => [
                'new_url' => \Auth::user()->can('create', Trip::class) ? path('Acp\Trips@create') : null,
            ],
        ];
    }
}
