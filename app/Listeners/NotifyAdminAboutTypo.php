<?php

namespace App\Listeners;

use App\Events\TypoReported;
use App\Models\User;
use App\Notifications\TypoReportedNotification;

class NotifyAdminAboutTypo
{
    public function handle(TypoReported $event): void
    {
        $admin = User::query()
            ->where('root', true)
            ->orderBy('id')
            ->first();

        if ($admin === null) {
            return;
        }

        $admin->notify(new TypoReportedNotification($event->selection, $event->page));
    }
}
