<?php

namespace App\Listeners;

use App\Events\TypoReported;
use App\Notifications\TypoReceivedNotification;
use App\User;

class NotifyAdminAboutTypo
{
    public function handle(TypoReported $event): void
    {
        $admin = User::first();

        if ($admin === null) {
            return;
        }

        $admin->notify(new TypoReceivedNotification($event->selection, $event->page));
    }
}
