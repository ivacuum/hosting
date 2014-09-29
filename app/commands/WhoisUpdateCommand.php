<?php

use Illuminate\Console\Command;

class WhoisUpdateCommand extends Command
{
	protected $name = 'app:whois-update';
	protected $description = 'Update domains information.';

	public function fire()
	{
		foreach (Domain::whoisReady()->orderBy('paid_till')->get() as $domain) {
			if (empty($data = $domain->getWhoisParsedData())) {
				$this->error($domain->domain);
				continue;
			}
			
			$diff = $this->checkForChanges($domain, $data);
			$domain->update($data);

			if (!empty($diff)) {
				Mail::send('emails.whois.changed', compact('diff', 'data'), function($mail) use ($domain) {
					$mail->to('domains@ivacuum.ru')
						->subject($domain->domain);
				});
				
				$this->info("{$domain->domain} " . json_encode($diff));
				continue;
			}

			$this->info($domain->domain);
		}
	}
	
	/**
	* Проверка изменения данных домена (ip, mx, ns, etc.)
	*/
	protected function checkForChanges(Domain $current, array $new)
	{
		$diff = [];
		
		if ($new['ipv4'] != $current->ipv4) {
			$diff['ipv4'] = ['from' => $current->ipv4, 'to' => $new['ipv4']];
		}
		
		if ($new['ipv6'] != $current->ipv6) {
			$diff['ipv6'] = ['from' => $current->ipv6, 'to' => $new['ipv6']];
		}
		
		if ($new['mx'] != $current->mx) {
			$diff['mx'] = ['from' => $current->mx, 'to' => $new['mx']];
		}
		
		if ($new['ns'] != $current->ns) {
			$diff['ns'] = ['from' => $current->ns, 'to' => $new['ns']];
		}
		
		if ($new['registered_at']->diffInDays($current->registered_at) > 300) {
			$diff['registered_at'] = [
				'from' => (string) $current->registered_at,
				'to'   => (string) $new['registered_at']
			];
		}
		
		if ($new['paid_till']->diffInHours($current->paid_till) > 24) {
			$diff['paid_till'] = [
				'from' => (string) $current->paid_till,
				'to'   => (string) $new['paid_till'],
			];
		}

		return $diff;
	}
}
