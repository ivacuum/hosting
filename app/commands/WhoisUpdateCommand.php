<?php

use Illuminate\Console\Command;

class WhoisUpdateCommand extends Command
{
	protected $name = 'app:whois-update';
	protected $description = 'Update domains information';

	public function fire()
	{
		foreach (Domain::whoisReady()->orderBy('paid_till')->get() as $domain) {
			$result = $domain->updateWhois();
			
			if (false === $result) {
				$this->error($domain->domain);
				continue;
			} elseif (true === $result) {
				$this->info($domain->domain);
				continue;
			}
			
			$this->info("{$domain->domain} " . json_encode($result));
		}
	}
}
