<?php namespace App\Http\Controllers\Acp;

use App\Gig;
use App\Notifications\GigPublishedNotification;
use App\User;
use Ivacuum\Generic\Controllers\Acp\Controller;

class GigPublishedNotify extends Controller
{
    public function __invoke(Gig $gig)
    {
        if ($gig->isNotPublished()) {
            return [
                'status' => 'error',
                'message' => 'Для рассылки уведомлений концерт должен быть опубликован',
            ];
        }

        $users = User::where('notify_gigs', 1)
            ->where('status', User::STATUS_ACTIVE)
            ->get();

        \Notification::send($users, new GigPublishedNotification($gig));

        return [
            'status' => 'OK',
            'message' => 'Уведомления разосланы пользователям: '.sizeof($users),
        ];
    }

    protected function getModelName(): string
    {
        return Gig::class;
    }
}
