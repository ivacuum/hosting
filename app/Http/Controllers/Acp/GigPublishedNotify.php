<?php namespace App\Http\Controllers\Acp;

use App\Gig as Model;
use App\Notifications\GigPublished;
use App\User;
use Ivacuum\Generic\Controllers\Acp\Controller;

class GigPublishedNotify extends Controller
{
    public function __invoke(int $id): array
    {
        /* @var Model $model */
        $model = $this->getModel($id);

        if ($model->status !== Model::STATUS_PUBLISHED) {
            return [
                'status' => 'error',
                'message' => 'Для рассылки уведомлений концерт должен быть опубликован',
            ];
        }

        $users = User::where('notify_gigs', 1)
            ->where('status', User::STATUS_ACTIVE)
            ->get();

        \Notification::send($users, new GigPublished($model));

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
