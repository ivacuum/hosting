<?php namespace App\Console\Commands;

use Ivacuum\Generic\Commands\Command;

class ExternalHttpRequestsPurge extends Command
{
    protected $signature = 'app:external-http-requests-purge';
    protected $description = 'Purge external http requests from database';

    public function handle()
    {
        $deleted = \DB::table('external_http_requests')
            ->where('created_at', '<', now()->subWeeks(2)->toDateTimeString())
            ->delete();

        $this->info("Удалено логов запросов к внешним сервисам: {$deleted}");
    }
}
