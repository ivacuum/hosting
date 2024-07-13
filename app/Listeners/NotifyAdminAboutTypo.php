<?php

namespace App\Listeners;

use App\Events\TypoReported;
use App\Notifications\TypoReportedNotification;
use App\User;

class NotifyAdminAboutTypo
{
    public function handle(TypoReported $event): void
    {
        $admin = User::query()->first();

        if ($admin === null) {
            return;
        }

        $admin->notify(new TypoReportedNotification($event->selection, $event->page));
    }
}
