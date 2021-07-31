<?php namespace App\Http\Controllers\Acp;

use App\Http\Requests\Acp\TripPublishedNotifyRequest;
use App\Jobs\NotifyTripSubscribers;
use App\Trip;

class TripPublishedNotify extends AbstractController
{
    public function __invoke(Trip $trip, TripPublishedNotifyRequest $request)
    {
        if (!$trip->status->isPublished()) {
            return [
                'status' => 'error',
                'message' => 'Для рассылки уведомлений поездка должна быть опубликована',
            ];
        }

        NotifyTripSubscribers::dispatch($trip)
            ->delay($request->date());

        return [
            'status' => 'OK',
            'message' => 'Рассылка уведомлений добавлена в очередь',
        ];
    }

    protected function getModelName(): string
    {
        return Trip::class;
    }
}
