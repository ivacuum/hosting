<?php namespace App\Console\Commands;

use App\Action\GetWhoisDataAction;
use App\Domain;
use App\Events\DomainWhoisUpdated;
use App\Scope\DomainWhoisReadyScope;
use Ivacuum\Generic\Commands\Command;

class WhoisUpdate extends Command
{
    protected $signature = 'app:whois-update';
    protected $description = 'Update domains information';

    public function handle(GetWhoisDataAction $getWhoisData)
    {
        foreach (Domain::tap(new DomainWhoisReadyScope)->orderBy('paid_till')->get() as $domain) {
            if (empty($data = $getWhoisData->execute($domain->domain))) {
                $this->error("Failed to update whois data for {$domain->domain}");

                continue;
            }

            event(new DomainWhoisUpdated($domain, $data));

            $domain->update($data);

            $this->info($domain->domain);
        }
    }
}
