<?php

namespace App\Http\Controllers\Acp;

use App\Domain\Life\Models\Gig;
use App\Domain\Life\Notification\GigPublishedNotification;
use App\Domain\NotificationDeliveryMethod;
use App\Domain\UserStatus;
use App\User;

class GigPublishedNotifyController
{
    public function __invoke(Gig $gig)
    {
        if (!$gig->status->isPublished()) {
            return [
                'status' => 'error',
                'message' => 'Для рассылки уведомлений концерт должен быть опубликован',
            ];
        }

        $users = User::query()
            ->where('notify_gigs', NotificationDeliveryMethod::Mail)
            ->where('status', UserStatus::Active)
            ->get();

        \Notification::send($users, new GigPublishedNotification($gig));

        return [
            'status' => 'OK',
            'message' => "Уведомления разосланы пользователям: {$users->count()}",
        ];
    }
}
