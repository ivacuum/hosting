<?php namespace App\Http\Resources\Acp;

use App\Trip;

class TripCollection extends ResourceCollection
{
    public function with($request)
    {
        /** @var \App\User $me */
        $me = $request->user();

        return [
            'meta' => [
                'new_url' => $me->can('create', Trip::class) ? path(['App\Http\Controllers\Acp\Trips', 'create']) : null,
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
