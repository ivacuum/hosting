<?php namespace App\Console\Commands;

use App\Domain;
use App\Scope\DomainWhoisReadyScope;
use Ivacuum\Generic\Commands\Command;

class WhoisUpdate extends Command
{
    protected $signature = 'app:whois-update';
    protected $description = 'Update domains information';

    public function handle()
    {
        foreach (Domain::tap(new DomainWhoisReadyScope)->orderBy('paid_till')->get() as $domain) {
            $result = $domain->updateWhois();

            if (false === $result) {
                $this->error("{$domain->domain} failed");
                continue;
            }

            $this->info($domain->domain);
        }
    }
}
