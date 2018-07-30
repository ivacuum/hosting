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
            'filters' => [[
                'field' => 'status',
                'title' => trans('model.trip.status'),
                'values' => [
                    ['label' => 'Опубликованные', 'value' => Trip::STATUS_PUBLISHED],
                    ['label' => 'Пишутся', 'value' => Trip::STATUS_INACTIVE],
                    ['label' => 'Скрытые', 'value' => Trip::STATUS_HIDDEN],
                ]
            ]],
        ];
    }
}
