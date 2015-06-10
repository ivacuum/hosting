<?php namespace App\Console\Commands;

use App\Domain;

class WhoisUpdate extends Command
{
	protected $signature = 'app:whois-update';
	protected $description = 'Update domains information';

	public function handle()
	{
		foreach (Domain::whoisReady()->orderBy('paid_till')->get() as $domain) {
			$result = $domain->updateWhois();
			
			if (false === $result) {
				$this->error("{$domain->domain} failed");
				continue;
			} elseif (true === $result) {
				$this->info($domain->domain);
				continue;
			}
			
			$this->info("{$domain->domain} " . json_encode($result));
		}
	}
}
