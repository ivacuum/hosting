<?php namespace App\Console\Commands;

use App\Domain;
use App\Services\YandexPdd\YandexPddClient;
use Ivacuum\Generic\Commands\Command;

class YandexPddDkimStatus extends Command
{
    protected $signature = 'app:yandex-pdd-dkim-status {domain}';
    protected $description = '';

    public function handle(YandexPddClient $yandexPdd)
    {
        /** @var Domain $domain */
        $domain = Domain::where('domain', $this->argument('domain'))->firstOrFail();

        $response = $yandexPdd->dkimStatus($domain->yandexUser->token, $domain->domain, true);

        echo $response->secretKey;
    }
}
