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
     *
     * @param \App\Domain $domain
     * @param array $new
     * @return array
     */
    protected function checkForChanges(Domain $domain, array $new): array
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
            if (!str_contains($new['ns'], 'dns1.yandex.') ||
                !str_contains($domain->ns, 'dns1.yandex.')
            ) {
                $diff['ns'] = ['from' => $domain->ns, 'to' => $new['ns']];
            }
        }

        if ($new['registered_at']->diffInDays($domain->registered_at) > 300) {
            $diff['registered_at'] = [
                'from' => (string) $domain->registered_at,
                'to' => (string) $new['registered_at'],
            ];
        }

        if (isset($new['paid_till']) && $new['paid_till']->diffInHours($domain->paid_till) > 24) {
            $diff['paid_till'] = [
                'from' => (string) $domain->paid_till,
                'to' => (string) $new['paid_till'],
            ];
        }

        return $diff;
    }

    protected function mail($domain, $diff, $data)
    {
        register_shutdown_function(function () use ($domain, $diff, $data) {
            $this->mailer->send(
                'emails.whois.changed',
                ['diff' => $diff, 'data' => $data],
                function ($mail) use ($domain) {
                    $mail->to('domains@ivacuum.ru')
                        ->subject($domain->domain);
                }
            );
        });
    }
}
