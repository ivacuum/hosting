<?php

namespace App\Http\Controllers\Acp;

use App\Domain\Life\Job\NotifyTripSubscribersJob;
use App\Domain\Life\Models\Trip;
use App\Http\Requests\Acp\TripPublishedNotifyRequest;

class TripPublishedNotifyController
{
    public function __invoke(Trip $trip, TripPublishedNotifyRequest $request)
    {
        if (!$trip->status->isPublished()) {
            return [
                'status' => 'error',
                'message' => 'Для рассылки уведомлений поездка должна быть опубликована',
            ];
        }

        NotifyTripSubscribersJob::dispatch($trip)
            ->delay($request->date);

        return [
            'status' => 'OK',
            'message' => 'Рассылка уведомлений добавлена в очередь',
        ];
    }
}
