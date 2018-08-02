<?php namespace App\Http\Controllers\Acp;

use App\Notifications\TripPublished;
use App\Trip as Model;
use App\User;
use Ivacuum\Generic\Controllers\Acp\Controller;

class TripPublishedNotify extends Controller
{
    public function __invoke(int $id): array
    {
        /* @var Model $model */
        $model = $this->getModel($id);

        if ($model->status !== Model::STATUS_PUBLISHED) {
            return [
                'status' => 'error',
                'message' => 'Для рассылки уведомлений поездка должна быть опубликована',
            ];
        }

        $users = User::where('notify_trips', 1)
            ->where('status', User::STATUS_ACTIVE)
            ->get();

        \Notification::send($users, new TripPublished($model));

        return [
            'status' => 'OK',
            'message' => 'Уведомления разосланы пользователям: '.sizeof($users),
        ];
    }

    protected function getModelName(): string
    {
        return Model::class;
    }
}
