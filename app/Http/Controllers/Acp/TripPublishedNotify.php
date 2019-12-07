<?php namespace App\Http\Controllers\Acp;

use App\Http\Requests\Acp\TripPublishedNotifyRequest;
use App\Jobs\NotifyTripSubscribers;
use App\Trip as Model;
use Illuminate\Support\Carbon;
use Ivacuum\Generic\Controllers\Acp\Controller;

class TripPublishedNotify extends Controller
{
    public function __invoke(int $id, TripPublishedNotifyRequest $request): array
    {
        /** @var Model $model */
        $model = $this->getModel($id);

        if ($model->isNotPublished()) {
            return [
                'status' => 'error',
                'message' => 'Для рассылки уведомлений поездка должна быть опубликована',
            ];
        }

        NotifyTripSubscribers::dispatch($model)
            ->delay(Carbon::parse($request->input('date')));

        return [
            'status' => 'OK',
            'message' => 'Рассылка уведомлений добавлена в очередь',
        ];
    }

    protected function getModelName(): string
    {
        return Model::class;
    }
}
