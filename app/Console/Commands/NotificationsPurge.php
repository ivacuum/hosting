<?php namespace App\Console\Commands;

use Carbon\Carbon;

class NotificationsPurge extends Command
{
    protected $signature = 'app:notifications-purge';
    protected $description = 'Purge notifications from database';

    public function handle()
    {
        $notifications = \DB::table('notifications')
            ->whereNull('read_at')
            ->where('created_at', '<', Carbon::now()->subDays(7)->toDateTimeString())
            ->delete();

        $this->info("Удалено непрочитанных более недели уведомлений: {$notifications}");

        $notifications = \DB::table('notifications')
            ->where('read_at', '<', Carbon::now()->subDay()->toDateTimeString())
            ->delete();

        $this->info("Удалено прочитанных более одного дня уведомлений: {$notifications}");
    }
}
