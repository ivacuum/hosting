<?php namespace App\Http\Controllers\Acp;

use App\Domain\NotificationDeliveryMethod;
use App\Domain\UserStatus;
use App\Gig;
use App\Notifications\GigPublishedNotification;
use App\User;

class GigPublishedNotify
{
    public function __invoke(Gig $gig)
    {
        if (!$gig->status->isPublished()) {
            return [
                'status' => 'error',
                'message' => 'Для рассылки уведомлений концерт должен быть опубликован',
            ];
        }

        $users = User::where('notify_gigs', NotificationDeliveryMethod::Mail)
            ->where('status', UserStatus::Active)
            ->get();

        \Notification::send($users, new GigPublishedNotification($gig));

        return [
            'status' => 'OK',
            'message' => 'Уведомления разосланы пользователям: ' . sizeof($users),
        ];
    }
}
