<?php namespace App\Listeners;

use App\Domain;
use App\Events\DomainWhoisUpdated;
use Illuminate\Contracts\Mail\Mailer;

class EmailWhoisChanges
{
    protected $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function handle(DomainWhoisUpdated $event)
    {
        $diff = $this->checkForChanges($event->domain, $event->data);

        if (!empty($diff)) {
            $this->mail($event->domain, $diff, $event->data);
        }
    }

    /**
    * Проверка изменения данных домена (ip, mx, ns, etc.)
    */
    protected function checkForChanges(Domain $domain, array $new)
    {
        $diff = [];

        if (!$domain->isExpired() && isset($new['ipv4']) && $new['ipv4'] != $domain->ipv4) {
            $diff['ipv4'] = ['from' => $domain->ipv4, 'to' => $new['ipv4']];
        }

        if (isset($new['ipv6']) && $new['ipv6'] != $domain->ipv6) {
            $diff['ipv6'] = ['from' => $domain->ipv6, 'to' => $new['ipv6']];
        }

        if (isset($new['mx']) && $new['mx'] != $domain->mx) {
            $diff['mx'] = ['from' => $domain->mx, 'to' => $new['mx']];
        }

        if (isset($new['ns']) && $new['ns'] && $new['ns'] != $domain->ns) {
            // Workaround dns1.yandex.ru to dns1.yandex.net and vice versa
            if (false === strpos($new['ns'], 'dns1.yandex.') ||
                false === strpos($domain->ns, 'dns1.yandex.')
            ) {
                $diff['ns'] = ['from' => $domain->ns, 'to' => $new['ns']];
            }
        }

        if ($new['registered_at']->diffInDays($domain->registered_at) > 300) {
            $diff['registered_at'] = [
                'from' => (string) $domain->registered_at,
                'to'   => (string) $new['registered_at']
            ];
        }

        if (isset($new['paid_till']) && $new['paid_till']->diffInHours($domain->paid_till) > 24) {
            $diff['paid_till'] = [
                'from' => (string) $domain->paid_till,
                'to'   => (string) $new['paid_till'],
            ];
        }

        return $diff;
    }

    protected function mail($domain, $diff, $data)
    {
        register_shutdown_function(
            [$this->mailer, 'send'],
            'emails.whois.changed',
            compact('diff', 'data'),
            function ($mail) use ($domain) {
                $mail->to('domains@ivacuum.ru')
                    ->subject($domain->domain);
            }
        );
    }
}
